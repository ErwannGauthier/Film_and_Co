<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film&Co - <?= $title ?></title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top:45px">
            <div class="col-md-12">
                <h4>Liste des films diponibles</h4>
                <hr>
                <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('fail'); ?>
                    </div>

                <?php elseif(!empty(session()->getFlashdata('warning'))) : ?>
                    <div class="alert alert-warning">
                        <?= session()->getFlashdata('warning'); ?>
                    </div>

                <?php elseif(!empty(session()->getFlashdata('success'))) : ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success'); ?>
                    </div>
                <?php endif ?>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr> 
                        <?php
                            foreach($heading as $val){
                                echo '<th>' . $val . '</th>';
                            }
                        ?>
                    </tr>
                </thead>
                <tbody>
                <?php    
                    foreach ($movies as $val){
                        echo '<tr>';

                        foreach($val as $k=>$v){
                            echo '<th>';

                            if($k == 'poster'){
                                echo '<img src="' . $v . '" width=100 height=150>';
                            }
                            else{
                                echo $v;
                            }

                            echo '</th>';
                        }

                        if(!empty(session()->get('loggedUser'))){
                            echo '<th> <a href="' . site_url('listmovie/addMovieCollection/' . $val->idimdb) . '" class="link-success">Ajouter</a></th>';
                        }

                        echo '</tr>';
                    }      
                ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</body>
</html>