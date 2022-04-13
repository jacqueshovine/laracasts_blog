<?php

namespace App\Services;
use MailchimpMarketing\ApiClient;


class MailChimpNewsletter implements Newsletter
{

    public function __construct(protected ApiClient $client)
    {

    }

    public function subscribe(string $email, string $list = null)
    {
        // SUbscribe user with ConvertKit specific API requests
    }
}
