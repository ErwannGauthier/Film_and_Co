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
            <?php if(!empty(session()->get('loggedUser'))):?>
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="d-flex justify-content-center" >Bonjour <?=session()->get('loggedUsername');?> !</h1>
                    <h4 class="d-flex justify-content-center" >Dirigez-vous à l'aide de la barre de navigation.</h4>
                </div>
            <?php else: ?>
                <div class="col-md-8 col-md-offset-2">
                    <h1 class="d-flex justify-content-center" >Bienvenue à vous !</h1>
                    <h4 class="d-flex justify-content-center" ><a href="<?= site_url('../auth'); ?>">Connectez-vous</a>&nbspafin de pouvoir collectionner des films !</h4>
                </div> 
            <?php endif ?>   
        </div>
        <footer class="footer fixed-bottom py-2 bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6 col-md-offset-4 d-flex justify-content-center">
                        <a href="mailto:erwann.gauthier@etudiant.univ-rennes1.fr">Erwann GAUTHIER</a>&nbsp-&nbsp
                        <a href="mailto:mathis.lefeuvre@etudiant.univ-rennes1.fr">Mathis LEFEUVRE</a>&nbsp-&nbsp
                        <a href="mailto:mathieu.dary@etudiant.univ-rennes1.fr">Mathieu DARY</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>