<?php

namespace App\Services;
use MailchimpMarketing\ApiClient;


class Newsletter
{

    public function __construct(protected ApiClient $client)
    {

    }

    public function subscribe(string $email, string $list = null)
    {
        
        $list ??= config('services.mailchimp.lists.subscribers');

        // The client has been set in the AppServiceProvider and bound to the Newsletter object
        return $this->client->lists->addListMember(config('services.mailchimp.lists.subscribers'), [
            'email_address' => $email,
            'status' => 'subscribed',
        ]);
    }
}
