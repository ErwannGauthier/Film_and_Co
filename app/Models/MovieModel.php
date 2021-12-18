<?php

namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model{
    protected $table = "movie";
    protected $primaryKey = 'idimdb';
    protected $allowedFields = ['idimdb', 'title', 'release', 'overview', 'poster'];
}

?>