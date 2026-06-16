<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>FinanzasApp V2</title>

    <link
        rel="stylesheet"
        href="<?= base_url('assets/css/app.css') ?>"
    >

</head>

<body>

    <?= view('layouts/sidebar') ?>

    <div class="wrapper">

        <?= view('layouts/navbar') ?>

        <main class="content">

            <?= $this->renderSection('content') ?>

        </main>

    </div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="<?= base_url('assets/js/app.js') ?>"></script>

<script src="<?= base_url('assets/js/dashboard.js') ?>"></script>



</body>

</html>