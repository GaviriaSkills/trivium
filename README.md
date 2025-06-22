# Trivium | Cervecería Artesanal

[![Versión](https://img.shields.io/badge/version-1.0.0-blue.svg)](https://github.com/tuusuario/trivium)
[![Laravel](https://img.shields.io/badge/Laravel-10.x-red.svg)](https://laravel.com/)
[![Node](https://img.shields.io/badge/Node.js-18.x-green.svg)](https://nodejs.org/)

Aplicación de gestión para la cervecería artesanal Trivium.

---

## Instalación

1. **Clona el repositorio:**
   ```bash
   git clone https://github.com/GaviriaSkills/trivium.git
   cd trivium
   ```
2. **Instala dependencias de PHP:**
   ```bash
   composer install
   ```
3. **Instala dependencias de Node.js:**
   ```bash
   npm install
   ```
4. **Copia el archivo de entorno:**
   ```bash
   cp .env.example .env
   ```
5. **Genera la clave de la aplicación:**
   ```bash
   php artisan key:generate
   ```
6. **Crea el enlace de almacenamiento:**
   ```bash
   php artisan storage:link
   ```
7. **Ejecuta las migraciones:**
   ```bash
   php artisan migrate
   ```

---

## Ejecución

Asegúrate de que MySQL esté corriendo y configurado correctamente en tu archivo `.env`.

1. **Inicia el backend de Laravel:**
   ```bash
   php artisan serve
   ```
2. **En otra terminal, inicia el frontend:**
   ```bash
   npm run dev
   ```

La aplicación estará disponible en [http://localhost:8000](http://localhost:8000).

---

## Notas
- Requiere PHP 8.1+, Composer, Node.js 18+ y MySQL.
- Si tienes problemas con permisos en Linux, ejecuta: `chmod -R 775 storage bootstrap/cache`

---

¡Bienvenido a Trivium!
