<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

use App\Pod;
use App\Account;
use App\Libraries\EjabberdAPI;

class AccountsController extends Controller
{
    private $domain = 'movim.eu';

    public function login(Request $request)
    {
        if (Auth::guard('panel')->check()) {
            return redirect()->route('accounts.panel');
        }

        return view('accounts.login');
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
            'You are trying to authenticate to the Movim Account Panel, here is the unique to confirm your authentication: '.route('accounts.authenticate', $account->auth_key)
        );

        return view('accounts.auth_requested');
    }

    public function authenticate(Request $request, string $key)
    {
        $account = Account::where('auth_key', $key)->firstOrFail();

        Auth::guard('panel')->login($account);

        $account->auth_key = null;
        $account->save();

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
        $account = $request->user();
        $account->email_notification = (bool)$enabled;
        $account->save();

        return redirect()->route('accounts.emailToXMPP');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return redirect()->route('accounts.login');
    }

    public function create(Request $request)
    {
        if($this->checkRestricted(\geoip_record_by_name($_SERVER['REMOTE_ADDR']))) {
            return response()->view('accounts.disabled');
        }

        return view('accounts.create', [
            'referer' => $request->header('referer'),
            'registration' => config('app.xmpp_registration')
        ]);
    }

    public function legals(Request $request)
    {
        return view('accounts.legals');
    }

    public function store(Request $request)
    {
        $geo = geoip_record_by_name($_SERVER['REMOTE_ADDR']);

        if($this->checkRestricted($geo)) {
            return view('accounts.disabled');
        }

        if(!config('app.xmpp_registration')) return;

        $this->validate($request, [
            'username'              => 'required|alpha_dash|between:4,20',
            'legals'                => 'required',
            'g-recaptcha-response'  => 'required|captcha',
            'password'              => 'required|confirmed|min:8'
        ]);

        $command = 'sudo -u ejabberd ' . config('app.ejabberd_path') . ' --no-timeout --config-dir /etc/ejabberd/ register '.
            escapeshellarg($request->get('username')).
            ' '.
            $this->domain.
            ' '.
            escapeshellarg($request->get('password'));

        $output = [];
        exec($command, $output);

        // Check if user could be registered
        foreach($output as $line) {
            if(preg_match('/User '.$request->get('username').'@'.$this->domain.' successfully registered/i', $line)) {

                $account = new Account;
                $account->username = $request->get('username');
                $account->ip = $_SERVER['REMOTE_ADDR'];

                if($geo) {
                    $account->country_code = $geo['country_code'];
                    $account->region = $geo['region'];
                    $account->city = utf8_encode($geo['city']);
                    $account->latitude = $geo['latitude'];
                    $account->longitude = $geo['longitude'];
                }

                $account->save();

                return view('accounts.created', [
                    'jid'       => $request->get('username').'@'.$this->domain,
                    'referer'   => $request->get('referer'),
                    'pods'      => Pod::where('activated','=', 1)
                        ->where('favorite','=',1)
                        ->get()
                ]);
            }

            if(preg_match('/Error: conflict/i', $line)) {
                return redirect()->back()->withInput()->withErrors(['user' => 'User already exists']);
            }
        }

        return redirect()->back()->withInput()->withErrors(['user' => 'Unknown error']);
    }

    private function checkRestricted($geo)
    {
        $restrictedCountries = explode(',', config('app.restricted_countries'));
        return (is_array($geo) && in_array($geo['country_code'], $restrictedCountries));
    }
}
