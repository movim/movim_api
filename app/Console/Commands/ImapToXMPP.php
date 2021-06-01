<?php

namespace App\Console\Commands;

use PhpImap\Mailbox;
use Illuminate\Console\Command;

use App\Libraries\EjabberdAPI;
use App\Account;

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
        $server = '{'.config('imaptoxmpp.server').':'.config('imaptoxmpp.port').'/imap/tls}INBOX';
        $this->info('Connecting to '.$server.' username = '.config('imaptoxmpp.username'));
        $mailbox = new Mailbox(
            $server,
            config('imaptoxmpp.username'),
            config('imaptoxmpp.password'),
            __DIR__,
            'UTF-8'
        );

        $mailbox->setAttachmentsIgnore(true);

        try {
            // We parse indefinitly
            while (1) {
                $enabledAccountsJids = [];
                foreach (Account::where('email_notification', true)->get() as $account) {
                    array_push($enabledAccountsJids, $account->jid);
                }

                $mailsIds = $mailbox->searchMailbox('UNSEEN');

                $api = new EjabberdAPI;

                foreach ($mailsIds as $mailsId) {
                    $mail = $mailbox->getMail($mailsId);
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
                    $this->info('Process: '.$mail->subject . ' to '.$extractedTo );

                    if ($extractedTo) {
                        if (in_array($extractedTo, $enabledAccountsJids)) {
                            $api->sendMail($extractedTo, $mail);
                            $this->info('Mail delivered to '.$extractedTo.', subject: '.$mail->subject);
                        } else {
                            $this->error('Feature not enabled for '.$extractedTo.', email not delivered, subject: '.$mail->subject);
                        }

                        $mailbox->markMailAsRead($mailsId);
                    }
                }

                sleep (5);
            }
        } catch(\Exception $ex) {
            echo "IMAP connection failed: " . $ex;
            die();
        }

        return 0;
    }
}
