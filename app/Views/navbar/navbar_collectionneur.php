<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <title>Collectionneur</title> -->
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <a class="navbar-brand ps-4">Film&Co</a>
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?= site_url('../Accueil'); ?>">Accueil </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('../ListMovie'); ?>">Liste films</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('../Collection'); ?>">Collection</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto row-reverse px-3">
            <li class="nav-item">
                <div class="d-inline-flex bg-danger rounded-pill">
                    <a class="nav-link text-light" href="<?= site_url('auth/logout'); ?>">Se déconnecter</a>
                </div>
            </li>
            <li class="nav-item order-first px-2">
                <a class="nav-link text-dark"><?=session()->get('loggedUsername'); ?></a>
            </li>
        </ul>
    </nav>
</body>
</html>