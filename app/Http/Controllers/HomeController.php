<?php

namespace App\Http\Controllers;

use App\Category;
use App\Job;
use App\Mail\ContactUs;
use App\Mail\ContactUsSendToSender;
use App\Post;
use App\Pricing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categories = Category::orderBy('category_name', 'asc')->get();
        $premium_jobs = Job::active()->premium()->orderBy('id', 'desc')->with('employer')->get();
        $regular_jobs = Job::active()->orderBy('id', 'desc')->with('employer')->take(15)->get();
        $blog_posts = Post::whereType('post')->with('author')->orderBy('id', 'desc')->take(3)->get();
        $packages = Pricing::all();
        return view('home', compact('categories', 'premium_jobs','regular_jobs','packages', 'blog_posts'));
    }

    public function newRegister(){
        $title = __('app.register');
        return view('new_register', compact('title'));
    }

    public function pricing(){
        $title = __('app.pricing');
        $packages = Pricing::all();
        return view('pricing', compact('title', 'packages'));
    }

    public function contactUs(){
        $title = trans('app.contact_us');
        return view('contact_us', compact('title'));
    }

    public function contactUsPost(Request $request){
        $rules = [
            'name'  => 'required',
            'email'  => 'required|email',
            'subject'  => 'required',
        ];

        $this->validate($request, $rules);

        try{
            Mail::send(new ContactUs($request));
            Mail::send(new ContactUsSendToSender($request));
        }catch (\Exception $exception){
            return redirect()->back()->with('error', '<h4>'.trans('app.smtp_error_message').'</h4>'. $exception->getMessage());
        }

        return redirect()->back()->with('success', trans('app.message_has_been_sent'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     *
     * Clear all cache
     */
    public function clearCache(){
        Artisan::call('debugbar:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        if (function_exists('exec')){
            exec('rm ' . storage_path('logs/*'));
        }
        return redirect(route('home'));
    }

}
