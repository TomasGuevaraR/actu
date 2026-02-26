@extends('layouts.app')

@section('content')
    @php
        use App\Models\LibroContable;
        use Carbon\Carbon;
        $rolUsuario = Auth::user()->rol ?? '';
        $libroActivo = LibroContable::where('estado', 'activo')->first();

        // 🔹 Calcular fechas mín y máx basándose en mes_libro y anio_libro
        $fechaMin = date('d-m-Y');
        $fechaMax = date('d-m-Y');
        $fechaDefault = date('d-m-Y');

        if ($libroActivo) {
            $fechaInicio = Carbon::createFromDate($libroActivo->anio_libro, $libroActivo->mes_libro, 1)->startOfMonth();
            $fechaFin = Carbon::createFromDate($libroActivo->anio_libro, $libroActivo->mes_libro, 1)->endOfMonth();

            $fechaMin = $fechaInicio->format('Y-m-d');
            $fechaMax = $fechaFin->format('Y-m-d');

            // 🔹 Fecha por defecto (hoy si está en rango, sino la fecha de inicio del libro)
            $hoy = Carbon::today();

            if ($hoy->lt($fechaInicio)) {
                $fechaDefault = $fechaMin;
            } elseif ($hoy->gt($fechaFin)) {
                $fechaDefault = $fechaMax;
            } else {
                $fechaDefault = $hoy->format('Y-m-d');
            }
        }
    @endphp

    @if (in_array($rolUsuario, ['tesorero', 'anciano']))
        <div class="container py-5">
            <div class="max-w-4xl mx-auto bg-white shadow-md rounded-lg p-6">
                <a href="{{ route('dashboard') }}"
                    class="inline-flex items-center px-4 py-2 bg-[#0166b3] text-white text-sm font-medium rounded hover:bg-[#014c86] transition">
                    <i class="fas fa-arrow-left mr-2"></i> Volver
                </a>

                <h2 class="text-2xl font-bold text-[#198754] text-center mb-6">
                    Registrar Diezmo y Ofrenda
                </h2>

                {{-- 📌 Mostrar libro contable activo --}}
                @if($libroActivo)
                    @php
                        $nombresMeses = [
                            1 => 'Enero',
                            2 => 'Febrero',
                            3 => 'Marzo',
                            4 => 'Abril',
                            5 => 'Mayo',
                            6 => 'Junio',
                            7 => 'Julio',
                            8 => 'Agosto',
                            9 => 'Septiembre',
                            10 => 'Octubre',
                            11 => 'Noviembre',
                            12 => 'Diciembre'
                        ];
                        $nombreMes = $nombresMeses[$libroActivo->mes_libro] ?? 'Desconocido';
                        $fechaInicio = Carbon::createFromDate($libroActivo->anio_libro, $libroActivo->mes_libro, 1)->startOfMonth();
                        $fechaFin = Carbon::createFromDate($libroActivo->anio_libro, $libroActivo->mes_libro, 1)->endOfMonth();
                    @endphp
                    <div class="mb-4 p-3 bg-green-50 border border-green-200 rounded">
                        <p class="text-sm text-green-800">
                            📚 Libro contable activo: <strong>{{ $libroActivo->nombre }}</strong><br>
                            📅 Período: <strong>{{ $nombreMes }} {{ $libroActivo->anio_libro }}</strong>
                            ({{ $fechaInicio->format('d/m/Y') }} - {{ $fechaFin->format('d/m/Y') }})
                        </p>
                    </div>
                @else
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded">
                        <p class="text-sm text-red-800 font-bold">
                            🚫 No hay un libro contable activo. Activa un libro para poder registrar diezmos.
                        </p>
                    </div>
                @endif

                {{-- 📌 Mostrar errores de validación --}}
                @if ($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded">
                        <ul class="text-sm text-red-800">
                            @foreach ($errors->all() as $error)
                                <li>❌ {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- 📌 Si hay libro activo se permite registrar --}}
                @if($libroActivo)
                    <form id="formDiezmo" action="{{ route('diezmo.store') }}" method="POST">
                        @csrf

                        <!-- Fecha -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">
                                Fecha
                                @if($libroActivo)
                                    @php
                                        $nombresMeses = [
                                            1 => 'Enero',
                                            2 => 'Febrero',
                                            3 => 'Marzo',
                                            4 => 'Abril',
                                            5 => 'Mayo',
                                            6 => 'Junio',
                                            7 => 'Julio',
                                            8 => 'Agosto',
                                            9 => 'Septiembre',
                                            10 => 'Octubre',
                                            11 => 'Noviembre',
                                            12 => 'Diciembre'
                                        ];
                                        $nombreMes = $nombresMeses[$libroActivo->mes_libro] ?? 'Desconocido';
                                        $fechaInicio = Carbon::createFromDate($libroActivo->anio_libro, $libroActivo->mes_libro, 1)->startOfMonth();
                                        $fechaFin = Carbon::createFromDate($libroActivo->anio_libro, $libroActivo->mes_libro, 1)->endOfMonth();
                                    @endphp
                                    <span class="text-xs text-gray-500">

                                    </span>
                                @endif
                            </label>
                            <input type="date" name="fecha" required class="form-control" value="{{ old('fecha', $fechaDefault) }}"
                                min="{{ $fechaMin }}" max="{{ $fechaMax }}" />
                        </div>

                        <!-- Detalle y concepto -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Detalle</label>
                                <input type="text" name="detalle" class="form-control" placeholder="Ej: Servicio dominical" required
                                    value="{{ old('detalle') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Concepto</label>
                                <input type="text" name="concepto" class="form-control" placeholder="Ej: Diezmo y Ofrenda general"
                                    required value="{{ old('concepto') }}">
                            </div>
                        </div>

                        <!-- Lista de diezmos -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Diezmos</label>
                            <div id="diezmoList"></div>
                            <button type="button" onclick="agregarDiezmo()" class="mt-2 text-sm text-blue-600 hover:underline">
                                ➕ Agregar persona
                            </button>
                        </div>

                        <!-- Total de diezmos -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Total Diezmos</label>
                            <input type="text" id="totalDiezmos" class="form-control bg-gray-100" readonly>
                        </div>

                        <!-- Ofrenda -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Valor Ofrenda</label>
                            <input type="number" name="ofrenda" id="ofrenda" class="form-control" value="{{ old('ofrenda', 0) }}"
                                min="0">
                        </div>

                        <!-- Total general -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700">Total General</label>
                            <input type="text" id="totalGeneral" class="form-control bg-gray-100" readonly>
                        </div>

                        <!-- Botón guardar -->
                        <div class="text-center">
                            <button type="submit"
                                class="bg-[#198754] hover:bg-[#146c43] text-white font-bold py-2 px-6 rounded-full transition">
                                Guardar todo
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>

        <!-- Datalist de miembros -->
        <datalist id="lista-miembros">
            @foreach($miembros as $miembro)
                <option value="{{ $miembro }}">
            @endforeach
        </datalist>

        <!-- Scripts -->
        <script>
            function agregarDiezmo() {
                const container = document.getElementById('diezmoList');

                const div = document.createElement('div');
                div.classList.add('grid', 'grid-cols-2', 'gap-4', 'mb-2');

                div.innerHTML = `
                                                    <input type="text" name="nombres[]" list="lista-miembros" placeholder="Nombre del miembro" class="form-control" required>
                                                    <input type="number" name="valores[]" placeholder="Valor" class="form-control valor-diezmo" required min="0">
                                                `;

                container.appendChild(div);
                actualizarTotales();
            }

            document.addEventListener('input', actualizarTotales);

            function actualizarTotales() {
                let totalDiezmos = 0;
                document.querySelectorAll('.valor-diezmo').forEach(el => {
                    totalDiezmos += parseInt(el.value) || 0;
                });

                const ofrenda = parseInt(document.getElementById('ofrenda').value) || 0;
                const total = totalDiezmos + ofrenda;

                document.getElementById('totalDiezmos').value = totalDiezmos.toLocaleString();
                document.getElementById('totalGeneral').value = total.toLocaleString();
            }

            window.addEventListener('DOMContentLoaded', agregarDiezmo);
        </script>
    @else
        <div class="container py-5 text-center">
            <h2 class="text-red-600 font-bold">🚫 No tienes permisos para acceder a este módulo.</h2>
        </div>
    @endif
    <script>
        // 💵 Solo billetes
        const billetes = [100000, 50000, 20000, 10000, 5000, 2000];

        function abrirCalculadora() {
            document.getElementById('modalCalculadora').classList.remove('hidden');
            document.getElementById('modalCalculadora').classList.add('flex');
            generarInputs();
        }

        function cerrarCalculadora() {
            document.getElementById('modalCalculadora').classList.add('hidden');
        }

        function generarInputs() {
            const container = document.getElementById('contadorBilletes');
            container.innerHTML = '';

            // 🔹 Billetes
            billetes.forEach(valor => {
                container.innerHTML += `
                            <div class="flex justify-between items-center">
                                <label class="text-sm font-medium">$ ${valor.toLocaleString()}</label>
                                <input type="number" min="0" value="0"
                                    onchange="calcularTotal()"
                                    class="w-20 border rounded p-1 text-right input-billete"
                                    data-valor="${valor}">
                            </div>
                        `;
            });

            // 🔹 Campo único para monedas
            container.innerHTML += `
                        <hr class="my-2">
                        <div class="flex justify-between items-center">
                            <label class="text-sm font-medium">Monedas (Total)</label>
                            <input type="number" min="0" value="0"
                                onchange="calcularTotal()"
                                class="w-24 border rounded p-1 text-right"
                                id="totalMonedas">
                        </div>
                    `;
        }

        function calcularTotal() {
            let total = 0;

            // 🔹 Sumar billetes
            document.querySelectorAll('.input-billete').forEach(input => {
                total += (parseInt(input.value) || 0) * parseInt(input.dataset.valor);
            });

            // 🔹 Sumar monedas (valor directo)
            const monedas = parseInt(document.getElementById('totalMonedas').value) || 0;
            total += monedas;

            document.getElementById('totalContado').innerText = total.toLocaleString();
        }

        function pasarAOfrenda() {
            const total = document.getElementById('totalContado').innerText.replace(/\./g, '');
            document.getElementById('ofrenda').value = total;
            actualizarTotales();
            cerrarCalculadora();
        }
    </script>


    <!-- Calculadora 💰 Botón flotante -->
    <button type="button" onclick="abrirCalculadora()"
        class="fixed bottom-6 right-6 bg-green-600 hover:bg-green-700 text-white w-14 h-14 rounded-full shadow-lg text-xl flex items-center justify-center z-50">
        💵
    </button>

    <!-- 💰 Modal Contador de Billetes -->
    <div id="modalCalculadora" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

        <div class="bg-white rounded-lg shadow-xl w-96 p-5 relative">

            <button onclick="cerrarCalculadora()" class="absolute top-2 right-3 text-gray-500 hover:text-red-600 text-lg">
                ✖
            </button>

            <h3 class="text-center font-bold text-green-700 mb-4">
                Contador de Billetes y Monedas
            </h3>

            <div id="contadorBilletes" class="space-y-2"></div>

            <hr class="my-3">

            <div class="text-lg font-bold text-center">
                Total: $ <span id="totalContado">0</span>
            </div>

            <div class="text-center mt-4">
                <button onclick="pasarAOfrenda()" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

@endsection