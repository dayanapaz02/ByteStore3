-- Script para actualizar la base de datos y agregar la columna identidad
-- Ejecutar este script en phpMyAdmin o en la línea de comandos de MySQL

-- Usar la base de datos
USE bytestore_db;

-- Verificar si la tabla users existe, si no, crearla
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    identidad VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Si la tabla ya existe, agregar la columna identidad si no existe
-- Verificar si la columna identidad ya existe
SET @sql = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE TABLE_SCHEMA = 'bytestore_db' 
     AND TABLE_NAME = 'users' 
     AND COLUMN_NAME = 'identidad') = 0,
    'ALTER TABLE users ADD COLUMN identidad VARCHAR(255) NOT NULL AFTER full_name',
    'SELECT "La columna identidad ya existe" AS message'
));

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

-- Mostrar la estructura actualizada de la tabla
DESCRIBE users; 