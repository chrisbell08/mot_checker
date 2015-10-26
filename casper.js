/**
 * Casper JS
 * http://casperjs.org/
 *
 * Runs the phantom.js headless server to crawl web pages
 */
// Globals
var apiUrl = 'http://ec2-52-17-183-118.eu-west-1.compute.amazonaws.com//api/v1/casperPost';
var vehicleId;

// Create new instance of Casper
var casper = require('casper').create();

// Crawl the DVLA website for vehicle details
casper.start('https://www.vehicleenquiry.service.gov.uk/', function() {

    // Get args from cli
    var reg = casper.cli.args[0];
    var make = casper.cli.args[1];
    vehicleId = casper.cli.args[2];

    var formData = {
        "ctl00$MainContent$txtSearchVrm": reg,
        "ctl00$MainContent$MakeTextBox": make
    };

    // Populate dvla MOT form with vehicle data
    casper.fill('#EVL', formData, false);

    // Submit form
    this.click('#MainContent_butSearch');
});

// Process results
casper.then(function() {

    // Get data from form
    var mot = this.getHTML('.isValidMot p');
    var tax = this.getHTML('.isValidTax p');
    var details = this.getHTML('.ul-data');

    // Remove unwatched text from strings
    mot = mot.substring(mot.lastIndexOf(":")+2);
    tax = tax.substring(tax.lastIndexOf(":")+2);

    // Trim the empty spaces from the details string
    details = details.trim(details);

    // Debugging
    //this.echo(mot);
    //this.echo(tax);
    //this.echo(details);

    casper.open(apiUrl, {
        method: 'POST',
        data: {
            'mot': mot,
            'tax': tax,
            'details': details,
            'vehicleId' : vehicleId
        }
    });
});


casper.run();
