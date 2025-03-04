<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

use GuzzleHttp\Exception\RequestException;

use App\Account;
use App\Libraries\EjabberdAPI;
use App\Libraries\StringPrep;
use App\Mail\AuthenticationLink;

class AccountsController extends Controller
{
    private $domains = ['movim.eu', 'jappix.com'];

    public function login(Request $request)
    {
        if (Auth::guard('panel')->check()) {
            return redirect()->route('accounts.panel');
        }

        return view('accounts.login');
    }

    public function resolveNickname(Request $request, string $nickname)
    {
        return response()->json([
            'username' => StringPrep::resolve($nickname)
        ]);
    }

    public function panel(Request $request)
    {
        return view('accounts.panel', [
            'account' => $request->user()
        ]);
    }

    public function requestAuthentication(Request $request)
    {
        $request->validate(['username' => 'required|ends_with:@movim.eu,@jappix.com']);

        list($username, $domain) = explode('@', $request->input('username'));

        $api = new EjabberdAPI;
        if (!$api->checkAccount($username, $domain)) {
            return view('accounts.login')->withErrors(['username' => 'Invalid account']);
        }

        $account = Account::where([
            'username' => $username,
            'domain' => $domain,
        ])->first();

        if (!$account) {
            $account = new Account;
            $account->username = $username;
            $account->domain = $domain;
        }

        $account->auth_key = Str::random(40);
        $account->save();

        // Send the XMPP message to the related account
        $api->sendMessage(
            $account->jid,
            'Authentication request',
            'You are trying to authenticate to the Movim Account Panel, here is the unique link to confirm your authentication: '.route('accounts.authenticate', $account->auth_key)
        );

        // And if the account has an attached email address, send the link by email
        $email = $api->getEmail($username, $domain);

        if ($email && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Mail::to($email)->send(new AuthenticationLink($account));
        }

        return view('accounts.auth_requested', [
            'email' => $email
        ]);
    }

    public function authenticate(string $key)
    {
        $account = Account::where('auth_key', $key)->firstOrFail();

        Auth::guard('panel')->login($account);

        $account->auth_key = null;
        $account->save();

        $api = new EjabberdAPI;
        $api->sendMessage(
            $account->jid,
            'Authentication authorized',
            'You are now authentified on the Movim Account Panel'
        );

        return redirect()->route('accounts.panel');
    }

    public function emailToXMPP(Request $request)
    {
        return view('accounts.email_to_xmpp', [
            'account' => $request->user()
        ]);
    }

    public function setEmailToXMPP(Request $request, $enabled)
    {
        /*$account = $request->user();
        $account->email_notification = (bool)$enabled;
        $account->save();

        $api = new EjabberdAPI;
        $api->sendMessage(
            $account->jid,
            'Email To XMPP',
            $account->email_notification
                ? 'The Email To XMPP feature is now enabled for your account, you can try to send an email to "'.$account->jid.'" to try it'
                : 'The Email To XMPP feature has been disabled for your account'
        );

        return redirect()->route('accounts.emailToXMPP');*/
    }

    public function changePassword(Request $request)
    {
        return view('accounts.change_password', [
            'account' => $request->user()
        ]);
    }

    public function setChangePassword(Request $request)
    {
        $this->validate($request, [
            'h-captcha-response'    => 'required|HCaptcha',
            'password'              => 'required|confirmed|min:8'
        ]);

        $account = $request->user();

        $api = new EjabberdAPI;
        $api->changePassword(
            $account->username,
            $account->domain,
            $request->get('password')
        );

        $api->sendMessage(
            $account->jid,
            'Password changed',
            'Your account password was successfully updated'
        );

        return redirect()->route('accounts.panel');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('accounts.login');
    }

    public function create(Request $request)
    {
        /*if($this->checkRestricted(\geoip_record_by_name($_SERVER['REMOTE_ADDR']))) {
            return response()->view('accounts.disabled');
        }*/

        return view('accounts.create', [
            'referer' => $request->header('referer'),
            'registration' => config('app.xmpp_registration'),
            'domains' => $this->domains,
        ]);
    }

    public function legals(Request $request)
    {
        return view('accounts.legals');
    }

    public function store(Request $request)
    {
        /*$geo = geoip_record_by_name($_SERVER['REMOTE_ADDR']);

        if($this->checkRestricted($geo)) {
            return view('accounts.disabled');
        }*/

        if(!config('app.xmpp_registration')) return;

        $this->validate($request, [
            'email'                 => 'email|nullable',
            'username'              => 'required|alpha_dash|between:4,20',
            'legals'                => 'required',
            'domain'                => ['required', Rule::in($this->domains)],
            'h-captcha-response'    => 'required|HCaptcha',
            'password'              => 'required|confirmed|between:8,100'
        ]);

        $username = StringPrep::resolve($request->get('username'));

        try {
            $api = new EjabberdAPI;
            $api->register(
                $username,
                $request->get('domain'),
                $request->get('password')
            );

            if ($request->filled('email')) {
                $api->setEmail(
                    $username,
                    $request->get('domain'),
                    $request->get('email')
                );
            }

            $account = new Account;
            $account->username = $username;
            $account->ip = $_SERVER['REMOTE_ADDR'];

            /*if ($geo) {
                $account->country_code = $geo['country_code'];
                $account->region = $geo['region'];
                $account->city = utf8_encode($geo['city']);
                $account->latitude = $geo['latitude'];
                $account->longitude = $geo['longitude'];
            }*/

            if (config('app.xmpp_admin_notify')) {
                $notify = $username.'@'.$request->get('domain').' registered';

                if ($request->filled('email')) {
                    $notify .= ' with an email address';
                }

                $api->sendMessage(
                    config('app.xmpp_admin_notify'),
                    'Account registered',
                    $notify
                );
            }

            $account->save();

            return view('accounts.created', [
                'jid'       => $username.'@'.$request->get('domain'),
                'referer'   => $request->get('referer')
            ]);
        } catch (RequestException $exception) {
            if ($exception->getCode() == 409) {
                return redirect()->back()->withInput()->withErrors(['user' => 'User already exists']);
            }

            if ($exception->getCode() == 400) {
                return redirect()->back()->withInput()->withErrors(['user' => 'Bad request']);
            }

            return redirect()->back()->withInput()->withErrors(['user' => 'Unknown error']);
        }
    }

    /*private function checkRestricted($geo)
    {
        $restrictedCountries = explode(',', config('app.restricted_countries'));
        return (is_array($geo) && in_array($geo['country_code'], $restrictedCountries));
    }*/
}
