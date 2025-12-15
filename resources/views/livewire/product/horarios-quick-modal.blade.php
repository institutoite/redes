<div class="p-4">
    <h2 class="text-xl font-bold mb-4 text-blue-700 flex items-center">
        <svg class="w-6 h-6 mr-2 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        Gestión rápida de horarios
    </h2>
    @if(session('success'))
        <div class="mb-3 p-2 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
    @endif
    <div class="space-y-3">
        @forelse($horarios as $horario)
            <div class="flex items-center justify-between bg-gray-50 rounded p-2 shadow-sm">
                <div class="font-medium text-gray-700 flex-1">{{ $horario['horario'] }}</div>
                <div class="flex items-center gap-4">
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" class="form-radio text-green-600" name="estado_{{ $horario['id'] }}" value="1" @if($horario['estado']) checked @endif wire:click="updateEstado({{ $horario['id'] }}, 1)">
                        <span class="ml-1 text-green-700">Habilitado</span>
                    </label>
                    <label class="inline-flex items-center cursor-pointer">
                        <input type="radio" class="form-radio text-red-600" name="estado_{{ $horario['id'] }}" value="0" @if(!$horario['estado']) checked @endif wire:click="updateEstado({{ $horario['id'] }}, 0)">
                        <span class="ml-1 text-red-700">Deshabilitado</span>
                    </label>
                </div>
            </div>
        @empty
            <div class="text-gray-500">No hay horarios registrados para este producto.</div>
        @endforelse
    </div>
</div>
