<?php
// Script para actualizar la base de datos y agregar la columna identidad
// Ejecutar este archivo desde el navegador: http://localhost/Suministros-Dayana/php/update_database.php

// Incluir configuración de la base de datos
require_once 'db_config.php';

echo "<h2>Actualizando Base de Datos...</h2>";

try {
    // Verificar si la tabla users existe
    $check_table = "SHOW TABLES LIKE 'users'";
    $result = $conn->query($check_table);
    
    if ($result->num_rows == 0) {
        // Crear la tabla users si no existe
        echo "<p>Creando tabla 'users'...</p>";
        
        $create_table = "CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            identidad VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password_hash VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($create_table) === TRUE) {
            echo "<p style='color: green;'>✅ Tabla 'users' creada exitosamente</p>";
        } else {
            echo "<p style='color: red;'>❌ Error al crear la tabla: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>✅ Tabla 'users' ya existe</p>";
        
        // Verificar si la columna identidad existe
        $check_column = "SHOW COLUMNS FROM users LIKE 'identidad'";
        $result = $conn->query($check_column);
        
        if ($result->num_rows == 0) {
            // Agregar la columna identidad
            echo "<p>Agregando columna 'identidad'...</p>";
            
            $add_column = "ALTER TABLE users ADD COLUMN identidad VARCHAR(255) NOT NULL AFTER full_name";
            
            if ($conn->query($add_column) === TRUE) {
                echo "<p style='color: green;'>✅ Columna 'identidad' agregada exitosamente</p>";
            } else {
                echo "<p style='color: red;'>❌ Error al agregar la columna: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style='color: green;'>✅ Columna 'identidad' ya existe</p>";
        }
    }
    
    // Mostrar la estructura actual de la tabla
    echo "<h3>Estructura actual de la tabla 'users':</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Campo</th><th>Tipo</th><th>Nulo</th><th>Llave</th><th>Por defecto</th><th>Extra</th></tr>";
    
    $describe = "DESCRIBE users";
    $result = $conn->query($describe);
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['Field'] . "</td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    echo "<h3 style='color: green;'>✅ Base de datos actualizada correctamente</h3>";
    echo "<p><a href='../registro.html'>Ir al formulario de registro</a></p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?> 