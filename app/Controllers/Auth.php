<?php

namespace App\Controllers;

require ('../App/Views/navbar/navbar_visiteur.php');

use CodeIgniter\Controller;
use App\Libraries\Hash;

class Auth extends BaseController{

    public function __construct() {
        helper(['url', 'form']);
    }

    public function index(){

        $data = [
            'title' => "Se connecter"
        ];

        return view('auth/login', $data);
    }

    public function register(){

        $data = [
            'title' => "S'enregistrer"
        ];

        return view('auth/register', $data);
    }

    public function save(){
        
        $validation = $this->validate([
            'username'=>[
                'rules'=>'required|min_length[5]|max_length[26]|is_unique[users.username]',
                'errors'=>[
                    'required'=>'Veuillez saisir votre nom d\'utilisateur.',
                    'min_length'=>'Votre nom d\'utilisateur doit faire au moins 5 caractères.',
                    'max_length'=>'Votre nom d\'utilisateur ne peut pas faire plus de 26 caractères.',
                    'is_unique'=>'Ce nom d\'utilisateur est déjà pris.'
                ]
            ],
            'password'=>[
                'rules'=>'required|min_length[5]|max_length[100]',
                'errors'=>[
                    'required'=>'Veuillez saisir un mot de passe.',
                    'min_length'=>'Votre mot de passe doit faire au moins 5 caractères.',
                    'max_length'=>'Votre mot de passe ne peut pas faire plus de 100 caractères.'
                ]
            ],
            'cpassword'=>[
                'rules'=>'required|matches[password]',
                'errors'=>[
                    'required'=>'Veuillez confirmer votre mot de passe.',
                    'matches'=>'Vous avez saisi deux mots de passe différents.'
                ]
            ]
                ]);

        if(!$validation){

            $data = [
                'title' => "S'enregistrer",
                'validation' =>$this->validator
            ];

            return view('auth/register', $data);
        }
        else{
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $values = [
                'username'=>$username,
                'password'=>Hash::make($password)
            ];

            $userModel = new \App\Models\UsersModel();
            $query = $userModel->insert($values);

            if(!$query){
                return redirect()->back()->with('fail', 'Quelque chose s\'est mal passé.');
            }
            else{
                return redirect()->to('auth/index')->with('success', 'Vous êtes desormais enregistré.');

            }
        }
    }

    public function check(){
        
        $validation = $this->validate([
            'username'=>[
                'rules'=>'required|is_not_unique[users.username]',
                'errors'=>[
                    'required'=>'Veuillez saisir votre non d\'utilisateur.',
                    'is_not_unique'=>'Ce nom d\'utilisateur n\'existe pas.'
                ]
            ],
            'password'=>[
                'rules'=>'required|min_length[5]|max_length[100]',
                'errors'=>[
                    'required'=>'Veuillez saisir votre mot de passe.',
                    'min_length'=>'Votre mot de passe contient au minimum 5 caractères.',
                    'max_length'=>'Votre mot de passe contient au maximum 100 caractères.'
                ]
            ]
        ]);

        if(!$validation){
            $data = [
                'title' => "Se connecter",
                'validation' =>$this->validator
            ];
            
            return view('auth/login', $data);
        }
        else{
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $userModel = new \App\Models\UsersModel();
            $user_info = $userModel->where('username', $username)->first();

            $check_password = Hash::check($password, $user_info['password']);
            if(!$check_password){
                session()->setFlashdata('fail', 'Mot de passe incorrect.');
                return redirect()->to('/auth')->withInput();
            }
            else{
                $user_id = $user_info['id'];
                session()->set('loggedUser', $user_id);
                session()->set('loggedUsername', $user_info['username']);
                
                
                $adminModel = new \App\Models\AdminModel();
                $admin_info = $adminModel->find($user_id);

                $userModel = new \App\Models\UsersModel();
                
                // Si admin redirige vers dashboard
                if($admin_info){
                    return redirect()->to('/dashboard');
                }
                // Sinon vers accueil utilisateur
                else{
                    return redirect()->to('/Accueil');
                }
                
            }
        }
    }

    public function logout(){

        if(session()->has('loggedUser')){
            session()->remove('loggedUser');
            session()->remove('loggedUsername');
            return redirect()->to('/auth?access=out')->with('fail', 'Vous avez été déconnecté.');
        }
    }
}