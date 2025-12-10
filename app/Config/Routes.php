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

// 🏠 Rutas de Inicio (Home)
$routes->get('/', 'News::index');

// 📰 Rutas para News (Noticias)
$routes->get('news', [News::class, 'index']);
$routes->get('news/new', [News::class, 'new']); 
$routes->post('news', [News::class, 'create']); 
$routes->get('news/del/(:num)',[News::class, 'delete']);
$routes->post('news/update/updated/(:num)',[News::class, 'updatedItem']);
$routes->get('news/update/(:num)',[News::class, 'update']);
// La ruta con segmento variable DEBE ir al final de las rutas de News
$routes->get('news/(:segment)', [News::class, 'show']); 


// 🏷️ Rutas para Category (Categorías)
$routes->get('category', [Category::class, 'index']);
$routes->get('category/new', [Category::class, 'new']); 
$routes->post('category', [Category::class, 'create']); 
$routes->get('category/del/(:num)',[Category::class, 'delete']);
$routes->post('category/update/(:num)', [Category::class, 'updateSave']);
$routes->get('category/update/(:num)',[Category::class, 'update']);
// La ruta con segmento variable DEBE ir al final de las rutas de Category
$routes->get('category/(:segment)', [Category::class, 'show']); 


// 🔐 Rutas de Autenticación (Users)
// Muestra formulario de inicio de sesión
$routes->get('admin', [Users::class, 'loginForm']); 
// Procesa usuario y contraseña (POST al mismo path para conveniencia)
$routes->post('admin', [Users::class, 'checkUser']);
// Cierre de sesión (Usando 'logout' que es más estándar que 'sesion')
$routes->get('admin/logout', [Users::class, 'closeSession']); 


// 📄 Rutas Generales de Páginas (DEBEN IR AL FINAL)
// Estas rutas actúan como un "catch-all" y deben estar al final para no interferir
$routes->get('pages', [Pages::class, 'index']);
$routes->get('(:segment)', [Pages::class, 'view']);