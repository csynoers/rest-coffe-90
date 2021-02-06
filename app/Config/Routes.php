<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

$routes->resource('kategori');
$routes->add('kategori/update/(:num)','Kategori::update/$1');

$routes->resource('menu');
$routes->add('menu/update/(:num)','Menu::update/$1');

// Equivalent to the following:
// $routes->get('kategori/new',                'kategori::new');
// $routes->post('kategori/create',            'kategori::create');
// $routes->post('kategori',                   'kategori::create');   // alias
// $routes->get('kategori',                    'kategori::index');
// $routes->get('kategori/show/(:segment)',    'kategori::show/$1');
// $routes->get('kategori/(:segment)',         'kategori::show/$1');  // alias
// $routes->get('kategori/edit/(:segment)',    'kategori::edit/$1');
// $routes->post('kategori/update/(:segment)', 'kategori::update/$1');
// $routes->get('kategori/remove/(:segment)',  'kategori::remove/$1');
// $routes->post('kategori/delete/(:segment)', 'kategori::update/$1');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
