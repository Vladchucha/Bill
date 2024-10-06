<!-- app/views/landing.php -->
<?php 
// Define the content to be injected into the layout
ob_start();  // Start output buffering
?>

<div class="container">
    <h1><?= $text_menu['intro_text'] ?></h1>
    <div>
        <a href="/bill/login" class="login"><?= $text_menu['login'] ?></a>
        <a href="/bill/register" class="register"><?= $text_menu['register'] ?></a>
    </div>
</div>

<!-- Language selection -->
<div class="language-menu">
    <ul>
        <li>
            <a href="#"><?= $text_menu['language'] ?>+</a>
            <ul class="submenu">
                <li><a href="/?lang=ru">RU</a></li>
                <li><a href="/?lang=de">DE</a></li>
                <li><a href="/?lang=en">EN</a></li>
            </ul>
        </li>
    </ul>
</div>

<?php
$content = ob_get_clean();  // Get the buffered content
$title = $text_menu['intro_text'];  // Set the page title dynamically
require_once "layout.php";  // Include the layout
?>
