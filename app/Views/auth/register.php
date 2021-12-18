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
            <div class="col-md-4 col-md-offset-4">
                <h4>S'enregistrer</h4>
                <hr>
                <form action="<?= base_url('auth/save') ?>" method="post" autocomplete="off">
                    <?= csrf_field() ?>
                    <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                        <div class="alert alert-danger">
                            <?= session()->getFlashdata('fail'); ?>
                        </div>
                    <?php endif ?>

                    <?php if(!empty(session()->getFlashdata('success'))) : ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success'); ?>
                        </div>
                    <?php endif ?>

                    <div class="form-group">
                        <label for="">Nom d'utilisateur</label>
                        <input type="text" name="username" class="form-control" placeholder="Entrer votre nom d'utilisateur" value="<?= set_value('username'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'username') : '' ?></span>
                    </div>

                    <div class="form-group">
                        <label for="">Mot de passe</label>
                        <input type="password" name="password" class="form-control" placeholder="Entrer votre mot de passe" value="<?= set_value('password'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                    </div>

                    <div class="form-group">
                        <label for="">Confirmer le mot de passe</label>
                        <input type="password" name="cpassword" class="form-control" placeholder="Confirmer votre mot de passe" value="<?= set_value('cpassword'); ?>">
                        <span class="text-danger"><?= isset($validation) ? display_error($validation, 'cpassword') : '' ?></span>
                    </div>
                    <br>
                    <div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit">S'enregistrer</button>
                    </div>
                    <br>
                    <a href="<?= site_url('auth') ?>">J'ai déjà un compte.</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>