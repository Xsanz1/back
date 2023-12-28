<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

// $routes->match(['post', 'options'], 'register', 'UserController::register');
// $routes->get('users', 'UserController::index');
// $routes->match(['post', 'options'], 'login', 'UserController::login');
// $routes->match(['put', 'options'], 'update-user/(:any)', 'UserController::update/$1');
// $routes->match(['delete', 'options'], 'delete-user/(:any)', 'UserController::delete/$1');
$routes->get('/', 'Home::index');

// User Routes
$routes->match(['post', 'options'], 'register', 'UserController::register');
$routes->get('users', 'UserController::index');
$routes->match(['post', 'options'], 'login', 'UserController::login');
$routes->match(['put', 'options'], 'update-user/(:any)', 'UserController::update/$1');
$routes->match(['delete', 'options'], 'delete-user/(:any)', 'UserController::delete/$1');

// Income Routes
$routes->match(['post', 'options'], 'add-income', 'IncomeController::addIncome');
$routes->get('get-incomes', 'IncomeController::getIncomes');
$routes->match(['delete', 'options'], 'delete-income/(:num)', 'IncomeController::deleteIncome/$1');

// Analytics
$routes->post('analytics/save', 'AnalyticsController::saveData');

//bills
$routes->match(['get', 'options'], 'bills', 'BillsController::index');
$routes->match(['post', 'options'], 'create/bills', 'BillsController::create');
$routes->match(['put', 'options'], 'update/bills/(:segment)', 'BillsController::update/$1');
$routes->match(['delete', 'options'], 'delete/bills/(:segment)', 'BillsController::delete/$1');

//goals
$routes->match(['get', 'options'], 'goals', 'GoalsController::index');
$routes->match(['post', 'options'], 'create/goals', 'GoalsController::create');
$routes->match(['put', 'options'], 'update/goals/(:segment)', 'GoalsController::update/$1');
$routes->match(['delete', 'options'], 'delete/goals/(:segment)', 'GoalsController::delete/$1');

//Analytics
$routes->match(['get', 'options'], 'analytics', 'AnalyticsController::index');
$routes->match(['post', 'options'], 'create/analytics', 'AnalyticsController::create');
$routes->match(['put', 'options'], 'update/analytics/(:segment)', 'AnalyticsController::update/$1');
$routes->match(['delete', 'options'], 'delete/analytics/(:segment)', 'AnalyticsController::delete/$1');

// TRANSACTION
$routes->match(['get', 'options'], 'transaction', 'TransactionController::index');
$routes->match(['post', 'options'], 'create/transaction', 'TransactionController::create');
$routes->match(['put', 'options'], 'update/transaction/(:segment)', 'TransactionController::update/$1');
$routes->match(['delete', 'options'], 'delete/transaction/(:segment)', 'TransactionController::delete/$1');

// Expense Routes
$routes->match(['post', 'options'], 'add-expense', 'ExpenseController::addExpense');
$routes->get('get-expenses', 'ExpenseController::getExpense');
$routes->match(['delete', 'options'], 'delete-expense/(:num)', 'ExpenseController::deleteExpense/$1');

$routes->group('api', ['namespace' => 'App\Controllers\Api'], function ($routes) {
    $routes->post('admin-login', 'AuthController::adminLogin');
});

