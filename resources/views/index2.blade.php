@extends('layouts.header')

@section('content')
 <div class="container">
    <div class="row justify-content-center ml-0 mr-0">
        <div class="col-md-5 left-col">
            <h1>IBOR <strong class="lg-header">7</strong> </h1>
            <div class="img-wrapper">
                <img src="{{asset('imgs/ib.png')}}" class="img-fluid" alt="ibor-logo">
            </div>
            <br>
            <h4>Welcome to the IBOR 7 registration portal</h4>
            <p>Remember to make a payment of N10,000 after submitting this form. Payments can be made using the button that will
                be displayed after successful submission of the form.</p>
            
            <div class="col-12">
                <p>You can alternately use this button to make your payment if you already registered for the event or would like to support the event.</p>
                <a href="/paynow" class="custom-btn" target="_blank">
                  Make payment
                </a>
            </div>
        </div>
        <div class="col-md-5 bg-white right-col">  
            <h2>REGISTER HERE</h2>          
            <form id="reg-form" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <div class="row">
                        <div class="col-6">
                            <label for="name" class="label-control">First Name <span>*</span></label>
                            <input type="text" name="fname" id="fname" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="lastname" class="label-control">Last Name <span>*</span></label>
                            <input type="text" name="lname" id="lname" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="email" class="label-control">Email address <span>*</span></label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="col-6">
                            <label for="phonenumber" class="label-control">Phone number <span>*</span></label>
                            <input type="tel" pattern="[0-9]{11}" name="phone" id="phone" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="occupation" class="label-control">Your occupation</label>
                            <input type="text" name="occupation" id="occupation" class="form-control" >
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <label for="address" class="label-control">Address</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12">
                            <input type="checkbox" name="attend" id="attend"> I will be in attendance.
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-4">
                            <button class="btn btn-color subm-btn" id="subm-btn">
                                Register
                            </button>
                        </div>
                        <div class="col-8">
                            <p id="loader" class="success hidden"><strong>Please wait......</strong></p>                            
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-12 msg">
                            <p id="loader" class="success hidden"><strong>Sending......</strong></p>
                            <div id="successMsg" class="alert alert-success hidden">
                                <span></span>
                            </div>
                            <div id="errorMsg" class="alert alert-danger hidden">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="col-md-12 hidden" id="paystack-tab">
                <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                    <div class="row" style="margin-bottom:40px;">
                    <div class="col-md-4">
                        <p>
                            <div>
                                <p>Pay now</p>
                            </div>
                        </p>
                        <input type="hidden" name="email" id="emailAd" value="peteritodo@gmail.com"> {{-- required --}}
                        <input type="hidden" name="name" id="name" value="">
                        <input type="hidden" name="orderID" id="orderID" value="345">
                        <input type="hidden" name="amount" id="amount" value="1000000"> {{-- required in kobo --}}
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                        <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                        {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}    
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}   
                        <p>
                            <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">
                                <i class="fa fa-plus-circle fa-lg"></i> Pay Now
                            </button>
                        </p>
                    </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
@endsection