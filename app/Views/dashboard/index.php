<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Dashboard</h1>

<div class="cards">

    <div class="card">

        <h3>Ingresos</h3>

        <p>
            $<?= number_format($ingresos, 2) ?>
        </p>

    </div>

    <div class="card">

        <h3>Gastos</h3>

        <p>
            $<?= number_format($gastos, 2) ?>
        </p>

    </div>

    <div class="card">

        <h3>Balance</h3>

        <p>
            $<?= number_format($balance, 2) ?>
        </p>

    </div>

    <div class="card">

        <h3>Presupuestos</h3>

        <p>
            <?= $presupuestos ?>
        </p>

    </div>

</div>

<hr style="margin:30px 0;">

<h2>Últimos Ingresos</h2>

<table class="table">

    <thead>

        <tr>

            <th>Descripción</th>

            <th>Monto</th>

            <th>Fecha</th>

        </tr>

    </thead>

    <tbody>

    <?php foreach($ultimosIngresos as $i): ?>

        <tr>

            <td>
                <?= esc($i['descripcion']) ?>
            </td>

            <td>
                $<?= number_format($i['monto'], 2) ?>
            </td>

            <td>
                <?= $i['fecha'] ?>
            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

<br><br>

<h2>Últimos Gastos</h2>

<table class="table">

    <thead>

        <tr>

            <th>Descripción</th>

            <th>Monto</th>

            <th>Fecha</th>

        </tr>

    </thead>

    <tbody>

    <?php foreach($ultimosGastos as $g): ?>

        <tr>

            <td>
                <?= esc($g['descripcion']) ?>
            </td>

            <td>
                $<?= number_format($g['monto'], 2) ?>
            </td>

            <td>
                <?= $g['fecha'] ?>
            </td>

        </tr>

    <?php endforeach; ?>

    </tbody>

</table>

<br><br>

<div class="card">

    <h2>
        Evolución de ingresos
    </h2>

    <canvas
        id="balanceChart"
    ></canvas>

</div>

<script>

const ingresosData =
<?= json_encode($ingresosMensuales) ?>;

const gastosData =
<?= json_encode($gastosMensuales) ?>;

</script>
<?= $this->endSection() ?>