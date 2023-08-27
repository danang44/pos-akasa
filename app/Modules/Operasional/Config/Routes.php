<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('operasional', ['namespace' => 'App\Modules\Operasional\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','OperasionalAction::$1');
    $subroutes->add('ajax/(:any)','OperasionalAjax::$1');
    $subroutes->add('', 'Operasional::index');
	$subroutes->add('(:any)', 'Operasional::$1');

});

