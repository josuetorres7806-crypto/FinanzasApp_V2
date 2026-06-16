<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <h1>Gastos</h1>

    <a
        href="/gastos/create"
        class="btn-primary"
    >
        Nuevo Gasto
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

    <?php foreach($gastos as $g): ?>

    <tr>

        <td><?= $g['id'] ?></td>

        <td><?= esc($g['descripcion']) ?></td>

        <td>
            $
            <?= number_format(
                $g['monto'],
                2
            ) ?>
        </td>

        <td><?= $g['fecha'] ?></td>

        <td>

            <a
                class="btn-danger"
                href="/gastos/delete/<?= $g['id'] ?>"
            >
                Eliminar
            </a>

        </td>

    </tr>

    <?php endforeach ?>

    </tbody>

</table>

<?= $this->endSection() ?>