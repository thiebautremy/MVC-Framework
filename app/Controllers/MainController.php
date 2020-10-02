<?php

namespace App\Controllers;

use oFramework\Controllers\CoreController;
use App\Models\ExampleModel;

class MainController extends CoreController {
    /**
     * Method for the home page
     */
    public function home() {
        // If I need data from database (Models)
        $examples = ExampleModel::findAll();

        // For now, this page only needs the view
        $this->show('home', [
            'examples' => $examples
        ]);
    }
}