<?php
// app/Router.php

class Router {
    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function dispatch($url) {
        // Remove leading/trailing slashes and remove /bill prefix
       
$url = trim($url, '/'); // echo 'URL = '.$url;
        // Parse the URL into segments
        $urlParts = explode('/', $url);
   if (isset($urlParts[1]))
   {    
        switch ($urlParts[1]) {
            case 'login':
                $controller = new LoginController($this->db);
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $controller->index();
                } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->login();
                }
                break;

            case 'register':
                $controller = new RegisterController($this->db);
                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                    $controller->index();
                } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->register();
                }
                break;

            case 'carriers':
                $controller = new CarriersController($this->db);
                if (isset($urlParts[2])) {
                    switch ($urlParts[2]) {
                        case 'add':
                            $controller->add();
                            break;
                        case 'addCarrier':
                            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                $controller->addCarrier();
                            }
                            break;
                        case 'update':
                            $controller->updateCarrier();
                            break;
                        case 'delete':
            case 'delete':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $carrierId = $_POST['carrierId'];  // Get the carrier ID from the form
                    $controller->deleteCarrier($carrierId);  // Pass the carrier ID to delete
                }           
                     break;
             case 'edit':  // This case should call editCarrier
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                        $controller->editCarrier();  // Show the edit form
                }
                break;
            case 'updateCarrier':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $controller->updateCarrier();
                }
                break;
            }
           }   ///End of carriers-block
            case 'bills':
              $controller = new BillsController($this->db);
              if (isset($urlParts[2])) {
                  switch ($urlParts[2]) {
//                      case 'create':
//                          $controller->create();  // Step 1: Show the form to select carrier and year
//                          break;

                      case 'createBillStep2':
//                          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//                              echo 'In Cont<br>';
                              $controller->createBillStep2();  // Step 2: Generate bill number and show item form
//                          }
                          break;
                      case 'createBill':
                            $controller->createBill();  // Handle the first step of creating a bill
                            break;
    
                      case 'addBillItem':
                          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                              $controller->addBillItem();  // Handle adding an item to the bill
                          }
                          break;
                          
                      case 'finalizeBill':
                          if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                              $controller->finalizeBill();  // Finalize the bill
                          }
                          break;
                      case 'createPDF':
                            $controller->createPDF();  // Display bills without PDFs
                            break;

                        case 'generatePDF':
                            if (isset($urlParts[3])) {
                                $controller->generatePDF($urlParts[3]);  // Generate the PDF for the specific bill
                            }
                            break;

                          
                       case 'viewBill':
                          if (isset($urlParts[2])) {
                           $controller->viewBill($urlParts[2]);  // Pass the billId to view the complete bill
                         }
                          break;
   
                  }
              }
              else {
                 $controller = new BillsController($this->db);
                 $controller->index();
               }  
//            default:
//                // Default route (e.g., landing page)
//                $controller = new LandingController();
//                $controller->index();
//                break;
        }
     }
    else {
          $controller = new LandingController($this->db);
          $controller->index();}
   }
}
