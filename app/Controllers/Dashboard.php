<?php

namespace App\Controllers;

require ('../App/Views/navbar/navbar_admin.php');

class Dashboard extends BaseController
{
    public function index()
    {
        $loggedUserID = session()->get('loggedUser');

        $loggedUserID = session()->get('loggedUser');
        if (!($loggedUserID == '1')){
            return redirect()->to('/Accueil');
        }
        else{
            $userModel = new \App\Models\UsersModel();
            $userModel->select('id, username');
            $userModel->whereNotIn('id', [$loggedUserID]);
            $query = $userModel->get();
            $data = [
                'title'=>'Dashboard',
                'heading'=>['ID', 'Username', 'Remove user'],
                'users'=>$query->getResult()
            ];
            return view('dashboard/index', $data);
        }
    }

    public function deleteUser($id){
        $userModel = new \App\Models\UsersModel();
        $userModel->where('id', $id);
        $query = $userModel->delete();

        if(!$query){
            return redirect()->back()->with('fail', 'Quelque chose s\'est mal passé.');
        }
        else{
            return redirect()->back()->with('success', 'Vous avez supprimé l\'utilisateur n°'. $id .'.');

        }
    }
}
?>