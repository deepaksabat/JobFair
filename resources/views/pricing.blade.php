@extends('layouts.theme')

@section('content')


    <div class="pricing-section bg-white pb-5 pt-5">
        <div class="container">

            <div class="row">
                <div class="col-md-12">

                    <div class="pricing-section-heading mb-5 text-center">

                        <h1>Pricing</h1>
                        <h5 class="text-muted">Choose a package to unlock Premium/Regular jobs posting ability.</h5>
                        <h5 class="text-muted">To get a large amount of quality application, choose the premium package</h5>
                    </div>

                </div>
            </div>


            <div class="row">

                <div class="col-xs-12 col-md-4">
                    <div class="pricing-table-wrap bg-light pt-5 pb-5 text-center">
                        <h1 class="display-4">$0</h1>
                        <h3>Free</h3>

                        <div class="pricing-package-ribbon pricing-package-ribbon-light">Regular</div>

                        <p class="mb-2 text-muted"> No Premium Job Post</p>
                        <p class="mb-2 text-muted"> Unlimited Regular Job Post</p>
                        <p class="mb-2 text-muted"> Unlimited Applicants</p>
                        <p class="mb-2 text-muted"> Dashboard access to manage application</p>
                        <p class="mb-2 text-muted"> No support available</p>

                        <a href="{{route('new_register')}}" class="btn btn-success mt-4"><i class="la la-user-plus"></i> Sign Up</a>
                    </div>
                </div>

                @foreach($packages as $package)
                    <div class="col-xs-12 col-md-4">
                        <div class="pricing-table-wrap bg-light pt-5 pb-5 text-center">
                            <h1 class="display-4">{!! get_amount($package->price) !!}</h1>
                            <h3>{{$package->package_name}}</h3>
                            <div class="pricing-package-ribbon pricing-package-ribbon-green">Premium</div>

                            <p class="mb-2 text-muted"> {{$package->premium_job}} Premium Jobs Post</p>
                            <p class="mb-2 text-muted"> Unlimited Regular Job Post</p>
                            <p class="mb-2 text-muted"> Unlimited Applicants</p>
                            <p class="mb-2 text-muted"> Dashboard access to manage application</p>
                            <p class="mb-2 text-muted"> E-Mail support available</p>
                            <a href="{{route('checkout', $package->id)}}" class="btn btn-success mt-4"> <i class="la la-shopping-cart"></i> Purchas Package</a>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </div>


@endsection
