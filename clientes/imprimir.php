<?php
    include "../deposito.class.php";
    $admin = new Deposito;  
    $admin->conexion();
    if (!isset($_GET['id_carrito'])) {
        die("ERROR");
    }
    if (!is_numeric($_GET['id_carrito'])) {
        die("ERROR");
    }
    $id_carrito = $_GET['id_carrito'];
    $sql = 'SELECT c.id_carrito, concat(x.nombre, " " ,apaterno, " " ,amaterno) AS nombre, fecha, cd.id_producto, p.nombre AS producto, cd.cantidad, cd.precio_final, (cd.precio_final * cd.cantidad) AS monto from carrito c JOIN cliente x ON c.id_cliente = x.id_cliente JOIN carrito_detalle cd ON c.id_carrito = cd.id_carrito join producto p ON p.id = cd.id_producto WHERE c.id_carrito = :id_carrito;';
    $stmt = $admin->con->prepare($sql);
    $stmt->bindParam(':id_carrito', $id_carrito);
    $stmt->execute();
    $historial = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $content = "<h1>Factura</h1>";
    $content .= '<h3 style="color:red">Cliente: '.$historial[0]['nombre'].'</h3>';
    $content .= '<h3>Fecha: '.$historial[0]['fecha'].'</h3>';
    $content .= '<table>
                    <tr>
                        <th>Nombre producto</th>
                        <th>Cantidad</th>
                        <th>Precio</th>
                        <th>Subtotal</th>
                    </tr>';
    for ($i=0; $i < sizeof($historial); $i++) {
        $content .= '<tr>
                        <td>'.$historial[$i]['producto'].'</td>
                        <td>'.$historial[$i]['cantidad'].'</td>
                        <td>'.$historial[$i]['precio_final'].'</td>
                        <td>'.$historial[$i]['monto'].'</td>
                    </tr>';
    }
    $content .= '</table>';
    require_once('../lib/html2pdf/vendor/autoload.php');
    try
    {
        $html2pdf = new HTML2PDF('P', 'A4', 'fr');
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        $html2pdf->Output('factura.pdf');
    }
    catch(HTML2PDF_exception $e) {
        echo $e;
        exit;
    }
