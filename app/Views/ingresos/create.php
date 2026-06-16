<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Nuevo Ingreso</h1>

<form
    action="/ingresos/store"
    method="post"
>

    <div class="form-group">

        <label>
            Categoría
        </label>

        <select
            name="categoria_id"
        >

            <?php foreach(
                $categorias
                as $c
            ): ?>

            <option
                value="<?= $c['id'] ?>"
            >
                <?= esc(
                    $c['nombre']
                ) ?>
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
        >

    </div>

    <div class="form-group">

        <label>
            Fecha
        </label>

        <input
            type="date"
            name="fecha"
        >

    </div>

    <button
        class="btn-primary"
    >
        Guardar
    </button>

</form>

<?= $this->endSection() ?>