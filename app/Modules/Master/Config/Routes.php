<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('master', ['namespace' => 'App\Modules\Master\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','MasterAction::$1');
    $subroutes->add('ajax/(:any)','MasterAjax::$1');
    $subroutes->add('', 'Master::index');
	$subroutes->add('(:any)', 'Master::$1');

});