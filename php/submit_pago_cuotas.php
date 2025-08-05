<?php

require_once('db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar y limpiar los datos
    $nombre_cliente = $conn->real_escape_string(trim($_POST['nombre_cliente']));
    $numero_contrato_identidad = $conn->real_escape_string(trim($_POST['numero_contrato_identidad']));
    $direccion_cliente = $conn->real_escape_string(trim($_POST['direccion_cliente']));
    $telefono_cliente = $conn->real_escape_string(trim($_POST['telefono_cliente']));
    $monto_pago = $conn->real_escape_string(trim($_POST['monto_pago']));
    $metodo_pago = $conn->real_escape_string(trim($_POST['metodo_pago']));
    $email = $conn->real_escape_string(trim($_POST['email']));

    // Validaciones básicas
    if (empty($nombre_cliente) || empty($numero_contrato_identidad) || empty($direccion_cliente) || empty($telefono_cliente) || empty($monto_pago) || empty($metodo_pago) || empty($email)) {
        echo "<script>alert('Por favor complete todos los campos requeridos.'); window.location.href='../pago-cuotas.html';</script>";
        exit();
    }

    // Validar que el monto sea positivo
    if ($monto_pago <= 0) {
        echo "<script>alert('El monto del pago debe ser mayor a 0.'); window.location.href='../pago-cuotas.html';</script>";
        exit();
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO pagos_cuotas (nombre_cliente, numero_contrato_identidad, direccion_cliente, telefono_cliente, monto_pago, metodo_pago, email) 
            VALUES ('$nombre_cliente', '$numero_contrato_identidad', '$direccion_cliente', '$telefono_cliente', '$monto_pago', '$metodo_pago', '$email')";

    if ($conn->query($sql) === TRUE) {
        // Generar número de factura único
        $factura_numero = date('Y') . str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        // Calcular ISV (15% en Honduras)
        $subtotal = $monto_pago;
        $isv = $subtotal * 0.15;
        $total = $subtotal + $isv;
        
        // Obtener productos del carrito desde localStorage (se pasará por JavaScript)
        $productos_carrito = isset($_POST['productos_carrito']) ? $_POST['productos_carrito'] : '[]';
        
        // Debug: registrar los productos recibidos
        error_log("Productos del carrito recibidos: " . $productos_carrito);
        
        // Redirigir a la factura con los datos
        $factura_url = "../factura.php?" . http_build_query([
            'numero' => $factura_numero,
            'cliente' => $nombre_cliente,
            'direccion' => $direccion_cliente,
            'telefono' => $telefono_cliente,
            'subtotal' => $subtotal,
            'isv' => $isv,
            'total' => $total,
            'productos' => $productos_carrito
        ]);
        
        echo "<script>
                alert('¡Pago de cuotas procesado con éxito!');
                window.location.href='$factura_url';
              </script>";
    } else {
        echo "<script>
                alert('Error al procesar el pago: " . $conn->error . "');
                window.location.href='../pago-cuotas.html';
              </script>";
    }
}

$conn->close();

?> 