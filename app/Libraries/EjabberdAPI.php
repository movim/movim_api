<?php

namespace App\Libraries;

use GuzzleHttp\Client;

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
        return ((string)$this->client->request('POST', 'check_account', [
            'json' => [
                'user' => $username,
                'host' => $domain,
            ]
        ])->getBody() == '0');
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

    public function register(string $user, string $host, string $password)
    {
        $this->client->request('POST', 'register', [
            'json' => [
                'user' => $user,
                'host' => $host,
                'password' => $password
            ]
        ]);
    }

    public function setEmail(string $user, string $host, string $email)
    {
        $this->client->request('POST', 'set_vcard2', [
            'json' => [
                'user' => $user,
                'host' => $host,
                'name' => 'EMAIL',
                'subname' => 'USERID',
                'content' => $email
            ]
        ]);
    }

    public function changePassword(string $user, string $host, string $password)
    {
        $this->client->request('POST', 'change_password', [
            'json' => [
                'user' => $user,
                'host' => $host,
                'newpass' => $password,
            ]
        ]);
    }

    public function getEmail(string $user, string $host): ?string
    {
        $json = (string)$this->client->request('POST', 'get_vcard2', [
            'json' => [
                'user' => $user,
                'host' => $host,
                'name' => 'EMAIL',
                'subname' => 'USERID'
            ]
        ])->getBody();

        if (!empty($json)) {
            $json = \json_decode($json);
            return (string)$json->content;
        }

        return null;
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
'.$mail->textPlain
            ]
        ]);
    }
}