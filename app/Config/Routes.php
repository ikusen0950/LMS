<?php

namespace Config;

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
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

//Routes for login
$routes->get('/', '\Myth\Auth\Controllers\AuthController::login');
$routes->get('/logout', '\Myth\Auth\Controllers\AuthController::logout');


//Routes for sub menu in dashbaord
$routes->get('/setting_status', 'Status::index');
$routes->get('/setting_grade', 'Grade::index');
$routes->get('/setting_authors', 'Author::index');
$routes->get('/setting_genre', 'Genre::index');
$routes->get('/setting_publisher', 'Publisher::index');
$routes->get('/setting_activity_log', 'Log::index');
$routes->get('/setting_users', 'User::index');
$routes->get('/setting_app', 'Setting::index');
$routes->get('/setting_book_status', 'BookStatus::index');

$routes->get('/profile', 'Profile::index');
$routes->get('/students', 'Student::index');
$routes->get('/inventory', 'Book::index');
$routes->get('/history', 'History::index');


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');

/*
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
