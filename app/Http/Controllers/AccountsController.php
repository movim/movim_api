<?php

namespace App\Http\Controllers;

use FeedCleaner\Parser;
use Illuminate\Http\Request;

use App\Pod;

class AccountsController extends Controller
{
    private $domain = 'movim.eu';

    public function create(Request $request)
    {
        return response()
            ->view('accounts.create', [
                'referer' => $request->header('referer'),
                'registration' => config('app.xmpp_registration')
            ]);
    }

    public function legals(Request $request)
    {
        return response()
            ->view('accounts.legals');
    }

    public function store(Request $request)
    {
        if(!config('app.xmpp_registration')) return;

        $this->validate($request, [
            'username'              => 'required|between:4,20',
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
                return response()->view('accounts.created', [
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
}
