<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::loginForm');
$routes->get('/register', 'Auth::registerForm');
//$routes->get('/user_panel', 'UserPanelController::index');
$routes->get('/logout', 'Auth::logout');
$routes->get('/forgotpass', 'Auth::forgotpass');
$routes->get('/menu', 'Home::showMenu');





$routes->post('/register/process', 'Auth::processRegister');
$routes->post('/login/authenticate', 'Auth::processLogin');



$routes->group('admin', ['filter' => 'admin_auth'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('users', 'Admin::users');
    $routes->get('edit/(:num)', 'Admin::editUser/$1');
    $routes->post('update/(:num)', 'Admin::updateUser/$1');
    $routes->get('delete/(:num)', 'Admin::delete/$1');
    $routes->post('updatePrice', 'Admin::updatePrice');
    $routes->get('data', 'Admin::systemData');
    $routes->post('updateDateRecords', 'Admin::updateSystemDate');
    $routes->post('updateClassAvailability', 'Admin::updateClass');
});

$routes->group('accountant', ['filter' => 'accountant_auth'], function($routes) {
    $routes->get('/', 'Accountant::index');
    $routes->get('menu', 'Accountant::uploadView');
    $routes->get('menu/edit/(:num)', 'Accountant::edit/$1');
    $routes->post('menu/update/(:num)', 'Accountant::update/$1');
    $routes->get('financialInfo', 'Accountant::financialInfo');
    $routes->post('addPayment', 'Accountant::addPayment');
    $routes->post('uploadMenu', 'Accountant::uploadMenu');
    $routes->get('daily_orders/(:any)?', 'Accountant::dailyOrders/$1');
    $routes->get('daily_orders', 'Accountant::dailyOrders');
    $routes->post('generatePDF/(:any)', 'Accountant::generatePDF/$1');
});

$routes->group('user', ['filter' => 'user_auth'], function($routes) {
    $routes->get('/', 'User::index');
    $routes->get('order/(:num)', 'User::showOrder/1/$1');
    $routes->get('order', 'User::showOrder/1');
    $routes->get('order_mobile', 'User::showOrder/0');
    $routes->get('order_mobile/(:num)', 'User::showOrder/0/$1');
    $routes->post('saveOrder', 'User::saveOrder');
    $routes->get('changeMonth/(:any)/(:num)', 'User::changeMonth/$1/$2');
    $routes->get('info', 'User::profile');
    $routes->post('selectClass', 'User::selectClass');
});


$routes->group('graduated', ['filter' => 'graduated_auth'], function($routes) {
    $routes->get('/', 'Graduated::index');
});
