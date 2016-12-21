<?php

namespace App\Http\Controllers;

use FeedCleaner\Parser;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    private $domain = 'movim.eu';

    public function create(Request $request)
    {
        return response()
            ->view('accounts.create', [
                'referer' => $request->header('referer')
            ]);
    }

    public function legals(Request $request)
    {
        return response()
            ->view('accounts.legals');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'username'              => 'required|between:4,20',
            'legals'                => 'required',
            'g-recaptcha-response'  => 'required|captcha',
            'password'              => 'required|confirmed|min:8'
        ]);

        $command = 'sudo metronomectl adduser '.
            escapeshellarg(
                $request->get('username').
                '@'.
                $this->domain
            ).
            ' '.
            escapeshellarg($request->get('password'));

        $output = [];
        exec($command, $output);

        // Check if user could be registered
        foreach($output as $line) {
            if(preg_match('/User successfully added/i', $line)) {
                return response()->view('accounts.created', [
                    'jid'       => $request->get('username').'@'.$this->domain,
                    'referer'   => $request->get('referer')
                ]);
            }

            if(preg_match('/User already exists/i', $line)) {
                return redirect()->back()->withInput()->withErrors(['user' => 'User already exists']);
            }
        }

        return redirect()->back()->withInput()->withErrors(['user' => 'Unknown error']);
    }
}
