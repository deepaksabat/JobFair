<?php

namespace App\Providers;

use App\Option;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        try {
            DB::connection()->getPdo();

            $options = Option::all()->pluck('option_value', 'option_key')->toArray();
            $allOptions = [];
            $allOptions['options'] = $options;
            $allOptions['header_menu_pages'] = Post::whereStatus('1')->where('show_in_header_menu', 1)->get();
            $allOptions['footer_menu_pages'] = Post::whereStatus('1')->where('show_in_footer_menu', 1)->get();
            config($allOptions);

            /**
             * Set dynamic configuration for third party services
             */
            $facebookConfig = [
                'services.facebook' =>
                    [
                        'client_id' => get_option('fb_app_id'),
                        'client_secret' => get_option('fb_app_secret'),
                        'redirect' => url('login/facebook-callback'),
                    ]
            ];
            $googleConfig = [
                'services.google' =>
                    [
                        'client_id' => get_option('google_client_id'),
                        'client_secret' => get_option('google_client_secret'),
                        'redirect' => url('login/google-callback'),
                    ]
            ];
            $twitterConfig = [
                'services.twitter' =>
                    [
                        'client_id' => get_option('twitter_consumer_key'),
                        'client_secret' => get_option('twitter_consumer_secret'),
                        'redirect' => url('login/twitter-callback'),
                    ]
            ];
            config($facebookConfig);
            config($googleConfig);
            config($twitterConfig);

        }catch (\Exception $e){
            //echo $e->getMessage();
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
