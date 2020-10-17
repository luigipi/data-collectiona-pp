@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            <img src="{{asset('imgs/ib.png')}}" alt="logo">
            {{-- {{ config('app.name') }} --}}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}   
    Follow us on: 
    <a href="https://facebook.com/iborwoman">Facebook</a>
    <a href="https://instagram.com/iborwoman">Instagram</a>
    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('mail::subcopy')
                {{ $subcopy }}                
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} {{ config('app.name') }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
