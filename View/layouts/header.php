<?php
$pageTitle = $pageTitle ?? 'Nobanno Agro Farm';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        <?= htmlspecialchars($pageTitle) ?>
        | Nobanno Agro Farm
    </title>

    <link
        rel="stylesheet"
        href="public/css/style.css"
    >

    <?php if (!empty($extraCss)): ?>

        <?php foreach ($extraCss as $css): ?>

            <link
                rel="stylesheet"
                href="<?= htmlspecialchars($css) ?>"
            >

        <?php endforeach; ?>

    <?php endif; ?>

</head>

<body>

<?php
require __DIR__ . '/navbar.php';
?>