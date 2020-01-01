<?php

namespace App\Http\Controllers;

use FeedCleaner\Parser;
use Illuminate\Http\Request;

use App\Pod;
use App\Account;

class AccountsController extends Controller
{
    private $domain = 'movim.eu';

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
                    $account->city = $geo['city'];
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
