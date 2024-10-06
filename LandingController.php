<?php // app/controllers/LandingController.php

//class LandingController {
//    public function index() {
//        // Get language based on URL or session
//        $lan = sprache(explode('/', $_SERVER['REQUEST_URI']));
//        
//        // Include the correct language file
//        require_once "../config/languages/textMenu{$lan}.php";
//        
//        // Render the landing page view with the language content
//        $view = new View('landing', ['text_menu' => $text_menu]);
//        $view->render();
//    }
//}

// app/controllers/LandingController.php

class LandingController {
    public function index() {
     require_once 'config/languages/textMenuEN.php';
         //echo 'In controller -  OK!!!!!';
     require_once "app/views/landing.php";
    }
}
