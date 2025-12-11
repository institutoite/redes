<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dias;

class ProgramacionSeeder extends Seeder
{
    public function run(): void
    {
        // Usar el producto existente 'Programación' (ProductSeeder)
        $product = Product::where('nombre', 'Programación')->first();
        if (!$product) {
            $catId = \DB::table('categories')->where('description', 'PROGRAMACION')->value('id')
                ?? \DB::table('categories')->where('description', 'INSTITUTOS')->value('id')
                ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'Programación',
            ], [
                'imagen' => 'programacion.jpg',
                'price' => 250.00,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades
        $modalidadesData = [
            ['modalidad' => 'Tres Veces por Semana', 'inversion' => 300.00, 'descripcion' => 'Fundamentos y práctica guiada 3x/semana en C++, Java, JS y Python.', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Lunes a Viernes', 'inversion' => 380.00, 'descripcion' => 'Entrenamiento diario: ejercicios, retos y revisión de código.', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Solo Sábados', 'inversion' => 220.00, 'descripcion' => 'Sesión extendida de laboratorio y proyecto por lenguaje.', 'dias' => ['Sábado']],
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
            // Días
            $diaIds = [];
            foreach ($md['dias'] as $diaNombre) {
                $dia = Dias::firstOrCreate(['dia' => $diaNombre]);
                $diaIds[] = $dia->id;
            }
            $m->dias()->syncWithoutDetaching($diaIds);
        }

        // Ventajas
        foreach ($modalidades as $m) {
            foreach ([
                ['ventaja' => 'Pensamiento algorítmico', 'detalle' => 'Resolver problemas paso a paso con estructuras y funciones.'],
                ['ventaja' => 'Multilenguaje', 'detalle' => 'Aplicar conceptos base en C++, Java, JavaScript y Python.'],
                ['ventaja' => 'Estructuras y árboles', 'detalle' => 'Dominar listas, pilas, colas y árboles (recorridos e inserción).'],
            ] as $v) {
                Ventaja::firstOrCreate(['modalidad_id' => $m->id, 'ventaja' => $v['ventaja']], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales
        $materiales = [
            ['nombre' => 'VS Code / IDEs', 'descripcion' => 'Editor con extensiones útiles y/o IDE por lenguaje.'],
            ['nombre' => 'Compiladores/Intérpretes', 'descripcion' => 'g++ (C++), JDK (Java), Node.js (JS), Python 3 (Python).'],
            ['nombre' => 'Git y Terminal', 'descripcion' => 'Control de versiones y ejecución de comandos.'],
            ['nombre' => 'Guías y retos', 'descripcion' => 'Ejercicios graduados y proyectos por lenguaje.'],
        ];
        $ordenM = 1;
        foreach ($materiales as $mat) {
            Material::firstOrCreate(['product_id' => $product->id, 'nombre' => $mat['nombre']], ['descripcion' => $mat['descripcion'], 'estado' => true, 'orden' => $ordenM++]);
        }

        // Contenidos: Numerados 1..13 con subtemas 1.x
        $contenidos = [
            // 1. Entorno y “Hola Mundo”
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1. Entorno y "Hola Mundo"', 'descripcion' => 'Panorama general del entorno y objetivo del primer programa.', 'orden' => 1],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.1 Instalación de herramientas (g++, JDK, Node.js, Python)', 'descripcion' => 'Instalar compiladores e intérpretes para C++, Java, JS y Python.', 'orden' => 2],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.2 Instalación y configuración de VS Code', 'descripcion' => 'Extensiones recomendadas, configuración básica y depuración inicial.', 'orden' => 3],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.3 Instalación y uso básico de Git', 'descripcion' => 'Git init, commit, status y sincronización simple.', 'orden' => 4],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.4 Compilar y ejecutar programas en los 4 lenguajes', 'descripcion' => 'Comandos de compilación/ejecución para C++, Java, JS y Python.', 'orden' => 5],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.5 Primer programa "Hola Mundo" en cada lenguaje', 'descripcion' => 'Imprimir en consola el clásico Hola Mundo en cada stack.', 'orden' => 6],

            // 2. Secuencias y Entrada/Salida
            ['subnivel' => '2. Secuencias y Entrada/Salida', 'titulo' => '2. Secuencias y Entrada/Salida', 'descripcion' => 'Introducción a flujo de ejecución y E/S estándar.', 'orden' => 7],
            ['subnivel' => '2. Secuencias y Entrada/Salida', 'titulo' => '2.1 Flujo de ejecución', 'descripcion' => 'Orden de instrucciones y efectos laterales.', 'orden' => 8],
            ['subnivel' => '2. Secuencias y Entrada/Salida', 'titulo' => '2.2 Operadores (aritméticos, relacionales, lógicos)', 'descripcion' => 'Precedencia y asociatividad; cortocircuito lógico.', 'orden' => 9],
            ['subnivel' => '2. Secuencias y Entrada/Salida', 'titulo' => '2.3 Entrada y salida estándar', 'descripcion' => 'Lectura/escritura en consola por lenguaje.', 'orden' => 10],
            ['subnivel' => '2. Secuencias y Entrada/Salida', 'titulo' => '2.4 Evaluación de expresiones', 'descripcion' => 'Evaluación paso a paso de expresiones y conversiones.', 'orden' => 11],
            ['subnivel' => '2. Secuencias y Entrada/Salida', 'titulo' => '2.5 Ejercicios prácticos', 'descripcion' => 'Retos guiados para afianzar E/S y operadores.', 'orden' => 12],

            // 3. Condicionales
            ['subnivel' => '3. Condicionales', 'titulo' => '3. Condicionales', 'descripcion' => 'Decisiones con if/else y estructuras alternativas.', 'orden' => 13],
            ['subnivel' => '3. Condicionales', 'titulo' => '3.1 Estructura if y if/else', 'descripcion' => 'Bloques condicionales y anidados.', 'orden' => 14],
            ['subnivel' => '3. Condicionales', 'titulo' => '3.2 Estructura switch', 'descripcion' => 'Cuando usar switch; casos y default.', 'orden' => 15],
            ['subnivel' => '3. Condicionales', 'titulo' => '3.3 Comparaciones y operadores booleanos', 'descripcion' => 'Igualdad, desigualdad y operadores lógicos.', 'orden' => 16],
            ['subnivel' => '3. Condicionales', 'titulo' => '3.4 Casos prácticos en cada lenguaje', 'descripcion' => 'Ejemplos equivalentes en C++, Java, JS y Python.', 'orden' => 17],

            // 4. Ciclos
            ['subnivel' => '4. Ciclos', 'titulo' => '4. Ciclos', 'descripcion' => 'Iteración estructurada y control de bucles.', 'orden' => 18],
            ['subnivel' => '4. Ciclos', 'titulo' => '4.1 Ciclo for', 'descripcion' => 'Uso típico y variantes por lenguaje.', 'orden' => 19],
            ['subnivel' => '4. Ciclos', 'titulo' => '4.2 Ciclo while', 'descripcion' => 'Iteración basada en condición.', 'orden' => 20],
            ['subnivel' => '4. Ciclos', 'titulo' => '4.3 Ciclo do-while', 'descripcion' => 'Evaluación al final y casos de uso.', 'orden' => 21],
            ['subnivel' => '4. Ciclos', 'titulo' => '4.4 Control de bucles (break, continue)', 'descripcion' => 'Interrupción y salto dentro del ciclo.', 'orden' => 22],
            ['subnivel' => '4. Ciclos', 'titulo' => '4.5 Patrones comunes de iteración', 'descripcion' => 'Acumuladores, contadores y búsquedas.', 'orden' => 23],

            // 5. Cadenas
            ['subnivel' => '5. Cadenas', 'titulo' => '5. Cadenas', 'descripcion' => 'Manipulación de texto y diferencias entre lenguajes.', 'orden' => 24],
            ['subnivel' => '5. Cadenas', 'titulo' => '5.1 Concatenación y manipulación básica', 'descripcion' => 'Operaciones comunes: longitud, concatenar y formatear.', 'orden' => 25],
            ['subnivel' => '5. Cadenas', 'titulo' => '5.2 Búsqueda y extracción de subcadenas', 'descripcion' => 'indexOf/find, substrings y slicing.', 'orden' => 26],
            ['subnivel' => '5. Cadenas', 'titulo' => '5.3 Parsing y análisis de texto', 'descripcion' => 'Split, tokenización y conversión de tipos.', 'orden' => 27],
            ['subnivel' => '5. Cadenas', 'titulo' => '5.4 Diferencias entre lenguajes', 'descripcion' => 'String vs char[], inmutabilidad y métodos.', 'orden' => 28],

            // 6. Vectores / Arrays
            ['subnivel' => '6. Vectores / Arrays', 'titulo' => '6. Vectores / Arrays', 'descripcion' => 'Estructuras indexadas y uso eficiente.', 'orden' => 29],
            ['subnivel' => '6. Vectores / Arrays', 'titulo' => '6.1 Declaración y creación', 'descripcion' => 'Arreglos estáticos y dinámicos según lenguaje.', 'orden' => 30],
            ['subnivel' => '6. Vectores / Arrays', 'titulo' => '6.2 Acceso y recorrido', 'descripcion' => 'Indices, límites y patrones de recorrido.', 'orden' => 31],
            ['subnivel' => '6. Vectores / Arrays', 'titulo' => '6.3 Inserción y eliminación de elementos', 'descripcion' => 'Shift/unshift/splice; push/pop; conceptos en C++/Java.', 'orden' => 32],
            ['subnivel' => '6. Vectores / Arrays', 'titulo' => '6.4 Ordenamientos básicos (nociones)', 'descripcion' => 'Burbuja/selección/inserción (visión general).', 'orden' => 33],
            ['subnivel' => '6. Vectores / Arrays', 'titulo' => '6.5 Buenas prácticas', 'descripcion' => 'Complejidad, memoria y legibilidad.', 'orden' => 34],

            // 7. Matrices
            ['subnivel' => '7. Matrices', 'titulo' => '7. Matrices', 'descripcion' => 'Arreglos bidimensionales y operaciones típicas.', 'orden' => 35],
            ['subnivel' => '7. Matrices', 'titulo' => '7.1 Arreglos bidimensionales', 'descripcion' => 'Declaración y memoria; listas de listas.', 'orden' => 36],
            ['subnivel' => '7. Matrices', 'titulo' => '7.2 Recorrido por filas y columnas', 'descripcion' => 'Patrones de acceso eficientes.', 'orden' => 37],
            ['subnivel' => '7. Matrices', 'titulo' => '7.3 Suma, promedio, máximos/mínimos', 'descripcion' => 'Agregación y estadísticas básicas.', 'orden' => 38],
            ['subnivel' => '7. Matrices', 'titulo' => '7.4 Transposición de matrices', 'descripcion' => 'Intercambio de filas/columnas y costo.', 'orden' => 39],
            ['subnivel' => '7. Matrices', 'titulo' => '7.5 Casos reales (tableros, mapas, tablas)', 'descripcion' => 'Aplicaciones prácticas de matrices.', 'orden' => 40],

            // 8. Funciones y Procedimientos
            ['subnivel' => '8. Funciones y Procedimientos', 'titulo' => '8. Funciones y Procedimientos', 'descripcion' => 'Modularidad y reutilización de código.', 'orden' => 41],
            ['subnivel' => '8. Funciones y Procedimientos', 'titulo' => '8.1 Definición y llamada', 'descripcion' => 'Firma, nombre y llamada de funciones.', 'orden' => 42],
            ['subnivel' => '8. Funciones y Procedimientos', 'titulo' => '8.2 Parámetros y retorno', 'descripcion' => 'Por valor/referencia; tipos de retorno.', 'orden' => 43],
            ['subnivel' => '8. Funciones y Procedimientos', 'titulo' => '8.3 Alcance de variables (scope)', 'descripcion' => 'Local/global; sombras y tiempos de vida.', 'orden' => 44],
            ['subnivel' => '8. Funciones y Procedimientos', 'titulo' => '8.4 Sobrecarga y variaciones por lenguaje', 'descripcion' => 'Overloading en C++/Java, alternativas en JS/Python.', 'orden' => 45],
            ['subnivel' => '8. Funciones y Procedimientos', 'titulo' => '8.5 Buen diseño de funciones', 'descripcion' => 'Nombres claros, pureza y pruebas.', 'orden' => 46],

            // 9. Listas
            ['subnivel' => '9. Listas', 'titulo' => '9. Listas', 'descripcion' => 'Estructuras enlazadas y casos de uso.', 'orden' => 47],
            ['subnivel' => '9. Listas', 'titulo' => '9.1 Concepto de nodo', 'descripcion' => 'Estructura Nodo: dato y punteros.', 'orden' => 48],
            ['subnivel' => '9. Listas', 'titulo' => '9.2 Inserción en lista simple', 'descripcion' => 'Insertar al inicio/final y en medio.', 'orden' => 49],
            ['subnivel' => '9. Listas', 'titulo' => '9.3 Eliminación de nodos', 'descripcion' => 'Eliminar por valor/posición y manejo de punteros.', 'orden' => 50],
            ['subnivel' => '9. Listas', 'titulo' => '9.4 Recorrido y búsqueda', 'descripcion' => 'Iteración y búsqueda lineal.', 'orden' => 51],
            ['subnivel' => '9. Listas', 'titulo' => '9.5 Implementación manual y usos comunes', 'descripcion' => 'Construcción desde cero y aplicaciones.', 'orden' => 52],

            // 10. Pilas (Stack)
            ['subnivel' => '10. Pilas (Stack)', 'titulo' => '10. Pilas (Stack)', 'descripcion' => 'Modelo LIFO y operaciones principales.', 'orden' => 53],
            ['subnivel' => '10. Pilas (Stack)', 'titulo' => '10.1 Estructura LIFO', 'descripcion' => 'Concepto y representación en memoria.', 'orden' => 54],
            ['subnivel' => '10. Pilas (Stack)', 'titulo' => '10.2 Operaciones: push, pop, peek', 'descripcion' => 'Definición y complejidad de operaciones.', 'orden' => 55],
            ['subnivel' => '10. Pilas (Stack)', 'titulo' => '10.3 Aplicaciones reales', 'descripcion' => 'Deshacer (CTRL+Z), historial de navegación, evaluación de expresiones.', 'orden' => 56],

            // 11. Colas (Queue)
            ['subnivel' => '11. Colas (Queue)', 'titulo' => '11. Colas (Queue)', 'descripcion' => 'Modelo FIFO y variaciones.', 'orden' => 57],
            ['subnivel' => '11. Colas (Queue)', 'titulo' => '11.1 Estructura FIFO', 'descripcion' => 'Concepto y representación en memoria.', 'orden' => 58],
            ['subnivel' => '11. Colas (Queue)', 'titulo' => '11.2 Operaciones: enqueue, dequeue', 'descripcion' => 'Definición y complejidad de operaciones.', 'orden' => 59],
            ['subnivel' => '11. Colas (Queue)', 'titulo' => '11.3 Colas circulares (noción)', 'descripcion' => 'Idea de cola circular y ventajas.', 'orden' => 60],
            ['subnivel' => '11. Colas (Queue)', 'titulo' => '11.4 Introducción a colas con prioridad', 'descripcion' => 'Concepto de prioridad y casos de uso.', 'orden' => 61],

            // 12. Recorridos
            ['subnivel' => '12. Recorridos', 'titulo' => '12. Recorridos', 'descripcion' => 'Recorrido en estructuras lineales y jerárquicas.', 'orden' => 62],
            ['subnivel' => '12. Recorridos', 'titulo' => '12.1 Recorridos lineales (arrays, listas)', 'descripcion' => 'Iteración y patrones en estructuras lineales.', 'orden' => 63],
            ['subnivel' => '12. Recorridos', 'titulo' => '12.2 Recorridos jerárquicos (árboles)', 'descripcion' => 'Recorridos pre/in/postorden y niveles.', 'orden' => 64],
            ['subnivel' => '12. Recorridos', 'titulo' => '12.3 Introducción a BFS', 'descripcion' => 'Búsqueda en anchura: cola y niveles.', 'orden' => 65],
            ['subnivel' => '12. Recorridos', 'titulo' => '12.4 Introducción a DFS', 'descripcion' => 'Búsqueda en profundidad: pila/recursión.', 'orden' => 66],

            // 13. Programación Orientada a Objetos (POO)
            ['subnivel' => '13. POO', 'titulo' => '13. Programación Orientada a Objetos (POO)', 'descripcion' => 'Visión general y objetivos de POO.', 'orden' => 67],
            ['subnivel' => '13. POO', 'titulo' => '13.1 Conceptos básicos: clases y objetos', 'descripcion' => 'Definición de clase, objeto y estado/comportamiento.', 'orden' => 68],
            ['subnivel' => '13. POO', 'titulo' => '13.2 Encapsulación (atributos y métodos)', 'descripcion' => 'Ocultamiento de datos y acceso controlado.', 'orden' => 69],
            ['subnivel' => '13. POO', 'titulo' => '13.3 Constructores y destructores', 'descripcion' => 'Inicialización y liberación de recursos por lenguaje.', 'orden' => 70],
            ['subnivel' => '13. POO', 'titulo' => '13.4 Introducción a herencia', 'descripcion' => 'Relación IS-A y reutilización.', 'orden' => 71],
            ['subnivel' => '13. POO', 'titulo' => '13.5 Introducción al polimorfismo', 'descripcion' => 'Sobrescritura y despacho dinámico (noción).', 'orden' => 72],
            ['subnivel' => '13. POO', 'titulo' => '13.6 Aplicación práctica simple', 'descripcion' => 'Mini proyecto orientado a objetos en el lenguaje elegido.', 'orden' => 73],
        ];

        foreach ($contenidos as $c) {
            Contenido::firstOrCreate([
                'product_id' => $product->id,
                'titulo' => $c['titulo'],
            ], [
                'subnivel' => $c['subnivel'],
                'descripcion' => $c['descripcion'],
                'orden' => $c['orden'],
                'estado' => true,
            ]);
        }
    }
}
