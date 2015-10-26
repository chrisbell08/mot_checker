@extends('spark::layouts.app')

@section('content')
	<div class="modal fade" id="lookup-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Enter your vehicle details below</h4>
				</div>
				<div class="modal-body">
					@include('VehicleLookup.new')
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

	<div class="modal fade" id="vehicle-details">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Full Lookup Details</h4>
				</div>
				<div class="modal-body clearfix">

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

<!-- Main Content -->
<div class="container spark-screen">
	@if (Spark::usingTeams() && ! Auth::user()->hasTeams())

		<!-- Teams Are Enabled, But The User Doesn't Have One -->
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">You Need A Team!</div>

					<div class="panel-body bg-warning">
						It looks like you haven't created a team!
						You can create one in your <a href="/settings?tab=teams">account settings</a>.
					</div>
				</div>
			</div>
		</div>

	@else

	<!-- Teams Are Disabled Or User Is On Team -->
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Your Vehicles <button class="pull-right btn btn-primary btn-xs" data-toggle="modal" data-target="#lookup-modal"><i class="fa fa-plus-circle"></i>&nbsp;New Lookup</button></div>

				<div class="panel-body">
					<table class="table">
						<thead>
							<th></th>
							<th>Make</th>
							<th>Reg</th>
							<th>MOT Due</th>
							<th>Taxt Due</th>
							<th>Last lookup date</th>
							<th></th>
							<th></th>
						</thead>
						<tbody>
							@foreach($vehicles as $vehicle)
								<tr id="{!! $vehicle->latest_lookup->first()->id !!}">
									@include('partials.vehicleTable')
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	@endif
</div>
@endsection
