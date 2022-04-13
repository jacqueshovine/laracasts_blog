<?php

namespace App\Services;
use MailchimpMarketing\ApiClient;


class MailChimpNewsletter
{

    public function __construct(protected ApiClient $client)
    {

    }

    public function subscribe(string $email, string $list = null)
    {
        
        $list ??= config('services.mailchimp.lists.subscribers');

        // The client has been registered in the AppServiceProvider and bound to the MailChimpNewsletter object
        return $this->client->lists->addListMember(config('services.mailchimp.lists.subscribers'), [
            'email_address' => $email,
            'status' => 'subscribed',
        ]);
    }
}
