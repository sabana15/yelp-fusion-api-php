PHP wrapper for the Yelp API V3
----------------------------------------------------------------------
INSTALL
----------------------------------------------------------------------
#NOTE: Ignore this guzzle package if you already have it installed

1. You can add as a dependency using Composer:

   composer require guzzlehttp/guzzle:^6.0

   composer require sabana15/yelp-fusion-api-php

2. Alternatively, you can specify as a dependency in your project's existing composer.json file:

   {

        "require": {

            "guzzlehttp/guzzle:^6.0",

            "sabana15/yelp-fusion-api-php": "1.0"

        }
    }

----------------------------------------------------------------------
USAGE
----------------------------------------------------------------------
This package only supports Yelp Fusion API v3

# Create Yelp API CLient
$yelpFusion = new TrialAPI\YelpClient('Place the API Key here);

# Fetch the businesses based on search parameters
$param = array('location' => 'xyz');

$businessSearchList = $yelpFusion->getBusinessesSearchResults($param);

# PHP Example

Create the file index.php and put the following content.

require 'vendor/autoload.php';

try{

    $apikey = 'API key goes here';

    $yelpFusion = new TrialAPI\YelpClient($apikey);

    $param = array('location' => 'melbourne');

    $businessSearchList = $yelpFusion->getBusinessesSearchResults($param);

    var_dump($businessSearchList);

}

catch(Exception $e) {

    echo $e->getResponseBody();

}

Run 'php index.php' to check in terminal or accesss and check in browser
