<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Webklex\PHPIMAP\ClientManager;
use App\Models\Email;
use Carbon\Carbon;

class FetchEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch unseen emails from a specific sender and store them in the database';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Create a new ClientManager instance
        $clientManager = new ClientManager();

        // Make a new client with the provided configuration
        $client = $clientManager->make([
            'host'          => 'imap.gmail.com',
            'port'          => 993,
            'encryption'    => 'ssl',
            'validate_cert' => true,
            'username'      => 'ini.osungbesan@gmail.com',
            'password'      => 'jznvjzjgcjndxuez',
            'protocol'      => 'imap'
        ]);

        // Connect to the client
        $client->connect();

        // Get the INBOX folder
        $folder = $client->getFolder('INBOX');

        // Query the folder for unseen emails from the specific sender within the last month
        $messages = $folder->query()
                           ->since(Carbon::now()->subMonth())
                           ->from('komolafeezekiel123@gmail.com')
                           ->unseen()
                           ->get();

        // Iterate through the messages and store them in the database
        foreach ($messages as $message) {
            $email = new Email();
            $email->title = $message->getSubject();
            $email->content = strip_tags($message->getHTMLBody(true)); // Stripping HTML tags from the email content
            $email->save();
        }

        // Display a success message
        $this->info('Emails fetched and stored successfully.');

        return 0;
    }
}
