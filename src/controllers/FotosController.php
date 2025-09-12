<?php
namespace src\controllers;

use \core\Controller;


class FotosController extends Controller {

   			 public function index() {
    			    // Renderiza a view home
    			    $this->render('fotos'); 

					//echo "Paramos no Controller";
   			 }
}
