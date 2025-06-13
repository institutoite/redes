// Ejemplo de cómo integrar el footer con una API real
// Este archivo muestra cómo conectar con las tablas de base de datos que proporcionaste

class FooterAPI {
    constructor() {
        this.baseURL = '/api'; // Ajusta según tu configuración
    }

    // Obtener información de la empresa desde la tabla 'infos'
    async getCompanyInfo() {
        try {
            const response = await fetch(`${this.baseURL}/company-info`);
            if (!response.ok) {
                throw new Error('Error al obtener información de la empresa');
            }
            return await response.json();
        } catch (error) {
            console.error('Error:', error);
            return null;
        }
    }

    // Obtener redes sociales desde la tabla 'socials'
    async getSocialNetworks() {
        try {
            const response = await fetch(`${this.baseURL}/social-networks`);
            if (!response.ok) {
                throw new Error('Error al obtener redes sociales');
            }
            return await response.json();
        } catch (error) {
            console.error('Error:', error);
            return [];
        }
    }

    // Actualizar contador de clics en una red social
    async updateSocialClicks(socialId) {
        try {
            const response = await fetch(`${this.baseURL}/socials/${socialId}/click`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ timestamp: new Date().toISOString() })
            });
            
            if (!response.ok) {
                throw new Error('Error al actualizar contador de clics');
            }
            
            return await response.json();
        } catch (error) {
            console.error('Error:', error);
            return false;
        }
    }

    // Obtener todas las redes sociales activas ordenadas por prioridad
    async getActiveSocialNetworks() {
        try {
            const response = await fetch(`${this.baseURL}/social-networks/active`);
            if (!response.ok) {
                throw new Error('Error al obtener redes sociales activas');
            }
            
            const socials = await response.json();
            
            // Ordenar por prioridad
            return socials.sort((a, b) => parseInt(a.priority) - parseInt(b.priority));
        } catch (error) {
            console.error('Error:', error);
            return [];
        }
    }
}

// Clase mejorada del FooterManager que usa la API real
class FooterManagerWithAPI extends FooterManager {
    constructor() {
        super();
        this.api = new FooterAPI();
        this.loadDataFromAPI();
    }

    async loadDataFromAPI() {
        try {
            // Cargar información de la empresa
            const companyData = await this.api.getCompanyInfo();
            if (companyData) {
                this.updateCompanyInfo(companyData);
            }

            // Cargar redes sociales
            const socialData = await this.api.getActiveSocialNetworks();
            if (socialData && socialData.length > 0) {
                this.updateSocialNetworks(socialData);
            }
        } catch (error) {
            console.error('Error al cargar datos desde la API:', error);
            // Usar datos por defecto si la API falla
            this.loadCompanyInfo();
            this.loadSocialNetworks();
        }
    }

    updateCompanyInfo(data) {
        // Actualizar elementos del DOM con datos reales
        const elements = {
            'company-logo': data.logo,
            'company-name': data.company_name,
            'company-slogan': data.slogan,
            'company-description': data.description,
            'company-address': data.address,
            'company-phone': data.phone,
            'copyright-company-name': data.company_name
        };

        Object.entries(elements).forEach(([id, value]) => {
            const element = document.getElementById(id);
            if (element && value) {
                if (id === 'company-logo') {
                    element.src = value;
                    element.alt = `Logo de ${data.company_name}`;
                } else {
                    element.textContent = value;
                }
            }
        });
    }

    updateSocialNetworks(socials) {
        const container = document.getElementById('social-icons');
        if (!container) return;

        container.innerHTML = '';

        socials.forEach(social => {
            const socialIcon = this.createSocialIconFromAPI(social);
            container.appendChild(socialIcon);
        });
    }

    createSocialIconFromAPI(social) {
        const link = document.createElement('a');
        link.href = social.link;
        link.className = `social-icon ${social.social}`;
        link.target = '_blank';
        link.rel = 'noopener noreferrer';
        link.title = `Síguenos en ${social.social.charAt(0).toUpperCase() + social.social.slice(1)}`;

        // Aplicar color personalizado desde la base de datos
        if (social.color) {
            link.style.backgroundColor = social.color;
        }

        const icon = document.createElement('i');
        icon.className = social.icon;
        link.appendChild(icon);

        // Event listener con tracking real
        link.addEventListener('click', async () => {
            await this.trackSocialClickReal(social.id);
        });

        return link;
    }

    async trackSocialClickReal(socialId) {
        try {
            const success = await this.api.updateSocialClicks(socialId);
            if (success) {
                console.log(`Clic registrado para red social ID: ${socialId}`);
            }
        } catch (error) {
            console.error('Error al registrar clic:', error);
        }
    }
}

// Ejemplo de endpoints que necesitarías en tu backend (Laravel/PHP)

/*
// En tu controlador Laravel:

public function getCompanyInfo()
{
    $info = DB::table('infos')->first();
    return response()->json($info);
}

public function getActiveSocialNetworks()
{
    $socials = DB::table('socials')
        ->where('state', 1)
        ->orderBy('priority', 'asc')
        ->get();
    return response()->json($socials);
}

public function updateSocialClicks($id)
{
    $social = DB::table('socials')->find($id);
    if ($social) {
        DB::table('socials')
            ->where('id', $id)
            ->increment('clicks');
        return response()->json(['success' => true]);
    }
    return response()->json(['success' => false], 404);
}

// En routes/api.php:
Route::get('/company-info', [FooterController::class, 'getCompanyInfo']);
Route::get('/social-networks/active', [FooterController::class, 'getActiveSocialNetworks']);
Route::post('/socials/{id}/click', [FooterController::class, 'updateSocialClicks']);
*/

// Inicializar con API real
document.addEventListener('DOMContentLoaded', () => {
    // Usar la versión con API si está disponible
    if (typeof FooterManagerWithAPI !== 'undefined') {
        new FooterManagerWithAPI();
    } else {
        // Fallback a la versión con datos simulados
        new FooterManager();
    }
}); 