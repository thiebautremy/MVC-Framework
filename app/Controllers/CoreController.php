<?php

// Every Controller MUST extends this class

namespace oFramework\Controllers;

abstract class CoreController {
    /**
     * Méthode s'occupant d'afficher le rendu HTML à paratir de la template demandée
     * 
     * @param $viewName string Le nom de la template/views
     * @param $viewVars array les données à transmettre
     */
    protected function show($viewName, $viewVars=array()) {
        global $app; // moche, mais propre ce serait trop compliqué
        // var_dump($viewVars);exit;

        // Si on a besoin de la variable $router, permettant de générer des URLs
        $router = $app->getAltoRouter();

        // Je crée une variable contenant l'URL absolue jusqu'au dossier "public"
        // La clé "BASE_URI" est générée par le fichier .htaccess créant l'entonnoir
        if (!empty($_SERVER['BASE_URI'])) {
            $absoluteUrl = $_SERVER['BASE_URI'];
        }
        else {
            $absoluteUrl = '/';
        }
        // Cette variable $absoluteUrl est désormais disponible dans toutes mes templates/views

        // Astuce de méga sioux
        // On transforme les index de $viewVars en variable
        // ON transforme les index=>valeur en variable $index = valeur
        extract($viewVars);
        // Maintenant, on aura une variable dispo par donnée fournie à la méthode show

        // $viewVars est disponible dans chaque fichier de vue
        include(__DIR__.'/../views/header.tpl.php');
        // TODO check if file exists before inclusion
        include(__DIR__.'/../views/'.$viewName.'.tpl.php');
        include(__DIR__.'/../views/footer.tpl.php');
    }

    /**
     * Méthode permettant d'encoder une donnée en JSON et de l'afficher
     * 
     * @param $data mixed la donnée à encoder
     */
    protected function showJson($data) {
        // Autorise l'accès à la ressource depuis n'importe quel autre domaine
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Credentials: true');

        // Je dis au navigateur que la réponse est en JSON
        // (et non text/html comme d'habitude)
        header('Content-Type: application/json');

        // J'affiche la version encodée en JSON de la donnée (souvent un tablaeu associatif)
        // http://php.net/json_encode
        echo json_encode($data);
    }

    /**
     * Méthdoe permettant de rediriger vers une route mappée avec AltoRouter
     */
    public function redirectToRoute($routeName, $routeVars=[]) {
        global $router;

        // On génère l'URL vers laquelle rediriger
        $url = $router->generate($routeName, $routeVars);

        // Redirection
        header('Location: '.$url);
        exit;
    }
}