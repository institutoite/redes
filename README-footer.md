# Footer Personalizado con Clases Únicas

## 📋 Descripción

Este footer ha sido diseñado con clases CSS únicas que utilizan el prefijo `footer-custom-` para evitar conflictos con otros estilos CSS existentes en tu proyecto.

## 🎯 Características

- ✅ **Clases únicas**: Todas las clases usan el prefijo `footer-custom-`
- ✅ **Sin conflictos**: No interfiere con otros CSS existentes
- ✅ **Completamente responsivo**: Adaptable a todos los dispositivos
- ✅ **Integración con base de datos**: Compatible con las tablas `socials` e `infos`
- ✅ **Tracking de clics**: Registra interacciones con redes sociales

## 📁 Archivos

- `footer.html` - Estructura HTML del footer
- `footer.css` - Estilos CSS con clases únicas
- `footer.js` - Funcionalidad JavaScript
- `footer-api-example.js` - Ejemplo de integración con API

## 🚀 Instalación

### 1. Incluir los archivos CSS y JS

```html
<!-- En el head de tu HTML -->
<link rel="stylesheet" href="footer.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- Al final del body -->
<script src="footer.js"></script>
```

### 2. Agregar el footer a tu página

```html
<!-- Footer con clases únicas -->
<footer class="footer-custom">
    <div class="footer-custom-container">
        <!-- Información de la empresa -->
        <div class="footer-custom-section footer-custom-company-info">
            <div class="footer-custom-company-logo">
                <img src="tu-logo.png" alt="Logo de la empresa" id="company-logo">
            </div>
            <h3 id="company-name">Nombre de la Empresa</h3>
            <p id="company-slogan">Slogan de la empresa</p>
            <p id="company-description">Descripción de la empresa.</p>
        </div>

        <!-- Información de contacto -->
        <div class="footer-custom-section footer-custom-contact-info">
            <h4>Información de Contacto</h4>
            <div class="footer-custom-contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <span id="company-address">Dirección de la empresa</span>
            </div>
            <div class="footer-custom-contact-item">
                <i class="fas fa-phone"></i>
                <span id="company-phone">+1 234 567 890</span>
            </div>
            <div class="footer-custom-contact-item">
                <i class="fas fa-envelope"></i>
                <span id="company-email">info@empresa.com</span>
            </div>
        </div>

        <!-- Redes sociales -->
        <div class="footer-custom-section footer-custom-social-media">
            <h4>Síguenos en Redes Sociales</h4>
            <div class="footer-custom-social-icons" id="social-icons">
                <!-- Los iconos se cargan dinámicamente -->
            </div>
        </div>
    </div>

    <!-- Línea divisoria -->
    <div class="footer-custom-divider"></div>

    <!-- Copyright -->
    <div class="footer-custom-bottom">
        <p>&copy; <span id="current-year"></span> <span id="copyright-company-name">Nombre de la Empresa</span>. Todos los derechos reservados.</p>
    </div>
</footer>
```

## 🗄️ Integración con Base de Datos

### Tabla `infos` (Información de la empresa)
```sql
CREATE TABLE infos (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    company_name VARCHAR(100),
    logo VARCHAR(255) NULL,
    slogan VARCHAR(255) NULL,
    description TEXT NULL,
    address VARCHAR(255) NULL,
    code VARCHAR(20) NULL,
    phone VARCHAR(20) NULL,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

### Tabla `socials` (Redes sociales)
```sql
CREATE TABLE socials (
    id BIGINT PRIMARY KEY AUTO_INCREMENT,
    social VARCHAR(15),
    color VARCHAR(8),
    icon VARCHAR(25),
    link VARCHAR(150),
    priority VARCHAR(150),
    state BOOLEAN DEFAULT 1,
    clicks BIGINT UNSIGNED DEFAULT 0,
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

## 🎨 Clases CSS Utilizadas

### Clases principales:
- `.footer-custom` - Contenedor principal del footer
- `.footer-custom-container` - Grid contenedor
- `.footer-custom-section` - Secciones individuales
- `.footer-custom-company-info` - Información de la empresa
- `.footer-custom-contact-info` - Información de contacto
- `.footer-custom-social-media` - Redes sociales
- `.footer-custom-social-icon` - Iconos de redes sociales

### Clases de elementos:
- `.footer-custom-company-logo` - Logo de la empresa
- `.footer-custom-contact-item` - Elementos de contacto
- `.footer-custom-social-icons` - Contenedor de iconos sociales
- `.footer-custom-divider` - Línea divisoria
- `.footer-custom-bottom` - Sección de copyright

## 📱 Responsive Design

El footer se adapta automáticamente a diferentes tamaños de pantalla:

- **Desktop (1024px+)**: Grid de 3 columnas
- **Tablet (768px-1024px)**: Grid adaptativo
- **Móvil (480px-768px)**: Una columna
- **Móvil pequeño (360px-480px)**: Elementos compactos
- **Móvil muy pequeño (<360px)**: Layout vertical

## 🔧 Personalización

### Cambiar colores:
```css
.footer-custom {
    background: linear-gradient(135deg, #tu-color1 0%, #tu-color2 100%);
}

.footer-custom-company-info h3,
.footer-custom-contact-info h4,
.footer-custom-social-media h4 {
    color: #tu-color-accento;
}
```

### Cambiar fuentes:
```css
.footer-custom-body {
    font-family: 'Tu-Fuente', sans-serif;
}
```

### Agregar más redes sociales:
```javascript
const socialNetworks = [
    // ... redes existentes
    {
        id: 7,
        social: "tu-red-social",
        color: "#color-hex",
        icon: "fab fa-tu-icono",
        link: "https://tu-red-social.com/tu-perfil",
        priority: "7",
        state: true,
        clicks: 0
    }
];
```

## 🚨 Solución de Problemas

### Si hay conflictos de estilos:
1. Verifica que todas las clases usen el prefijo `footer-custom-`
2. Asegúrate de que el archivo `footer.css` se cargue después de otros CSS
3. Usa `!important` solo si es absolutamente necesario

### Si las redes sociales no aparecen:
1. Verifica que los datos estén en la base de datos
2. Revisa la consola del navegador para errores
3. Asegúrate de que Font Awesome esté cargado

### Si el footer no es responsivo:
1. Verifica que el viewport meta tag esté presente
2. Asegúrate de que no haya CSS que sobrescriba las media queries
3. Prueba en diferentes dispositivos

## 📞 Soporte

Si tienes problemas o necesitas personalizaciones adicionales, revisa:
1. La consola del navegador para errores JavaScript
2. Las herramientas de desarrollador para conflictos CSS
3. Los logs del servidor para errores de API

## 📄 Licencia

Este footer es de uso libre y puede ser modificado según tus necesidades. 