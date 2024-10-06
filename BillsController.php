<?php

class BillsController {
    private $db;
    private $billModel;
    private $carrierModel;

    public function __construct($db) {
         include 'config/checkErrors.php' ;
        require_once "app/models/Bill.php";  // Load the bill model
        require_once "app/models/Carrier.php";  // Load the carrier model
        $this->db = $db;
        $this->billModel = new Bill($db);
        $this->carrierModel = new Carrier($db);
     //   echo '<br>In BillsContoller, Construct<br>'; 
        
    }
    
    public function index() {
      require_once "app/views/bills.php";
    // Step 1: Show the form to select the carrier and year
//    public function create() {
//        $id_users = $_SESSION['user_id'];  // Get the current user's ID
//        $carriers = $this->carrierModel->getCarriersByUser($id_users);  // Fetch user's carriers
//        
//        require_once "app/views/newBill.php";  // Load the view for the form
    }
    public function create() {
    $id_users = $_SESSION['user_id'];  // Get the logged-in user's ID
    $carriers = $this->carrierModel->getCarriersByUser($id_users);  // Fetch user's carriers

    // Check if carriers are being fetched correctly
    echo_r($carriers);  // Debugging: Check what is being fetched

    require_once "app/views/newBill.php";  // Load the view for the form
}
public function createBill() {// echo 'In function createBill()<br>';
    $id_users = $_SESSION['user_id'];  // Get the logged-in user's ID
//    $carriers = $this->carrierModel->getCarriersByUser($id_users);  echo_r($carriers);// Fetch user's carriers
    // Make sure it's a POST request (since it's handling form submission)
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
       // echo 'In post';// die();
        // Get data from form (carrier, year, and optional month)
    $year = $_POST['year'];    
    $carrierId = $_POST['carrierId'];
    $month = $_POST['month'] ?? null;

        // Create the bill header in the database
        $billId = $this->billModel->createBillHeader($carrierId, $_SESSION['user_id'], $year, $month);
// echo '$billId ='.$billId; die();
        // Check if the bill header was created successfully
        if ($billId) {
            // Store the billId in the session for subsequent steps
            $_SESSION['billId'] = $billId;

            // Redirect to Step 2 for adding bill items
            header('Location: /bill/bills/createBillStep2');
            exit;
        } else {
            // Handle error (e.g., failed to create bill)
            $error = "Failed to create the bill header.";
            require_once "app/views/newBill.php";  // Reload the form with an error message
        }
    } else {
        // If not a POST request, redirect back to the form
        $carriers = $this->carrierModel->getCarriersByUser($id_users); // echo_r($carriers);// Fetch user's carriers
        require_once "app/views/newBill.php";  // Load the view for the form
        // header('Location: /bill/bills/create');
        exit;
    }
}



    // Step 2: Generate bill number and show the form for adding items
  public function createBillStep2() { echo 'In function createBillSTEP2()<br>';
    // Retrieve the bill ID from the session
    if (isset($_SESSION['billId'])) {
        $billId = $_SESSION['billId'];

        // Fetch the bill header from the database
        $billHeader = $this->billModel->getBillHeader($billId, $_SESSION['user_id']);
        
        // Check if the bill header is found
        if ($billHeader === null) {
            $error = "Bill header not found.";
            require_once "app/views/addBillItems.php";
            return;
        }

        // Fetch existing bill items
        $items = $this->billModel->getBillItems($billId) ?? [];

        // Load the form for adding items
        require_once "app/views/addBillItems.php";
    } else { echo 'NO Bill ID !!!';
//        header('Location: /bill/bills/create');  // Redirect to Step 1 if no bill ID is found
//        exit;
    }
}


public function addBillItem() {  echo ' in BillItem';
    if (isset($_POST['bill_number'], $_POST['item_work'], $_POST['price'], $_POST['quantity'])) {
        $billNumber = $_POST['bill_number'];
        $itemWork = $_POST['item_work'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];

        // Debugging: Check the bill number
        echo "Bill Number:". $billNumber.' NUMBER END<br>';

        // Fetch the bill ID from the bill number
        $billId = $this->billModel->getBillIdByNumber($billNumber, $_SESSION['user_id']);

        // Debugging: Check if billId is being fetched correctly
        var_dump("Bill ID:", $billId);
        // exit;

        if ($billId === null) {
            $error = "Bill not found. Please check the bill number.";
            require_once "app/views/addBillItems.php";
            return;
        }

        // Add item to the bill
        $amount = $price * $quantity;
        $this->billModel->addBillItem($billId, $itemWork, $price, $quantity, $amount);

        // Fetch bill header for display
        $billHeader = $this->billModel->getBillHeader($billId, $_SESSION['user_id']);
        $items = $this->billModel->getBillItems($billId) ?? [];

        // Reload the view with updated items
        require_once "app/views/addBillItems.php";
    }
    echo 'Not in Post';
}
  public function finalizeBill() {
    echo 'In Finalize';
    
    if (isset($_POST['bill_number'])) {
        $billNumber = $_POST['bill_number'];  // Get the bill number from the form submission

        // Convert the bill number to the bill ID using the model
        $billId = $this->billModel->getBillIdByNumber($billNumber, $_SESSION['user_id']);
        echo 'BillID = ' . $billId;

        // Fetch all items for the current bill
        $items = $this->billModel->getBillItems($billId);
        echo_r($items);

        // Check if there are items to finalize
        if (!empty($items)) {
            // Calculate the total sum (netto) using 'amount', not 'totalRow'
            $sumNetto = array_sum(array_map(function ($item) {
                return $item->amount;  // Use 'amount' instead of 'totalRow'
            }, $items));

            // Calculate VAT and total (brutto)
            $vatPercent = 0.19;  // Assuming 19% VAT (you can adjust this)
            $vat = $sumNetto * $vatPercent;
            $totalBrutto = $sumNetto + $vat;

            // Save the final bill data to bill_bottom
            $this->billModel->finalizeBill($billId, $sumNetto, $vat, $totalBrutto);

            // Fetch the final bill header and bottom details to display the completed bill
            $billHeader = $this->billModel->getBillHeader($billId, $_SESSION['user_id']);
            $billItems = $this->billModel->getBillItems($billId);  // Fetch the items here
            $billBottom = $this->billModel->getBillBottom($billId);

// Pass all the data to the completeBill view
require_once "app/views/completeBill.php";

            // Pass all the data to the completeBill view
            require_once "app/views/completeBill.php";
        } else {
            // Handle the case when no items are found for the bill
            $error = "No items found to finalize the bill.";
            require_once "app/views/addBillItems.php";  // Reload the item adding view with error
        }
    } else {
        // Handle the case when no bill number is passed
        $error = "Bill number missing. Unable to finalize the bill.";
        echo $error;
    }
}
 
   public function viewBill($billId) {
    $id_users = $_SESSION['user_id'];  // Get the logged-in user's ID

    // Fetch bill header details for this user
    $billHeader = $this->billModel->getBillHeader($billId, $id_users);

    // Fetch all items (rows) for this bill
    $billItems = $this->billModel->getBillItems($billId);

    // Fetch the total, VAT, and netto from the bill_bottom
    $billBottom = $this->billModel->getBillBottom($billId);

    // Check if the bill exists and belongs to the user, else show an error
    if (!$billHeader || !$billBottom || !$billItems) {
        $error = "Bill not found or you do not have access to view this bill.";
        require_once "app/views/error.php";  // Load an error view if no bill is found
        return;
    }

    // Load the invoice view with the complete bill details
    require_once "app/views/completeBill.php";
}
public function createPDF() {
    $userId = $_SESSION['user_id'];  // Get the logged-in user's ID

    // Fetch bills for this user that don't have a PDF yet
    $billsWithoutPDF = $this->billModel->getBillsWithoutPDF($userId);

    // Load the view to display the bills
    require_once "app/views/createPDF.php";
}
public function generatePDF($billId) {
    // Load the bill data
    $billHeader = $this->billModel->getBillHeader($billId, $_SESSION['user_id']);
    $billItems = $this->billModel->getBillItems($billId);
    $billBottom = $this->billModel->getBillBottom($billId);
    
    // Check if bill header and items exist
    if (!$billHeader || !$billItems) {
        echo "Bill not found or no items to display.";
        return;
    }

    // Include the FPDF library
    require_once 'fpdf/fpdf.php';
    
    // Create a new PDF instance
    $pdf = new FPDF();
    $pdf->AddPage();
    
    // Set the font for the header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Invoice');
    
    // Bill header information
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Bill Number: ' . $billHeader->bill_number);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Year: ' . $billHeader->year);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Date: ' . $billHeader->date_created);
    
    // Add space before items
    $pdf->Ln(10);
    $pdf->Cell(40, 10, 'Items:');
    
    // Table for bill items
    foreach ($billItems as $item) {
        $pdf->Ln();
        $pdf->Cell(40, 10, 'Description: ' . $item->item_work);
        $pdf->Cell(40, 10, 'Price: ' . $item->price);
        $pdf->Cell(40, 10, 'Quantity: ' . $item->quantity);
        $pdf->Cell(40, 10, 'Total: ' . $item->amount);
    }
    
    // Add the total amounts at the bottom
    $pdf->Ln(20);
    $pdf->Cell(40, 10, 'Netto: ' . $billBottom->sum_netto);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'VAT: ' . $billBottom->vat);
    $pdf->Ln();
    $pdf->Cell(40, 10, 'Total: ' . $billBottom->total);
    
    $testFile = '/opt/lampp/htdocs/bill/myPDF/testfile.txt';
if (file_put_contents($testFile, 'This is a test')) {
    echo "File written successfully!";
} else {
    echo "Failed to write file.";
}
die();
    // Set the path for saving PDFs
    $pathToSave = '/opt/lampp/htdocs/bill/myPDF/bill_' . $billId . '.pdf';  // Adjust path
 echo '<br>PathToSave = '.$pathToSave;
    // Output the PDF to file
    if (!$pdf->Output('F', $pathToSave)) {
        echo "Failed to save the PDF file.";
        return;
    }

    // Mark the bill as having a PDF in the database
    $this->billModel->markPDFGenerated($billId);

    // Redirect back to the bills overview page after generating the PDF
    header('Location: /bill/bills/browse');
    exit;
}


}



