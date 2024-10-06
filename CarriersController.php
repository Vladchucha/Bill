<?php
// app/controllers/CarriersController.php

class CarriersController {
    private $db;
    private $carrierModel;

    public function __construct($db) {
        require_once "app/models/Carrier.php";  // Include the Carrier model
        $this->db = $db;
        $this->carrierModel = new Carrier($db);
    }

    // Show the form to add a new carrier
    public function add() {
        require_once "app/views/addCarrier.php";  // Load the form view without any messages initially
    }

    // Handle adding a new carrier
    public function addCarrier() {
        $id_users = $_SESSION['user_id'];  // Assuming the logged-in user's ID is stored in the session
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $telephon = $_POST['telephon'] ?? null;
        $comment = $_POST['comment'] ?? null;

        // Validate email format (additional validation)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email format. Please enter a valid email.";
            require_once "app/views/addCarrier.php";
            return;
        }

        // Call the model to add the carrier to the database
        if ($this->carrierModel->addCarrier($id_users, $name, $address, $email, $telephon, $comment)) {
            // Set success message and pass it to the view
            $success = "Carrier added successfully!";
            require_once "app/views/addCarrier.php";  // Reload the form with the success message
        } else {
            // Set error message and pass it to the view
            $error = "Failed to add carrier. Please try again.";
            require_once "app/views/addCarrier.php";  // Reload the form with the error message
        }
    }
    // Fetch carriers for a specific user
    public function getCarriersByUser($id_users) {
        $sql = "SELECT * FROM carriers WHERE id_users = ?";
        $params = [$id_users];
        return $this->db->queryObjectArray($sql, $params);
    }

    // Get a carrier by its ID
    public function getCarrierById($id) {
        $sql = "SELECT * FROM carriers WHERE id = ?";
        $params = [$id];
        return $this->db->queryObjectArray($sql, $params)[0] ?? null;
    }

    // Delete a carrier by its ID
    public function deleteCarrier($carrierId) {
    // Call the model to delete the carrier by ID
    if ($this->carrierModel->deleteCarrier($carrierId)) {
        $success = "Carrier deleted successfully!";
    } else {
        $error = "Failed to delete carrier.";
    }

    // Fetch all carriers again to show the updated list
    $id_users = $_SESSION['user_id'];
    $carriers = $this->carrierModel->getCarriersByUser($id_users);
    
    require_once "app/views/updateCarriers.php";  // Reload the carrier list with success/error message
}
    // Update a carrier
    public function updateCarrier() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if the required POST data is present
        if (isset($_POST['carrierId'], $_POST['name'], $_POST['address'], $_POST['email'])) {
            $carrierId = $_POST['carrierId'];
            $name = $_POST['name'];
            $address = $_POST['address'];
            $email = $_POST['email'];
            $telephon = $_POST['telephon'] ?? null;
            $comment = $_POST['comment'] ?? null;

            // Call the model to update the carrier
            if ($this->carrierModel->updateCarrier($carrierId, $name, $address, $email, $telephon, $comment)) {
                $success = "Carrier updated successfully!";
            } else {
                $error = "Failed to update carrier.";
            }
        } else {
            $error = "Required form fields are missing.";
        }

        $id_users = $_SESSION['user_id'];  // Fetch all carriers again to show the updated list
        $carriers = $this->carrierModel->getCarriersByUser($id_users);
        require_once "app/views/updateCarriers.php";  // Reload the carrier list with success/error message
    } else {
        // If the request is not POST, load the form for updating
         $id_users = $_SESSION['user_id'];  
        $carriers = $this->carrierModel->getCarriersByUser($id_users) ?? [];
        require_once "app/views/updateCarriers.php";
    }
 }
 public function editCarrier() {
    if (isset($_POST['carrierId'])) {
        $carrierId = $_POST['carrierId'];

        // Fetch the carrier data from the model by its ID
        $carrier = $this->carrierModel->getCarrierById($carrierId);

        if ($carrier) {
            // Load the form for editing, with carrier details pre-filled
            require_once "app/views/editCarrier.php";
        } else {
            $error = "Carrier not found.";
            $id_users = $_SESSION['user_id'];
            $carriers = $this->carrierModel->getCarriersByUser($id_users);
            require_once "app/views/updateCarriers.php";  // Reload carrier list with error message
        }
    } else {
        $error = "Carrier ID not provided.";
        $id_users = $_SESSION['user_id'];
        $carriers = $this->carrierModel->getCarriersByUser($id_users);
        require_once "app/views/updateCarriers.php";  // Reload carrier list with error message
    }
}


}


