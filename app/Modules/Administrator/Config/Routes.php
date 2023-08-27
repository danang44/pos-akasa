<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('administrator', ['namespace' => 'App\Modules\Administrator\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','AdministratorAction::$1');
    $subroutes->add('ajax/(:any)','AdministratorAjax::$1');
    $subroutes->add('', 'Administrator::index');
	$subroutes->add('(:any)', 'Administrator::$1');

});

$routes->group('objekpajak', ['namespace' => 'App\Modules\Objekpajak\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','ObjekpajakAction::$1');
    $subroutes->add('ajax/(:any)','ObjekpajakAjax::$1');
    $subroutes->add('', 'Objekpajak::index');
	$subroutes->add('(:any)', 'Objekpajak::$1');

});