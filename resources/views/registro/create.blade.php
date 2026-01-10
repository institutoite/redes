        <style>
            .brand-input {
                border: 1.5px solid var(--brand-teal);
                transition: border-color 0.2s;
            }
            .brand-input:focus {
                border-color: var(--brand-blue);
                outline: none;
                box-shadow: 0 0 0 1.5px var(--brand-blue33, rgba(55,95,122,0.2));
            }
            .ck.ck-editor__main > .ck-editor__editable {
                min-height: 120px;
                border: 1.5px solid var(--brand-teal);
                border-radius: 0.375rem;
            }
            .ck.ck-editor__main > .ck-editor__editable:focus {
                border-color: var(--brand-blue);
                box-shadow: 0 0 0 1.5px var(--brand-blue33, rgba(55,95,122,0.2));
            }
        </style>
    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
@extends('layouts.base')

@section('content')
<div class="container mx-auto max-w-lg p-6 brand-card">
    <h2 class="text-2xl font-bold mb-4 brand-title">Registro de Estudiante</h2>
    <form action="{{ route('registro.store') }}" method="POST" enctype="multipart/form-data">
        <div class="mb-4">
              <input type="hidden" name="modalidad_id" id="modalidad_id" value="{{ old('modalidad_id', isset($modalidad_id) ? $modalidad_id : request('modalidad_id')) }}">
        </div>
        @error('modalidad_id') <span class="text-red-500 text-xs block mb-2">{{ $message }}</span> @enderror
        @csrf
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nombre completo del estudiante</label>
            <input type="text" name="nombre_estudiante" class="w-full rounded p-2 brand-input" value="{{ old('nombre_estudiante') }}">
            @error('nombre_estudiante') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" class="w-full rounded p-2 brand-input" value="{{ old('fecha_nacimiento') }}">
            @error('fecha_nacimiento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Requerimiento del estudiante</label>
            <textarea id="requerimiento" name="requerimiento" class="w-full rounded p-2 brand-input">{{ old('requerimiento', $requerimiento ?? '') }}</textarea>
            @error('requerimiento') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            <script>
            document.addEventListener('DOMContentLoaded', function() {
                ClassicEditor.create(document.querySelector('#requerimiento'), {
                    language: 'es',
                    toolbar: [
                        'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo'
                    ]
                }).catch(error => { console.error(error); });
            });
            </script>
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">¿Cómo nos conoció?</label>
            <select name="como_nos_conocio" class="w-full rounded p-2 brand-input">
                <option value="">Seleccione</option>
                <option value="facebook" @if(old('como_nos_conocio')=='facebook') selected @endif>Facebook</option>
                <option value="instagram" @if(old('como_nos_conocio')=='instagram') selected @endif>Instagram</option>
                <option value="web" @if(old('como_nos_conocio')=='web') selected @endif>Web</option>
                <option value="recomendacion" @if(old('como_nos_conocio')=='recomendacion') selected @endif>Recomendación</option>
                <option value="otro" @if(old('como_nos_conocio')=='otro') selected @endif>Otro</option>
            </select>
            @error('como_nos_conocio') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Nombre del apoderado (padre o madre)</label>
            <input type="text" name="nombre_apoderado" class="w-full rounded p-2 brand-input" value="{{ old('nombre_apoderado') }}">
            @error('nombre_apoderado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Número de teléfono del apoderado</label>
            <input type="tel" name="telefono_apoderado" class="w-full rounded p-2 brand-input" value="{{ old('telefono_apoderado') }}" autocomplete="tel">
            @error('telefono_apoderado') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="flex justify-center">
            <button type="submit" class="brand-btn">Registrar</button>
        </div>
    </form>
</div>
@endsection
