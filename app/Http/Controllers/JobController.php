<?php

namespace App\Http\Controllers;

use App\Category;
use App\Country;
use App\FlagJob;
use App\Job;
use App\JobApplication;
use App\Mail\ShareByEMail;
use App\State;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Mockery\Exception;

class JobController extends Controller
{
    public function newJob(){
        $title = __('app.post_new_job');

        $categories = Category::orderBy('category_name', 'asc')->get();
        $countries = Country::all();
        $old_country = false;
        if (old('country')){
            $old_country = Country::find(old('country'));
        }

        return view('admin.post-new-job', compact('title', 'categories','countries', 'old_country'));
    }


    public function newJobPost(Request $request){
        $user_id = Auth::user()->id;

        $rules = [
            'job_title' => ['required', 'string', 'max:190'],
            'position' => ['required', 'string', 'max:190'],
            'category' => 'required',
            'description' => 'required',
            'deadline' => 'required',
        ];
        $this->validate($request, $rules);

        $job_title = $request->job_title;
        $job_slug = unique_slug($job_title, 'Job', 'job_slug');


        $country = Country::find($request->country);
        $state_name = null;
        if ($request->state){
            $state = State::find($request->state);
            $state_name = $state->state_name;
        }

        $job_id = strtoupper(str_random(8));
        $data = [
            'user_id'                   => $user_id,
            'job_title'                 => $job_title,
            'job_slug'                  => $job_slug,
            'position'                  => $request->position,
            'category_id'               => $request->category,
            'is_any_where'              => $request->is_any_where,
            'salary'                    => $request->salary,
            'salary_upto'               => $request->salary_upto,
            'is_negotiable'             => $request->is_negotiable,
            'salary_currency'           => $request->salary_currency,
            'salary_cycle'              => $request->salary_cycle,
            'vacancy'                   => $request->vacancy,
            'gender'                    => $request->gender,
            'exp_level'                 => $request->exp_level,
            'job_type'                => $request->job_type,

            'experience_required_years' => $request->experience_required_years,
            'experience_plus'           => $request->experience_plus,
            'description'               => $request->description,
            'skills'                    => $request->skills,
            'responsibilities'          => $request->responsibilities,
            'educational_requirements'  => $request->educational_requirements,
            'experience_requirements'   => $request->experience_requirements,
            'additional_requirements'   => $request->additional_requirements,
            'benefits'                  => $request->benefits,
            'apply_instruction'         => $request->apply_instruction,
            'country_id'                => $request->country,
            'country_name'              => $country->country_name,
            'state_id'                  => $request->state,
            'state_name'                => $state_name,
            'city_name'                 => $request->city_name,
            'deadline'                  => $request->deadline,
            'status'                    => 0,
            'is_premium'                => $request->is_premium,
        ];


        $job = Job::create($data);
        if ( ! $job){
            return back()->with('error', 'app.something_went_wrong')->withInput($request->input());
        }

        $job->update(['job_id' => $job->id.$job_id]);
        return redirect(route('posted_jobs'))->with('success', __('app.job_posted_success'));
    }


    public function postedJobs(){
        $title = __('app.posted_jobs');
        $user = Auth::user();
        $jobs = $user->jobs()->paginate(20);

        return view('admin.jobs', compact('title', 'jobs','user'));
    }

    public function edit($id){
        $title = __('app.edit_job');
        $job = Job::find($id);

        $user = Auth::user();
        if ( ! $user->is_admin() && $user->id != $job->user_id ){
            return redirect(route('dashboard'))->with('error', trans('app.access_restricted'));
        }

        $categories = Category::orderBy('category_name', 'asc')->get();
        $countries = Country::all();
        $old_country = false;
        if ($job->country_id){
            $old_country = Country::find($job->country_id);
        }

        return view('admin.edit-job', compact('title', 'job','categories','countries', 'old_country'));
    }

    /**
     * @param null $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     * View any single page
     */
    public function view($slug = null){
        $job = Job::whereJobSlug($slug)->first();

        if ( ! $slug || ! $job || (! $job->is_active() && ! $job->can_edit()) ){
            abort(404);
        }

        $title = $job->job_title;
        return view('job-view', compact('title', 'job'));
    }

    /**
     * Apply to job
     */
    public function applyJob(Request $request){
        $rules = [
            'name'              => 'required',
            'email'             => 'required',
            'phone_number'      => 'required',
            'message'           => 'required',
            'resume'            => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        $user_id = 0;
        if (Auth::check()){
            $user_id = Auth::user()->id;
        }

        session()->flash('job_validation_fails', true);

        if ($validator->fails()){
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        if ($request->hasFile('resume')){
            $image = $request->file('resume');
            $valid_extensions = ['pdf','doc','docx'];
            if ( ! in_array(strtolower($image->getClientOriginalExtension()), $valid_extensions) ){
                session()->flash('job_validation_fails', true);
                return redirect()->back()->withInput($request->input())->with('error', trans('app.resume_file_type_allowed_msg') ) ;
            }

            $file_base_name = str_replace('.'.$image->getClientOriginalExtension(), '', $image->getClientOriginalName());

            $image_name = strtolower(time().str_random(5).'-'.str_slug($file_base_name)).'.' . $image->getClientOriginalExtension();

            $imageFileName = 'uploads/resume/'.$image_name;
            try{
                //Upload original image
                Storage::disk('public')->put($imageFileName, file_get_contents($image));

                $job = Job::find($request->job_id);

                $application_data = [
                    'job_id'                => $request->job_id,
                    'employer_id'           => $job->user_id,
                    'user_id'               => $user_id,
                    'name'                  => $request->name,
                    'email'                 => $request->email,
                    'phone_number'          => $request->phone_number,
                    'message'               => $request->message,
                    'resume'                => $image_name,
                ];
                JobApplication::create($application_data);

                session()->forget('job_validation_fails');
                return redirect()->back()->withInput($request->input())->with('success', trans('app.job_applied_success_msg')) ;

            } catch (\Exception $e){
                return redirect()->back()->withInput($request->input())->with('error', $e->getMessage()) ;
            }
        }

        return redirect()->back()->withInput($request->input())->with('error', trans('app.error_msg')) ;
    }

    public function flagJob(Request $request, $id){
        $rules = [
            'reason'              => 'required',
            'email'             => 'required',
            'message'           => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()){
            session()->flash('flag_job_validation_fails', true);
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        $data = [
            'job_id'    => $id,
            'reason'    => $request->reason,
            'email'     => $request->email,
            'message'   => $request->message,
        ];
        FlagJob::create($data);

        return redirect()->back()->with('success', __('app.job_flag_submitted'));
    }

    public function pendingJobs(){
        $title = __('app.pending_jobs');
        $jobs = Job::pending()->orderBy('id', 'desc')->paginate(20);
        return view('admin.jobs', compact('title', 'jobs'));
    }
    public function approvedJobs(){
        $title = __('app.approved_jobs');
        $jobs = Job::approved()->orderBy('id', 'desc')->paginate(20);
        return view('admin.jobs', compact('title', 'jobs'));
    }
    public function blockedJobs(){
        $title = __('app.approved_jobs');
        $jobs = Job::blocked()->orderBy('id', 'desc')->paginate(20);
        return view('admin.jobs', compact('title', 'jobs'));
    }

    public function flaggedMessage(){
        $title = __('app.flagged_jobs');
        $flagged = FlagJob::orderBy('id', 'desc')->paginate(20);
        return view('admin.flagged_jobs', compact('title', 'flagged'));
    }


    /**
     * @param $job_id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse
     *
     * Change the job status
     */
    public function statusChange($job_id, $status){
        $job = Job::find($job_id);
        if (! $job->can_edit()){
            return back()->with('error', __('app.permission_denied'));
        }

        if ($status === 'approve'){
            $job->status = 1;
            $job->save();
        }elseif ($status === 'block'){
            $job->status = 2;
            $job->save();
        }elseif($status === 'delete'){
            //
        }elseif($status === 'premium'){
            $balance = $job->employer->premium_jobs_balance;
            if ( ! $balance){
                return back()->with('error', "You don't have any premium jobs balance");
            }
            $job->is_premium = 1;
            $job->save();
            $job->employer->checkJobBalace();
        }

        return back()->with('success', __('app.success'));
    }

    public function jobApplicants($job_id){
        $job = Job::find($job_id);

        $title = __('app.applicants')." For ({$job->job_title})";
        $applications = JobApplication::whereJobId($job_id)->orderBy('id', 'desc')->paginate(20);

        return view('admin.applicants', compact('title', 'applications'));
    }

    public function jobsByEmployer($company_slug = null){
        if ( ! $company_slug){
            abort(404);
        }

        $employer = User::whereCompanySlug($company_slug)->first();
        if ( ! $employer){
            abort(404);
        }

        $title = "Jobs by ".$employer->company_name;

        return view('jobs-by-employer', compact('title', 'employer'));
    }


    public function shareByEmail(Request $request){
        $rules = [
            'receiver_name'     => 'required',
            'receiver_email'    => 'email|required',
            'your_name'         => 'required',
            'your_email'        => 'email|required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()){
            session()->flash('share_job_validation_fails', true);
            return redirect()->back()->withInput($request->input())->withErrors($validator);
        }

        try{
            Mail::send(new ShareByEMail($request));
        }catch (\Exception $e){
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', __('app.job_shared_email_msg'));
    }

    public function jobsListing(Request $request){

        $title = "Browse Jobs";


        $categories = Category::orderBy('category_name', 'asc')->get();
        $countries = Country::all();
        $old_country = false;
        if (request('country')){
            $old_country = Country::find(request('country'));
        }


        $jobs = Job::active();

        if ($request->q){
            $jobs = $jobs->where(function ($query) use($request){
                $query->where('job_title', 'like', "%{$request->q}%")
                    ->orWhere('position', 'like', "%{$request->q}%")
                    ->orWhere('description', 'like', "%{$request->q}%");
            });
        }

        if ($request->location){
            $jobs = $jobs->where('city_name', 'like', "%{$request->location}%");
        }

        if ($request->gender){
            $jobs = $jobs->whereGender($request->gender);
        }
        if ($request->exp_level){
            $jobs = $jobs->whereExpLevel($request->exp_level);
        }
        if ($request->job_type){
            $jobs = $jobs->whereJobType($request->job_type);
        }
        if ($request->country){
            $jobs = $jobs->whereCountryId($request->country);
        }
        if ($request->state){
            $jobs = $jobs->whereStateId($request->state);
        }
        if ($request->category){
            $jobs = $jobs->whereCategoryId($request->category);
        }

        $jobs = $jobs->orderBy('id', 'desc')->with('employer')->paginate(20);

        return view('jobs', compact('title', 'jobs','categories', 'countries', 'old_country'));
    }


}
