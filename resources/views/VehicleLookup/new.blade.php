<div id="lookup-form-wrapper" class="lookup-form__wrapper">
    <div id="lookup-form-form" class="lookup-form__form">

        <div class="col-md-6 col-xs-12">
            {!!  Form::open(array('route' => 'lookup.postNewLookup', 'method' => 'POST', 'id' => 'postNewLookup')) !!}
            <div class="form-group">
                {!!  Form::text('reg', null, ['class' => 'form-control', 'placeholder' => 'Your Registration', 'required' => 'true'])  !!}
            </div>
            <div class="form-group">
                {!!  Form::text('make', null, ['class' => 'form-control', 'placeholder' => 'Vehicle Make', 'required' => 'true'])  !!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success"><i class="fa fa-search"></i>&nbsp;Lookup Details</button>
            </div>
            {!! csrf_field() !!}
            {!! Form::close() !!}
        </div>
        <div class="col-md-6 hidden-xs hidden-sm">

        </div>

    </div>

    <div id="lookup-form-loader" class="lookup-form__loader opaque">
        <img src="/img/speedo-loading.gif" alt="Wait" /><h3>Looking up details..</h3>
    </div>

    <div id="lookup-form-results" class="lookup-form__results opaque"></div>
</div>