<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Film&Co - <?= $title; ?></title>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top:45px">
            <?php if(isset($movies)):?> 
                <div class="col-md-12">
                    <h4>Ma collection</h4>
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('fail'); ?>
                        </div>

                    <?php elseif(!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-warning">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif ?>

                    <hr>

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

                                    echo '<th> <a href="' . site_url('collection/removeMovieCollection/' . $val->idimdb) . '" class="link-danger">Supprimer</a></th>';

                                    echo '</tr>';
                                }
                            ?>      
                        </tbody>
                    </table>
                </div>
            <?php else:?>
                <div class="col-md-8 col-md-offset-2">
                    <h4>Ma collection</h4>
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('fail'); ?>
                        </div>

                    <?php elseif(!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-warning">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif ?>
                    <hr>
                    <p>Votre collection est vide.</p>
                    <p>Vous pouvez ajouter jusqu'à 5 films à votre collection dans l'onglet 
                        <a href="<?= site_url('../ListMovie'); ?>">Liste films</a>. 
                    </p>    
                </div>
            <?php endif?>
        </div>
    </div>
</body>
</html>