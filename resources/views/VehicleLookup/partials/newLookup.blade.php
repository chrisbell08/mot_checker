<div class="col-xs-12">
    @if($lookup->vehicle_details === 'failed')
        <div class="alert alert-danger">
            <h4><i class="fa fa-times"></i>&nbsp;Lookup Failed</h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu elementum velit, in vestibulum est. Duis interdum, lorem id condimentum auctor, mi nibh vulputate odio, eget tristique augue ante eu augue</p>
        </div>
    @else
        <div class="lookup-form__results__headings">

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    @if($lookup->mot_due->format('d/m/Y') === "01/01/1900")
                        <div class="alert alert-success">
                            <strong>MOT Due:</strong>&nbsp;No details held by DVLA
                        @else
                        @if($lookup->mot_expired)
                            <div class="alert alert-danger">
                                <i class="fa fa-times"></i>
                        @else
                            <div class="alert alert-success">
                                <i class="fa fa-check"></i>
                        @endif
                             <strong>MOT Due:</strong>&nbsp;{!! $lookup->mot_due->format('d/m/Y') !!}
                    @endif
                    </div>
                </div>
                <div class="col-xs-12 col-md-6">
                    @if($lookup->tax_due->format('d/m/Y') === "01/01/1900")
                        <div class="alert alert-danger">
                            <strong>TAX Due:</strong>&nbsp;SORN
                    @else
                    @if($lookup->tax_expired)
                        <div class="alert alert-danger">
                            <i class="fa fa-times"></i>
                     @else
                        <div class="alert alert-info">
                            <i class="fa fa-check"></i>
                    @endif
                            <strong>TAX Due:</strong>&nbsp;{!! $lookup->tax_due->format('d/m/Y') !!}
                    @endif
                    </div>
                </div>
            </div>

        </div>

        <div class="lookup-form__results__details">
            <h5>Vehicle Information</h5>
            <ul class="no-bullet list-group">
                {!! $lookup->vehicle_details !!}
            </ul>
        </div>
    @endif
</div>

