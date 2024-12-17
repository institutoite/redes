<div>
    <h3 class="text-lg font-bold mb-4">Lista de Días</h3>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border px-4 py-2 text-left">Día</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dias as $dia)
                <tr>
                    <td class="border px-4 py-2">{{ $dia->dia }}</td>
                </tr>
            @empty
                <tr>
                    <td class="border px-4 py-2 text-center text-gray-500" colspan="1">
                        No hay días registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
