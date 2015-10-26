<div class="col-xs-12">
    <div class="lookup-form__results__headings">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="alert alert-success"><strong>MOT Due:</strong>&nbsp;{!! $lookup->mot_due->format('d/m/Y') !!}</div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="alert alert-info"><strong>TAX Due:</strong>&nbsp;{!! $lookup->tax_due->format('d/m/Y') !!}</div>
            </div>
        </div>
    </div>
    <div class="lookup-form__results__details">
        <h5>Vehicle Information</h5>
        <ul class="no-bullet list-group">
            {!! $lookup->vehicle_details !!}
        </ul>
    </div>

</div>