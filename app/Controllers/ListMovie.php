<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class ListMovie extends BaseController{

    public function __construct() {
        helper(['url', 'form']);
    }

    public function index(){
        $title = "Liste films";

        $db = \Config\Database::connect();

        // Recupere tout les films
        $movieModel = new \App\Models\MovieModel();
        $movieModel->select('idimdb, title, release, overview, poster');
        $movieModel->orderBy('release', 'ASC');
        $query = $movieModel->get();
        $movies = $query->getResult();

        if(!empty(session()->get('loggedUser'))){
            require ('../App/Views/navbar/navbar_collectionneur.php');

            $user_id = session()->get('loggedUser');

            // Recupere id des films du collectionneur
            $builder = $db->table('collection');
            $builder->select('movie_id');
            $builder->where('user_id', $user_id);
            $query = $builder->get()->getResult();
            foreach($query as $row){
                $movie_id_collection[] = $row->movie_id;
            }

            // Recupere tout les films - les films du collectionneur
            $movieModel->select('idimdb, title, release, overview, poster');
            if(isset($movie_id_collection)){
                $movieModel->whereNotIn('idimdb', $movie_id_collection);
            }
            $movieModel->orderBy('release', 'ASC');
            $query = $movieModel->get();
            $movies_collect = $query->getResult();

            $data = [
                'title' => $title,
                'heading' => ['IDIMDB', 'Title', 'Release', 'Overview', 'Poster', 'Add'],
                'movies' => $movies_collect
            ];
        }
        else{
            require ('../App/Views/navbar/navbar_visiteur.php');

            $data = [
                'title' => $title,
                'heading' => ['IDIMDB', 'Title', 'Release', 'Overview', 'Poster'],
                'movies' => $movies
            ];
        }

        return view('listmovie/movie', $data);
    }

    public function addMovieCollection($movie_id){

        $db = \Config\Database::connect();
        $builder = $db->table('collection');
        $user_id = session()->get('loggedUser');

        $data = [
            'user_id' => $user_id,
            'movie_id' => $movie_id
        ];

        // Calcul nb d'apparition du collectionneur dans table collection
        $builder->selectCount('user_id');
        foreach($builder->where('user_id', $user_id)->get()->getResult() as $row){
            $count = $row->user_id;
        }

        if($count >= 5){
            // Select le movie_id ayant la date de sortie la plus récente.
            $builder->select('movie_id');
            $builder->join('movie', 'collection.movie_id = movie.idimdb', 'left');
            $builder->where('user_id', $user_id);
            $builder->orderBy('movie.release DESC');
            $builder->limit(1);
            foreach($builder->get()->getResult() as $row){
                $idimdb = $row->movie_id;
            }

            $builder->where('user_id', $user_id);
            $builder->where('movie_id', $idimdb);
            $builder->delete();
        }

        $query = $builder->insert($data);

        if(!$query){
            return redirect()->back()->with('fail', 'Quelque chose s\'est mal passé.');
        }
        else if(isset($idimdb)){
            return redirect()->back()->with('warning', 'Vous ne pouvez pas avoir plus de 5 films dans votre collection.<br>Le film n°' . $idimdb . ' a été supprimé pour pouvoir ajouté le film n°' . $movie_id .'.');
        }
        else{
            return redirect()->back()->with('success', 'Vous avez ajouté le film n°'. $movie_id .' à votre collection.');

        }
    }
}
?>