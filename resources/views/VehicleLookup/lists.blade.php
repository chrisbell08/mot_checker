
<table class="table">

	<thead>
		<tr>
			<th>ID</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
		@if( $items->isEmpty() )
			<tr>
				<td colspan="2">No items to list</td>
			</tr>
		@else
			@foreach( $items as $item )
				<tr>
					<td>{!! $item->id !!}</td>
					<td><a href="{!! route( 'vehiclelookups.edit', $item->id ) !!}}" class="btn btn-sm btn-primary">Edit</a></td>
					<td><a href="{!! route( 'vehiclelookups.delete', $item->id ) !!}}" class="btn btn-sm btn-danger">Delete</a></td>
				</tr>
			@endforeach
		@endif
	</tbody>

</table>

@if( ! $items->isEmpty() )
	{!! $items->links() !!}
@endif