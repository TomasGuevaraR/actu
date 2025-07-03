@extends('layouts.app')

<!-- Enlaces a Bootstrap e íconos -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0 rounded-4 overflow-hidden">
                <div class="card-header bg-gradient-primary text-white py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 fw-bold">
                            <i class="bi bi-person-plus me-2"></i>
                            <span style="color: #0d6efd;">Crear Nuevo Usuario</span>
                        </h4>
                        <a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-primary rounded-pill" style="background-color: #0d6efd; border-color: #0d6efd;">
                            <i class="bi bi-arrow-left me-1"></i> Volver
                        </a>
                    </div>
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

                    <form action="{{ route('usuarios.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="row g-3">
                            <!-- Nombre -->
                            <div class="col-md-6">
                                <label for="nombre" class="form-label fw-bold">
                                    <i class="bi bi-person-badge-fill me-2 text-primary"></i>Nombre completo
                                </label>
                                <input type="text" name="nombre" id="nombre" class="form-control shadow-sm" required>
                            </div>

                            <!-- Número de identificación -->
                            <div class="col-md-6">
                                <label for="numero_identificacion" class="form-label fw-bold">
                                    <i class="bi bi-credit-card-2-front-fill me-2 text-primary"></i>Número de Identificación
                                </label>
                                <input type="text" name="numero_identificacion" id="numero_identificacion" class="form-control shadow-sm" required>
                            </div>

                            <!-- Correo -->
                            <div class="col-md-6">
                                <label for="email" class="form-label fw-bold">
                                    <i class="bi bi-envelope-fill me-2 text-primary"></i>Correo electrónico
                                </label>
                                <input type="email" name="email" id="email" class="form-control shadow-sm" required>
                            </div>

                            <!-- Contraseña -->
                            <div class="col-md-6">
                                <label for="password" class="form-label fw-bold">
                                    <i class="bi bi-key-fill me-1 text-primary"></i>Contraseña
                                </label>
                                <input type="password" id="password" name="password" class="form-control shadow-sm" required>
                            </div>

                            <!-- Confirmar contraseña -->
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label fw-bold">
                                    <i class="bi bi-key-fill me-1 text-primary"></i>Confirmar Contraseña
                                </label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control shadow-sm" required>
                            </div>

                            <!-- Rol -->
                            <div class="col-md-6">
                                <label for="rol" class="form-label fw-bold">
                                    <i class="bi bi-person-gear me-1 text-primary"></i>Rol del usuario
                                </label>
                                <select id="rol" name="rol" class="form-select shadow-sm" required>
                                    <option value="">-- Seleccione --</option>
                                    <option value="pastor">Pastor</option>
                                    <option value="anciano">Anciano</option>
                                    <option value="tesorero">Tesorero</option>
                                    <option value="fiscal">Fiscal</option>
                                    <option value="secretario">Secretario</option>
                                </select>
                            </div>

                            <!-- Estado -->
                            <div class="col-md-6">
                                <label for="estado" class="form-label fw-bold">
                                    <i class="bi bi-toggle-on me-1 text-primary"></i>Estado
                                </label>
                                <select name="estado" id="estado" class="form-select shadow-sm" required>
                                    <option value="activo" selected>Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>

                        <!-- Botón guardar -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-lg py-3">
                                <i class="bi bi-save-fill me-2"></i>Guardar Usuario
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
