@extends('layouts.dashboard')


@section('content')

    @if(auth()->user()->is_admin())
        <div class="row">
            <div class="col-md-3">
                <div class="p-3 mb-3 text-white bg-success">
                    <h4>Users</h4>
                    <h5>{{$usersCount}}</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 mb-3 bg-warning">
                    <h4>Payments</h4>
                    <h5>{!! get_amount($totalPayments) !!}</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 mb-3 bg-light">
                    <h4>Active Jobs</h4>
                    <h5>{{$activeJobs}}</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 mb-3 text-white bg-danger">
                    <h4>Total Jobs</h4>
                    <h5>{{$totalJobs}}</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 mb-3 text-white bg-dark">
                    <h4>Employer</h4>
                    <h5>{{$employerCount}}</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 mb-3 text-white bg-info">
                    <h4>Agent</h4>
                    <h5>{{$agentCount}}</h5>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 mb-3 text-white bg-primary">
                    <h4>Applied</h4>
                    <h5>{{$totalApplicants}}</h5>
                </div>
            </div>
        </div>

    @else

        <div class="row">
            <div class="col-md-12">
                <div class="no data-wrap py-5 my-5 text-center">
                    <h1 class="display-1"><i class="la la-frown-o"></i> </h1>
                    <h1>No Data available here</h1>
                </div>
            </div>
        </div>
    @endif

@endsection