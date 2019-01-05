<?php

use Illuminate\Database\Seeder;

class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('options')->insert([
            0 => array (
                'id' => 2,
                'option_key' => 'enable_paypal',
                'option_value' => '1',
            ),
            1 => array (
                'id' => 3,
                'option_key' => 'enable_stripe',
                'option_value' => '1',
            ),
            2 => array (
                'id' => 4,
                'option_key' => 'stripe_test_mode',
                'option_value' => '1',
            ),
            3 => array (
                'id' => 5,
                'option_key' => 'stripe_test_secret_key',
                'option_value' => 'sk_test_tJeAdA1KbhiYV8I8bfPmJcOL',
            ),
            4 => array (
                'id' => 6,
                'option_key' => 'stripe_test_publishable_key',
                'option_value' => 'pk_test_P3TFmKrvT7l29Zpyy1f4pwk8',
            ),
            5 => array (
                'id' => 7,
                'option_key' => 'stripe_live_secret_key',
                'option_value' => '',
            ),
            6 => array (
                'id' => 8,
                'option_key' => 'stripe_live_publishable_key',
                'option_value' => '',
            ),
            7 => array (
                'id' => 9,
                'option_key' => 'date_format',
                'option_value' => 'd/m/Y',
            ),
            8 => array (
                'id' => 10,
                'option_key' => 'default_timezone',
                'option_value' => 'Asia/Dhaka',
            ),
            9 => array (
                'id' => 11,
                'option_key' => 'date_format_custom',
                'option_value' => 'd/m/Y',
            ),
            10 => array (
                'id' => 12,
                'option_key' => 'site_title',
                'option_value' => 'ThemeqxEstate',
            ),
            11 => array (
                'id' => 13,
                'option_key' => 'email_address',
                'option_value' => 'admin@demo.com',
            ),
            12 => array (
                'id' => 14,
                'option_key' => 'time_format',
                'option_value' => 'g:i A',
            ),
            13 => array (
                'id' => 15,
                'option_key' => 'time_format_custom',
                'option_value' => 'g:i A',
            ),
            14 => array (
                'id' => 17,
                'option_key' => 'number_of_premium_ads_in_home',
                'option_value' => '8',
            ),
            15 => array (
                'id' => 18,
                'option_key' => 'number_of_free_ads_in_home',
                'option_value' => '8',
            ),
            16 => array (
                'id' => 19,
                'option_key' => 'ads_per_page',
                'option_value' => '12',
            ),
            17 => array (
                'id' => 20,
                'option_key' => 'regular_ads_price',
                'option_value' => '3',
            ),
            18 => array (
                'id' => 21,
                'option_key' => 'premium_ads_price',
                'option_value' => '8',
            ),
            19 => array (
                'id' => 22,
                'option_key' => 'ads_price_plan',
                'option_value' => 'regular_ads_free_premium_paid',
            ),
            20 => array (
                'id' => 23,
                'option_key' => 'ads_moderation',
                'option_value' => 'need_moderation',
            ),
            21 => array (
                'id' => 24,
                'option_key' => 'paypal_receiver_email',
                'option_value' => 'shohelmail71-facilitator@gmail.com',
            ),
            22 => array (
                'id' => 25,
                'option_key' => 'enable_paypal_sandbox',
                'option_value' => '1',
            ),
            23 => array (
                'id' => 26,
                'option_key' => 'site_name',
                'option_value' => 'ThemeqxEstate',
            ),
            24 => array (
                'id' => 27,
                'option_key' => 'default_storage',
                'option_value' => 'public',
            ),
            29 => array (
                'id' => 32,
                'option_key' => 'enable_facebook_login',
                'option_value' => '1',
            ),
            30 => array (
                'id' => 33,
                'option_key' => 'enable_google_login',
                'option_value' => '1',
            ),
            31 => array (
                'id' => 34,
                'option_key' => 'fb_app_id',
                'option_value' => '807346162754117',
            ),
            32 => array (
                'id' => 35,
                'option_key' => 'fb_app_secret',
                'option_value' => '6b93030d5c4f2715aa9d02be93256fbd',
            ),
            33 => array (
                'id' => 36,
                'option_key' => 'google_client_id',
                'option_value' => '',
            ),
            34 => array (
                'id' => 37,
                'option_key' => 'google_client_secret',
                'option_value' => '',
            ),
            35 => array (
                'id' => 38,
                'option_key' => 'enable_social_login',
                'option_value' => '1',
            ),
            36 => array (
                'id' => 39,
                'option_key' => 'enable_social_sharing_in_ad_box',
                'option_value' => '1',
            ),
            37 => array (
                'id' => 40,
                'option_key' => 'order_by_premium_ads_in_listing',
                'option_value' => 'random',
            ),
            38 => array (
                'id' => 41,
                'option_key' => 'number_of_premium_ads_in_listing',
                'option_value' => '3',
            ),
            39 => array (
                'id' => 42,
                'option_key' => 'number_of_last_days_premium_ads',
                'option_value' => '30',
            ),
            40 => array (
                'id' => 43,
                'option_key' => 'enable_slider',
                'option_value' => '1',
            ),
            41 => array (
                'id' => 44,
                'option_key' => 'premium_ads_max_impressions',
                'option_value' => '50',
            ),
            42 => array (
                'id' => 45,
                'option_key' => 'footer_left_text',
                'option_value' => 'Copyright [copyright_sign] [year] your company',
            ),
            43 => array (
                'id' => 46,
                'option_key' => 'footer_right_text',
                'option_value' => 'Your additional text, can be use link too',
            ),
            46 => array (
                'id' => 49,
                'option_key' => 'facebook_url',
                'option_value' => 'https://facebook.com/themeqx',
            ),
            47 => array (
                'id' => 50,
                'option_key' => 'twitter_url',
                'option_value' => '#',
            ),
            48 => array (
                'id' => 51,
                'option_key' => 'linked_in_url',
                'option_value' => '#',
            ),
            49 => array (
                'id' => 52,
                'option_key' => 'dribble_url',
                'option_value' => '#',
            ),
            50 => array (
                'id' => 53,
                'option_key' => 'google_plus_url',
                'option_value' => '#',
            ),
            51 => array (
                'id' => 54,
                'option_key' => 'youtube_url',
                'option_value' => '#',
            ),
            52 => array (
                'id' => 55,
                'option_key' => 'footer_company_name',
                'option_value' => '[site_name]',
            ),
            53 => array (
                'id' => 56,
                'option_key' => 'footer_address',
                'option_value' => '2/21 Barden Loop  <br /> Cupertino, CA 774636',
            ),
            54 => array (
                'id' => 57,
                'option_key' => 'site_phone_number',
                'option_value' => '(123) 456-7890',
            ),
            55 => array (
                'id' => 58,
                'option_key' => 'site_email_address',
                'option_value' => 'info@customer.com ',
            ),
            56 => array (
                'id' => 59,
                'option_key' => 'footer_about_us',
                'option_value' => 'Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui.',
            ),
            57 => array (
                'id' => 60,
                'option_key' => 'footer_about_us_read_more_text',
                'option_value' => '<a href="#">View details »</a>',
            ),
            79 => array (
                'id' => 82,
                'option_key' => 'show_blog_in_footer',
                'option_value' => '0',
            ),
            80 => array (
                'id' => 83,
                'option_key' => 'show_blog_in_header',
                'option_value' => '1',
            ),
            81 => array (
                'id' => 84,
                'option_key' => 'blog_post_amount_in_homepage',
                'option_value' => '6',
            ),
            82 => array (
                'id' => 85,
                'option_key' => 'show_latest_blog_in_homepage',
                'option_value' => '1',
            ),
            83 => array (
                'id' => 86,
                'option_key' => 'currency_sign',
                'option_value' => 'EUR',
            ),
            89 => array (
                'id' => 92,
                'option_key' => 'default_theme',
                'option_value' => 'modern',
            ),
            90 => array (
                'id' => 93,
                'option_key' => 'meta_description',
                'option_value' => 'meta_description',
            ),
            91 => array (
                'id' => 94,
                'option_key' => 'modern_category_display_style',
                'option_value' => 'show_top_category_with_sub',
            ),
            92 => array (
                'id' => 95,
                'option_key' => 'modern_home_left_title',
                'option_value' => 'Lorem Ipsum is simply',
            ),

        ]);
    }
}
