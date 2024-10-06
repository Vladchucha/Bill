<?php
// Define the content to be injected into the layout
ob_start();
?>

<div class="container">
    <h2>Create New Bill</h2>

    <!-- Success or error message if set -->
    <?php if (isset($success)): ?>
        <p class="success"><?= htmlspecialchars($success) ?></p>
    <?php elseif (isset($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form action="/bill/bills/createBill" method="POST">
        <div class="form-group">
            <label for="carrier">Select Carrier:</label>
            <select name="carrierId" required>
                <option value="">-- Select Carrier --</option>
                <?php foreach ($carriers as $carrier): ?>
                    <option value="<?= htmlspecialchars($carrier->id) ?>"><?= htmlspecialchars($carrier->name) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label for="year">Bill Year:</label>
            <input type="number" name="year" value="<?= date('Y') ?>" required> <!-- Default is the current year -->
        </div>

        <div class="form-group">
            <label for="month">Month (optional):</label>
            <input type="text" name="month" placeholder="e.g. July">
        </div>

        <button type="submit">Proceed to Bill Details</button>
    </form>
</div>

<?php
$content = ob_get_clean();
$title = "Create New Bill - Step 1";
require_once "layout.php";
