<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index');
$routes->get('logout', 'HomeController::logout');
$routes->post('auth', 'HomeController::auth');
$routes->get('users', 'UsersController::index', ['filter' => 'auth']);
$routes->post('users/save', 'UsersController::save', ['filter' => 'auth']);
$routes->post('users/update', 'UsersController::update', ['filter' => 'auth']);
$routes->post('users/delete', 'UsersController::delete', ['filter' => 'auth']);
$routes->get('category', 'CategoryController::index', ['filter' => 'auth']);
$routes->post('category/save', 'CategoryController::save', ['filter' => 'auth']);
$routes->post('category/update', 'CategoryController::update', ['filter' => 'auth']);
$routes->post('category/duplicate', 'CategoryController::duplicate', ['filter' => 'auth']);
$routes->post('category/delete', 'CategoryController::delete', ['filter' => 'auth']);
$routes->get('category/(:any)', 'CategoryController::detail/$1', ['filter' => 'auth']);
$routes->post('category/getData', 'CheckController::getDataById', ['filter' => 'auth']);
$routes->post('category/getDataProses', 'CheckController::getDataByIdProses', ['filter' => 'auth']);
$routes->post('check/getDataCategory', 'CategoryController::getDataCategory', ['filter' => 'auth']);
$routes->post('check/getDataByTipe', 'CategoryController::getDataByTipe', ['filter' => 'auth']);
$routes->get('check', 'CheckController::index', ['filter' => 'auth']);
$routes->get('check/bulk', 'CheckController::bulkAdd', ['filter' => 'auth']);
$routes->post('check/save', 'CheckController::save', ['filter' => 'auth']);
$routes->post('check/saveMulti', 'CheckController::saveMulti', ['filter' => 'auth']);
$routes->post('check/saveMultiBulk', 'CheckController::saveMultiBulk', ['filter' => 'auth']);
$routes->post('check/update', 'CheckController::update', ['filter' => 'auth']);
$routes->post('check/delete', 'CheckController::delete', ['filter' => 'auth']);
$routes->post('area/save', 'CategoryController::saveArea', ['filter' => 'auth']);
$routes->post('area/update', 'CategoryController::updateArea', ['filter' => 'auth']);
$routes->post('area/delete', 'CategoryController::deleteArea', ['filter' => 'auth']);
$routes->post('category/getDataArea', 'CategoryController::getDataArea', ['filter' => 'auth']);
$routes->post('check/getDataAreaById', 'CategoryController::getDataAreaById', ['filter' => 'auth']);
$routes->post('check/getDataAreaByName', 'CategoryController::getDataAreaByName', ['filter' => 'auth']);
$routes->get('task', 'TaskController::index', ['filter' => 'auth']);
$routes->get('taskboard', 'TaskController::taskBoard', ['filter' => 'auth']);
$routes->get('taskSummary', 'TaskController::taskSummary', ['filter' => 'auth']);
$routes->get('taskSummary/detail/(:num)', 'TaskController::detailAudit/$1', ['filter' => 'auth']);
$routes->get('taskSummary/detailTask/(:num)', 'TaskController::detailTask/$1', ['filter' => 'auth']);
$routes->post('task/save', 'TaskController::save', ['filter' => 'auth']);
$routes->post('taskSummary/saveDetail', 'TaskController::saveDetail', ['filter' => 'auth']);
$routes->post('taskSummary/approve', 'TaskController::approve', ['filter' => 'auth']);
$routes->post('taskSummary/audity', 'TaskController::audity', ['filter' => 'auth']);
$routes->post('taskSummary/deleteFoto', 'TaskController::deleteFoto', ['filter' => 'auth']);
$routes->post('task/update', 'TaskController::update', ['filter' => 'auth']);
$routes->post('task/delete', 'TaskController::delete', ['filter' => 'auth']);
$routes->post('task/audity', 'TaskController::audityAuditor', ['filter' => 'auth']);
$routes->get('finding', 'FindingController::index', ['filter' => 'auth']);
$routes->post('finding/getDataFindingIdAudit', 'FindingController::getDataFindingIdAudit', ['filter' => 'auth']);
$routes->post('finding/getDataFindingIdDetailAudit', 'FindingController::getDataFindingIdDetail', ['filter' => 'auth']);
$routes->post('finding/save', 'FindingController::save', ['filter' => 'auth']);
$routes->get('task/auditor', 'TaskController::taskAuditor', ['filter' => 'auth']);
$routes->get('task/detail/(:num)', 'TaskController::taskDetailAuditor/$1', ['filter' => 'auth']);
$routes->post('task/detail/saveDetail', 'TaskController::saveDetailAuditor', ['filter' => 'auth']);
$routes->post('task/detail/deleteFoto', 'TaskController::deleteFotoAuditor', ['filter' => 'auth']);
$routes->post('task/detail/finishTask', 'TaskController::finishTaskAuditor', ['filter' => 'auth']);
$routes->post('/searchCp', 'CheckController::search', ['filter' => 'auth']);
$routes->post('/searchClausal', 'CheckController::searchClausal', ['filter' => 'auth']);
$routes->get('/report', 'ReportController::index', ['filter' => 'auth']);

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
