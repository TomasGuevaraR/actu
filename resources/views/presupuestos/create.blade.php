@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow rounded-4">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0"><i class="bi bi-plus-circle me-2"></i> Nueva Casilla de Presupuesto</h4>
                    <a href="{{ route('presupuestos.index') }}" class="btn btn-light btn-sm rounded-pill">
                        ← Volver
                    </a>
                </div>

                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger rounded">
                            <strong>¡Ups!</strong> Hay algunos errores.<br><br>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>- {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('presupuestos.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nombre_casilla" class="form-label fw-bold">Nombre de la Casilla</label>
                            <input type="text" name="nombre_casilla" id="nombre_casilla"
                                class="form-control rounded-pill" placeholder="Ej: Sueldo Pastor" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label fw-bold">Tipo</label>
                            <select name="tipo" id="tipo" class="form-select rounded-pill" required>
                                <option value="" disabled selected>Categoria</option>
                                <option value="administracion">Administración Pastoral</option>
                                <option value="demoninacion">Aportes Denominacionales</option>
                                <option value="ministerios">Ministerios y Formación</option>
                                <option value="servicio">Servicio</option>
                                <option value="otros">Otros</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="valor_mensual" class="form-label fw-bold">Valor Mensual</label>
                            <input type="number" name="valor_mensual" id="valor_mensual"
                                class="form-control rounded-pill" placeholder="Ej: 1000000" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label for="año" class="form-label fw-bold">Año</label>
                            <input type="number" name="año" id="año" class="form-control rounded-pill"
                                placeholder="Ej: 2025" value="{{ now()->year }}" min="2023" required>
                        </div>

                        <div class="mb-4">
                            <label for="responsable" class="form-label fw-bold">Responsable</label>
                            <input type="text" name="responsable" id="responsable"
                                class="form-control rounded-pill" placeholder="Nombre del responsable (opcional)">
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary px-4 rounded-pill">
                                <i class="bi bi-save me-1"></i> Guardar Casilla
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
