<?php


use app\controllers\CatalogController;
use app\controllers\CourseController;
use app\controllers\EnrollmentController;
use app\controllers\HomeController;
use app\controllers\AuthController;
use app\controllers\AdminController;
use app\controllers\ApiController;

use app\controllers\LessonController;
use app\controllers\PricingController;
use app\core\routing\Router;

$router = Router::getRouter();

$router->get('/', HomeController::class, 'index');
$router->get('/home', HomeController::class, 'index');
$router->get('/pricing', PricingController::class, 'index');
$router->get('/catalog', CatalogController::class, 'index');

$router->get('/login', AuthController::class, 'login');
$router->post('/login', AuthController::class, 'submitLogin');
$router->post('/logout', AuthController::class, 'submitLogOut');

$router->get('/signup', AuthController::class, 'signup');
$router->get('/register', AuthController::class, 'signup');
$router->post('/signup', AuthController::class, 'submitSignup');
$router->post('/register', AuthController::class, 'submitSignup');

$router->post('/enroll', EnrollmentController::class, 'submitEnrollment');

$router->get('/admin', AdminController::class, 'adminPanel');
$router->get('/admin/crud', AdminController::class, 'adminCrud');
$router->get('/admin/search', AdminController::class, 'adminSearch');
$router->get('/admin/query', AdminController::class, 'adminQuery');

// API routes
$router->get('/api/getTables', ApiController::class, 'getTables');
$router->get('/api/getTableData', ApiController::class, 'getTableData');
$router->get('/api/getCourses', ApiController::class, 'getCourses');
$router->get('/api/fetchProcedures', ApiController::class, 'fetchProcedures');
$router->get('/api/fetchFunctions', ApiController::class, 'fetchFunctions');
$router->get('/api/search', ApiController::class, 'search');
$router->get('/api/query', ApiController::class, 'query');
$router->post('/api/insertDatabase', ApiController::class, 'insertDatabase');
$router->post('/api/updateDatabase', ApiController::class, 'updateDatabase');
$router->post('/api/deleteFromDatabase', ApiController::class, 'deleteFromDatabase');

$router->get('/api/fetchVideo', ApiController::class, 'fetchVideo');

// Composed URI paths
$router->get('/course/(\d+)', CourseController::class, 'getCourse'); 
$router->get('/course/(\d+)/lesson/(\d+)', LessonController::class, 'getLesson'); 
