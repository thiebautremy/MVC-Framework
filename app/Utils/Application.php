<?php

namespace oFramework\Utils;

use AltoRouter;
use Dispatcher;

class Application {
    /**
     * @var AltoRouter
     */
    protected $altoRouter;

    /**
     * @var string
     */
    protected $controllersNamespace;

    public function __construct($controllersNamespace) {
        $this->controllersNamespace = $controllersNamespace;

        $this->altoRouter = new AltoRouter();

        if (!empty($_SERVER['BASE_URI'])) {
            $this->altoRouter->setBasePath($_SERVER['BASE_URI']);
        }

        $this->mapRoutes();
    }

    protected function mapRoutes() {
        // map all routes in app/routes.php file
        include __DIR__.'/../routes.php';
    }

    protected function addRoute($httpMethod, $url, $controllerName, $methodName, $routeName='') {
        $this->altoRouter->map(
            $httpMethod, // HTTP Method
            $url, // URL pattern
            [ // target containing controller name and method name
                'controller' => $this->controllersNamespace . '\\' . $controllerName, // '\\' => \
                'method' => $methodName
            ],
            $routeName // => route's name (for URL generation)
        );
    }

    /**
     * Méthode lançant notre application
     * => exécution spécifique pour chaque page
     * Analogie : pour ensuite pouvoir passer un appel spécifique à une personne
     */
    public function run() {
        // 4- On demande à AltoRouter de cherche si une route correspond à l'URL actuelle
        $match = $this->altoRouter->match();

        // You can optionnally add a try/catch here to handle Exceptions
        // Instanciate the dispatcher, give it the $match variable and a fallback action
        $dispatcher = new Dispatcher($match, $this->controllersNamespace.'\ErrorController::error404');
        // then run the dispatch method which will call the mapped method
        $dispatcher->dispatch();
    }

    /**
     * Get Propriété contenant l'objet AltoRouter
     *
     * @return AltoRouter
     */ 
    public function getAltoRouter() : AltoRouter // ": AltoRouter" = typehint = typage du retour de la méthode
    {
        return $this->altoRouter;
    }
}

