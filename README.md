PHP wrapper for the Yelp API
----------------------------------------------------------------------
INSTALL
----------------------------------------------------------------------
1. You can add as a dependency using Composer:
   composer require sabana15/yelp-fusion-api-php

2. Alternatively, you can specify as a dependency in your project's existing composer.json file:
   {
        "require": {
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

# fetch the business by Id
$businessId = '111111';

$businessbyId = $yelpFusion->getBusinessbyId($businessId);

