<?php

namespace App\Http\Controllers;

use App\Services\MailChimpNewsletter;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class NewsletterController extends Controller
{
    // A new Newsletter will be instantiated by laravel
    public function __invoke(MailChimpNewsletter $newsletter)
    {
        request()->validate(['email' => 'required|email']);

        try {
    
            $newsletter->subscribe(request('email'));
    
        } catch (\Exception $e) {
    
            throw ValidationException::withMessages([
                'email' => 'This email could not be added to our newsletter list.'
            ]);
    
        }
    
        return redirect('/')->with('success', 'You are now signed up for our newsletter!');
    }
}
