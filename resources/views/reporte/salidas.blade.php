@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Reporte de Salidas</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Fecha de Salida</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            @foreach($salidas as $salida)
            <tr>
                <td>{{ $salida->id }}</td>
                <td>{{ $salida->producto->nombre }}</td>
                <td>{{ $salida->cantidad }}</td>
                <td>{{ $salida->fecha_salida }}</td>
                <td>{{ $salida->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection