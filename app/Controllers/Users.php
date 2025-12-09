<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{
    public function loginForm($error = null)
{
    helper('form');
    if ($error == null) {
        return view('templates/header',['title'=> 'Private Acces'])
        . view('users/login',['error' => ''])
        . view('templates/footer');
    } else {
        return view('templates/header',['title'=> 'Private Acces'])
        . view('users/login',['error' => 'Credenciales Incorrectas'])
        . view('templates/footer');
    }
}
}