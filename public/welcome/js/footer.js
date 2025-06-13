// Datos simulados de la base de datos
// En un entorno real, estos datos vendrían de una API o se cargarían desde el servidor

const companyInfo = {
    company_name: "Mi Empresa S.A.",
    logo: "https://via.placeholder.com/120x60/3498db/ffffff?text=LOGO",
    slogan: "Innovación y calidad en cada proyecto",
    description: "Somos una empresa comprometida con la excelencia y la innovación tecnológica. Ofrecemos soluciones integrales para nuestros clientes.",
    address: "Av. Principal 123, Ciudad, País",
    code: "12345",
    phone: "+1 234 567 890"
};

const socialNetworks = [
    {
        id: 1,
        social: "facebook",
        color: "#1877f2",
        icon: "fab fa-facebook-f",
        link: "https://facebook.com/miempresa",
        priority: "1",
        state: true,
        clicks: 150
    },
    {
        id: 2,
        social: "twitter",
        color: "#1da1f2",
        icon: "fab fa-twitter",
        link: "https://twitter.com/miempresa",
        priority: "2",
        state: true,
        clicks: 89
    },
    {
        id: 3,
        social: "instagram",
        color: "#e4405f",
        icon: "fab fa-instagram",
        link: "https://instagram.com/miempresa",
        priority: "3",
        state: true,
        clicks: 234
    },
    {
        id: 4,
        social: "linkedin",
        color: "#0077b5",
        icon: "fab fa-linkedin-in",
        link: "https://linkedin.com/company/miempresa",
        priority: "4",
        state: true,
        clicks: 67
    },
    {
        id: 5,
        social: "youtube",
        color: "#ff0000",
        icon: "fab fa-youtube",
        link: "https://youtube.com/miempresa",
        priority: "5",
        state: true,
        clicks: 445
    },
    {
        id: 6,
        social: "whatsapp",
        color: "#25d366",
        icon: "fab fa-whatsapp",
        link: "https://wa.me/1234567890",
        priority: "6",
        state: true,
        clicks: 123
    }
];

// Clase para manejar el footer
class FooterManager {
    constructor() {
        this.init();
    }

    init() {
        this.loadCompanyInfo();
        this.loadSocialNetworks();
        this.setCurrentYear();
        this.addEventListeners();
    }

    // Cargar información de la empresa
    loadCompanyInfo() {
        const logoElement = document.getElementById('company-logo');
        const nameElement = document.getElementById('company-name');
        const sloganElement = document.getElementById('company-slogan');
        const descriptionElement = document.getElementById('company-description');
        const addressElement = document.getElementById('company-address');
        const phoneElement = document.getElementById('company-phone');
        const copyrightNameElement = document.getElementById('copyright-company-name');

        if (logoElement && companyInfo.logo) {
            logoElement.src = companyInfo.logo;
            logoElement.alt = `Logo de ${companyInfo.company_name}`;
        }

        if (nameElement) {
            nameElement.textContent = companyInfo.company_name;
        }

        if (sloganElement && companyInfo.slogan) {
            sloganElement.textContent = companyInfo.slogan;
        } else if (sloganElement) {
            sloganElement.style.display = 'none';
        }

        if (descriptionElement && companyInfo.description) {
            descriptionElement.textContent = companyInfo.description;
        } else if (descriptionElement) {
            descriptionElement.style.display = 'none';
        }

        if (addressElement && companyInfo.address) {
            addressElement.textContent = companyInfo.address;
        } else if (addressElement) {
            addressElement.parentElement.style.display = 'none';
        }

        if (phoneElement && companyInfo.phone) {
            phoneElement.textContent = companyInfo.phone;
        } else if (phoneElement) {
            phoneElement.parentElement.style.display = 'none';
        }

        if (copyrightNameElement) {
            copyrightNameElement.textContent = companyInfo.company_name;
        }
    }

    // Cargar redes sociales
    loadSocialNetworks() {
        const socialIconsContainer = document.getElementById('social-icons');
        
        if (!socialIconsContainer) return;

        // Filtrar solo las redes sociales activas y ordenar por prioridad
        const activeSocials = socialNetworks
            .filter(social => social.state)
            .sort((a, b) => parseInt(a.priority) - parseInt(b.priority));

        if (activeSocials.length === 0) {
            socialIconsContainer.innerHTML = '<p style="text-align: center; opacity: 0.7;">No hay redes sociales disponibles</p>';
            return;
        }

        socialIconsContainer.innerHTML = '';

        activeSocials.forEach(social => {
            const socialIcon = this.createSocialIcon(social);
            socialIconsContainer.appendChild(socialIcon);
        });
    }

    // Crear elemento de icono de red social
    createSocialIcon(social) {
        const link = document.createElement('a');
        link.href = social.link;
        link.className = `footer-custom-social-icon ${social.social}`;
        link.target = '_blank';
        link.rel = 'noopener noreferrer';
        link.title = `Síguenos en ${social.social.charAt(0).toUpperCase() + social.social.slice(1)}`;

        // Aplicar color personalizado si existe
        if (social.color) {
            link.style.backgroundColor = social.color;
        }

        const icon = document.createElement('i');
        icon.className = social.icon;

        link.appendChild(icon);

        // Agregar evento de clic para tracking
        link.addEventListener('click', () => {
            this.trackSocialClick(social.id);
        });

        return link;
    }

    // Establecer año actual en el copyright
    setCurrentYear() {
        const currentYearElement = document.getElementById('current-year');
        if (currentYearElement) {
            currentYearElement.textContent = new Date().getFullYear();
        }
    }

    // Agregar event listeners
    addEventListeners() {
        // Event listener para animaciones al hacer scroll
        window.addEventListener('scroll', () => {
            this.handleScrollAnimation();
        });

        // Event listener para responsive
        window.addEventListener('resize', () => {
            this.handleResize();
        });

        // Event listener para prevenir zoom en dispositivos móviles
        document.addEventListener('gesturestart', (e) => {
            e.preventDefault();
        });
    }

    // Manejar animaciones al hacer scroll
    handleScrollAnimation() {
        const footer = document.querySelector('.footer-custom');
        if (!footer) return;

        const footerTop = footer.offsetTop;
        const scrollPosition = window.scrollY + window.innerHeight;

        if (scrollPosition > footerTop) {
            footer.classList.add('footer-custom-visible');
        }
    }

    // Manejar cambios de tamaño de ventana
    handleResize() {
        // Reorganizar elementos si es necesario
        this.adjustLayoutForScreenSize();
    }

    // Ajustar layout según el tamaño de pantalla
    adjustLayoutForScreenSize() {
        const width = window.innerWidth;
        const socialIconsContainer = document.getElementById('social-icons');
        
        if (socialIconsContainer) {
            if (width <= 480) {
                // En pantallas muy pequeñas, reducir el gap entre iconos
                socialIconsContainer.style.gap = '0.5rem';
            } else if (width <= 768) {
                socialIconsContainer.style.gap = '0.8rem';
            } else {
                socialIconsContainer.style.gap = '1rem';
            }
        }
    }

    // Trackear clics en redes sociales (simulado)
    trackSocialClick(socialId) {
        console.log(`Clic en red social ID: ${socialId}`);
        
        // En un entorno real, aquí harías una llamada a la API para actualizar el contador
        // fetch('/api/socials/click', {
        //     method: 'POST',
        //     headers: { 'Content-Type': 'application/json' },
        //     body: JSON.stringify({ social_id: socialId })
        // });

        // Simular actualización del contador
        const social = socialNetworks.find(s => s.id === socialId);
        if (social) {
            social.clicks++;
            console.log(`Nuevo total de clics para ${social.social}: ${social.clicks}`);
        }
    }

    // Método para actualizar datos desde el servidor
    async updateData() {
        try {
            // Simular llamada a API
            // const response = await fetch('/api/footer-data');
            // const data = await response.json();
            
            // Actualizar datos locales
            // this.companyInfo = data.companyInfo;
            // this.socialNetworks = data.socialNetworks;
            
            // Recargar el footer
            this.loadCompanyInfo();
            this.loadSocialNetworks();
            
        } catch (error) {
            console.error('Error al actualizar datos del footer:', error);
        }
    }

    // Método para validar y limpiar datos
    validateData() {
        // Validar que los datos de la empresa existan
        if (!companyInfo.company_name) {
            console.warn('Nombre de empresa no encontrado');
        }

        // Validar que al menos una red social esté activa
        const activeSocials = socialNetworks.filter(social => social.state);
        if (activeSocials.length === 0) {
            console.warn('No hay redes sociales activas');
        }
    }
}

// Función para cargar datos desde una API real
async function loadFooterDataFromAPI() {
    try {
        // Ejemplo de cómo cargar datos desde una API
        // const response = await fetch('/api/footer-data');
        // const data = await response.json();
        // return data;
        
        // Por ahora retornamos los datos simulados
        return {
            companyInfo,
            socialNetworks
        };
    } catch (error) {
        console.error('Error al cargar datos del footer:', error);
        return null;
    }
}

// Función para manejar errores de carga de imágenes
function handleImageError(img) {
    img.src = 'https://via.placeholder.com/120x60/3498db/ffffff?text=LOGO';
    img.alt = 'Logo no disponible';
}

// Inicializar cuando el DOM esté listo
// document.addEventListener('DOMContentLoaded', () => {
//     const footerManager = new FooterManager();
    
//     // Validar datos
//     footerManager.validateData();
    
//     // Ajustar layout inicial
//     footerManager.adjustLayoutForScreenSize();
    
//     // Manejar errores de carga de imágenes
//     const logoImg = document.getElementById('company-logo');
//     if (logoImg) {
//         logoImg.addEventListener('error', () => handleImageError(logoImg));
//     }
// });

// Exportar para uso en otros módulos si es necesario
if (typeof module !== 'undefined' && module.exports) {
    module.exports = FooterManager;
} 