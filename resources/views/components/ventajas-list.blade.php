<div>
    <h3 class="text-lg font-bold mb-4">Lista de Ventajas</h3>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-left">Ventaja</th>
                <th class="border px-4 py-2 text-left">Detalle</th>
                <th class="border px-4 py-2 text-left">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($ventajas as $ventaja)
                <tr>
                    <td class="border px-4 py-2">{{ $ventaja->ventaja }}</td>
                    <td class="border px-4 py-2">{{ $ventaja->detalle ?? 'N/A' }}</td>
                    <td class="border px-4 py-2">
                        @if ($ventaja->estado)
                            <span class="text-green-600">Activo</span>
                        @else
                            <span class="text-red-600">Inactivo</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="border px-4 py-2 text-center text-gray-500" colspan="3">
                        No hay ventajas registradas.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
