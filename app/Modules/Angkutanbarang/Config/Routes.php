<?php

if(!isset($routes))
{ 
    $routes = \Config\Services::routes(true);
}

$routes->group('angkutanbarang', ['namespace' => 'App\Modules\Angkutanbarang\Controllers', 'filter' => 'web-auth'], function($subroutes){
    $subroutes->add('action/(:any)','AngkutanbarangAction::$1');
    $subroutes->add('ajax/(:any)','AngkutanbarangAjax::$1');
    $subroutes->add('', 'Angkutanbarang::index');
	$subroutes->add('(:any)', 'Angkutanbarang::$1');

});