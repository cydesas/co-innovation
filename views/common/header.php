<?php

use utils\SessionHelpers;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-H11LM5RZRK"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'G-H11LM5RZRK');
    </script>

    <!-- og meta -->
    <meta property="og:title" content=Co-Innovation>
    <meta property="og:site_name" content=Co-Innovation>
    <meta property="og:url" content=https://co-innovation.fr/>
    <meta property="og:description" content="Vous souhaitez innover et booster votre entreprise ? Parcourez les idées proposées sur notre plateforme et trouvez des partenaires pertinents pour développer votre activité !">
    <meta property="og:type" content=website>
    <meta property="og:image" content=https://co-innovation.fr/public/img/logo.svg>

    <!-- Canonical URL -->
    <link rel="canonical" href="<?= $canonical ?>"/>

    <meta name="google-site-verification" content="XyICbbbakSvIrtJcCrv7tn7fPrBuw0_gt7KOAZov9x0" />
    <!-- JSON-LD -->
    <script type="application/ld+json"><?= $jsonld_website ?></script>
    <script type="application/ld+json"><?= $jsonld_organization ?></script>
    <script type="application/ld+json"><?= $jsonld_breadcrumb ?></script>

    <!-- Meta required -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Content-Language" content="fr">
    <meta name="msapplication-TileColor" content="#ffc40d">
    <meta name="theme-color" content="#ffffff">

    <!-- Meta SEO -->
    <title><?= $titre ?> </title>
    <meta name="Description"
          content="<?= $description ?>">
    <meta name="Keywords" content="co-innovation, CYDE, digital, innovant, social, durable, innover, idées">
    <meta name="Subject" content="Page d'accueil">
    <meta name="Copyright" content="Cyde 2022">
    <meta name="author" content="Cyprien">
    <meta name="Identifier-Url" content="www.co-innovation.fr">
    <meta name="Robots" content="all">

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/img/favicon-16x16.png">
    <link rel="manifest" href="./site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
          integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <link rel="stylesheet" href="../public/css/main.css">
</head>

<body class="<?= isset($_GET['id']) ? 'brick' : '' ?>">
<header class="header">
    <div class="logo">
        <a href="/">
            <img src="../public/img/logo.svg" class="logo-svg" height="48px" width="48px"
                 alt="Logo de la co-innovation">
            <p >Co-innovation</p>
        </a>
    </div>
    <nav>
        <div class="nav-connexion">
            <?php if (SessionHelpers::isLogin()) : ?>
                <a href="/deconnexion" class="connexion">Déconnexion</a>
                <a href="/profil" class="cta-yellow">Mon profil</a>
            <?php else : ?>
                <a href="/connexion" class="connexion">Connexion</a>
                <a href="/inscription" class="cta-yellow">Inscription</a>
            <?php endif; ?>
        </div>
    </nav>
</header>