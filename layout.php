<!-- app/views/layout.php -->

<!DOCTYPE html>
<html lang="<?= $lan ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Bill Management' ?></title>
    <link rel="stylesheet" href="/bill/public/CSS/styles.css?v=tgllhjgfghtrytyhjrtghvhjftgyjugjht6"> <!-- Link to external CSS -->
</head>
<body>

    <?= $content ?>  <!-- This is where the page-specific content will be injected -->

</body>
</html>
