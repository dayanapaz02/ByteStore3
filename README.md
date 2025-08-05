# Suministros Dayana - ByteStore v4.0

## Descripción del Proyecto

Este es un sistema de tienda en línea para Suministros Dayana (ByteStore) que funciona completamente sin base de datos. El proyecto está diseñado para generar facturas automáticamente al realizar pagos, sin necesidad de conexión a base de datos.

## Características Principales

### ✅ Funcionalidades Implementadas

1. **Sistema de Carrito de Compras**
   - Agregar productos al carrito
   - Calcular totales automáticamente
   - Persistencia de datos en localStorage

2. **Formulario de Pago de Cuotas**
   - Validación de formularios en tiempo real
   - Cálculo automático de ISV (15%)
   - Generación de facturas sin base de datos

3. **Sistema de Facturación**
   - Generación automática de números de factura
   - Cálculo de impuestos (ISV 15%)
   - Exportación a PDF mediante impresión del navegador
   - Diseño profesional y responsive

4. **Navegación Completa**
   - Páginas de productos
   - Blog con artículos técnicos
   - Servicios técnicos
   - Información de contacto

## Estructura del Proyecto

```
Suministros-Dayana/
├── index.html                 # Página principal
├── productos.html             # Catálogo de productos
├── pago-cuotas.html          # Formulario de pago
├── factura.html              # Generador de facturas (sin PHP)
├── factura.php               # Generador de facturas (con PHP)
├── css/                      # Estilos CSS
├── js/                       # Scripts JavaScript
├── Imagenes/                 # Imágenes del proyecto
└── php/                      # Archivos PHP (opcionales)
```

## Cómo Funciona el Sistema Sin Base de Datos

### 1. Almacenamiento de Datos
- **localStorage**: Se utiliza para almacenar temporalmente los productos del carrito
- **SessionStorage**: Para datos de sesión del usuario
- **Cookies**: Para preferencias del usuario

### 2. Flujo de Pago
1. El usuario agrega productos al carrito
2. Los productos se almacenan en localStorage
3. Al completar el formulario de pago, los datos se procesan en JavaScript
4. Se genera una factura automáticamente
5. Los datos se limpian del localStorage después de generar la factura

### 3. Generación de Facturas
- **factura.html**: Versión completamente en JavaScript (recomendada)
- **factura.php**: Versión con PHP (requiere servidor web)

## Instalación y Uso

### Opción 1: Sin Servidor Web (Recomendada)
1. Descarga todos los archivos
2. Abre `index.html` en tu navegador
3. Navega por el sitio normalmente
4. Al hacer clic en "Realizar Pago" se generará una factura automáticamente

### Opción 2: Con Servidor Web
1. Coloca los archivos en tu servidor web (XAMPP, WAMP, etc.)
2. Accede a través de `http://localhost/Suministros-Dayana`
3. Funciona tanto con `factura.html` como con `factura.php`

## Características Técnicas

### Frontend
- **HTML5**: Estructura semántica
- **CSS3**: Diseño responsive y moderno
- **JavaScript ES6+**: Funcionalidad dinámica
- **Bootstrap 5**: Framework CSS para diseño responsive
- **FontAwesome**: Iconos profesionales

### Funcionalidades JavaScript
- Validación de formularios en tiempo real
- Cálculo automático de totales e impuestos
- Generación de números de factura únicos
- Persistencia de datos en localStorage
- Exportación a PDF mediante impresión del navegador

## Archivos Principales

### `pago-cuotas.html`
- Formulario de pago con validación
- Cálculo automático de totales
- Integración con carrito de compras
- Generación de facturas sin base de datos

### `factura.html`
- Generador de facturas en JavaScript puro
- Diseño profesional y responsive
- Exportación a PDF
- Limpieza automática del carrito

### `productos.html`
- Catálogo de productos
- Sistema de carrito integrado
- Filtros de productos
- Diseño responsive

## Ventajas del Sistema Sin Base de Datos

1. **Simplicidad**: No requiere configuración de base de datos
2. **Portabilidad**: Funciona en cualquier servidor web o localmente
3. **Rendimiento**: Respuesta instantánea sin consultas a BD
4. **Mantenimiento**: Fácil de mantener y modificar
5. **Seguridad**: No hay vulnerabilidades de base de datos

## Limitaciones

1. **Persistencia**: Los datos se pierden al limpiar el navegador
2. **Escalabilidad**: Limitado para grandes volúmenes de datos
3. **Backup**: No hay respaldo automático de datos
4. **Multi-usuario**: Limitado para uso simultáneo

## Personalización

### Cambiar Información de la Empresa
Edita los siguientes archivos:
- `factura.html` (líneas 60-65)
- `factura.php` (líneas 60-65)
- `pago-cuotas.html` (línea 60)

### Modificar Impuestos
Cambia el porcentaje de ISV en:
- `factura.html` (línea 200)
- `factura.php` (línea 25)
- `pago-cuotas.html` (línea 200)

### Agregar Productos
Edita `productos.html` para agregar nuevos productos al catálogo.

## Soporte

Para cualquier consulta o problema:
- Email: info@bytestore.com
- Sitio web: www.bytestore.com

## Licencia

Este proyecto es propiedad de Suministros Dayana - ByteStore.
Todos los derechos reservados.

---

**Versión**: 4.0  
**Última actualización**: Diciembre 2024  
**Desarrollado para**: Suministros Dayana 