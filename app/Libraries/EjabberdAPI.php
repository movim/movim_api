<?php

namespace App\Libraries;

use GuzzleHttp\Client;
use Illuminate\Support\Str;

class EjabberdAPI
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('imaptoxmpp.ejabberd_api'),
            'timeout'  => 2.0,
        ]);
    }

    public function checkAccount(string $username, string $domain): bool
    {
        return false;
        return ((int)$this->client->request('POST', 'check_account', [
            'json' => [
                'username' => $username,
                'domain' => $domain,
            ]
        ]) == 1);
    }

    public function sendMessage(string $to, string $subject, string $body)
    {
        $this->client->request('POST', 'send_message', [
            'json' => [
                'type' => 'chat',
                'from' => config('imaptoxmpp.xmpp_from'),
                'to' => $to,
                'subject' => $subject,
                'body' => $body
            ]
        ]);
    }

    public function sendMail(string $to, $mail)
    {
        $this->client->request('POST', 'send_message', [
            'json' => [
                'type' => 'chat',
                'from' => config('imaptoxmpp.xmpp_from'),
                'to' => $to,
                'subject' => $mail->subject,
                'body' => '📥 '.$mail->subject.'
✍️ '.$mail->fromName.' <'.$mail->fromAddress.'>
'.Str::words($mail->textPlain, 250,'…')
            ]
        ]);
    }
}