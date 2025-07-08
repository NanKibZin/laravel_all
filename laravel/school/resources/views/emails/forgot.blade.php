{{-- @component('mail::message')
helle {{ $user->name }},
<p>We understand it happen.</p>
@component('mail::button',['url'=>url('reset/'.$user->remember_token)])
Reset your password
@endcomponent
     
 <p>In case you have any issues rocovering your password ,please contact us.</p>
 Thank, <br/>
 {{ config('app.name') }}
 @endcomponent --}}
 @component('mail::message')
helle {{ $user->name }},

<p>We understand it happen.</p>
@component('mail::button',['url'=>url('reset/'.$user->remember_token)])
Reset your password
@endcomponent