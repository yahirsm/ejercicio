<x-app-layout>
    @include('layouts.partials.admin.navigation')
    @include('layouts.partials.admin.sidebar')

    <div class="sm:ml-64 p-4 pt-20">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-3xl font-bold text-red-700 dark:text-red-400 mb-4">
                <i class="fas fa-user-plus mr-2"></i> Agregar Nuevo Usuario
            </h2>

            @if ($errors->any())
                <div class="bg-red-500 text-white p-2 mb-4 rounded shadow-md dark:bg-red-700">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('usuarios.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nombre</label>
                    <input type="text" name="nombre" id="nombre" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="primer_apellido" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Primer Apellido</label>
                    <input type="text" name="primer_apellido" id="primer_apellido" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="segundo_apellido" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Segundo Apellido</label>
                    <input type="text" name="segundo_apellido" id="segundo_apellido" 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="numero_empleado" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Número de Empleado</label>
                    <input type="number" name="numero_empleado" id="numero_empleado" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="rfc" class="block text-sm font-medium text-gray-700 dark:text-gray-300">RFC</label>
                    <input type="text" name="rfc" id="rfc" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                </div>
                
                <div>
                    <label for="plaza" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Plaza</label>
                    <select name="plaza" id="plaza" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option value="Confianza">Confianza</option>
                        <option value="Base">Base</option>
                        <option value="Eventual">Eventual</option>
                        <option value="INSABI">INSABI</option>
                    </select>
                </div>
                
                <div>
                    <label for="servicio_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Servicio Actual</label>
                    <select name="servicio_id" id="servicio_id" required 
                        class="w-full p-2 border border-gray-300 rounded dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        @foreach ($servicios as $servicio)
                            <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex justify-end space-x-2">
                    <a href="{{ route('usuarios.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-medium px-4 py-2 rounded">
                        Cancelar
                    </a>
                    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-medium px-4 py-2 rounded">
                        Guardar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
