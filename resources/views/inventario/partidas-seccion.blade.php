<!-- Sección Partidas -->
<div class="mb-10">
    <div class="flex justify-between items-center mb-2">
        <h3 class="text-xl font-semibold text-red-600 dark:text-red-300">Partidas</h3>
        <button onclick="document.getElementById('formAgregarPartida').classList.toggle('hidden')"
            class="bg-green-500 hover:bg-green-600 text-white font-medium px-4 py-2 rounded flex items-center gap-2 transition">
            <i class="fas fa-plus"></i>
            <span>Agregar Partida</span>
        </button>
    </div>

    <div id="formAgregarPartida" class="hidden mb-6">
        <form method="POST" action="{{ route('partidas.store') }}"
            class="bg-gray-100 p-4 rounded-lg shadow-md dark:bg-gray-700" onsubmit="return validarFormularioPartida()">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Clave (5 dígitos)</label>
                <input type="text" name="clave" id="claveInput" maxlength="5" minlength="5" pattern="\d{5}"
                    required
                    class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
                    value="{{ old('clave') }}" oninput="verificarClave()">
                <p id="claveExiste" class="text-red-500 text-sm mt-1 hidden"><i class="fas fa-exclamation-triangle"></i>
                    Esta clave ya existe.</p>
                @error('clave')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-200">Nombre</label>
                <input type="text" name="nombre" id="nombreInput" required
       style="text-transform: uppercase"
       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:ring-red-700 focus:border-red-700 dark:bg-gray-800 dark:border-gray-600 dark:text-white"
       value="{{ old('nombre') }}">
       <p id="errorNombre" class="text-red-500 text-sm mt-1 hidden">
        El nombre debe contener solo letras y al menos 3 caracteres.
    </p>
                @error('nombre')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('formAgregarPartida').classList.add('hidden')"
                class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition">
                    <i class="fas fa-times-circle"></i>
                    <span>Cancelar</span>
                </button>
                <button type="submit" id="guardarBtn"
                    class="bg-red-700 hover:bg-red-800 text-white font-bold py-2 px-4 rounded-lg flex items-center gap-2 transition disabled:opacity-50 disabled:cursor-not-allowed">
                    <i class="fas fa-save"></i>
                    <span>Guardar</span>
                </button>
            </div>
        </form>
    </div>

    @include('inventario.partidas-tabla')
</div>

<script>
    const clavesExistentes = @json($partidas->pluck('clave'));

    function verificarClave() {
        const clave = document.getElementById('claveInput').value;
        const alerta = document.getElementById('claveExiste');
        const btnGuardar = document.getElementById('guardarBtn');

        if (clavesExistentes.includes(clave)) {
            alerta.classList.remove('hidden');
            btnGuardar.disabled = true;
        } else {
            alerta.classList.add('hidden');
            btnGuardar.disabled = false;
        }
    }

    function validarFormularioPartida() {
        const nombreInput = document.getElementById('nombreInput');
        const nombre = nombreInput.value.trim();
        const errorNombre = document.getElementById('errorNombre');

        // Regex permite letras y espacios, mínimo 3 caracteres
        const regex = /^[a-zA-ZÁÉÍÓÚáéíóúÑñüÜ\s]{3,}$/;


        if (!regex.test(nombre)) {
            errorNombre.classList.remove('hidden');
            nombreInput.focus();
            return false;
        }

        errorNombre.classList.add('hidden');
        return true;
    }
</script>
