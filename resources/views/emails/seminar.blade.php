@component('mail::message')
   {{-- ![{{ 'IBOR' }}]({{asset('imgs/bi.png')}}) --}}

# Hi, {{$sendMail->fname}} <br>

Thanks for registering for the IBOR 7 event "Beautiful Imperfections".

A seat has been reserved for you, this mail serves as your ticket to the event.<br>
<h3>ID:{{$sendMail->reg_code}}</h3> <br>
<img src="{{asset('imgs/Ibor-invite.jpg')}}" alt="Ibor-invite"> <br>

<strong>Date:</strong> Saturday 28<sup>th</sup> September, 2019 <br>
<strong>Venue:</strong> Sheraton hotel Ikeja Lagos<br>
<strong>Time:</strong> 2:00pm prompt

<p>If you feel like supporting this event, kindly us the button bellow</p>
@component('mail::button', ['url' => 'http://iborwoman.com/register/support'])
  Support
@endcomponent

Regards,<br>
    IBOR Team.<br>
    +234-8069311722
@endcomponent
