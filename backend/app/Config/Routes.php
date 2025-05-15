<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api', function($routes){
    $routes->resource('prodi', ['controller' => 'ProdiController']);
    $routes->resource('matkul', ['controller' => 'MatkulController']);
    $routes->resource('mahasiswa', ['controller' => 'MahasiswaController']);
    $routes->resource('pengisian-krs', ['controller' => 'PengisianKRSController']);
    $routes->post('login', 'Auth::login');
    $routes->post('register', 'Auth::register');
    $routes->get('profile', 'Profile::index', ['filter' => 'auth']);
});