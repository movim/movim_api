<?php

namespace App\Console\Commands;

use PhpImap\Mailbox;

use Illuminate\Console\Command;
use GuzzleHttp\Client;

class ImapToXMPP extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'imaptoxmpp:handle';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Handle Inbox and dispatch them to the XMPP JIDs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $mailbox = new Mailbox(
            '{'.config('imaptoxmpp.server').':'.config('imaptoxmpp.port').'/imap/tls/novalidate-cert}INBOX', // IMAP server and mailbox folder
            config('imaptoxmpp.username'), // Username for the before configured mailbox
            config('imaptoxmpp.password'), // Password for the before configured username
            __DIR__, // Directory, where attachments will be saved (optional)
            'UTF-8' // Server encoding (optional)
        );

        try {
            $mailsIds = $mailbox->searchMailbox('UNSEEN');

            $client = new Client([
                'base_uri' => config('imaptoxmpp.ejabberd_api'),
                'timeout'  => 2.0,
            ]);

            foreach ($mailsIds as $mailsId) {
                $mail = $mailbox->getMail($mailsId, true);

                $client->request('POST', 'send_message', [
                    'json' => [
                        'type' => 'chat',
                        'from' => config('imaptoxmpp.xmpp_from'),
                        'to' => array_keys($mail->to)[0],
                        'subject' => $mail->subject,
                        'body' => $mail->textPlain,
                    ]
                ]);
            }
        } catch(\PhpImap\Exceptions\ConnectionException $ex) {
            echo "IMAP connection failed: " . $ex;
            die();
        }
    }
}
