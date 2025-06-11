// Datos de ejemplo de redes sociales (simula la colección PHP $redesSociales)
const redesSociales = [];
//     {
//         nombre: 'Facebook',
//         icono: 'fab fa-facebook-f',
//         color: '#1877f2',
//         url: 'https://facebook.com/usuario',
//         descripcion: 'Síguenos para las últimas noticias',
//         seguidores: '2.5K seguidores',
//         id: 'facebook'
//     },
//     {
//         nombre: 'Instagram',
//         icono: 'fab fa-instagram',
//         color: '#e4405f',
//         url: 'https://instagram.com/usuario',
//         descripcion: 'Fotos y contenido visual',
//         seguidores: '1.8K seguidores',
//         id: 'instagram'
//     },
//     {
//         nombre: 'Twitter',
//         icono: 'fab fa-twitter',
//         color: '#1da1f2',
//         url: 'https://twitter.com/usuario',
//         descripcion: 'Últimas actualizaciones y noticias',
//         seguidores: '892 seguidores',
//         id: 'twitter'
//     },
//     {
//         nombre: 'LinkedIn',
//         icono: 'fab fa-linkedin-in',
//         color: '#0077b5',
//         url: 'https://linkedin.com/in/usuario',
//         descripcion: 'Conecta profesionalmente',
//         seguidores: '654 conexiones',
//         id: 'linkedin'
//     },
//     {
//         nombre: 'YouTube',
//         icono: 'fab fa-youtube',
//         color: '#ff0000',
//         url: 'https://youtube.com/c/usuario',
//         descripcion: 'Videos y tutoriales',
//         seguidores: '3.2K suscriptores',
//         id: 'youtube'
//     },
//     {
//         nombre: 'WhatsApp',
//         icono: 'fab fa-whatsapp',
//         color: '#25d366',
//         url: 'https://wa.me/5551234567',
//         descripcion: 'Contacto directo',
//         seguidores: 'Chat disponible',
//         id: 'whatsapp'
//     }
// ];

// Función para crear el HTML de cada red social
function crearRedSocialHTML(redSocial, index) {
    return `
        <a href="${redSocial.url}" 
           class="red-social-item" 
           data-red="${redSocial.id}"
           target="_blank" 
           rel="noopener noreferrer"
           style="animation-delay: ${index * 0.1}s">
            <div class="red-social-contenido">
                <div class="icono-red-social" style="background-color: ${redSocial.color}">
                    <i class="${redSocial.icono}"></i>
                </div>
                <div class="red-social-info">
                    <h3 class="nombre-red-social">${redSocial.nombre}z</h3>
                    <p class="descripcion-red-social">${redSocial.descripcion}y</p>
                    <span class="contador-seguidores">${redSocial.seguidores}x</span>
                </div>
            </div>
        </a>
    `;
}

// Función para renderizar todas las redes sociales
function renderizarRedesSociales() {
    const container = document.getElementById('redes-container');
    
    if (!container) {
        console.error('Contenedor de redes sociales no encontrado');
        return;
    }
    
    // Limpiar contenedor
    container.innerHTML = '';
    
    // Crear HTML para cada red social
    redesSociales.forEach((redSocial, index) => {
        container.innerHTML += crearRedSocialHTML(redSocial, index);
    });
    
    console.log(`${redesSociales.length} redes sociales cargadas correctamente`);
}

// Función para agregar una nueva red social dinámicamente
function agregarRedSocial(nuevaRed) {
    redesSociales.push(nuevaRed);
    renderizarRedesSociales();
}

// Función para actualizar una red social existente
function actualizarRedSocial(id, datosActualizados) {
    const index = redesSociales.findIndex(red => red.id === id);
    if (index !== -1) {
        redesSociales[index] = { ...redesSociales[index], ...datosActualizados };
        renderizarRedesSociales();
    }
}

// Función para eliminar una red social
function eliminarRedSocial(id) {
    const index = redesSociales.findIndex(red => red.id === id);
    if (index !== -1) {
        redesSociales.splice(index, 1);
        renderizarRedesSociales();
    }
}

// Función para personalizar colores de las redes sociales
function personalizarColoresRedes(coloresPersonalizados) {
    redesSociales.forEach(red => {
        if (coloresPersonalizados[red.id]) {
            red.color = coloresPersonalizados[red.id];
        }
    });
    renderizarRedesSociales();
}

// Función para integrar con el código existente de la tarjeta personal
function integrarConTarjetaPersonal() {
    // Buscar la sección social existente y reemplazarla
    const seccionSocialExistente = document.querySelector('.social-section');
    
    if (seccionSocialExistente) {
        // Crear nueva sección
        const nuevaSeccion = document.createElement('div');
        nuevaSeccion.className = 'redes-sociales-dinamicas';
        nuevaSeccion.innerHTML = `
            <div class="container">
                <h2 class="titulo-redes">Síguenos en Redes Sociales</h2>
                <div class="redes-grid" id="redes-container">
                    <!-- Las redes sociales se cargarán dinámicamente aquí -->
                </div>
            </div>
        `;
        
        // Reemplazar la sección existente
        seccionSocialExistente.parentNode.replaceChild(nuevaSeccion, seccionSocialExistente);
        
        // Renderizar las redes sociales
        renderizarRedesSociales();
    }
}

// Función de ejemplo para simular datos desde Laravel/PHP
function cargarDesdeColeccionPHP(datosPhp) {
    // Esta función simula recibir datos desde una colección PHP
    // En un entorno real, estos datos vendrían del servidor
    if (Array.isArray(datosPhp)) {
        redesSociales.length = 0; // Limpiar array
        redesSociales.push(...datosPhp); // Agregar nuevos datos
        renderizarRedesSociales();
    }
}

// Ejemplo de uso con datos que vendrían de Laravel
const datosEjemploPhp = [
    {
        nombre: 'TikTok',
        icono: 'fab fa-tiktok',
        color: '#000000',
        url: 'https://tiktok.com/@usuario',
        descripcion: 'Videos cortos y entretenidos',
        seguidores: '5.1K seguidores',
        id: 'tiktok'
    }
];

// Inicialización cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    //renderizarRedesSociales();
    
    // Ejemplo de integración automática con tarjeta personal existente
    // integrarConTarjetaPersonal();
    
    console.log('Sección de redes sociales dinámicas inicializada');
});

// Exportar funciones para uso global
window.agregarRedSocial = agregarRedSocial;
window.actualizarRedSocial = actualizarRedSocial;
window.eliminarRedSocial = eliminarRedSocial;
window.personalizarColoresRedes = personalizarColoresRedes;
window.cargarDesdeColeccionPHP = cargarDesdeColeccionPHP;
window.integrarConTarjetaPersonal = integrarConTarjetaPersonal;

// Ejemplo de uso:
/*
// Agregar nueva red social
agregarRedSocial({
    nombre: 'Discord',
    icono: 'fab fa-discord',
    color: '#7289da',
    url: 'https://discord.gg/servidor',
    descripcion: 'Únete a nuestra comunidad',
    seguidores: '256 miembros',
    id: 'discord'
});

// Personalizar colores
personalizarColoresRedes({
    'facebook': '#4267B2',
    'instagram': '#C13584'
});
*/