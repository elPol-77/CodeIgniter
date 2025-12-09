<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;
use App\Controllers\News;
use App\Controllers\Category;
use App\Controllers\Users;

/**
 * @var RouteCollection $routes
 */
$routes->setAutoRoute(false);

// $routes->get('/', 'Home::index');
$routes->get('/', 'News::index');

$routes->get('news', [News::class, 'index']);
$routes->get('news/new', [News::class, 'new']); // Add this line
$routes->post('news', [News::class, 'create']); // Add this line
$routes->get('news/(:segment)', [News::class, 'show']);
$routes->get('news/del/(:num)',[News::class, 'delete']);
$routes->post('news/update/updated/(:num)',[News::class, 'updatedItem']);
$routes->get('news/update/(:num)',[News::class, 'update']);

$routes->get('category', [Category::class, 'index']);
$routes->get('category/new', [Category::class, 'new']); // Add this line
$routes->post('category', [Category::class, 'create']); // Add this line
$routes->get('category/(:segment)', [Category::class, 'show']);
$routes->get('category/del/(:num)',[Category::class, 'delete']);
$routes->post('category/update/(:num)', [Category::class, 'updateSave']);
$routes->get('category/update/(:num)',[Category::class, 'update']);

// Muestra formulario inicio sesión
$routes->get('admin',[users::class, 'loginfForm']);
//Obtenemos user y pass
$routes->post('login',[Users::class,'checkUser']);


$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);