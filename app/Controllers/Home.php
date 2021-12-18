<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        require ('../App/Views/navbar/navbar_visiteur.php');

        $data = [
            'title' => "Accueil"
        ];

        return view('/accueil/accueil', $data);
    }
}
