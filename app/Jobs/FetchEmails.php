<?php

namespace App\Jobs;

use Webklex\PHPIMAP\ClientManager;
use Webklex\PHPIMAP\Client;
use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\DB;

class FetchEmails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $clientManager = new ClientManager();
        $client = $clientManager->make([
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => true,
            'username'      => 'ini.osungbesan@gmail.com',
            'password'      => 'jznvjzjgcjndxuez',
            'protocol'      => 'imap'
        ]);

        $client->connect();
        
        $folder = $client->getFolder('INBOX');
        $messages = $folder->query()
                           ->since(now()->subMonth())
                           ->from('komolafeezekiel123@gmail.com')
                           ->unseen()
                           ->get();

        foreach ($messages as $message) {
            $email = new Email();
            $email->title = $message->getSubject();
            $email->content = strip_tags($message->getHTMLBody(true));
            $email->save();
        }
    }
}
