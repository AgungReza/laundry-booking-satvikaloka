<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

$routes->get('/', 'Home::index');
$routes->get('payment-proof/(:num)', 'PaymentProofController::show/$1', ['filter' => 'auth']);

$routes->group('', ['filter' => 'guest'], static function ($routes) {
    $routes->get('login', 'Auth\AuthController::login');
    $routes->post('login', 'Auth\AuthController::doLogin');
    $routes->get('register', 'Auth\AuthController::register');
    $routes->post('register', 'Auth\AuthController::doRegister');
});

$routes->get('logout', 'Auth\AuthController::logout', ['filter' => 'auth']);

// Admin routes with authentication and role-based access control
$routes->group('admin', ['filter' => ['auth', 'role:admin']], static function ($routes) {
    $routes->get('dashboard', 'Admin\DashboardController::index');

    $routes->get('machines', 'Admin\MachineController::index');
    $routes->get('machines/create', 'Admin\MachineController::create');
    $routes->post('machines', 'Admin\MachineController::store');
    $routes->get('machines/(:num)/edit', 'Admin\MachineController::edit/$1');
    $routes->post('machines/(:num)', 'Admin\MachineController::update/$1');
    $routes->post('machines/(:num)/delete', 'Admin\MachineController::delete/$1');

    $routes->get('addons', 'Admin\AddonController::index');
    $routes->get('addons/create', 'Admin\AddonController::create');
    $routes->post('addons', 'Admin\AddonController::store');
    $routes->get('addons/(:num)/edit', 'Admin\AddonController::edit/$1');
    $routes->post('addons/(:num)', 'Admin\AddonController::update/$1');
    $routes->post('addons/(:num)/delete', 'Admin\AddonController::delete/$1');

    $routes->get('bookings', 'Admin\BookingController::index');
    $routes->get('bookings/(:num)', 'Admin\BookingController::show/$1');
    $routes->post('bookings/(:num)/complete', 'Admin\BookingController::complete/$1');
    $routes->post('bookings/(:num)/cancel', 'Admin\BookingController::cancel/$1');

    $routes->get('payments', 'Admin\PaymentController::index');
    $routes->post('payments/(:num)/approve', 'Admin\PaymentController::approve/$1');
    $routes->post('payments/(:num)/reject', 'Admin\PaymentController::reject/$1');

    $routes->get('bank-accounts', 'Admin\BankAccountController::index');
    $routes->post('bank-accounts', 'Admin\BankAccountController::store');
    $routes->post('bank-accounts/(:num)/toggle', 'Admin\BankAccountController::toggle/$1');

    $routes->get('expenses', 'Admin\ExpenseController::index');
    $routes->post('expenses', 'Admin\ExpenseController::store');

    $routes->get('reports', 'Admin\ReportController::index');
});
// Customer routes with authentication and role-based access control
$routes->group('customer', ['filter' => ['auth', 'role:customer']], static function ($routes) {
    $routes->get('dashboard', 'Customer\DashboardController::index');
    $routes->get('bookings', 'Customer\BookingController::index');
    $routes->get('bookings/create', 'Customer\BookingController::create');
    $routes->post('bookings', 'Customer\BookingController::store');
    $routes->get('bookings/(:num)', 'Customer\BookingController::show/$1');

    $routes->get('payments/(:num)/upload', 'Customer\PaymentController::uploadForm/$1');
    $routes->post('payments/(:num)/upload', 'Customer\PaymentController::upload/$1');
});