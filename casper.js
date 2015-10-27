/**
 * Casper JS
 * http://casperjs.org/
 *
 * Runs the phantom.js headless server to crawl web pages
 */
// Globals
var homeUrl = 'http://ec2-52-17-183-118.eu-west-1.compute.amazonaws.com';
//var homeUrl = 'http://motchecker:8888';
var apiUrl = homeUrl + '/api/v1/casperPost';
var lookupId;
var errors = false;

// Create new instance of Casper
var casper = require('casper').create();

// Crawl the DVLA website for vehicle details
casper.start('https://www.vehicleenquiry.service.gov.uk/', function() {

    // Get args from cli
    var reg = casper.cli.args[0];
    var make = casper.cli.args[1];
    lookupId = casper.cli.args[2];

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
    var mot;
    var tax;
    var details;

    // Check the mot
    if (this.exists('.isValidMot p')) {
        mot = this.getHTML('.isValidMot p');

        // Has MOT been done (New cars)
        mot = mot.trim();
        if(mot === "No details held by DVLA") {
            mot = 'no-mot';
        } else {
            mot = mot.substring(mot.lastIndexOf(":")+2);
        }
    } else if (this.exists('.isInvalidMot p')) {
        mot = this.getHTML('.isInvalidMot p');
        mot = mot.substring(mot.lastIndexOf(":")+2);
    } else {
        errors = true;
    }

    // Check the tax
    if (this.exists('.isValidTax p')) {
        tax = this.getHTML('.isValidTax p');

        // Is the car SORN
        if(tax == "&nbsp;") {
            tax = 'sorn';

        } else {
            tax = tax.substring(tax.lastIndexOf(":")+2);
        }
    }else if (this.exists('.isInvalidTax p')) {
        tax = this.getHTML('.isInvalidTax p');
        tax = tax.substring(tax.lastIndexOf(":")+2);
    } else {
        errors = true;
    }

    if (this.exists('.ul-data')) {
        details = this.getHTML('.ul-data');
        details = details.trim(details);
    } else {
        errors = true;
    }

    if(!errors) {
        casper.open(apiUrl, {
            method: 'POST',
            data: {
                'mot': mot,
                'tax': tax,
                'details': details,
                'lookupId' : lookupId
            }
        });
    } else {
        this.echo('failed');
    }
});

casper.run();
