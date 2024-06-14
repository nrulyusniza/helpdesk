<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Sapura')
<img src="https://i.ibb.co/kxHTMH6/ATM4.png" alt="ATM4">
{{-- <img src="https://i.ibb.co/RgCWjxr/ATM3.png" alt="ATM3" > --}}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
