@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Estado Financiero Anual - {{ $anio }}</h1>

    <!-- Botón para ingresar saldo inicial -->
    <div class="mb-3">
        <a href="{{ route('estado.saldo-inicial.form') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Ingresar Saldo Inicial
        </a>
    </div>

    <form class="mb-4" method="GET" action="{{ route('estado.index') }}">
        <label for="anio">Seleccionar año:</label>
        <select name="anio" id="anio" onchange="this.form.submit()">
            @for ($a = now()->year; $a >= now()->year - 5; $a--)
                <option value="{{ $a }}" {{ $a == $anio ? 'selected' : '' }}>{{ $a }}</option>
            @endfor
        </select>
    </form>

    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>Mes</th>
                <th>Saldo Inicial</th>
                <th>Entradas</th>
                <th>Salidas</th>
                <th>Saldo Final</th>
            </tr>
        </thead>
        <tbody>
            @php
                $meses = [
                    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ];
                $saldoFinal = 0;
            @endphp
            @foreach($meses as $i => $mes)
                <tr>
                    <td>{{ $mes }}</td>
                    <td>{{ number_format($saldos[$i]['inicial'], 2) }}</td>
                    <td>{{ number_format($saldos[$i]['entradas'], 2) }}</td>
                    <td>{{ number_format($saldos[$i]['salidas'], 2) }}</td>
                    <td>{{ number_format($saldos[$i]['final'], 2) }}</td>
                    @php $saldoFinal = $saldos[$i]['final']; @endphp
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="font-weight-bold">
                <td colspan="4" class="text-right">Saldo Final del Año:</td>
                <td>{{ number_format($saldoFinal, 2) }}</td>
            </tr>
        </tfoot>
    </table>
</div>
@endsection
