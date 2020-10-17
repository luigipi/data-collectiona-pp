@extends('layouts.header')

@section('content')
 <div class="container">
    <div class="row justify-content-center ml-0 mr-0">
        <div class="col-md-5 left-col mr-1">
            <h1 class="b-bottom">IBOR<strong class="lg-header">7</strong> </h1>
            <br>            
            <div class="col-md-12 bottom-row">
                <h4>Welcome to the IBOR registration portal</h4>
            <p>Remember to make a payment of N10,000 as your support to the event. Payments can be made using the "Pay Now" button bellow.</p>
                <!--<p>You can alternately use this button to make your payment if you already registered for the event or would like to support the event.</p>-->
                <a href="/paynow" class="custom-btn" target="_blank">
                  Pay Now
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
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control textarea-style"></textarea>
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
        </div>
    </div>
 </div>
@endsection