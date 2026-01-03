<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::authenticate');
$routes->get('logout', 'AuthController::logout');

// common dashboard route
$routes->get('dashboard', 'DashboardController::index', ['filter' => 'auth']);
// admin dashboard and routes
$routes->get('admin/dashboard', 'Admin\DashboardController::index', ['filter' => 'auth']);
// $routes->group('admin', ['filter' => 'auth'], function ($routes) {
$routes->group('admin', ['filter' => ['auth', 'role:admin']], function ($routes) {
    $routes->get('events', 'Admin\EventController::index');
    $routes->get('events/create', 'Admin\EventController::create');
    $routes->post('events/store', 'Admin\EventController::store');
    $routes->get('events/(:num)/edit', 'Admin\EventController::edit/$1');
    $routes->post('events/(:num)/edit', 'Admin\EventController::update/$1');

    $routes->get('events/(:num)/quotas', 'Admin\QuotaController::index/$1');
    $routes->post('events/(:num)/quotas', 'Admin\QuotaController::store/$1');
    $routes->get('quotas/(:num)/delete', 'Admin\QuotaController::delete/$1');

    $routes->get('events/(:num)/approval-bands', 'Admin\ApprovalBandController::index/$1');
    $routes->post('events/(:num)/approval-bands', 'Admin\ApprovalBandController::store/$1');
    $routes->get('approval-bands/(:num)/delete', 'Admin\ApprovalBandController::delete/$1');

    $routes->get('events/(:num)/form-fields', 'Admin\FormNodeController::index/$1');
    $routes->post('events/(:num)/form-fields', 'Admin\FormNodeController::store/$1');
    $routes->get('form-nodes/(:num)/delete', 'Admin\FormNodeController::delete/$1');
});

$routes->group('user', ['filter' => ['auth', 'role:employee,manager,director,external']], function ($routes) {
    $routes->get('events', 'User\EventController::index');
    $routes->get('events/(:num)/register', 'User\EventController::register/$1');
    $routes->post('events/(:num)/register', 'User\EventController::submit/$1');
});

$routes->group('approver', ['filter' => ['auth', 'role:manager,director']], function ($routes) {
    $routes->get('dashboard', 'Approver\DashboardController::index');
    $routes->post('registrations/(:num)/approve', 'Approver\DashboardController::approve/$1');
    $routes->post('registrations/(:num)/reject', 'Approver\DashboardController::reject/$1');
});
