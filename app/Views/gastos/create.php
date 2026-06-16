<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Nuevo Gasto</h1>

<form
    action="/gastos/store"
    method="post"
>

    <div class="form-group">

        <label>
            Categoría
        </label>

        <select
            name="categoria_id"
            required
        >

            <?php foreach($categorias as $c): ?>

            <option
                value="<?= $c['id'] ?>"
            >
                <?= esc($c['nombre']) ?>
            </option>

            <?php endforeach ?>

        </select>

    </div>

    <div class="form-group">

        <label>
            Presupuesto
        </label>

        <select
            name="presupuesto_id"
        >

            <option value="">
                Sin presupuesto
            </option>

            <?php foreach($presupuestos as $p): ?>

            <option
                value="<?= $p['id'] ?>"
            >
                <?= esc($p['nombre']) ?>
            </option>

            <?php endforeach ?>

        </select>

    </div>

    <div class="form-group">

        <label>
            Descripción
        </label>

        <input
            type="text"
            name="descripcion"
            required
        >

    </div>

    <div class="form-group">

        <label>
            Monto
        </label>

        <input
            type="number"
            step="0.01"
            name="monto"
            required
        >

    </div>

    <div class="form-group">

        <label>
            Fecha
        </label>

        <input
            type="date"
            name="fecha"
            required
        >

    </div>

    <button
        class="btn-primary"
    >
        Guardar Gasto
    </button>

</form>

<?= $this->endSection() ?>