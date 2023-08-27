<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('kspn', ['namespace' => 'App\Modules\Kspn\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','KspnAction::$1');
    $subroutes->add('ajax/(:any)','KspnAjax::$1');
    $subroutes->add('', 'Kspn::index');
	$subroutes->add('(:any)', 'Kspn::$1');

});