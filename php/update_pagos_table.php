<?php
// Script para actualizar la tabla pagos_cuotas
// Ejecutar este archivo desde el navegador: http://localhost/Suministros-Dayana/php/update_pagos_table.php

// Incluir configuración de la base de datos
require_once 'db_config.php';

echo "<h2>Actualizando Tabla de Pagos de Cuotas...</h2>";

try {
    // Verificar si la tabla pagos_cuotas existe
    $check_table = "SHOW TABLES LIKE 'pagos_cuotas'";
    $result = $conn->query($check_table);
    
    if ($result->num_rows == 0) {
        // Crear la tabla pagos_cuotas si no existe
        echo "<p>Creando tabla 'pagos_cuotas'...</p>";
        
        $create_table = "CREATE TABLE pagos_cuotas (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre_cliente VARCHAR(255) NOT NULL,
            numero_contrato_identidad VARCHAR(255) NOT NULL,
            direccion_cliente VARCHAR(255) NOT NULL,
            telefono_cliente VARCHAR(50) NOT NULL,
            monto_pago DECIMAL(10,2) NOT NULL,
            metodo_pago VARCHAR(100) NOT NULL,
            email VARCHAR(255) NOT NULL,
            fecha_pago TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($create_table) === TRUE) {
            echo "<p style='color: green;'>✅ Tabla 'pagos_cuotas' creada exitosamente</p>";
        } else {
            echo "<p style='color: red;'>❌ Error al crear la tabla: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>✅ Tabla 'pagos_cuotas' ya existe</p>";
        
        // Verificar y agregar columnas faltantes
        $columns_to_add = [
            'nombre_cliente' => "ALTER TABLE pagos_cuotas ADD COLUMN nombre_cliente VARCHAR(255) NOT NULL AFTER id",
            'direccion_cliente' => "ALTER TABLE pagos_cuotas ADD COLUMN direccion_cliente VARCHAR(255) NOT NULL AFTER numero_contrato_identidad",
            'telefono_cliente' => "ALTER TABLE pagos_cuotas ADD COLUMN telefono_cliente VARCHAR(50) NOT NULL AFTER direccion_cliente"
        ];
        
        foreach ($columns_to_add as $column_name => $sql) {
            $check_column = "SHOW COLUMNS FROM pagos_cuotas LIKE '$column_name'";
            $result = $conn->query($check_column);
            
            if ($result->num_rows == 0) {
                echo "<p>Agregando columna '$column_name'...</p>";
                
                if ($conn->query($sql) === TRUE) {
                    echo "<p style='color: green;'>✅ Columna '$column_name' agregada exitosamente</p>";
                } else {
                    echo "<p style='color: red;'>❌ Error al agregar la columna '$column_name': " . $conn->error . "</p>";
                }
            } else {
                echo "<p style='color: green;'>✅ Columna '$column_name' ya existe</p>";
            }
        }
    }
    
    // Mostrar la estructura actual de la tabla
    echo "<h3>Estructura actual de la tabla 'pagos_cuotas':</h3>";
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr><th>Campo</th><th>Tipo</th><th>Nulo</th><th>Llave</th><th>Por defecto</th><th>Extra</th></tr>";
    
    $describe = "DESCRIBE pagos_cuotas";
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
    
    echo "<h3 style='color: green;'>✅ Tabla de pagos actualizada correctamente</h3>";
    echo "<p><a href='../pago-cuotas.html'>Ir al formulario de pago</a></p>";
    
} catch (Exception $e) {
    echo "<p style='color: red;'>❌ Error: " . $e->getMessage() . "</p>";
} finally {
    if (isset($conn)) {
        $conn->close();
    }
}
?> 