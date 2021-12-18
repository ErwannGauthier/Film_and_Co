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
            <?php if(!empty($users)): ?>
                <div class="col-md-4 col-md-offset-4">
                    <h4><?= $title; ?></h4>

                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('fail'); ?>
                        </div>
                    <?php endif ?>

                    <?php if(!empty(session()->getFlashdata('success'))) : ?>
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
                        foreach ($users as $val){
                            echo '<tr>';
                            foreach($val as $k=>$v){
                                echo '<th>' . $v . '</th>';
                            }
                            echo '<th> <a href="' . site_url('dashboard/deleteUser/' . $val->id) . '" class="link-danger">Supprimer</a> </th>';
                            echo '</tr>';
                        }    
                    ?>
                    </tbody>
                </table>
                </div>
            <?php else:?>
                <div class="col-md-8 col-md-offset-2">
                    <h4>Dashboard</h4>
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
                    <p>Il n'y a pour le moment aucun utilisateur inscrit.</p>  
                </div>
            <?php endif?>    
        </div>
    </div>
</body>
</html>