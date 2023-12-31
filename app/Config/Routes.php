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
$routes->setDefaultController('home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override('App\Controllers\Auth::login');
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Auth Routes
 * --------------------------------------------------------------------
 */

$routes->match(['get', 'post'], 'login', 'Auth::login'); // LOGIN PAGE
$routes->match(['get', 'post'], 'register', 'Auth::register'); // REGISTER PAGE
$routes->match(['get', 'post'], 'forgotpassword', 'Auth::forgotPassword'); // FORGOT PASSWORD
$routes->match(['get', 'post'], 'activate/(:num)/(:any)', 'Auth::activateUser/$1/$2'); // INCOMING ACTIVATION TOKEN FROM EMAIL
$routes->match(['get', 'post'], 'resetpassword/(:num)/(:any)', 'Auth::resetPassword/$1/$2'); // INCOMING RESET TOKEN FROM EMAIL
$routes->match(['get', 'post'], 'updatepassword/(:num)', 'Auth::updatepassword/$1'); // UPDATE PASSWORD
$routes->match(['get', 'post'], 'lockscreen', 'Auth::lockscreen'); // LOCK SCREEN
$routes->get('logout', 'Auth::logout'); // LOGOUT


$routes->match(['get', 'post'], 'profile', 'Auth::profile'); 

/**
 * --------------------------------------------------------------------
 * Activity
 * --------------------------------------------------------------------
 */

$routes->match(['get', 'post'], 'Activity/show', 'Activity::show'); 
$routes->match(['get', 'post'], 'Activity/add', 'Activity::add'); 
$routes->match(['get', 'post'], 'Activity/edit/(:num)', 'Activity::edit/$1'); 
$routes->match(['get', 'post'], 'Activity/update/(:num)', 'Activity::update/$1'); 
$routes->match(['get', 'post'], 'Activity/delete/(:num)', 'Activity::delete/$1'); 

$routes->match(['get', 'post'], 'insertActivity', 'Activity::insert'); 

/**
 * --------------------------------------------------------------------
 * Tracker
 * --------------------------------------------------------------------
 */


 $routes->match(['get', 'post'], 'tracker', 'Tracker::index'); 
 $routes->match(['get', 'post'], 'setup', 'Setup\Setup::index'); 



 // AJAX ROUTES
$routes->post('/ajax/setup/runDatabase', 'Setup\Setup::runDatabaseAJAX');


/**
 * --------------------------------------------------------------------
 * Home Routes
 * --------------------------------------------------------------------
 */

$routes->get('/', 'Auth::login');
$routes->get('dashboard', 'Dashboard::index');

$routes->get('/setup', 'Setup\Setup::index');

/**
 * --------------------------------------------------------------------
 * SUPER ADMIN ROUTES. MUST BE LOGGED IN AND HAVE ROLE OF '1'
 * --------------------------------------------------------------------
 */

$routes->group('', ['filter' => 'auth:Role,1'], function ($routes) {

	$routes->get('superadmin', 'Superadmin::index'); // SUPER ADMIN DASHBOARD
	$routes->match(['get', 'post'], 'superadmin/profile', 'Auth::profile'); 

});


/**
 * --------------------------------------------------------------------
 * ADMIN ROUTES. MUST BE LOGGED IN AND HAVE ROLE OF '2'
 * --------------------------------------------------------------------
 */

$routes->group('', ['filter' => 'auth:Role,2'], function ($routes){

	$routes->get('dashboard', 'Dashboard::index'); // ADMIN DASHBOARD
	$routes->match(['get', 'post'], 'dashboard/profile', 'Auth::profile');
});

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
