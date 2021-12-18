<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Accueil extends BaseController{

    public function index(){

        $data = [
            "title" => "Accueil"
        ];

        if(session()->has('loggedUser')){
            require ('../App/Views/navbar/navbar_collectionneur.php');
           
        }
        else{
            require ('../App/Views/navbar/navbar_visiteur.php');
        }
        
        return view('accueil/accueil', $data);
    }
}
?>