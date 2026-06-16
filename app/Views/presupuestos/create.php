<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<h1>Nuevo Presupuesto</h1>

<form
    action="/presupuestos/store"
    method="post"
>

    <div class="form-group">

        <label>
            Nombre
        </label>

        <input
            type="text"
            name="nombre"
            required
        >

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
            required
        >

    </div>

    <div class="form-group">

        <label>
            Fecha inicio
        </label>

        <input
            type="date"
            name="fecha_inicio"
            required
        >

    </div>

    <div class="form-group">

        <label>
            Fecha fin
        </label>

        <input
            type="date"
            name="fecha_fin"
            required
        >

    </div>

    <button
        class="btn-primary"
    >
        Guardar
    </button>

</form>

<?= $this->endSection() ?>