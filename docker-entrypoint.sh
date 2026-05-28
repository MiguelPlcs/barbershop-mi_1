#!/bin/bash
set -e

echo "🚀 Iniciando Barbershop en producción..."

# Crear enlace simbólico de storage si no existe
php artisan storage:link --no-interaction || true

# Ejecutar migraciones
php artisan migrate --force

# Limpiar y cachear configuración
php artisan config:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Aplicación lista."

# Ejecutar comando principal (apache2-foreground)
exec "$@"
