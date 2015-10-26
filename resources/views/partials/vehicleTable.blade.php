<td class="text-center">{!! $vehicle->icon !!}</td>
<td>{!! $vehicle->make !!}</td>
<td>{!! $vehicle->reg !!}</td>
<td>{!! $vehicle->latest_lookup->first()->mot_due->format('d/m/Y') !!}</td>
<td>{!! $vehicle->latest_lookup->first()->mot_due->format('d/m/Y') !!}</td>
<td>{!! $vehicle->latest_lookup->first()->created_at->format('d/m/Y') !!}</td>
<td><a class="js-vehicle-lookup-refresh no-underline" data-id="{!! $vehicle->latest_lookup->first()->id !!}" href="#"><i class="fa fa-refresh"></i>&nbsp;Refresh</a></td>
<td><button class="btn btn-success btn-xs" data-toggle="modal" data-target="#vehicle-details" data-id="{!! $vehicle->latest_lookup->first()->id !!}"><i class="fa fa-list-ul"></i>&nbsp;Full Details</button></td>