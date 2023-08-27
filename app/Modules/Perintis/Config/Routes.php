<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('perintis', ['namespace' => 'App\Modules\Perintis\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','PerintisAction::$1');
    $subroutes->add('ajax/(:any)','PerintisAjax::$1');
    $subroutes->add('', 'Perintis::index');
	$subroutes->add('(:any)', 'Perintis::$1');

});