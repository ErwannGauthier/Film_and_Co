<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Collection extends BaseController{

    public function __construct() {
        helper(['url', 'form']);
    }

    public function index(){

        require ('../App/Views/navbar/navbar_collectionneur.php');
        $title = "Collection";

        $db = \Config\Database::connect();

        $user_id = session()->get('loggedUser');

        // Recupere id des films du collectionneur
        $builder = $db->table('collection');
        $builder->select('movie_id');
        $builder->where('user_id', $user_id);
        $query = $builder->get()->getResult();
        foreach($query as $row){
            $movie_id_collection[] = $row->movie_id;
        }

        // Si l'utilisateur à des films dans sa collection
        if(isset($movie_id_collection)){
            // Recupere tout les films du collectionneur
            $movieModel = new \App\Models\MovieModel();
            $movieModel->select('idimdb, title, release, overview, poster');
            $movieModel->whereIn('idimdb', $movie_id_collection);
            $movieModel->orderBy('release', 'ASC');
            $query = $movieModel->get();
            $movies_collect = $query->getResult();

            $data = [
                'title' => $title,
                'heading' => ['IDIMDB', 'Title', 'Release', 'Overview', 'Poster', 'Remove'],
                'movies' => $movies_collect
            ];
        }
        else{
            $data = [
                'title' => $title
            ];
        }

        return view('collection/collection', $data);
    }

    public function removeMovieCollection($movie_id){

        $user_id = session()->get('loggedUser');
        $db = \Config\Database::connect();
        $builder = $db->table('collection');
        $builder->where("user_id", $user_id);
        $builder->where("movie_id", $movie_id);
        $query = $builder->delete();

        if(!$query){
            return redirect()->back()->with('fail', 'Quelque chose s\'est mal passé.');
        }
        else{
            return redirect()->back()->with('success', 'Vous avez supprimé le film n°'. $movie_id .' de votre collection.');

        }
    }
}
?>