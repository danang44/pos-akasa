<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('main', ['namespace' => 'App\Modules\Main\Controllers', 'filter' => 'web-auth'], function($subroutes){
	$subroutes->add('action/(:any)','MainAction::$1');
    $subroutes->add('ajax/(:any)','MainAjax::$1');
    $subroutes->add('', 'Main::index');
    $subroutes->add('(:any)', 'Main::$1');
});

/*
$routes->group('objekpajak', ['namespace' => 'App\Modules\Objekpajak\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','ObjekpajakAction::$1');
    $subroutes->add('ajax/(:any)','ObjekpajakAjax::$1');
    $subroutes->add('', 'Objekpajak::index');
	$subroutes->add('(:any)', 'Objekpajak::$1');

});
*/