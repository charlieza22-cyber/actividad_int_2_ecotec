# Sistema de Gestión de Inventario y Ventas - ECOTEC

Este sistema ha sido desarrollado para la **Actividad Integradora 2**, aplicando una arquitectura de software basada en capas (MVC) y utilizando PHP con MySQL

## Funcionalidades
- **Gestión de Productos**: Registro, listado y eliminación de artículos con validaciones de precio y stock.
- **Módulo de Ventas**: Registro de transacciones con actualización automática de inventario (Descuento de stock en tiempo real).
- **Seguridad**: Validaciones para evitar campos vacíos y valores negativos.

## Instalación y Requisitos
1. Importar el archivo `inventario.sql` ubicado en la carpeta `/database`.
2. Configurar las credenciales de la base de datos en `/config/database.php`.
3. Ejecutar el proyecto desde la carpeta `/public/index.php`.

## Evidencia de Funcionamiento
*El sistema descuenta stock correctamente (Ejemplo: de 10 unidades a 8 tras una venta de 2).*
