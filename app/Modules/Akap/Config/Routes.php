<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('akap', ['namespace' => 'App\Modules\Akap\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','AkapAction::$1');
    $subroutes->add('ajax/(:any)','AkapAjax::$1');
    $subroutes->add('', 'Akap::index');
	$subroutes->add('(:any)', 'Akap::$1');

});
