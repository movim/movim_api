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
        $server = '{'.config('imaptoxmpp.server').':'.config('imaptoxmpp.port').'/imap/tls/novalidate-cert}INBOX';
        $this->info('Connecting to '.$server.' username = '.config('imaptoxmpp.username'));
        $mailbox = new Mailbox(
            $server, // IMAP server and mailbox folder
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

                $tos = array_merge(array_keys($mail->to), array_keys($mail->cc), array_keys($mail->bcc));
                $extractedTo = false;
                foreach($tos as $to) {
                    $var = explode('@', $to);
                    $domain = array_pop($var);
                    if ($domain == config('imaptoxmpp.xmpp_domain')) {
                        $extractedTo = $to;
                        break;
                    }
                }

                if ($extractedTo) {
                    $client->request('POST', 'send_message', [
                        'json' => [
                            'type' => 'chat',
                            'from' => config('imaptoxmpp.xmpp_from'),
                            'to' => $extractedTo,
                            'subject' => $mail->subject,
                            'body' => '📥 New email received: "'.$mail->subject.'"'
                        ]
                    ]);

                    $this->info('Mail sent to '.array_keys($mail->to)[0].', subject: '.$mail->subject);
                }
            }
        } catch(\PhpImap\Exceptions\ConnectionException $ex) {
            echo "IMAP connection failed: " . $ex;
            die();
        }
    }
}
