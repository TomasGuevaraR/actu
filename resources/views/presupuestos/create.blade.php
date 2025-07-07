@extends('layouts.app')

<!-- Estilos de Bootstrap e íconos -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom d-flex align-items-center justify-content-between px-4 py-3">
                    <h4 class="mb-0 fw-bold text-primary">
                        <i class="bi bi-calculator-fill me-2"></i> Nueva Casilla de Presupuesto
                    </h4>
                    <a href="{{ route('presupuestos.index') }}" class="btn btn-sm btn-primary rounded-pill shadow-sm" style="background-color: #0d6efd; border-color: #0d6efd;">
                        <i class="bi bi-arrow-left me-1"></i> Volver
                    </a>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3 shadow-sm">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('presupuestos.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-3">
                            <!-- Nombre de la Casilla -->
                            <div class="col-md-6">
                                <label for="nombre_casilla" class="form-label fw-bold">
                                    <i class="bi bi-card-text text-primary me-2"></i>Nombre de la Casilla
                                </label>
                                <input type="text" name="nombre_casilla" id="nombre_casilla" class="form-control shadow-sm" placeholder="Ej: Sueldo Pastor" required>
                            </div>

                            <!-- Categoría -->
                            <div class="col-md-6">
                                <label for="categoria" class="form-label fw-bold">
                                    <i class="bi bi-tags text-primary me-2"></i>Categoría
                                </label>
                                <select name="categoria" id="categoria" class="form-select shadow-sm" required>
                                    <option value="">-- Selecciona una categoría --</option>
                                    <option value="Administración Pastoral">Administración Pastoral</option>
                                    <option value="Aportes Denominacionales">Aportes Denominacionales</option>
                                    <option value="Ministerio y Formación">Ministerio y Formación</option>
                                    <option value="Servicio">Servicio</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>

                            <!-- Valor Mensual -->
                            <div class="col-md-6">
                                <label for="valor_mensual" class="form-label fw-bold">
                                    <i class="bi bi-currency-dollar text-primary me-2"></i>Valor Mensual
                                </label>
                                <input type="number" name="valor_mensual" id="valor_mensual" class="form-control shadow-sm" placeholder="Ej: 1000000" min="0" required>
                            </div>

                            <!-- Año -->
                            <div class="col-md-6">
                                <label for="año" class="form-label fw-bold">
                                    <i class="bi bi-calendar-event text-primary me-2"></i>Año
                                </label>
                                <input type="number" name="año" id="año" class="form-control shadow-sm" placeholder="Ej: 2025" value="{{ now()->year }}" min="2023" required>
                            </div>

                            <!-- Responsable -->
                            <div class="col-md-6">
                                <label for="responsable" class="form-label fw-bold">
                                    <i class="bi bi-person-fill text-primary me-2"></i>Responsable (opcional)
                                </label>
                                <input type="text" name="responsable" id="responsable" class="form-control shadow-sm" placeholder="Ej: Juan Pérez">
                            </div>
                        </div>

                        <!-- Botón Guardar -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-lg py-3">
                                <i class="bi bi-save-fill me-2"></i>Guardar Casilla
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
