
<td class="text-center">{!! $vehicle->icon !!}</td>
<td>{!! $vehicle->make !!}</td>
<td>{!! $vehicle->reg !!}</td>
<td>
    @if($vehicle->latest_lookup->first()->mot_due->format('d/m/Y') === "01/01/1900")
        <span class="text-success"><strong>No Record</strong></span>
    @elseif($vehicle->latest_lookup->first()->mot_due->isPast())
        <span class="text-danger"><strong>!&nbsp;</strong>{!! $vehicle->latest_lookup->first()->mot_due->format('d/m/Y') !!}</span>
    @else
        {!! $vehicle->latest_lookup->first()->mot_due->format('d/m/Y') !!}
    @endif
</td>
<td>
    @if($vehicle->latest_lookup->first()->tax_due->format('d/m/Y') === "01/01/1900")
        <span class="text-danger"><strong>SORN</strong></span>
    @elseif($vehicle->latest_lookup->first()->tax_due->isPast())
        <span class="text-danger"><strong>!&nbsp;</strong>{!! $vehicle->latest_lookup->first()->tax_due->format('d/m/Y') !!}</span>
    @else
        {!! $vehicle->latest_lookup->first()->tax_due->format('d/m/Y') !!}
    @endif
</td>
<td>{!! $vehicle->latest_lookup->first()->created_at->format('d/m/Y') !!}</td>
<td><a class="js-vehicle-lookup-refresh no-underline" data-id="{!! $vehicle->latest_lookup->first()->id !!}" href="#"><i class="fa fa-refresh"></i>&nbsp;Refresh</a></td>
<td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#vehicle-details" data-id="{!! $vehicle->latest_lookup->first()->id !!}"><i class="fa fa-list-ul"></i>&nbsp;Full Details</button></td>
