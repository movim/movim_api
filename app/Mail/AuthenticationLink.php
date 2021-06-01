<?php

namespace App\Mail;

use App\Account;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthenticationLink extends Mailable
{
    use Queueable, SerializesModels;

    private $account;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Movim Account Panel authentication request')
            ->text('mails.authentication_link')->with([
                'account' => $this->account,
            ]);
    }
}
