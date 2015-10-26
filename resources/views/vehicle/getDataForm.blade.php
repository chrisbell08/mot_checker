{!!  Form::open(array('route' => 'api.vehicleCheck', 'method' => 'POST')) !!}

reg
    {!!  Form::text('reg')  !!}


make
{!! Form::text('make') !!}

{!! Form::hidden('key', env('ADMIN_API_KEY') !!}
{!! Form::submit() !!}
{!! Form::close() !!}