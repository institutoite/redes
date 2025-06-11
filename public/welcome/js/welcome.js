
// Datos de productos/servicios
const productos = [
    {
        id: 1,
        nombre: "Consultoría Empresarial",
        precio: "Desde $500",
        imagen: "https://images.unsplash.com/photo-1721322800607-8c38375eef04?w=400&h=300&fit=crop",
        descripcion: "Optimiza tu negocio con nuestras estrategias personalizadas"
    },
    {
        id: 2,
        nombre: "Diseño Creativo",
        precio: "Desde $200",
        imagen: "https://images.unsplash.com/photo-1618160702438-9b02ab6515c9?w=400&h=300&fit=crop",
        descripcion: "Soluciones visuales que destacan tu marca"
    },
    {
        id: 3,
        nombre: "Coaching Personal",
        precio: "Desde $150",
        imagen: "https://images.unsplash.com/photo-1582562124811-c09040d0a901?w=400&h=300&fit=crop",
        descripcion: "Desarrolla tu potencial con sesiones personalizadas"
    },
    {
        id: 4,
        nombre: "Marketing Digital",
        precio: "Desde $800",
        imagen: "https://images.unsplash.com/photo-1487252665478-49b61b47f302?w=400&h=300&fit=crop",
        descripcion: "Amplifica tu presencia online y alcanza más clientes"
    },
    {
        id: 5,
        nombre: "Asesoría Financiera",
        precio: "Consulte",
        imagen: "https://images.unsplash.com/photo-1721322800607-8c38375eef04?w=400&h=300&fit=crop",
        descripcion: "Planifica tu futuro financiero con expertos"
    },
    {
        id: 6,
        nombre: "Capacitación Corporativa",
        precio: "Consulte",
        imagen: "https://images.unsplash.com/photo-1618160702438-9b02ab6515c9?w=400&h=300&fit=crop",
        descripcion: "Eleva las competencias de tu equipo de trabajo"
    }
];

// Función para crear tarjetas de productos
function crearTarjetaProducto(producto, index) {
    const tarjeta = document.createElement('div');
    tarjeta.className = 'product-card animate-fade-in-up';
    tarjeta.style.animationDelay = `${index * 0.1}s`;
    
    tarjeta.innerHTML = `
        <div class="product-image-container">
            <img src="${producto.imagen}" alt="${producto.nombre}" class="product-image">
            <div class="product-image-overlay"></div>
        </div>
        <div class="product-content">
            <h3 class="product-title">${producto.nombre}</h3>
            <p class="product-description">${producto.descripcion}</p>
            <div class="product-footer">
                <span class="product-price">${producto.precio}</span>
                <button class="btn-primary" onclick="consultarProducto('${producto.nombre}')">
                    Consultar
                </button>
            </div>
        </div>
    `;
    
    return tarjeta;
}

// Función para cargar productos
function cargarProductos() {
    const container = document.getElementById('products-grid');
    
    productos.forEach((producto, index) => {
        const tarjeta = crearTarjetaProducto(producto, index);
        container.appendChild(tarjeta);
    });
}

// Función para consultar producto (abre WhatsApp)
function consultarProducto(nombreProducto) {
    const mensaje = encodeURIComponent(`Hola! Me interesa conocer más sobre: ${nombreProducto}`);
    const numeroWhatsApp = '5551234567'; // Cambia este número
    const url = `https://wa.me/${numeroWhatsApp}?text=${mensaje}`;
    window.open(url, '_blank');
}

// Función para animaciones al hacer scroll
function observarElementos() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observar secciones
    const secciones = document.querySelectorAll('.animate-fade-in-up');
    secciones.forEach(seccion => {
        seccion.style.opacity = '0';
        seccion.style.transform = 'translateY(30px)';
        seccion.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
        observer.observe(seccion);
    });
}

// Función para remover pantalla de carga
function removerPantallaCarga() {
    setTimeout(() => {
        const loadingScreen = document.getElementById('loading-screen');
        if (loadingScreen) {
            loadingScreen.style.opacity = '0';
            setTimeout(() => {
                loadingScreen.remove();
            }, 500);
        }
    }, 1000);
}

// Función para smooth scroll en enlaces internos
function configurarSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

// Función para efectos de hover en tarjetas
function configurarEfectosHover() {
    document.addEventListener('mousemove', (e) => {
        const tarjetas = document.querySelectorAll('.product-card');
        
        tarjetas.forEach(tarjeta => {
            const rect = tarjeta.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            
            const rotateX = (y - centerY) / 10;
            const rotateY = (centerX - x) / 10;
            
            if (x >= 0 && x <= rect.width && y >= 0 && y <= rect.height) {
                tarjeta.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) translateY(-8px)`;
            } else {
                tarjeta.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) translateY(0px)';
            }
        });
    });
}

// Función para personalización fácil de colores
function personalizarColores(colorPrimario, colorSecundario) {
    const root = document.documentElement;
    
    if (colorPrimario) {
        root.style.setProperty('--color-primario', colorPrimario);
    }
    
    if (colorSecundario) {
        root.style.setProperty('--color-secundario', colorSecundario);
    }
}

// Función para cambiar información personal
function personalizarInformacion(datos) {
    // Cambiar nombre
    if (datos.nombre) {
        document.querySelector('.main-title').textContent = datos.nombre;
        document.title = `Tarjeta Personal Digital - ${datos.nombre}`;
    }
    
    // Cambiar lema
    if (datos.lema) {
        document.querySelector('.main-subtitle').textContent = datos.lema;
    }
    
    // Cambiar logo
    if (datos.logo) {
        document.querySelector('.logo-image').src = datos.logo;
    }
    
    // Cambiar contacto
    if (datos.telefono) {
        const telLink = document.querySelector('a[href^="tel:"]');
        telLink.href = `tel:${datos.telefono}`;
        telLink.textContent = datos.telefono;
    }
    
    if (datos.email) {
        const emailLink = document.querySelector('a[href^="mailto:"]');
        emailLink.href = `mailto:${datos.email}`;
        emailLink.textContent = datos.email;
    }
}

// Inicialización de la aplicación
document.addEventListener('DOMContentLoaded', function() {
    // Cargar productos
    //cargarProductos();
    
    // Configurar observador de elementos
    observarElementos();
    
    // Configurar smooth scroll
    configurarSmoothScroll();
    
    // Configurar efectos hover
    configurarEfectosHover();
    
    // Remover pantalla de carga
    removerPantallaCarga();
    
    console.log('Tarjeta Personal Digital cargada correctamente');
    
    // Ejemplo de personalización (descomenta para usar)
    /*
    personalizarColores('#2563eb', '#dc2626');
    personalizarInformacion({
        nombre: 'Tu Nombre',
        lema: 'Tu lema personal',
        telefono: '+1234567890',
        email: 'tu@email.com'
    });
    */
});

// Función para mostrar notificaciones (opcional)
function mostrarNotificacion(mensaje, tipo = 'info') {
    const notificacion = document.createElement('div');
    notificacion.className = `notificacion notificacion-${tipo}`;
    notificacion.textContent = mensaje;
    
    // Estilos para la notificación
    notificacion.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        background: white;
        border-left: 4px solid var(--color-primario);
        border-radius: 0.5rem;
        box-shadow: var(--sombra-media);
        z-index: 1000;
        animation: slideInRight 0.3s ease-out;
    `;
    
    document.body.appendChild(notificacion);
    
    setTimeout(() => {
        notificacion.style.animation = 'slideOutRight 0.3s ease-out';
        setTimeout(() => {
            notificacion.remove();
        }, 300);
    }, 3000);
}

// Exportar funciones para uso global
window.consultarProducto = consultarProducto;
window.personalizarColores = personalizarColores;
window.personalizarInformacion = personalizarInformacion;
window.mostrarNotificacion = mostrarNotificacion;