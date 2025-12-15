<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dia;

class CreacionContenidoSeeder extends Seeder
{
    public function run(): void
    {
        // Usar el producto existente 'Creación de Contenido'
        $product = Product::where('nombre', 'Creación de Contenido')->first();
        if (!$product) {
            $catId = \DB::table('categories')->where('description', 'COMPUTACION')->value('id')
                ?? \DB::table('categories')->where('description', 'INSTITUTOS')->value('id')
                ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'Creación de Contenido',
            ], [
                'imagen' => 'creacion_contenido.jpg',
                'price' => 550,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades
        $modalidadesData = [
            ['modalidad' => 'Tres Veces por Semana', 'inversion' => 550, 'descripcion' => 'Entrenamiento práctico en texto, imagen y video corto (3x/semana).', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Lunes a Viernes', 'inversion' => 1000, 'descripcion' => 'Plan intensivo: calendario, producción y publicación diaria.', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Solo Sábados', 'inversion' => 400, 'descripcion' => 'Sesión extendida de laboratorio con proyecto para redes.', 'dias' => ['Sábado']],
        ];

        $modalidades = [];
        $ordenModalidad = Modalidad::where('product_id', $product->id)->max('orden') ?? 0;
        foreach ($modalidadesData as $md) {
            $ordenModalidad++;
            $m = Modalidad::firstOrCreate([
                'product_id' => $product->id,
                'modalidad' => $md['modalidad'],
            ], [
                'descripcion' => $md['descripcion'],
                'inversion' => $md['inversion'],
                'estado' => true,
                'orden' => $ordenModalidad,
            ]);
            $modalidades[] = $m;
            // Días
            $diaIds = [];
            foreach ($md['dias'] as $diaNombre) {
                $dia = Dia::firstOrCreate(['dias' => $diaNombre]);
                $diaIds[] = $dia->id;
            }
            $m->dias()->syncWithoutDetaching($diaIds);
        }

        // Ventajas por modalidad
        foreach ($modalidades as $m) {
            foreach ([
                ['ventaja' => 'Calendario claro', 'detalle' => 'Plan de publicaciones con objetivos y métricas.'],
                ['ventaja' => 'Producción ágil', 'detalle' => 'Texto, imagen y video corto con herramientas simples.'],
                ['ventaja' => 'Seguridad y cumplimiento', 'detalle' => 'Buenas prácticas de cuentas, privacidad y derechos.'],
            ] as $v) {
                Ventaja::firstOrCreate(['modalidad_id' => $m->id, 'ventaja' => $v['ventaja']], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales
        $materiales = [
            ['nombre' => 'Smartphone con cámara', 'descripcion' => 'Dispositivo móvil para grabación y fotografía.'],
            ['nombre' => 'PC con navegador', 'descripcion' => 'Gestión de cuentas y edición ligera.'],
            ['nombre' => 'Editor de video (CapCut)', 'descripcion' => 'Edición simple de clips para redes.'],
            ['nombre' => 'Editor gráfico (Canva/Snapseed)', 'descripcion' => 'Diseños y retoques básicos.'],
            ['nombre' => 'Micrófono y luz (opcional)', 'descripcion' => 'Mejorar audio e iluminación.'],
            ['nombre' => 'Cuentas en redes sociales', 'descripcion' => 'Perfiles en Instagram, Facebook, TikTok, YouTube (según objetivo).'],
            ['nombre' => 'Plantillas y calendario', 'descripcion' => 'Hojas de ruta y templates de copy/hashtags.'],
            ['nombre' => 'Guía de seguridad', 'descripcion' => 'Contraseñas, MFA y prevención de phishing.' ],
        ];
        $ordenM = 1;
        foreach ($materiales as $mat) {
            Material::firstOrCreate([
                'product_id' => $product->id,
                'nombre' => $mat['nombre'],
            ], [
                'descripcion' => $mat['descripcion'],
                'estado' => true,
                'orden' => $ordenM++,
            ]);
        }

        // Contenidos numerados 1..13 con subtemas 1.x
        $c = [];
        $o = 1;

        // 1. Entorno y cuentas
        $c[] = ['subnivel' => '1. Entorno y cuentas', 'titulo' => '1. Entorno y apertura de cuentas', 'descripcion' => 'Configurar lo esencial para iniciar en redes.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y cuentas', 'titulo' => '1.1 Crear correo electrónico', 'descripcion' => 'Crear cuenta e integrar recuperación segura.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y cuentas', 'titulo' => '1.2 Seguridad básica', 'descripcion' => 'Contraseñas robustas y MFA en tus cuentas.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y cuentas', 'titulo' => '1.3 Perfiles en redes', 'descripcion' => 'Abrir cuentas en IG/FB/TikTok/YT y configurar perfil.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y cuentas', 'titulo' => '1.4 Preferencias y notificaciones', 'descripcion' => 'Ajustes útiles para producción y seguridad.', 'orden' => $o++];
        $c[] = ['subnivel' => '1. Entorno y cuentas', 'titulo' => '1.5 Guía de recuperación', 'descripcion' => 'Opciones ante pérdida de acceso.', 'orden' => $o++];

        // 2. Identidad y objetivos
        $c[] = ['subnivel' => '2. Identidad y objetivos', 'titulo' => '2. Identidad y objetivos', 'descripcion' => 'Base de marca y metas claras.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Identidad y objetivos', 'titulo' => '2.1 Marca personal', 'descripcion' => 'Valores, promesa y diferencia.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Identidad y objetivos', 'titulo' => '2.2 Audiencia', 'descripcion' => 'Quién es tu público y qué necesita.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Identidad y objetivos', 'titulo' => '2.3 Pilares de contenido', 'descripcion' => 'Temas centrales y ejemplos.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Identidad y objetivos', 'titulo' => '2.4 Voz y tono', 'descripcion' => 'Estilo consistente y cercano.', 'orden' => $o++];
        $c[] = ['subnivel' => '2. Identidad y objetivos', 'titulo' => '2.5 Ejemplo práctico', 'descripcion' => 'Caso guiado de marca personal.', 'orden' => $o++];

        // 3. Planificación y calendario
        $c[] = ['subnivel' => '3. Planificación', 'titulo' => '3. Planificación y calendario', 'descripcion' => 'Organiza publicaciones y recursos.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Planificación', 'titulo' => '3.1 Herramientas de calendario', 'descripcion' => 'Plantillas y apps recomendadas.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Planificación', 'titulo' => '3.2 Frecuencia por plataforma', 'descripcion' => 'Ritmo sugerido para IG/FB/TikTok/YT.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Planificación', 'titulo' => '3.3 Temario y series', 'descripcion' => 'Temas recurrentes y mini-series.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Planificación', 'titulo' => '3.4 Efemérides y campañas', 'descripcion' => 'Integrar fechas clave y lanzamientos.', 'orden' => $o++];
        $c[] = ['subnivel' => '3. Planificación', 'titulo' => '3.5 Hoja de ruta', 'descripcion' => 'Roadmap de 4 semanas.', 'orden' => $o++];

        // 4. Redacción (copywriting)
        $c[] = ['subnivel' => '4. Redacción', 'titulo' => '4. Redacción (copywriting)', 'descripcion' => 'Escribir para captar y convertir.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Redacción', 'titulo' => '4.1 Titulares y hooks', 'descripcion' => 'Abrir con valor y claridad.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Redacción', 'titulo' => '4.2 Llamadas a la acción', 'descripcion' => 'CTA efectivos y medibles.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Redacción', 'titulo' => '4.3 Hashtags y SEO social', 'descripcion' => 'Etiquetas útiles y alcance.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Redacción', 'titulo' => '4.4 Adaptación multiplataforma', 'descripcion' => 'Ajustes por formato y público.', 'orden' => $o++];
        $c[] = ['subnivel' => '4. Redacción', 'titulo' => '4.5 Corrección y estilo', 'descripcion' => 'Ortografía y legibilidad.', 'orden' => $o++];

        // 5. Imágenes
        $c[] = ['subnivel' => '5. Imágenes', 'titulo' => '5. Imágenes', 'descripcion' => 'Fotografía móvil y edición ligera.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Imágenes', 'titulo' => '5.1 Fotografía con móvil', 'descripcion' => 'Enfoque, estabilidad y encuadre.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Imágenes', 'titulo' => '5.2 Luz y composición', 'descripcion' => 'Reglas básicas y ejemplos.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Imágenes', 'titulo' => '5.3 Edición (Snapseed/Canva)', 'descripcion' => 'Ajustes rápidos y plantillas.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Imágenes', 'titulo' => '5.4 Formatos por plataforma', 'descripcion' => 'Tamaños, proporciones y calidad.', 'orden' => $o++];
        $c[] = ['subnivel' => '5. Imágenes', 'titulo' => '5.5 Derechos de imagen', 'descripcion' => 'Permisos y consideraciones legales.', 'orden' => $o++];

        // 6. Video corto
        $c[] = ['subnivel' => '6. Video corto', 'titulo' => '6. Video corto', 'descripcion' => 'Producción sencilla para Reels/Shorts.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Video corto', 'titulo' => '6.1 Guion breve', 'descripcion' => 'Estructura de 15–60 segundos.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Video corto', 'titulo' => '6.2 Grabación con móvil', 'descripcion' => 'Planos, estabilidad y audio.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Video corto', 'titulo' => '6.3 Edición con CapCut', 'descripcion' => 'Cortes, texto y transiciones básicas.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Video corto', 'titulo' => '6.4 Subtítulos y portadas', 'descripcion' => 'Accesibilidad y branding.', 'orden' => $o++];
        $c[] = ['subnivel' => '6. Video corto', 'titulo' => '6.5 Publicación', 'descripcion' => 'Exportar, subir y ajustes finales.', 'orden' => $o++];

        // 7. Audio
        $c[] = ['subnivel' => '7. Audio', 'titulo' => '7. Audio', 'descripcion' => 'Grabación limpia y voz en off.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Audio', 'titulo' => '7.1 Grabación limpia', 'descripcion' => 'Entorno, micrófono y niveles.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Audio', 'titulo' => '7.2 Música libre de derechos', 'descripcion' => 'Bancos y licencias básicas.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Audio', 'titulo' => '7.3 Voz en off', 'descripcion' => 'Guion y ritmo natural.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Audio', 'titulo' => '7.4 Podcast corto (noción)', 'descripcion' => 'Formato breve y distribución.', 'orden' => $o++];
        $c[] = ['subnivel' => '7. Audio', 'titulo' => '7.5 Adaptación a piezas', 'descripcion' => 'Reutilizar audio en video/texto.', 'orden' => $o++];

        // 8. Publicación y programación
        $c[] = ['subnivel' => '8. Publicación', 'titulo' => '8. Publicación y programación', 'descripcion' => 'Organizar y automatizar publicaciones.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Publicación', 'titulo' => '8.1 Mejores horarios', 'descripcion' => 'Rangos sugeridos por plataforma.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Publicación', 'titulo' => '8.2 Programación (Suite/Planner)', 'descripcion' => 'Herramientas para calendarizar.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Publicación', 'titulo' => '8.3 Crosspost y adaptaciones', 'descripcion' => 'Optimizar el reuso de piezas.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Publicación', 'titulo' => '8.4 Enlaces UTM', 'descripcion' => 'Medir campañas y fuentes.', 'orden' => $o++];
        $c[] = ['subnivel' => '8. Publicación', 'titulo' => '8.5 Checklist pre-publicación', 'descripcion' => 'Control de calidad antes de subir.', 'orden' => $o++];

        // 9. Interacción y comunidad
        $c[] = ['subnivel' => '9. Comunidad', 'titulo' => '9. Interacción y comunidad', 'descripcion' => 'Construir relaciones sanas y útiles.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Comunidad', 'titulo' => '9.1 Respuestas y tiempos', 'descripcion' => 'Buenas prácticas al responder.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Comunidad', 'titulo' => '9.2 Moderación', 'descripcion' => 'Eliminar spam y gestionar comentarios.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Comunidad', 'titulo' => '9.3 Dinámicas y retos', 'descripcion' => 'Ideas para participación activa.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Comunidad', 'titulo' => '9.4 Colaboraciones', 'descripcion' => 'Con otros creadores o marcas.', 'orden' => $o++];
        $c[] = ['subnivel' => '9. Comunidad', 'titulo' => '9.5 Manejo de crisis', 'descripcion' => 'Guía básica ante situaciones difíciles.', 'orden' => $o++];

        // 10. Seguridad y cumplimiento
        $c[] = ['subnivel' => '10. Seguridad', 'titulo' => '10. Seguridad y cumplimiento', 'descripcion' => 'Proteger cuentas y respetar normas.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Seguridad', 'titulo' => '10.1 Contraseñas/MFA', 'descripcion' => 'Gestores y autenticación de dos factores.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Seguridad', 'titulo' => '10.2 Phishing y estafas', 'descripcion' => 'Cómo reconocer y evitar fraudes.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Seguridad', 'titulo' => '10.3 Derechos de autor', 'descripcion' => 'Uso de contenido ajeno con respeto.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Seguridad', 'titulo' => '10.4 Contenido de terceros', 'descripcion' => 'Citas, licencias y atribuciones.', 'orden' => $o++];
        $c[] = ['subnivel' => '10. Seguridad', 'titulo' => '10.5 Privacidad y menores', 'descripcion' => 'Protecciones y permisos adecuados.', 'orden' => $o++];

        // 11. Métricas y mejora
        $c[] = ['subnivel' => '11. Métricas', 'titulo' => '11. Métricas y mejora', 'descripcion' => 'Leer datos y tomar decisiones.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Métricas', 'titulo' => '11.1 Alcance e impresiones', 'descripcion' => 'Qué significa y cómo influir.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Métricas', 'titulo' => '11.2 Engagement', 'descripcion' => 'Interacciones y tasas clave.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Métricas', 'titulo' => '11.3 Pruebas A/B', 'descripcion' => 'Comparar variantes y decidir.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Métricas', 'titulo' => '11.4 Análisis por plataforma', 'descripcion' => 'Herramientas nativas y lectura.', 'orden' => $o++];
        $c[] = ['subnivel' => '11. Métricas', 'titulo' => '11.5 Iteración', 'descripcion' => 'Mejoras continuas y aprendizaje.', 'orden' => $o++];

        // 12. Monetización básica
        $c[] = ['subnivel' => '12. Monetización', 'titulo' => '12. Monetización básica', 'descripcion' => 'Vías simples para obtener ingresos.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Monetización', 'titulo' => '12.1 Requisitos por plataforma', 'descripcion' => 'Normas y elegibilidad general.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Monetización', 'titulo' => '12.2 Afiliados', 'descripcion' => 'Promoción con enlaces y comisión.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Monetización', 'titulo' => '12.3 Patrocinios', 'descripcion' => 'Cómo buscar y negociar apoyos.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Monetización', 'titulo' => '12.4 Productos digitales', 'descripcion' => 'Ideas básicas y validación.', 'orden' => $o++];
        $c[] = ['subnivel' => '12. Monetización', 'titulo' => '12.5 Transparencia', 'descripcion' => 'Divulgación y ética ante la audiencia.', 'orden' => $o++];

        // 13. Proyecto final
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13. Proyecto final', 'descripcion' => 'Aplicar todo en un caso propio.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.1 Plan de 4 semanas', 'descripcion' => 'Calendario con objetivos y piezas.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.2 Kit de plantillas', 'descripcion' => 'Copies, hashtags y checklist.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.3 Producción de 5 piezas', 'descripcion' => '2 imágenes, 2 videos y 1 texto largo.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.4 Programación y publicación', 'descripcion' => 'Subir con horarios y enlaces.', 'orden' => $o++];
        $c[] = ['subnivel' => '13. Proyecto', 'titulo' => '13.5 Presentación y resultados', 'descripcion' => 'Informe breve y aprendizaje clave.', 'orden' => $o++];

        foreach ($c as $row) {
            $maxOrden = Contenido::where('product_id', $product->id)->max('orden') ?? 0;
            Contenido::firstOrCreate([
                'product_id' => $product->id,
                'titulo' => $row['titulo'],
            ], [
                'subnivel' => $row['subnivel'],
                'descripcion' => $row['descripcion'],
                'orden' => $maxOrden + 1,
                'estado' => true,
            ]);
        }
    }
}
