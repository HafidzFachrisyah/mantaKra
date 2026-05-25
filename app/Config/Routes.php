<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'PemetaanJabatan::index');
$routes->get('/pemetaan', 'PemetaanJabatan::index');
$routes->post('/pemetaan/import', 'PemetaanJabatan::import');
$routes->get('/pemetaan/export/(:segment)', 'PemetaanJabatan::export/$1');
$routes->post('/pemetaan/delete', 'PemetaanJabatan::deleteAll');
