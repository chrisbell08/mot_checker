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
    var mot;
    var tax;
    var postResults = true;

    // Check the mot
    if (this.exists('.isValidMot p')) {
        mot = this.getHTML('.isValidMot p');

        // Has MOT been done (New cars)
        mot = mot.trim();
        if(mot === "No details held by DVLA") {
            this.echo('This car hasn\'t been MOT\'d yet');
            postResults = false;
        } else {
            mot = mot.substring(mot.lastIndexOf(":")+2);
        }
    } else if (this.exists('.isInvalidMot p')) {
        mot = this.getHTML('.isInvalidMot p');
        mot = mot.substring(mot.lastIndexOf(":")+2);
    }

    // Check the tax
    if (this.exists('.isValidTax p')) {
        tax = this.getHTML('.isValidTax p');

        // Is the car SORN
        if(tax == "&nbsp;") {
            this.echo('This car has been declared SORN');
            postResults = false;

        } else {
            tax = tax.substring(tax.lastIndexOf(":")+2);
        }
    }else if (this.exists('.isInvalidTax p')) {
        tax = this.getHTML('.isInvalidTax p');
        tax = tax.substring(tax.lastIndexOf(":")+2);
    }

    var details = this.getHTML('.ul-data');

    // Trim the empty spaces from the details string
    details = details.trim(details);

    if(postResults) {
        casper.open(apiUrl, {
            method: 'POST',
            data: {
                'mot': mot,
                'tax': tax,
                'details': details,
                'vehicleId' : vehicleId
            }
        });
    }
});


casper.run();
