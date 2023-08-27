<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('ajap', ['namespace' => 'App\Modules\Ajap\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','AjapAction::$1');
    $subroutes->add('ajax/(:any)','AjapAjax::$1');
    $subroutes->add('', 'Ajap::index');
	$subroutes->add('(:any)', 'Ajap::$1');

});
