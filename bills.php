<?php
// Define the content to be injected into the layout
ob_start();
?>

<div class="container">
    <h2>Welcome to the Bills Page</h2>
    <p>You are logged in as <?= htmlspecialchars($_SESSION['user_email']) ?></p>
    <a href="/bill/logout" class="logout-button">Logout</a> <!-- Link to log out -->

    <!-- Menu container -->
    <div class="menu-container">
        <div class="menu-section">
            <h3>Private</h3>
            <div class="menu-item">
                <a href="/bill/private">View Private Info</a>
            </div>
        </div>

        <div class="menu-section">
            <h3>Carriers</h3>
            <div class="menu-item">
                <a href="/bill/carriers/add">Add New Carrier</a>
            </div>
            <div class="menu-item">
                <a href="/bill/carriers/update">Update Carrier</a>
            </div>
        </div>

        <div class="menu-section">
            <h3>Bills</h3>
            <div class="menu-item">
                <a href="/bill/bills/fromPrevious">New Bill from Previous</a>
            </div>
            <div class="menu-item">
                <a href="/bill/bills/createBill">Create New Bill</a>
            </div>
            <div class="menu-item">
                <a href="/bill/bills/browse">Bills Browsing</a>
            </div>
            <!-- New Create PDF option -->
            <div class="menu-item">
                <a href="/bill/bills/createPDF">Create PDF</a>
            </div>
        </div>

        <div class="menu-section">
            <h3>Statistics</h3>
            <div class="menu-item">
                <a href="/bill/statistics/option1">Statistic 1</a>
            </div>
            <div class="menu-item">
                <a href="/bill/statistics/option2">Statistic 2</a>
            </div>
            <div class="menu-item">
                <a href="/bill/statistics/option3">Statistic 3</a>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
$title = "Bills Menu";
require_once "layout.php";
?>
