
/*
 |--------------------------------------------------------------------------
 | Laravel Spark - Creating Amazing Experiences.
 |--------------------------------------------------------------------------
 |
 | First, we will load all of the "core" dependencies for Spark which are
 | libraries such as Vue and jQuery. Then, we will load the components
 | which manage the Spark screens such as the user settings screens.
 |
 | Next, we will create the root Vue application for Spark. We'll only do
 | this if a "spark-app" ID exists on the page. Otherwise, we will not
 | attempt to create this Vue application so we can avoid conflicts.
 |
 */

require('laravel-spark/core/dependencies');

if ($('#spark-app').length > 0) {
	require('./spark/components')

	new Vue(require('laravel-spark'));
}

/*
 |--------------------------------------------------------------------------
 | Ajax Vehicle Lookup
 |--------------------------------------------------------------------------
 |
 */
// Globals need for the form reset function
var $lookupFormForm = $('#lookup-form-form');
var $lookFormLoader = $('#lookup-form-loader');
var $lookupFormResults = $('#lookup-form-results');
var $formWrapper = $('#lookup-form-wrapper');

 $('#postNewLookup').submit(function(e){
      e.preventDefault()

     // Zoom out the form and zoom in the loader
     $($lookupFormForm).addClass('zoomOut');
     $($lookFormLoader).toggleClass('zoomIn opaque');

     // Post search form
      $.post($(this).attr('action'), $(this).serialize(), function (data) {

          // Inject the results into dom
          $($lookupFormResults).html(data);

          // Make modal bigger to show results
          $($formWrapper).addClass('lookup-form__wrapper--results');

          // Zoom out loader and in results
          $($lookFormLoader).toggleClass('zoomIn zoomOut');
          $($lookupFormResults).toggleClass('zoomIn opaque');
      })
 });

/*
 |--------------------------------------------------------------------------
 | Populate Vehicle Details Modal
 |--------------------------------------------------------------------------
 |
 */
var $modal = $('#vehicle-details');
$($modal).on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var lookUpId = button.data('id');
    var url = 'lookup/getVehicleDetails/' + lookUpId;

    // Get details for lookup id
    $.get(url, function(data){
        $($modal).find('.modal-body').html(data)
    });

});


/*
 |--------------------------------------------------------------------------
 | Ajax Refresh Vehicle Lookup
 |--------------------------------------------------------------------------
 |
 */
$('.js-vehicle-lookup-refresh').click(function(e){
    e.preventDefault();

    var anchor = $(this);
    var id = anchor.data('id');
    var url = 'lookup/refreshLookup/' + id;
    var row = '#' + id;

    $(this).children('i').toggleClass('fa-spin');

    // Send get request for data
    $.get(url, function(data){
        $(row).html(data);
        $(anchor).children('i').toggleClass('fa-spin');

        // TODO Bind the click event back to the link when it's injected into DOM
    });
});


/*
 |--------------------------------------------------------------------------
 | Reset the Vehicle lookup form when the modal is closed
 |--------------------------------------------------------------------------
 |
 */
$('#lookup-modal').on('hidden.bs.modal', function (e) {

    //// Reset the loader
    //$($lookFormLoader).toggleClass('opaque zoomOut');
    //
    //// Reset the lookup form
    //$($lookupFormForm).toggleClass('zoomOut');
    //
    //// Reset results
    //$($lookupFormResults).html("").toggleClass('opaque');
    //
    //// Reset Modal
    //$($formWrapper).removeClass('lookup-form__wrapper--results');

    // Todo refresh the vechile table with ajax instead of just refreshing the page
    location.reload();
});


