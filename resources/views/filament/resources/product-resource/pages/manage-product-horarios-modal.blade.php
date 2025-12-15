@php /** @var \App\Models\Product $record */ @endphp
<div>
    <h2 class="text-lg font-bold mb-2">Horarios</h2>
    <form>
        @foreach(\App\Models\Horario::where('product_id', $record->id)->get() as $horario)
            <div class="flex items-center mb-2">
                <span class="mr-2">{{ $horario->horario }}</span>
                <label class="inline-flex items-center">
                    <input type="radio" name="estado_{{ $horario->id }}" value="1" @if($horario->estado) checked @endif wire:click="$wire.call('updateEstado', {{ $horario->id }}, 1)">
                    <span class="ml-1">Habilitado</span>
                </label>
                <label class="inline-flex items-center ml-4">
                    <input type="radio" name="estado_{{ $horario->id }}" value="0" @if(!$horario->estado) checked @endif wire:click="$wire.call('updateEstado', {{ $horario->id }}, 0)">
                    <span class="ml-1">Deshabilitado</span>
                </label>
            </div>
        @endforeach
    </form>
</div>
