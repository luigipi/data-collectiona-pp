@component('mail::message')
   {{-- ![{{ 'IBOR' }}]({{asset('imgs/bi.png')}}) --}}

Thanks for supporting the IBOR 7 event "Beautiful Imperfections".

This mail serves as your VIP invite ticket.<br><br>
<img src="{{asset('imgs/Ibor-invite.jpg')}}" alt="Ibor-invite"> <br>
<strong>ID:{{$sendMail->reg_code}}</strong> <br>

<strong>Date:</strong> Saturday 13<sup>th</sup> September, 2019 <br>
<strong>Venue:</strong> Sheraton hotel Ikeja Lagos<br>
<strong>Time:</strong> 2:00pm prompt

Regards,<br>
    IBOR Team.<br>
    +234-8069311722
@endcomponent
