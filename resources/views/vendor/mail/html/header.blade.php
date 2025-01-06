@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
<img src={{ asset('images/logo_semu.png') }} class="logo" alt="Logo SEMU" width="1500" style="background-color: #8d0376;">
@endif
</a>
</td>
</tr>
