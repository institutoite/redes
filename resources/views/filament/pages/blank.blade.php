@php /** @var \App\Filament\Resources\ProductResource\Pages\ManageProductModalidades $this */ @endphp
<x-filament::page>
    <div class="text-2xl font-semibold mb-4">
        {{ $this->getTitle() }}
    </div>

    {{ $this->table }}
</x-filament::page>
