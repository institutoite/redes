<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class InteligenciaArtificialUsuarioSeeder extends Seeder
{
    public function run(): void
    {
        // Producto: "Inteligencia Artificial para Usuarios"
        $product = Product::where('nombre', 'Inteligencia Artificial para Usuarios')->first();
        if (!$product) {
            $catId = \DB::table('categories')->where('description', 'COMPUTACION')->value('id')
                ?? \DB::table('categories')->where('description', 'INSTITUTOS')->value('id')
                ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'Inteligencia Artificial para Usuarios',
            ], [
                'imagen' => 'ia_usuarios.jpg',
                'price' => 220.00,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades
        $modalidadesData = [
            ['modalidad' => 'Tres Veces por Semana', 'inversion' => 260.00, 'descripcion' => 'Uso práctico de IA conversacional y generativa 3x/semana, sin programación.', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Lunes a Viernes', 'inversion' => 320.00, 'descripcion' => 'Entrenamiento diario con proyectos: redacción, imagen, audio y productividad.', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Solo Sábados', 'inversion' => 220.00, 'descripcion' => 'Sesión extendida: guía de prompts y proyecto personal asistido.', 'dias' => ['Sábado']],
        ];

        $modalidades = [];
        foreach ($modalidadesData as $md) {
            $m = Modalidad::firstOrCreate([
                'product_id' => $product->id,
                'modalidad' => $md['modalidad'],
            ], [
                'descripcion' => $md['descripcion'],
                'inversion' => $md['inversion'],
                'estado' => true,
            ]);
            $modalidades[] = $m;
            $diaIds = [];
            foreach ($md['dias'] as $diaNombre) {
                $dia = Dias::firstOrCreate(['dia' => $diaNombre]);
                $diaIds[] = $dia->id;
            }
            $m->dias()->syncWithoutDetaching($diaIds);
        }

        // Ventajas por modalidad
        foreach ($modalidades as $m) {
            foreach ([
                ['ventaja' => 'Aprendizaje sin código', 'detalle' => 'Enfoque 100% práctico para usuarios que vienen de buscadores tradicionales.'],
                ['ventaja' => 'Prompts efectivos', 'detalle' => 'Estructuras claras para obtener respuestas útiles, verificables y seguras.'],
                ['ventaja' => 'Productividad real', 'detalle' => 'Aplicaciones cotidianas: redacción, resúmenes, imagen, audio y organización.'],
            ] as $v) {
                Ventaja::firstOrCreate(['modalidad_id' => $m->id, 'ventaja' => $v['ventaja']], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales
        $materiales = [
            ['nombre' => 'Dispositivo con navegador moderno', 'descripcion' => 'PC o móvil con conexión estable a internet.'],
            ['nombre' => 'Cuenta en plataforma de IA', 'descripcion' => 'Crear una cuenta en un asistente conversacional de tu preferencia.'],
            ['nombre' => 'Extensiones del navegador (opcional)', 'descripcion' => 'Captura de pantalla, dictado de voz, lectura en voz alta.'],
            ['nombre' => 'Plantillas de prompts', 'descripcion' => 'Guía impresa/digital con estructuras y ejemplos.'],
            ['nombre' => 'Cuaderno de prácticas', 'descripcion' => 'Registro de prompts efectivos y resultados.'],
        ];
        $ordenM = 1;
        foreach ($materiales as $mat) {
            Material::firstOrCreate(['product_id' => $product->id, 'nombre' => $mat['nombre']], ['descripcion' => $mat['descripcion'], 'estado' => true, 'orden' => $ordenM++]);
        }

        // Contenidos numerados 1..13 con subtemas 1.x (uso de IA y prompts)
        $c = [];
        $o = 1;

        // 1. Qué es la IA hoy y primeras pruebas
        $c[] = ['subnivel' => '1. Qué es la IA', 'titulo' => '1. Qué es la IA hoy y primeras pruebas', 'descripcion' => 'De buscadores a asistentes: qué puede y qué no puede hacer.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Qué es la IA', 'titulo' => '1.1 Buscador vs asistente conversacional', 'descripcion' => 'Diferencias: enlaces vs respuestas, diálogo y seguimiento.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Qué es la IA', 'titulo' => '1.2 Tipos de IA para usuarios', 'descripcion' => 'Texto, imagen, audio, video y asistentes multimodales.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Qué es la IA', 'titulo' => '1.3 Limitaciones, sesgos y alucinaciones', 'descripcion' => 'Cómo reconocer errores y mantener criterio propio.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Qué es la IA', 'titulo' => '1.4 Registro y acceso', 'descripcion' => 'Crear cuenta y ajustar preferencias básicas.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Qué es la IA', 'titulo' => '1.5 Tu primera conversación', 'descripcion' => 'Enviar tu primer prompt y analizar la respuesta.', 'orden' => $o++];

        // 2. Cuentas, privacidad y seguridad
        $c[] = ['subnivel' => '2. Privacidad y seguridad', 'titulo' => '2. Cuentas, privacidad y seguridad', 'descripcion' => 'Buenas prácticas al compartir información con IA.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Privacidad y seguridad', 'titulo' => '2.1 Datos personales (PII)', 'descripcion' => 'Qué nunca compartir y cómo anonimizar.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Privacidad y seguridad', 'titulo' => '2.2 Historial y controles', 'descripcion' => 'Revisar, exportar y borrar conversaciones.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Privacidad y seguridad', 'titulo' => '2.3 Derechos de autor y uso responsable', 'descripcion' => 'Citas, licencias y atribución responsable.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Privacidad y seguridad', 'titulo' => '2.4 Seguridad básica', 'descripcion' => 'Contraseñas, MFA y phishing relacionado a IA.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Privacidad y seguridad', 'titulo' => '2.5 Evaluar fuentes', 'descripcion' => 'Cómo pedir referencias y verificar datos.', 'orden' => $o++];

        // 3. Prompting básico
        $c[] = ['subnivel' => '3. Prompting básico', 'titulo' => '3. Prompting básico', 'descripcion' => 'Cómo pedir: claro, específico y con objetivo.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Prompting básico', 'titulo' => '3.1 Rol, contexto y objetivo', 'descripcion' => 'Define el rol del asistente, el contexto y lo que esperas.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Prompting básico', 'titulo' => '3.2 Formato y tono', 'descripcion' => 'Longitud, estilo y audiencia; tabla/lista/resumen.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Prompting básico', 'titulo' => '3.3 Ejemplos y contraejemplos', 'descripcion' => 'Demuestra lo que quieres (y lo que no).', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Prompting básico', 'titulo' => '3.4 Restricciones y criterios', 'descripcion' => 'Límites de tiempo, presupuesto, fuentes y calidad.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Prompting básico', 'titulo' => '3.5 Iteración', 'descripcion' => 'Cómo refinar hasta obtener un resultado útil.', 'orden' => $o++];

        // 4. Prompting intermedio
        $c[] = ['subnivel' => '4. Prompting intermedio', 'titulo' => '4. Prompting intermedio', 'descripcion' => 'Estrategias para tareas compuestas.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Prompting intermedio', 'titulo' => '4.1 Desglosar en pasos', 'descripcion' => 'Pide soluciones paso a paso con chequeos.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Prompting intermedio', 'titulo' => '4.2 Pedir que piense antes de responder', 'descripcion' => 'Fomentar razonamiento y explicaciones.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Prompting intermedio', 'titulo' => '4.3 Pedir crítica y mejoras', 'descripcion' => 'Solicitar revisión y sugerencias de calidad.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Prompting intermedio', 'titulo' => '4.4 Pruebas A/B de prompts', 'descripcion' => 'Comparar variantes y elegir la mejor.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Prompting intermedio', 'titulo' => '4.5 Plantillas reutilizables', 'descripcion' => 'Estandarizar y guardar tus mejores prompts.', 'orden' => $o++];

        // 5. Búsqueda y verificación con IA
        $c[] = ['subnivel' => '5. Búsqueda y verificación', 'titulo' => '5. Búsqueda y verificación con IA', 'descripcion' => 'Cómo usar IA para investigar mejor.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Búsqueda y verificación', 'titulo' => '5.1 Encontrar información', 'descripcion' => 'Consultas efectivas y cuándo abrir enlaces.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Búsqueda y verificación', 'titulo' => '5.2 Comparar fuentes', 'descripcion' => 'Tablas comparativas y pros/cons.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Búsqueda y verificación', 'titulo' => '5.3 Pedir referencias', 'descripcion' => 'Solicitar enlaces confiables y citas.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Búsqueda y verificación', 'titulo' => '5.4 Detectar inconsistencias', 'descripcion' => 'Cruzar datos y pedir aclaraciones.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Búsqueda y verificación', 'titulo' => '5.5 Síntesis final', 'descripcion' => 'Resumen verificable y accionable.', 'orden' => $o++];

        // 6. Texto: redacción y corrección
        $c[] = ['subnivel' => '6. Texto', 'titulo' => '6. Texto: redacción y corrección', 'descripcion' => 'Emails, informes, resúmenes y guías.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Texto', 'titulo' => '6.1 Resumir y reescribir', 'descripcion' => 'Resúmenes por longitud y tono deseado.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Texto', 'titulo' => '6.2 Corrección y estilo', 'descripcion' => 'Ortografía, gramática y claridad.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Texto', 'titulo' => '6.3 Emails y mensajes', 'descripcion' => 'Estructuras claras y llamadas a la acción.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Texto', 'titulo' => '6.4 Guiones y borradores', 'descripcion' => 'Estructurar ideas y secciones.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Texto', 'titulo' => '6.5 Traducción y adaptación', 'descripcion' => 'Cambiar idioma y adaptar a audiencia.', 'orden' => $o++];

        // 7. Imágenes: ideas y edición ligera
        $c[] = ['subnivel' => '7. Imágenes', 'titulo' => '7. Imágenes: ideas y edición ligera', 'descripcion' => 'Describir estilos, variaciones y ajustes básicos.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Imágenes', 'titulo' => '7.1 Describir una imagen deseada', 'descripcion' => 'Tema, estilo, iluminación y composición.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Imágenes', 'titulo' => '7.2 Variaciones y refinamientos', 'descripcion' => 'Iterar con cambios graduales.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Imágenes', 'titulo' => '7.3 Edición ligera', 'descripcion' => 'Enfocar, recortar y ajustar color (noción).', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Imágenes', 'titulo' => '7.4 Consideraciones éticas', 'descripcion' => 'Usos apropiados y derechos de imagen.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Imágenes', 'titulo' => '7.5 Entregables prácticos', 'descripcion' => 'Flyer simple o visual para redes.', 'orden' => $o++];

        // 8. Audio y video (usuario)
        $c[] = ['subnivel' => '8. Audio y video', 'titulo' => '8. Audio y video (usuario)', 'descripcion' => 'Transcribir, resumir y crear guiones.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Audio y video', 'titulo' => '8.1 Transcripción', 'descripcion' => 'Pasar audio a texto para edición.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Audio y video', 'titulo' => '8.2 Resumen de videos/lives', 'descripcion' => 'Ideas clave y tareas accionables.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Audio y video', 'titulo' => '8.3 Guiones y escaletas', 'descripcion' => 'Estructurar un guion breve.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Audio y video', 'titulo' => '8.4 Subtítulos y descripciones', 'descripcion' => 'Textos para accesibilidad y SEO.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Audio y video', 'titulo' => '8.5 Derechos y atribución', 'descripcion' => 'Buenas prácticas de uso.', 'orden' => $o++];

        // 9. Organización y tareas personales
        $c[] = ['subnivel' => '9. Organización', 'titulo' => '9. Organización y tareas personales', 'descripcion' => 'Planificación con IA para el día a día.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Organización', 'titulo' => '9.1 Listas y recordatorios', 'descripcion' => 'Listas priorizadas y horarios sugeridos.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Organización', 'titulo' => '9.2 Planes y rutinas', 'descripcion' => 'Hábitos y planes semanales.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Organización', 'titulo' => '9.3 Formularios y resúmenes', 'descripcion' => 'Convertir notas en formatos útiles.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Organización', 'titulo' => '9.4 Minutas y acuerdos', 'descripcion' => 'Estructurar reuniones y siguientes pasos.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Organización', 'titulo' => '9.5 Hojas de cálculo (noción)', 'descripcion' => 'Proponer fórmulas y tablas simples.', 'orden' => $o++];

        // 10. Aprendizaje con IA
        $c[] = ['subnivel' => '10. Aprendizaje', 'titulo' => '10. Aprendizaje con IA', 'descripcion' => 'Estudiar temas nuevos de forma guiada.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Aprendizaje', 'titulo' => '10.1 Tutor conversacional', 'descripcion' => 'Resolver dudas con ejemplos claros.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Aprendizaje', 'titulo' => '10.2 Planes de estudio', 'descripcion' => 'Rutas con objetivos y materiales.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Aprendizaje', 'titulo' => '10.3 Prácticas guiadas', 'descripcion' => 'Ejercicios con retroalimentación inmediata.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Aprendizaje', 'titulo' => '10.4 Preparación de exámenes', 'descripcion' => 'Banco de preguntas y simulacros.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Aprendizaje', 'titulo' => '10.5 Evaluar progreso', 'descripcion' => 'Rubricas simples y siguientes pasos.', 'orden' => $o++];

        // 11. Multimodal y móviles
        $c[] = ['subnivel' => '11. Multimodal', 'titulo' => '11. Multimodal y móviles', 'descripcion' => 'Usar imágenes/voz y el teléfono.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Multimodal', 'titulo' => '11.1 Enviar imágenes', 'descripcion' => 'Pedir descripciones o instrucciones sobre fotos.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Multimodal', 'titulo' => '11.2 Voz a texto', 'descripcion' => 'Dictar y editar rápidamente.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Multimodal', 'titulo' => '11.3 Texto a voz (lectura)', 'descripcion' => 'Escuchar respuestas o resúmenes.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Multimodal', 'titulo' => '11.4 Uso en el teléfono', 'descripcion' => 'Atajos y mejores prácticas móviles.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Multimodal', 'titulo' => '11.5 Accesibilidad', 'descripcion' => 'Apoyos para lectura y escritura.', 'orden' => $o++];

        // 12. Ética y buenas prácticas
        $c[] = ['subnivel' => '12. Ética', 'titulo' => '12. Ética y buenas prácticas', 'descripcion' => 'Uso responsable y consciente.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Ética', 'titulo' => '12.1 Sesgos y respeto', 'descripcion' => 'Lenguaje inclusivo y no discriminatorio.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Ética', 'titulo' => '12.2 Contenido sensible', 'descripcion' => 'Evitar usos dañinos o desinformación.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Ética', 'titulo' => '12.3 Citar y atribuir', 'descripcion' => 'Reconocer fuentes y autoría.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Ética', 'titulo' => '12.4 Evaluar impacto', 'descripcion' => 'Efectos en trabajo y sociedad.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Ética', 'titulo' => '12.5 Límites saludables', 'descripcion' => 'Saber cuándo no usar IA.', 'orden' => $o++];

        // 13. Proyecto final (usuario)
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13. Proyecto final (usuario)', 'descripcion' => 'Crear tu “Asistente Personal” con prompts y guía de uso.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.1 Definir objetivo personal', 'descripcion' => 'Ej.: estudio, trabajo, emprendimiento o vida diaria.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.2 Diseñar plantillas de prompts', 'descripcion' => 'Tres plantillas reutilizables con variables.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.3 Probar y refinar', 'descripcion' => 'Iterar hasta obtener resultados consistentes.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.4 Entregable', 'descripcion' => 'Documento/guía con ejemplos y buenas prácticas.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.5 Presentación', 'descripcion' => 'Demostración breve y feedback.', 'orden' => $o++];

        foreach ($c as $row) {
            Contenido::firstOrCreate([
                'product_id' => $product->id,
                'titulo' => $row['titulo'],
            ], [
                'subnivel' => $row['subnivel'],
                'descripcion' => $row['descripcion'],
                'orden' => $row['orden'],
                'estado' => true,
            ]);
        }
    }
}
