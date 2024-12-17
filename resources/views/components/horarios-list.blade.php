<div>
    <h3 class="text-lg font-bold mb-4">Lista de Horarios</h3>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-left">Horario</th>
                <th class="border px-4 py-2 text-left">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($horarios as $horario)
                <tr>
                    <td class="border px-4 py-2">{{ $horario->horario }}</td>
                    <td class="border px-4 py-2">
                        @if ($horario->estado)
                            <span class="text-green-600">Activo</span>
                        @else
                            <span class="text-red-600">Inactivo</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="border px-4 py-2 text-center text-gray-500">
                        No hay horarios registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
