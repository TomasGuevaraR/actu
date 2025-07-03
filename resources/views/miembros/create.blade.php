{{-- resources/views/miembros/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow-md">
    <h2 class="text-2xl font-bold text-[#0166b3] mb-6">Agregar Nuevo Miembro</h2>

    <form action="{{ route('miembros.store') }}" method="POST" id="form-miembro">
        @csrf

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="font-bold text-red-600">Nombres *</label>
                <input type="text" name="nombres" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label class="font-bold text-red-600">Apellidos *</label>
                <input type="text" name="apellidos" class="w-full border rounded p-2" required>
            </div>

            <div class="col-span-2">
                <label class="font-bold text-red-600">Número de Identificación *</label>
                <input type="text" name="numero_identificacion" class="w-full border rounded p-2" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" class="w-full border rounded p-2">
            </div>

            <div>
                <label>Teléfono</label>
                <input type="text" name="telefono" class="w-full border rounded p-2">
            </div>

            <div>
                <label>Fecha de Nacimiento</label>
                <input type="date" name="fecha_nacimiento" id="fecha_nacimiento" class="w-full border rounded p-2">
            </div>

            <div>
                <label>Edad</label>
                <input type="number" name="edad" id="edad" class="w-full border rounded p-2" readonly>
            </div>

            <div class="col-span-2">
                <label>Dirección</label>
                <input type="text" name="direccion" class="w-full border rounded p-2">
            </div>

            <div class="col-span-2">
                <label>Barrio</label>
                <input type="text" name="barrio" class="w-full border rounded p-2">
            </div>

            <div class="col-span-2">
                <label>Estado</label>
                <select name="estado" class="w-full border rounded p-2">
                    <option value="activo" selected>Activo</option>
                    <option value="inactivo">Inactivo</option>
                    <option value="borrado">Borrado</option>
                    <option value="con excusa permanente">Con excusa permanente</option>
                    <option value="ausente">Ausente</option>
                </select>
            </div>
        </div>

        <div class="mt-6">
            <button type="submit" class="bg-[#0166b3] hover:bg-[#014a82] text-white font-bold py-2 px-4 rounded-full">
                Guardar Miembro
            </button>
        </div>
    </form>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const form = document.getElementById('form-miembro');
    const fechaNacimiento = document.getElementById('fecha_nacimiento');
    const campoEdad = document.getElementById('edad');

    // Calcular edad automáticamente
    fechaNacimiento.addEventListener('change', () => {
        const fecha = new Date(fechaNacimiento.value);
        const hoy = new Date();
        let edad = hoy.getFullYear() - fecha.getFullYear();
        const mes = hoy.getMonth() - fecha.getMonth();

        if (mes < 0 || (mes === 0 && hoy.getDate() < fecha.getDate())) {
            edad--;
        }

        campoEdad.value = edad > 0 ? edad : 0;
    });

    // Confirmación al enviar
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Deseas guardar este miembro?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#0166b3',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
@endsection
