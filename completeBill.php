<?php
ob_start();
?>

<div class="form-container">
    <h2>Invoice</h2>

    <p><strong>Bill Number:</strong> <?= htmlspecialchars($billHeader->bill_number) ?> / <?= htmlspecialchars($billHeader->year) ?></p>
    <p><strong>Bill Date:</strong> <?= htmlspecialchars($billHeader->date_created) ?></p>
    <p><strong>Carrier:</strong> <?= htmlspecialchars($billHeader->carrier_name) ?></p>
    <p><strong>Carrier Address:</strong> <?= htmlspecialchars($billHeader->carrier_address) ?></p>

    <h3>Bill Items</h3>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total (Row)</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($billItems as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item->item_work) ?></td>
                <td><?= htmlspecialchars($item->quantity) ?></td>
                <td><?= htmlspecialchars($item->price) ?></td>
                <td><?= htmlspecialchars($item->amount) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Bill Summary</h3>
    <p><strong>Total Netto:</strong> <?= htmlspecialchars($billBottom->sum_netto) ?></p>
    <p><strong>VAT (19%):</strong> <?= htmlspecialchars($billBottom->vat) ?></p>
    <p><strong>Total Brutto:</strong> <?= htmlspecialchars($billBottom->total) ?></p>

    <!-- Button to go back to the main menu -->
    <a href="/bill/bills" class="back-to-menu-button">Go Back to Main Menu</a>

    <!-- Button to generate a PDF -->
    <a href="/bill/bills/generatePDF/<?= htmlspecialchars($billHeader->bill_number) ?>" class="generate-pdf-button">Generate PDF</a>
</div>

<?php
$content = ob_get_clean();
$title = "Invoice";
require_once "layout.php";
?>
