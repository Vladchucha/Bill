<?php

class Bill {
    private $db;

    public function __construct($db) {
        $this->db = $db;
         include 'config/checkErrors.php' ;
    }

    // Get the next available bill number for the user and year
   public function getNextBillNumber($id_users, $year) {
    // Query to get the maximum bill number for the given user and year
    $sql = "SELECT MAX(bill_number) AS max_bill_number
            FROM bill_header
            WHERE 1d_users = ? AND year = ?";
    $params = [$id_users, $year];
    $result = $this->db->queryObjectArray($sql, $params);

    // If no bills exist, return 1, otherwise return max bill number + 1
    if ($result && $result[0]->max_bill_number !== null) {
        return $result[0]->max_bill_number + 1;  // Increment by 1
    } else {
        return 1;  // If no bills exist for the user, start with 1
    }
}


    /////// Create a new bill header
//    public function createBillHeader($carrierId, $id_users, $bill_number, $year, $month) {
//    $sql = "INSERT INTO bill_header (id_carriers, 1d_users, bill_number, year, month, date_created) 
//            VALUES (?, ?, ?, ?, ?, CURDATE())";
//    $params = [$carrierId, $id_users, $bill_number, $year, $month];
//    $this->db->executeQuery($sql, $params);
//
//    // Return the last inserted bill header ID
//    return $this->db->getLastInsertId();
//}
//public function createBillHeader($carrierId, $userId, $year, $month) {
//    // Generate a bill number based on the user and year
//    $billNumber = $this->generateBillNumber($userId, $year);
//echo 'billNumber = '.$billNumber.'<br>';
//    // Insert a new record into the bill_header table
//    $sql = "INSERT INTO bill_header (id_carriers, 1d_users, bill_number, year, month, date_created)
//            VALUES (?, ?, ?, ?, ?, NOW())";
//    $params = [$carrierId, $userId, $billNumber, $year, $month];
//    $this->db->executeQuery($sql, $params);
//
//    // Get the last inserted ID (billId)
//    return $this->db->getLastInsertId();
//}
public function createBillHeader($carrierId, $userId, $year, $month) {
    // Generate a bill number based on the user and year
    $billNumber = $this->generateBillNumber($userId, $year);

    // Insert the new bill header into the database
    $sql = "INSERT INTO bill_header (id_carriers, 1d_users, bill_number, year, month, date_created)
            VALUES (?, ?, ?, ?, ?, NOW())";
    $params = [$carrierId, $userId, $billNumber, $year, $month];
    
    // Execute the query
    $result = $this->db->executeQuery($sql, $params);
    
    // Check if the insertion was successful
    if ($result > 0) {
        // Get the last inserted ID (billId)
        $billId = $this->db->getLastInsertId();
        
        // Check if billId was successfully retrieved
        if ($billId) {
            return $billId;
        } else {
            echo "Error: Unable to retrieve the bill ID after creating the bill header.";
            return false;
        }
    } else {
        echo "Error: Failed to insert the bill header into the database.";
        return false;
    }
}

private function generateBillNumber($userId, $year) {
    // Logic to generate the next bill number for the user and year
    $sql = "SELECT MAX(bill_number) AS max_bill_number 
            FROM bill_header 
            WHERE 1d_users = ? AND year = ?";
    $params = [$userId, $year];
    $result = $this->db->queryObjectArray($sql, $params);

    $maxBillNumber = $result[0]->max_bill_number ?? 0;
    return $maxBillNumber + 1;
}


   public function addBillItem($billId, $itemWork, $price, $quantity, $amount) {
    // Get the next available item_number for this bill
    $itemNumber = $this->getNextItemNumber($billId);

    // Insert the new item into bill_rows
    $sql = "INSERT INTO bill_rows (id_bill_header, item_number, item_work, price, quantity, amount) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $params = [$billId, $itemNumber, $itemWork, $price, $quantity, $amount];
    return $this->db->executeQuery($sql, $params);
}
    
//    public function getBillItems($billId) {
//    $sql = "SELECT * FROM bill_rows WHERE id_bill_header = ?";
//    $params = [$billId];
//    return $this->db->queryObjectArray($sql, $params);
//}
public function getNextItemNumber($billId) {
    $sql = "SELECT MAX(item_number) AS max_item_number FROM bill_rows WHERE id_bill_header = ?";
    $params = [$billId];
    $result = $this->db->queryObjectArray($sql, $params);

    // If no items exist, start from 1, otherwise increment max item number by 1
    if ($result && $result[0]->max_item_number !== null) {
        return $result[0]->max_item_number + 1;
    } else {
        return 1;  // If no items exist, start with 1
    }
}

//public function finalizeBill($billId, $sumNetto, $vat, $totalBrutto) {
//    $sql = "INSERT INTO bill_bottom (id_bill_head, sum_netto, vat, total) VALUES (?, ?, ?, ?)
//            ON DUPLICATE KEY UPDATE sum_netto = VALUES(sum_netto), vat = VALUES(vat), total = VALUES(total)";
//    $params = [$billId, $sumNetto, $vat, $totalBrutto];
//    return $this->db->executeQuery($sql, $params);
//}
public function finalizeBill($billId, $sumNetto, $vat, $totalBrutto) {
    // Insert the finalized bill data into bill_bottom
    $sql = "INSERT INTO bill_bottom (id_bill_head, sum_netto, vat, total)
            VALUES (?, ?, ?, ?)";
    $params = [$billId, $sumNetto, $vat, $totalBrutto];
    
    return $this->db->executeQuery($sql, $params);  // Save the data
}

//public function getBillHeader($billId, $id_users) {
//    $sql = "SELECT bh.bill_number, bh.year, bh.month, bh.date_created, c.name AS carrier_name, c.address AS carrier_address
//            FROM bill_header bh
//            JOIN carriers c ON bh.id_carriers = c.id
//            WHERE bh.id = ? AND bh.1d_users = ?";
//    $params = [$billId, $id_users];
//    $result = $this->db->queryObjectArray($sql, $params);
//
//    // Return the first row (bill header) or null if not found
//    return $result[0] ?? null;
//}


//public function getBillHeader($billId, $id_users) {
//    $sql = "SELECT * FROM bill_header WHERE id = ? AND 1d_users = ?";
//    $params = [$billId, $id_users];
//
//    // Debugging: Check the query and parameters
//    var_dump($sql, $params);
//
//    $result = $this->db->queryObjectArray($sql, $params);
//
//    // Debugging: Check if a result is returned
//    var_dump($result);
//
//    if (!empty($result)) {
//        return $result[0];
//    }
//
//    return null;
//}
public function getBillHeader($billId, $userId) {
    $sql = "SELECT bh.*, c.name AS carrier_name, c.address AS carrier_address
            FROM bill_header bh
            JOIN carriers c ON bh.id_carriers = c.id
            WHERE bh.id = ? AND bh.1d_users = ?";
    
    $params = [$billId, $userId];
    return $this->db->queryObject($sql, $params);
}


public function getBillIdByNumber($billNumber, $id_users) {
    // Debugging: Check the input values for billNumber and id_users
    var_dump($billNumber, $id_users);  // Check if these values are correct
    $sql = "SELECT id FROM bill_header WHERE bill_number = ? AND 1d_users = ?";
    $params = [$billNumber, $id_users];
    
    // Debugging: Check the SQL query and parameters
    var_dump($sql, $params);
    
    $result = $this->db->queryObjectArray($sql, $params);

    // Debugging: Check if a result is returned
    var_dump($result);

    // If result is found, return the bill ID
    if (!empty($result)) {
        return $result[0]->id;
    }

    // If no result is found, return null
    return null;
}

public function getBillItems($billId) {
    $sql = "SELECT item_work, price, quantity, (price * quantity) as amount
            FROM bill_rows
            WHERE id_bill_header = ?";
    $params = [$billId];
    return $this->db->queryObjectArray($sql, $params);
}


public function getBillBottom($billId) {
    $sql = "SELECT sum_netto, vat, total
            FROM bill_bottom
            WHERE id_bill_head = ?";
    $params = [$billId];
    $result = $this->db->queryObjectArray($sql, $params);

    return $result[0] ?? null;  // Return the first row (bill bottom) or null if not found
}
public function getBillsWithoutPDF($userId) {
    $sql = "SELECT * FROM bill_header WHERE 1d_users = ? AND pdf = FALSE";
    $params = [$userId];
    return $this->db->queryObjectArray($sql, $params);
}
public function markPDFGenerated($billId) {
    $sql = "UPDATE bill_header SET pdf = TRUE WHERE id = ?";
    $params = [$billId];
    return $this->db->executeQuery($sql, $params);
}


}
