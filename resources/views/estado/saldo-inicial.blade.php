@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="col-md-6">
        <div class="text-center mb-4">
            <h2 class="fw-bold text-primary">💼 Ingresar Saldo Inicial del Año</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form action="{{ route('estado.saldo-inicial.guardar') }}" method="POST" class="card p-4 shadow rounded-4 border-0">
            @csrf
            <div class="form-group mb-3">
                <label for="anio" class="form-label fw-semibold">📅 Año</label>
                <input type="number" name="anio" id="anio" class="form-control form-control-lg" value="{{ old('anio', now()->year) }}" required>
            </div>

            <div class="form-group mb-4">
                <label for="saldo_inicial" class="form-label fw-semibold">💰 Saldo Inicial</label>
                <input type="number" step="0.01" name="saldo_inicial" id="saldo_inicial" class="form-control form-control-lg" value="{{ old('saldo_inicial') }}" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-lg text-white" style="background-color: #0166b3;">
                    <i class="bi bi-save"></i> Guardar
                </button>
                <a href="{{ route('estado.index') }}" class="btn btn-outline-secondary btn-lg">
                    <i class="bi bi-x-circle"></i> Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
