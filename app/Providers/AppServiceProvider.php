<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
          // Share unread messages with all admin views (views starting with 'admin.')
          View::composer('admin.*', function ($view) {
             // Get unread messages
             $unreadMessages = Contact::where('unreadMessage', false)->get();
             // Share the unread messages with all views
             $view->with('unreadMessages', $unreadMessages);
         });
    }
}
