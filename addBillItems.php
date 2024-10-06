<?php
ob_start();
?>

<div class="form-container">
    <h2>Add Items to Bill</h2>

    <p><strong>Bill Number:</strong> <?= htmlspecialchars($billHeader->bill_number) ?> / <?= htmlspecialchars($billHeader->year) ?></p>

    <form action="/bill/bills/addBillItem" method="POST">
        <input type="hidden" name="bill_number" value="<?= htmlspecialchars($billHeader->bill_number) ?>">

        <div class="form-group">
            <label for="item_work">Work/Service:</label>
            <input type="text" name="item_work" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" step="0.01" name="price" required>
        </div>

        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" step="0.01" name="quantity" required>
        </div>

        <button type="submit">Add Item</button>
    </form>

    <h3>Added Items</h3>
    <!-- Display the list of added items -->
    <?php if (!empty($items)): ?>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total (Row)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item->item_work) ?></td>
                    <td><?= htmlspecialchars($item->price) ?></td>
                    <td><?= htmlspecialchars($item->quantity) ?></td>
                    <td><?= htmlspecialchars($item->amount) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No items have been added yet.</p>
    <?php endif; ?>

    <!-- Finalize Bill Button -->
    <form action="/bill/bills/finalizeBill" method="POST">
        <input type="hidden" name="bill_number" value="<?= htmlspecialchars($billHeader->bill_number) ?>">
        <button type="submit">Done</button>
    </form>

    <!-- Button to go back to the main menu -->
    <a href="/bill/bills" class="back-to-menu-button">Go Back to Main Menu</a>
</div>

<?php
$content = ob_get_clean();
$title = "Add Items to Bill";
require_once "layout.php";
?>
