<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Modalidad;
use App\Models\Ventaja;
use App\Models\Material;
use App\Models\Contenido;
use App\Models\Dia;

class InteligenciaArtificialSeeder extends Seeder
{
    public function run(): void
    {
        // Asegurar producto 'Inteligencia Artificial'
        $product = Product::where('nombre', 'Inteligencia Artificial')->first();
        if (!$product) {
            $catId = \DB::table('categories')->where('description', 'COMPUTACION')->value('id')
                ?? \DB::table('categories')->where('description', 'INSTITUTOS')->value('id')
                ?? 1;
            $product = Product::firstOrCreate([
                'nombre' => 'Inteligencia Artificial',
            ], [
                'imagen' => 'ia.jpg',
                'price' => 300.00,
                'clicks' => 0,
                'categories_id' => $catId,
            ]);
        }

        // Modalidades (reutilizamos esquema común)
        $modalidadesData = [
            ['modalidad' => 'Tres Veces por Semana', 'inversion' => 320.00, 'descripcion' => 'Fundamentos de ML y práctica guiada 3x/semana con Python y librerías.', 'dias' => ['Lunes','Miércoles','Viernes']],
            ['modalidad' => 'Lunes a Viernes', 'inversion' => 400.00, 'descripcion' => 'Entrenamiento diario: datasets, modelos, evaluación y despliegue.', 'dias' => ['Lunes','Martes','Miércoles','Jueves','Viernes']],
            ['modalidad' => 'Solo Sábados', 'inversion' => 240.00, 'descripcion' => 'Sesión extendida de laboratorio con proyecto IA.', 'dias' => ['Sábado']],
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
            // Inserción en la tabla pivote product_modalidad_dia deshabilitada temporalmente
            // $diaIds = [];
            // foreach ($md['dias'] as $diaNombre) {
            //     $dia = Dia::firstOrCreate(['dias' => $diaNombre]);
            //     $diaIds[] = $dia->id;
            // }
            // $m->dias()->syncWithoutDetaching($diaIds);
        }

        // Ventajas por modalidad
        foreach ($modalidades as $m) {
            foreach ([
                ['ventaja' => 'Fundamentos sólidos de ML', 'detalle' => 'Desde datos y métricas hasta modelos supervisados y no supervisados.'],
                ['ventaja' => 'Herramientas modernas', 'detalle' => 'Práctica con NumPy, Pandas, scikit-learn y nociones de PyTorch/Keras.'],
                ['ventaja' => 'Proyecto aplicable', 'detalle' => 'Construye y despliega un modelo con una API básica y documentación.'],
            ] as $v) {
                Ventaja::firstOrCreate(['modalidad_id' => $m->id, 'ventaja' => $v['ventaja']], ['detalle' => $v['detalle'], 'estado' => true]);
            }
        }

        // Materiales
        $materiales = [
            ['nombre' => 'Python 3 y Anaconda (opcional)', 'descripcion' => 'Entorno de datos con paquetes científicos.'],
            ['nombre' => 'VS Code + Jupyter', 'descripcion' => 'Editor y notebooks para exploración y prototipos.'],
            ['nombre' => 'Librerías científicas', 'descripcion' => 'NumPy, Pandas, Matplotlib/Seaborn para EDA y visualización.'],
            ['nombre' => 'scikit-learn', 'descripcion' => 'Algoritmos clásicos de ML para clasificación y regresión.'],
            ['nombre' => 'PyTorch/Keras (nociones)', 'descripcion' => 'Redes neuronales básicas y transfer learning simple.'],
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
        $contenidos = [
            // 1. Entorno y “Hola Mundo”
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1. Entorno y "Hola Mundo"', 'descripcion' => 'Panorama del entorno de IA y primer script.', 'orden' => 1],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.1 Instalación de Python/Anaconda', 'descripcion' => 'Instalar Python 3 y/o Anaconda para ciencia de datos.', 'orden' => 2],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.2 Instalación y configuración de VS Code + Jupyter', 'descripcion' => 'Extensiones, notebooks y depuración básica.', 'orden' => 3],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.3 Instalación y uso básico de Git', 'descripcion' => 'Control de versiones para proyectos de IA.', 'orden' => 4],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.4 Ejecutar scripts y notebooks', 'descripcion' => 'Correr .py y .ipynb; buenas prácticas.', 'orden' => 5],
            ['subnivel' => '1. Entorno y Hola Mundo', 'titulo' => '1.5 Hola Mundo y operaciones básicas', 'descripcion' => 'Imprimir, variables y operaciones iniciales.', 'orden' => 6],

            // 2. Fundamentos de datos
            ['subnivel' => '2. Fundamentos de datos', 'titulo' => '2. Fundamentos de datos', 'descripcion' => 'Estructuras y manejo básico de datos.', 'orden' => 7],
            ['subnivel' => '2. Fundamentos de datos', 'titulo' => '2.1 Arreglos con NumPy', 'descripcion' => 'Creación, slicing y operaciones vectorizadas.', 'orden' => 8],
            ['subnivel' => '2. Fundamentos de datos', 'titulo' => '2.2 DataFrames con Pandas', 'descripcion' => 'Carga, selección y transformación de datos tabulares.', 'orden' => 9],
            ['subnivel' => '2. Fundamentos de datos', 'titulo' => '2.3 Carga de datos (CSV/JSON)', 'descripcion' => 'Lectura/escritura y formatos comunes.', 'orden' => 10],
            ['subnivel' => '2. Fundamentos de datos', 'titulo' => '2.4 Limpieza y EDA', 'descripcion' => 'Valores faltantes, outliers y visualización básica.', 'orden' => 11],
            ['subnivel' => '2. Fundamentos de datos', 'titulo' => '2.5 Ejercicios prácticos', 'descripcion' => 'Retos de transformación y análisis inicial.', 'orden' => 12],

            // 3. Matemática base
            ['subnivel' => '3. Matemática base', 'titulo' => '3. Matemática base', 'descripcion' => 'Álgebra lineal, probabilidad y cálculo necesarios.', 'orden' => 13],
            ['subnivel' => '3. Matemática base', 'titulo' => '3.1 Álgebra lineal', 'descripcion' => 'Vectores, matrices y operaciones fundamentales.', 'orden' => 14],
            ['subnivel' => '3. Matemática base', 'titulo' => '3.2 Probabilidad y estadística', 'descripcion' => 'Distribuciones, medidas y muestreo.', 'orden' => 15],
            ['subnivel' => '3. Matemática base', 'titulo' => '3.3 Derivadas y gradiente', 'descripcion' => 'Concepto de gradiente y optimización.', 'orden' => 16],
            ['subnivel' => '3. Matemática base', 'titulo' => '3.4 Normalización y escalado', 'descripcion' => 'Preprocesamiento numérico y sus efectos.', 'orden' => 17],
            ['subnivel' => '3. Matemática base', 'titulo' => '3.5 Ejercicios', 'descripcion' => 'Aplicar conceptos a datos reales pequeños.', 'orden' => 18],

            // 4. Aprendizaje supervisado
            ['subnivel' => '4. Aprendizaje supervisado', 'titulo' => '4. Aprendizaje supervisado', 'descripcion' => 'Modelos con etiquetas: regresión y clasificación.', 'orden' => 19],
            ['subnivel' => '4. Aprendizaje supervisado', 'titulo' => '4.1 Regresión lineal', 'descripcion' => 'Modelo básico y métricas de error.', 'orden' => 20],
            ['subnivel' => '4. Aprendizaje supervisado', 'titulo' => '4.2 Clasificación logística', 'descripcion' => 'Clasificación binaria y evaluación.', 'orden' => 21],
            ['subnivel' => '4. Aprendizaje supervisado', 'titulo' => '4.3 Árboles y Random Forests', 'descripcion' => 'Modelos interpretables y ensambles.', 'orden' => 22],
            ['subnivel' => '4. Aprendizaje supervisado', 'titulo' => '4.4 SVM (noción)', 'descripcion' => 'Márgenes y kernels a alto nivel.', 'orden' => 23],
            ['subnivel' => '4. Aprendizaje supervisado', 'titulo' => '4.5 Métricas', 'descripcion' => 'Accuracy, precision, recall y F1.', 'orden' => 24],

            // 5. Aprendizaje no supervisado
            ['subnivel' => '5. No supervisado', 'titulo' => '5. Aprendizaje no supervisado', 'descripcion' => 'Descubrir estructura sin etiquetas.', 'orden' => 25],
            ['subnivel' => '5. No supervisado', 'titulo' => '5.1 K-means', 'descripcion' => 'Centroides y asignaciones.', 'orden' => 26],
            ['subnivel' => '5. No supervisado', 'titulo' => '5.2 PCA', 'descripcion' => 'Reducción de dimensionalidad y componentes.', 'orden' => 27],
            ['subnivel' => '5. No supervisado', 'titulo' => '5.3 Clustering jerárquico', 'descripcion' => 'Vinculación y dendrogramas.', 'orden' => 28],
            ['subnivel' => '5. No supervisado', 'titulo' => '5.4 DBSCAN (noción)', 'descripcion' => 'Densidad y ruido.', 'orden' => 29],
            ['subnivel' => '5. No supervisado', 'titulo' => '5.5 Visualización de clusters', 'descripcion' => 'Proyección y gráficos.', 'orden' => 30],

            // 6. Ingeniería de características
            ['subnivel' => '6. Ingeniería de características', 'titulo' => '6. Ingeniería de características', 'descripcion' => 'Crear y seleccionar atributos útiles.', 'orden' => 31],
            ['subnivel' => '6. Ingeniería de características', 'titulo' => '6.1 Codificación categórica', 'descripcion' => 'One-hot, ordinal y target encoding (noción).', 'orden' => 32],
            ['subnivel' => '6. Ingeniería de características', 'titulo' => '6.2 Manejo de valores faltantes', 'descripcion' => 'Imputación simple y avanzada.', 'orden' => 33],
            ['subnivel' => '6. Ingeniería de características', 'titulo' => '6.3 Selección de características', 'descripcion' => 'Filtro, envoltura y métodos integrados.', 'orden' => 34],
            ['subnivel' => '6. Ingeniería de características', 'titulo' => '6.4 Transformaciones', 'descripcion' => 'Escalado, normalización y polinomios.', 'orden' => 35],
            ['subnivel' => '6. Ingeniería de características', 'titulo' => '6.5 Pipeline en scikit-learn', 'descripcion' => 'Encadenar pasos reproducibles.', 'orden' => 36],

            // 7. Evaluación y validación
            ['subnivel' => '7. Evaluación', 'titulo' => '7. Evaluación y validación', 'descripcion' => 'Estrategias para medir desempeño.', 'orden' => 37],
            ['subnivel' => '7. Evaluación', 'titulo' => '7.1 Train/Test split', 'descripcion' => 'Separar y controlar contaminación de datos.', 'orden' => 38],
            ['subnivel' => '7. Evaluación', 'titulo' => '7.2 Cross-validation', 'descripcion' => 'Validación cruzada y promedios.', 'orden' => 39],
            ['subnivel' => '7. Evaluación', 'titulo' => '7.3 Curvas ROC/PR', 'descripcion' => 'Umbrales y trade-offs.', 'orden' => 40],
            ['subnivel' => '7. Evaluación', 'titulo' => '7.4 Overfitting/Underfitting', 'descripcion' => 'Diagnóstico y mitigación.', 'orden' => 41],
            ['subnivel' => '7. Evaluación', 'titulo' => '7.5 Regularización', 'descripcion' => 'L1/L2 y efectos.', 'orden' => 42],

            // 8. Redes neuronales básicas
            ['subnivel' => '8. Redes neuronales', 'titulo' => '8. Redes neuronales básicas', 'descripcion' => 'Perceptrón y capas densas.', 'orden' => 43],
            ['subnivel' => '8. Redes neuronales', 'titulo' => '8.1 Perceptrón y MLP', 'descripcion' => 'Arquitecturas densas y funciones de pérdida.', 'orden' => 44],
            ['subnivel' => '8. Redes neuronales', 'titulo' => '8.2 Activaciones', 'descripcion' => 'ReLU, Sigmoid, Tanh y elección.', 'orden' => 45],
            ['subnivel' => '8. Redes neuronales', 'titulo' => '8.3 Backpropagation (noción)', 'descripcion' => 'Idea de gradientes y actualización.', 'orden' => 46],
            ['subnivel' => '8. Redes neuronales', 'titulo' => '8.4 Entrenamiento con Keras/PyTorch', 'descripcion' => 'Ciclos de entrenamiento y evaluación.', 'orden' => 47],
            ['subnivel' => '8. Redes neuronales', 'titulo' => '8.5 Ejercicios MNIST (noción)', 'descripcion' => 'Clasificación de dígitos simple.', 'orden' => 48],

            // 9. NLP básico
            ['subnivel' => '9. NLP', 'titulo' => '9. NLP básico', 'descripcion' => 'Procesamiento de lenguaje natural y clasificación.', 'orden' => 49],
            ['subnivel' => '9. NLP', 'titulo' => '9.1 Tokenización', 'descripcion' => 'Palabras, subpalabras y limpieza.', 'orden' => 50],
            ['subnivel' => '9. NLP', 'titulo' => '9.2 Bag of Words/TF-IDF', 'descripcion' => 'Representaciones clásicas.', 'orden' => 51],
            ['subnivel' => '9. NLP', 'titulo' => '9.3 Embeddings (noción)', 'descripcion' => 'Vectores semánticos preentrenados.', 'orden' => 52],
            ['subnivel' => '9. NLP', 'titulo' => '9.4 Clasificación de texto', 'descripcion' => 'Pipeline de clasificación y métricas.', 'orden' => 53],
            ['subnivel' => '9. NLP', 'titulo' => '9.5 Evaluación', 'descripcion' => 'Métricas y validación en NLP.', 'orden' => 54],

            // 10. Visión por computadora
            ['subnivel' => '10. Visión', 'titulo' => '10. Visión por computadora', 'descripcion' => 'Imagen, CNN y transferencia (noción).', 'orden' => 55],
            ['subnivel' => '10. Visión', 'titulo' => '10.1 Procesamiento de imágenes', 'descripcion' => 'Filtros y transformaciones básicas.', 'orden' => 56],
            ['subnivel' => '10. Visión', 'titulo' => '10.2 CNN (noción)', 'descripcion' => 'Convoluciones y arquitectura general.', 'orden' => 57],
            ['subnivel' => '10. Visión', 'titulo' => '10.3 Transfer learning', 'descripcion' => 'Reutilización de modelos preentrenados.', 'orden' => 58],
            ['subnivel' => '10. Visión', 'titulo' => '10.4 Clasificación de imágenes simple', 'descripcion' => 'Dataset pequeño y resultados.', 'orden' => 59],
            ['subnivel' => '10. Visión', 'titulo' => '10.5 Métricas', 'descripcion' => 'Accuracy y matrices de confusión.', 'orden' => 60],

            // 11. Producción y despliegue
            ['subnivel' => '11. Producción', 'titulo' => '11. Producción y despliegue', 'descripcion' => 'Llevar modelos a producción (nociones).', 'orden' => 61],
            ['subnivel' => '11. Producción', 'titulo' => '11.1 Guardar modelos (pickle/joblib)', 'descripcion' => 'Persistencia de modelos.', 'orden' => 62],
            ['subnivel' => '11. Producción', 'titulo' => '11.2 API con FastAPI/Flask', 'descripcion' => 'Servir predicciones vía HTTP.', 'orden' => 63],
            ['subnivel' => '11. Producción', 'titulo' => '11.3 Monitoreo', 'descripcion' => 'Seguimiento de métricas y drift.', 'orden' => 64],
            ['subnivel' => '11. Producción', 'titulo' => '11.4 Pruebas', 'descripcion' => 'Tests funcionales básicos.', 'orden' => 65],
            ['subnivel' => '11. Producción', 'titulo' => '11.5 Documentación', 'descripcion' => 'Guías y README del servicio.', 'orden' => 66],

            // 12. Ética y sesgos
            ['subnivel' => '12. Ética', 'titulo' => '12. Ética y sesgos', 'descripcion' => 'Privacidad, sesgo y equidad.', 'orden' => 67],
            ['subnivel' => '12. Ética', 'titulo' => '12.1 Privacidad', 'descripcion' => 'Datos sensibles y cumplimiento.', 'orden' => 68],
            ['subnivel' => '12. Ética', 'titulo' => '12.2 Sesgo y equidad', 'descripcion' => 'Detectar y mitigar sesgos.', 'orden' => 69],
            ['subnivel' => '12. Ética', 'titulo' => '12.3 Interpretabilidad', 'descripcion' => 'Explicar modelos (noción).', 'orden' => 70],
            ['subnivel' => '12. Ética', 'titulo' => '12.4 Seguridad', 'descripcion' => 'Ataques y robustez (noción).', 'orden' => 71],
            ['subnivel' => '12. Ética', 'titulo' => '12.5 Buenas prácticas', 'descripcion' => 'Guías para proyectos responsables.', 'orden' => 72],

            // 13. Proyecto final IA
            ['subnivel' => '13. Proyecto', 'titulo' => '13. Proyecto final IA', 'descripcion' => 'Integrar datos, modelos y despliegue.', 'orden' => 73],
            ['subnivel' => '13. Proyecto', 'titulo' => '13.1 Definición del problema', 'descripcion' => 'Objetivo, métrica y alcance.', 'orden' => 74],
            ['subnivel' => '13. Proyecto', 'titulo' => '13.2 Fuente de datos', 'descripcion' => 'Adquisición y preparación.', 'orden' => 75],
            ['subnivel' => '13. Proyecto', 'titulo' => '13.3 Entrenamiento y evaluación', 'descripcion' => 'Ciclo de experimentación.', 'orden' => 76],
            ['subnivel' => '13. Proyecto', 'titulo' => '13.4 Despliegue demo', 'descripcion' => 'Servicio sencillo para predicciones.', 'orden' => 77],
            ['subnivel' => '13. Proyecto', 'titulo' => '13.5 Presentación', 'descripcion' => 'Resultados y lecciones aprendidas.', 'orden' => 78],
        ];

        foreach ($contenidos as $c) {
            $maxOrden = Contenido::where('product_id', $product->id)->max('orden') ?? 0;
            Contenido::firstOrCreate([
                'product_id' => $product->id,
                'titulo' => $c['titulo'],
            ], [
                'subnivel' => $c['subnivel'],
                'descripcion' => $c['descripcion'],
                'orden' => $maxOrden + 1,
                'estado' => true,
            ]);
        }
    }
}
