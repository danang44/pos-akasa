<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('api', ['namespace' => 'App\Modules\Api\Controllers'], function($subroutes){
    $subroutes->add('token/(:any)','Token::$1', ["filter" => "token-auth"]);
    $subroutes->add('v1/(:any)','MobileV1::$1', ["filter" => "api-auth"]);
    $subroutes->add('dev/(:any)','MobileDev::$1', ["filter" => "token-auth"]);
    $subroutes->add('tes/(:any)','Tes::$1');
    $subroutes->add('tokenencryption/(:any)','TokenEncryption::$1', ["filter" => "token-auth-encryption"]);
    $subroutes->add('v2/(:any)','MobileV2::$1', ["filter" => "api-auth-encryption"]);
    $subroutes->add('mitradarat/(:any)','MitraDarat::$1');
});
