<?php

namespace routes;

use controllers\IdeaController;
use controllers\MainController;
use routes\base\Route;
use utils\SessionHelpers;

class Web
{
    function __construct()
    {
        $main = new MainController();
        $idea = new IdeaController();

        Route::Add('/', [$main, 'home']);
        Route::Add('/entreprise', [$main, 'entreprise']);
        Route::Add('/esn', [$main, 'esn']);
        Route::Add('/particulier', [$main, 'particulier']);


        Route::Add('/connexion', [$main, 'login']);
        Route::Add('/inscription', [$main, 'signup']);
        Route::Add('/verif-inscription', [$main, 'validation_signup']);
        Route::Add('/changer-mdp', [$main, 'new_mdp_form']);
        Route::Add('/entrer-nouveau-mdp', [$main, 'edit_mdp_form']);
        Route::Add('/deconnexion', [$main, 'logout']);
        Route::Add('/mentions-legales', [$main, 'mentions_legales']);
        Route::Add('/profil', [$main, 'profil']);
        Route::Add('/edit-profil', [$main, 'edit_profil']);

        Route::Add('/liste-idees', [$idea, 'list_ideas']);
        Route::Add('/idee', [$idea, 'idea']);
        //Route::Add('/idee/{id}', [$idea, 'idea']);
        Route::Add('/edit-idee', [$idea, 'create_idea']);

        Route::Add('/admin', [$idea, 'admin']);

        //        Exemple de limitation d'accès à une page en fonction de la SESSION.
        //        if (SessionHelpers::isLogin()) {
        //            Route::Add('/deconnexion', [$main, 'home']);
        //        }
    }
}

