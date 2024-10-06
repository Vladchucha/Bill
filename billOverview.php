<?php
// app/views/billsOverview.php

// Define the content to be injected into the layout
ob_start();
?>

<div class="container">
    <h2>All Bills</h2>

    <table>
        <thead>
            <tr>
                <th>Bill Number</th>
                <th>Carrier</th>
                <th>Item Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total (Row)</th>
                <th>Bill Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bills as $bill): ?>
                <tr>
                    <td><?= htmlspecialchars($bill->billId) ?></td>
                    <td><?= htmlspecialchars($bill->carrierName) ?></td>
                    <td><?= htmlspecialchars($bill->description) ?></td>
                    <td><?= htmlspecialchars($bill->quantity) ?></td>
                    <td><?= htmlspecialchars($bill->price) ?></td>
                    <td><?= htmlspecialchars($bill->totalRow) ?></td>
                    <td><?= htmlspecialchars($bill->bill_date) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$content = ob_get_clean();
$title = "Bills Overview";
require_once "layout.php";
