@extends('layouts.header')

@section('content')
    
    <div class="row justify-content-center m-2">
        <div class="col-md-4 paynow-form">
           
            <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
                <div class="row justify-content-center" style="margin-bottom:40px;">
                <div class="col-md-12 ">
                    <p>
                        <div>
                           <strong>IBOR 7</strong>  event registration payment and donations <br>
                           <strong>₦ 10,000</strong>  
                        </div>
                    </p>
                    
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                 <label for="fname">First name <span>*</span></label>
                                 <input type="text" id="fname" class="form-control" name="fname" required>
                            </div>
                            <div class="col-md-6">
                                 <label for="lname">Last name <span>*</span></label>
                                 <input type="text"id="lname" class="form-control" name="lname" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                 <label for="email">Email <span>*</span> </label>
                                 <input type="email" id="emailad" class="form-control" name="emailad" required>
                            </div>
                        </div>                        
                    </div>
                    <input type="hidden" name="email" id="email" value=""> {{-- required --}}
                    <input type="hidden" name="first_name" id="firstname" value="">
                    <input type="hidden" name="last_name" id="lastname" value="">
                    <input type="hidden" name="orderID" value="345">
                    <input type="hidden" name="amount" value="1000000"> {{-- required in kobo --}}
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                    <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                    {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                    <p>
                    <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!" id="pay">
                        <i class="fa fa-plus-circle fa-lg"></i> Pay Now!
                    </button>
                    </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection