<?php
$productos = [
    ["id" => 1, "nombre" => "Procesador AMD Ryzen 5", "precioOriginal" => 299000, "precioDescuento" => 199000, "imagen" => "imagenes/procesador.jpg"],
    ["id" => 2, "nombre" => "Tarjeta Gráfica NVIDIA GTX 1660", "precioOriginal" => 1499000, "precioDescuento" => 1299000, "imagen" => "imagenes/tarjeta.jpg"],
    ["id" => 3, "nombre" => "Memoria RAM 16GB DDR4", "precioOriginal" => 399000, "precioDescuento" => 349000, "imagen" => "imagenes/ram.jpg"],
    ["id" => 4, "nombre" => "Mouse inalámbrico", "precioOriginal" => 399000, "precioDescuento" => 299000, "imagen" => "imagenes/mouse.jpg"],
    ["id" => 5, "nombre" => "Case para computador", "precioOriginal" => 1299000, "precioDescuento" => 999000, "imagen" => "imagenes/case.jpg"],
    ["id" => 6, "nombre" => "Teclado mecánico", "precioOriginal" => 299000, "precioDescuento" => 99000, "imagen" => "imagenes/teclado.jpg"]
];

$page = isset($_GET['page']) ? $_GET['page'] : 'inicio';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda de Partes de Computador ComputEAN</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos del sitio */
        body { font-family: Arial, sans-serif; background-color: #f3f3f3; color: #333; }
        .header { background-color: #2d2d2d; color: #f3f3f3; padding: 15px; display: flex; justify-content: space-between; align-items: center; }
        .nav-bar a { color: #f3f3f3; text-decoration: none; margin: 0 15px; font-weight: 500; }
        .hero, .content { text-align: center; padding: 50px 20px; }
        .productos { display: flex; justify-content: space-around; flex-wrap: wrap; margin: 20px; }
        .producto { background-color: white; padding: 15px; width: 30%; text-align: center; margin-bottom: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .precio { color: #333; font-size: 1.2em; font-weight: bold; }
        .tachado { text-decoration: line-through; color: #888; }
        button { background-color: #2d2d2d; color: #f3f3f3; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background-color: #444; }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">COMPUTEAN</div>
        <nav class="nav-bar">
            <a href="?page=inicio">Inicio</a>
            <a href="?page=categorias">Categorías</a>
            <a href="?page=ofertas">Ofertas</a>
            <a href="?page=contacto">Contacto</a>
        </nav>
    </header>

    <section class="content">
        <?php
        switch ($page) {
            case 'inicio':
                echo "<h1>Bienvenido a ComputEAN</h1><p>Encuentra las mejores partes para tu PC con nosotros.</p>";
                break;

            case 'categorias':
                echo "<h1>Categorías</h1><p>Explora nuestras categorías de productos.</p>";
                break;

            case 'ofertas':
                echo "<h1>Ofertas</h1><p>Descubre nuestros descuentos especiales en productos seleccionados.</p>";
                echo "<section class='productos'>";
                foreach ($productos as $producto) {
                    echo "<div class='producto'>";
                    echo "<img src='{$producto['imagen']}' alt='{$producto['nombre']}'>";
                    echo "<h2>{$producto['nombre']}</h2>";
                    echo "<p>Antes: <span class='tachado'>$" . number_format($producto['precioOriginal']) . "</span></p>";
                    echo "<p class='precio'>$" . number_format($producto['precioDescuento']) . "</p>";
                    echo "<form action='?page=pagar' method='POST'>";
                    echo "<input type='hidden' name='producto_id' value='{$producto['id']}'>";
                    echo "<button type='submit'>Comprar ahora</button>";
                    echo "</form>";
                    echo "</div>";
                }
                echo "</section>";
                break;

            case 'contacto':
                echo "<h1>Contacto</h1><p>Ponte en contacto con nosotros para más información.</p>";
                break;

            case 'pagar':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $producto_id = isset($_POST['producto_id']) ? $_POST['producto_id'] : null;
                    if ($producto_id && isset($productos[$producto_id - 1])) {
                        $producto = $productos[$producto_id - 1];
                        echo "<h1>Pago de Producto</h1>";
                        echo "<p>Gracias por elegir el producto: <strong>{$producto['nombre']}</strong>.</p>";
                        echo "<p>Total a pagar: <strong>$" . number_format($producto['precioDescuento']) . "</strong></p>";
                        echo "<button onclick='alert(\"¡Compra realizada con éxito!\")'>Confirmar pago</button>";
                    } else {
                        echo "<h1>Error: Producto no encontrado</h1>";
                    }
                }
                break;

            default:
                echo "<h1>Página no encontrada</h1>";
                break;
        }
        ?>
    </section>
</body>
</html>
