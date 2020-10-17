@extends('layouts.header')

@section('content')    
    <div class="row justify-content-center ml-2 mr-2">
        <div class="col-md-4 paynow-form" style="padding:10px;">
            <p><strong class="success">{{$msg}}</strong></p>
            <p>Thank you for supporting IBOR.</p>
            <p><a href="http://iborwoman.com">Return to website</a></p>
        </div>
    </div>
@endsection
