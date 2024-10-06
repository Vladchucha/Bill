<?php
ob_start();
?>

<div class="form-container">
    <h2>Create New Bill - Heading</h2>
    <form action="/bill/bills/createBillStep2" method="POST">
        <label for="carrier">Select Carrier:</label>
        <select name="carrierId" required>
            <option value="">Select Carrier</option>
            <?php foreach ($carriers as $carrier): ?>
                <option value="<?= htmlspecialchars($carrier->id) ?>"><?= htmlspecialchars($carrier->name) ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="year">Year:</label>
        <input type="number" name="year" value="<?= date('Y') ?>" required>

        <label for="month">Month (optional):</label>
        <input type="text" name="month">

        <button type="submit">Next</button>
    </form>

    <!-- Button to go back to the main menu -->
    <a href="/bill/bills" class="back-to-menu-button">Go Back to Main Menu</a>
</div>

<?php
$content = ob_get_clean();
$title = "Create New Bill";
require_once "layout.php";
?>
