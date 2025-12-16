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

// Index del Frontend
$routes->get('/', [News::class, 'index']);

// Ver todas las noticias en frontend
$routes->get('news', [News::class, 'index']);

//Backend
$routes->group('backend', function($routes){; 
    // index de backend = todas las noticias 
    $routes->get ('/',[News::class, 'index/backend'] );

    // muestra formulario inicio sesión
    $routes->get('admin',[Users::class, 'loginForm']);
    // Obtenemos user y pass
    $routes->post('login', [Users::class, 'checkUser']);
    $routes->get('session', [Users::class, 'closeSession']); // Cerrar sesión

    // Formulario insertar
    $routes->get('news/new', [News::class, 'new']);

    // Envia el form insertar
    $routes->post('news/create', [News::class, 'create']);
    // eliminar noticia
    $routes->get('news/del/(:num)', [News::class, 'delete']);

    // enviar formulario de editar
    $routes->post('news/update/updated/(:num)', [News::class, 'updatedItem']);

    // mostrar formulario de editar
    $routes->get('news/update/(:num)', [News::class, 'update']);
    $routes->get('news/(:segment)', [News::class, 'show']);


    $routes->get('category', [Category::class, 'index']);

    // Formulario insertar
    $routes->get('category/new', [Category::class, 'new']);

    // Envia el form insertar
    $routes->post('category/create', [Category::class, 'create']);
    $routes->post('category/update/(:num)', [Category::class, 'updateSave']);
    $routes->get('category/update/(:num)',[Category::class, 'update']);
    // La ruta con segmento variable DEBE ir al final de las rutas de Category
    $routes->get('category/(:segment)', [Category::class, 'show']); 


});





// // Rutas de Autenticación (Users)
// // Muestra formulario de inicio de sesión
// $routes->get('admin', [Users::class, 'loginForm']); 
// // Procesa usuario y contraseña (POST al mismo path para conveniencia)
// $routes->post('admin', [Users::class, 'checkUser']);
// // Cierre de sesión (Usando 'logout' que es más estándar que 'sesion')
// $routes->get('admin/logout', [Users::class, 'closeSession']); 


// // Rutas Generales de Páginas (DEBEN IR AL FINAL)
// // Estas rutas actúan como un "catch-all" y deben estar al final para no interferir
// $routes->get('pages', [Pages::class, 'index']);
// $routes->get('(:segment)', [Pages::class, 'view']);