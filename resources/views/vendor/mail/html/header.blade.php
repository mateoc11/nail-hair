<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://cdn-icons-png.flaticon.com/512/40/40739.png" class="logo" alt="Nail&Hair Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
