@component('mail::message')

Hi {{$details->first_name}}, 

<p>
  Thanks for registering for the IBOR 8 event "Beautiful Beginnings".
</p>

This mail serves as your ticket to the event.<br>
<h3>ID:{{$details->reg_number}}</h3> <br>
<img src="{{asset('imgs/banner.jpg')}}" alt="ibor-invite"> <br>

<strong>Date:</strong> Saturday 31<sup>st</sup> Ocotber, 2020 <br>
<strong>Venue:</strong> Zoom<br>
<strong>Time:</strong> 2:00pm prompt

Regards,<br>
    IBOR Team.<br>
    +234-8069311722

@endcomponent

