@extends('layouts.theme')

@section('content')
    <div class="checkout-page py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h1>@lang('app.package') : {{$payment->package_name}}</h1>
                </div>
            </div>
        </div>
    </div>

    <div class="checkout-page bg-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    @if($payment->payment_method === 'paypal')
                        <h3 class="text-success">{!! get_amount($payment->amount) !!}</h3>
                        <form action="{{route('payment_paypal_pay', $payment->local_transaction_id)}}" method="post">
                            @csrf

                            <input type="hidden" name="cmd" value="_xclick" />
                            <input type="hidden" name="no_note" value="1" />
                            <input type="hidden" name="lc" value="UK" />
                            <input type="hidden" name="currency_code" value="{{get_option('currency_sign')}}" />
                            <input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" />
                            <button type="submit" class="btn btn-success btn-lg"> <i class="la la-paypal"></i> @lang('app.pay_with_paypal')</button>
                        </form>
                    @endif

                    @if($payment->payment_method === 'stripe')
                        <div class="stripe-button-container">
                            <script
                                    src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                                    data-key="{{ get_stripe_key() }}"
                                    data-amount="{{ get_stripe_amount($payment->amount) }}"
                                    data-email="{{$payment->email}}"
                                    data-name="{{ get_option('site_name') }}"
                                    data-description="{{ $payment->package_name." Package" }}"
                                    data-currency="{{$payment->currency}}"
                                    data-locale="auto">
                            </script>
                        </div>
                    @endif



                    @if($payment->payment_method === 'bank_transfer')
                        
                        <div class="alert alert-info">
                            <h4> @lang('app.payment_id') #{{$payment->local_transaction_id}} </h4>
                        </div>

                        <div class="jumbotron">
                            <h4>@lang('app.bank_payment_instruction')</h4>

                            <table class="table">
                                <tr>
                                    <th>@lang('app.bank_swift_code')</th>
                                    <td>{{get_option('bank_swift_code') }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('app.account_number')</th>
                                    <td>{{get_option('account_number') }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('app.branch_name')</th>
                                    <td>{{get_option('branch_name') }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('app.branch_address')</th>
                                    <td>{{get_option('branch_address') }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('app.account_name')</th>
                                    <td>{{get_option('account_name') }}</td>
                                </tr>
                                <tr>
                                    <th>@lang('app.iban')</th>
                                    <td>{{get_option('iban') }}</td>
                                </tr>
                            </table>
                        </div>

                        <form action="{{route('bank_transfer_submit', $payment->local_transaction_id)}}" method="post" id="bankTransferForm" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row {{ $errors->has('bank_swift_code')? 'has-error':'' }}">
                                <label for="bank_swift_code" class="col-sm-4 control-label">
                                    @lang('app.bank_swift_code') <span class="field-required">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="bank_swift_code" value="{{ old('bank_swift_code') }}" name="bank_swift_code" placeholder="@lang('app.bank_swift_code')">
                                    {!! e_form_error('bank_swift_code', $errors) !!}
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('account_number')? 'has-error':'' }}">
                                <label for="account_number" class="col-sm-4 control-label">@lang('app.account_number') <span class="field-required">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="account_number" value="{{ old('account_number') }}" name="account_number" placeholder="@lang('app.account_number')">
                                    {!! e_form_error('account_number', $errors) !!}
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('branch_name')? 'has-error':'' }}">
                                <label for="branch_name" class="col-sm-4 control-label">@lang('app.branch_name') <span class="field-required">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="branch_name" value="{{ old('branch_name') }}" name="branch_name" placeholder="@lang('app.branch_name')">
                                    {!! e_form_error('branch_name', $errors) !!}
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('branch_address')? 'has-error':'' }}">
                                <label for="branch_address" class="col-sm-4 control-label">@lang('app.branch_address') <span class="field-required">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="branch_address" value="{{ old('branch_address') }}" name="branch_address" placeholder="@lang('app.branch_address')">
                                    {!! e_form_error('branch_address', $errors) !!}
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('account_name')? 'has-error':'' }}">
                                <label for="account_name" class="col-sm-4 control-label">@lang('app.account_name') <span class="field-required">*</span></label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="account_name" value="{{ old('account_name') }}" name="account_name" placeholder="@lang('app.account_name')">
                                    {!! e_form_error('account_name', $errors) !!}
                                </div>
                            </div>

                            <div class="form-group row {{ $errors->has('iban')? 'has-error':'' }}">
                                <label for="iban" class="col-sm-4 control-label">@lang('app.iban')</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="iban" value="{{ old('iban') }}" name="iban" placeholder="@lang('app.iban')">
                                    {!! e_form_error('iban', $errors) !!}
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="offset-sm-4 col-sm-8">
                                    <button type="submit" class="btn btn-primary">@lang('app.pay_with_bank_bank_transfer')</button>
                                </div>
                            </div>

                        </form>

                    @endif


                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-js')

    <script>
        window.addEventListener('DOMContentLoaded', function() {

            $(function() {
                $('.stripe-button').on('token', function(e, token){
                    $.ajax({
                        url : '{{route('payment_stripe_receive', $payment->local_transaction_id)}}',
                        type: "POST",
                        data: { stripeToken : token.id, _token : '{{ csrf_token() }}' },
                        success : function (data) {
                            if (data.success == 1){
                                location.href = '{{route('payment_success', $payment->local_transaction_id)}}';
                            }
                        }
                    });
                });
            });
        });
    </script>

@endsection