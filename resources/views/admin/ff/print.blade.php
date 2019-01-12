<table>
@foreach ($pledges->chunk(6) as $row)
<tr>
  @foreach ($row as $pledge)
    <td style="padding:10px 15px; text-align: center; font-family: 'HelveticaNeue-CondensedBold'">
      <div>{!! QrCode::size(125)->margin(0)->generate(config('app.url').'/ff/ff2019/'.$pledge->code); !!}</div>
      <div style="padding:10px;">{{$pledge->name}}</div>
    </td>
  @endforeach
  </tr>
@endforeach
</table>
