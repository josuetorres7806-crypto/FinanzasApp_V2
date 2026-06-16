<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <h1>Presupuestos</h1>

    <a
        href="/presupuestos/create"
        class="btn-primary"
    >
        Nuevo Presupuesto
    </a>

</div>

<table class="table">

    <thead>

        <tr>

            <th>Nombre</th>

            <th>Monto</th>

            <th>Estado</th>

            <th></th>

        </tr>

    </thead>

    <tbody>

    <?php foreach($presupuestos as $p): ?>

        <tr>

            <td>
                <?= esc($p['nombre']) ?>
            </td>

            <td>
                $<?= number_format($p['monto'],2) ?>
            </td>

            <td>
                <?= esc($p['estado']) ?>
            </td>

            <td>

                <a
                    class="btn-danger"
                    href="/presupuestos/delete/<?= $p['id'] ?>"
                >
                    Eliminar
                </a>

            </td>

        </tr>

    <?php endforeach ?>

    </tbody>

</table>

<?= $this->endSection() ?>