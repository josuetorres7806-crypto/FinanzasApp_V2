<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <h1>Ingresos</h1>

    <a
        href="/ingresos/create"
        class="btn-primary"
    >
        Nuevo Ingreso
    </a>

</div>

<table class="table">

    <thead>

    <tr>

        <th>ID</th>

        <th>Descripción</th>

        <th>Monto</th>

        <th>Fecha</th>

        <th></th>

    </tr>

    </thead>

    <tbody>

    <?php foreach($ingresos as $i): ?>

    <tr>

        <td><?= $i['id'] ?></td>

        <td><?= esc($i['descripcion']) ?></td>

        <td>
            $
            <?= number_format(
                $i['monto'],
                2
            ) ?>
        </td>

        <td><?= $i['fecha'] ?></td>

        <td>

            <a
                class="btn-danger"
                href="/ingresos/delete/<?= $i['id'] ?>"
            >
                Eliminar
            </a>

        </td>

    </tr>

    <?php endforeach ?>

    </tbody>

</table>

<?= $this->endSection() ?>