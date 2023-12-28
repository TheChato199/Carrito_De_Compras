<?php

include 'conexion.php';

if(isset($_POST['order_btn'])){

    $nombre = $_POST['nombre'];
    $numero = $_POST['numero'];
    $email = $_POST['email'];
    $metodo = $_POST['metodo'];
    $flat = $_POST['flat'];
    $calle = $_POST['calle'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $pin_code = $_POST['pin_code'];

    $cart_query = mysqli_query($con, "SELECT * FROM `cart`");
    $price_total = 0;
    if(mysqli_num_rows($cart_query) > 0){
        while($product_item = mysqli_fetch_assoc($cart_query)){
            $product_name[] = $product_item['nombre'] .' ('. $product_item['cantidad'] .') ';
            $product_price = number_format($product_item['precio'] * $product_item['cantidad']);
            $price_total += $product_price;
        };
    };

    $total_product = implode(', ',$product_name);
    $detail_query = mysqli_query($con, "INSERT INTO `order`(nombre, numero, email, metodo, flat, calle, ciudad, pais, pin_code, total_products, total_precio) VALUES('$nombre','$numero','$email','$metodo','$flat','$calle','$ciudad','$pais','$pin_code','$total_product','$price_total')") or die('query failed');

    if($cart_query && $detail_query){
        echo "
        <div class='order-message-container'>
        <div class='message-container'>
            <h3>gracias por comprar!</h3>
            <div class='order-detail'>
                <span>".$total_product."</span>
                <span class='total'> total : $".$price_total."/-  </span>
            </div>
            <div class='customer-details'>
                <p> tu nombre : <span>".$nombre."</span> </p>
                <p> tu numero : <span>".$numero."</span> </p>
                <p> tu email : <span>".$email."</span> </p>
                <p> tu direccion : <span>".$flat.", ".$calle.", ".$ciudad.", ".$pais." - ".$pin_code."</span> </p>
                <p> tu modo de pago : <span>".$metodo."</span> </p>
                <p>(*Pague cuando llegue el producto*)</p>
            </div>
                <a href='products.php' class='btn'>seguir comprando</a>
            </div>
        </div>
        ";
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

    <h1 class="heading">Complete su orden</h1>

    <div class="display-order">

        <?php
            $select_cart = mysqli_query($con, "SELECT * FROM `cart`");
            $total = 0;
            $grand_total = 0;
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                $total_precio = number_format($fetch_cart['precio'] * $fetch_cart['cantidad']);
                $grand_total = $total += $total_precio;
        ?>
        <span><?= $fetch_cart['nombre']; ?>(<?= $fetch_cart['cantidad']; ?>)</span>
        <?php
            }
        }else{
            echo "<div class='display-order'><span>your cart is empty!</span></div>";
        }
        ?>
        <span class="grand-total"> grand total : $<?= $grand_total; ?>/- </span>
    </div>

    <form action="" method="post">
        <div class="flex">
            <div class="inputBox">
                <span>tu nombre</span>
                <input type="text" placeholder="Ingrese su nombre" name="nombre" required>
            </div>
            <div class="inputBox">
                <span>tu numero</span>
                <input type="number" placeholder="Ingrese su numero" name="numero" required>
            </div>
            <div class="inputBox">
                <span>tu email</span>
                <input type="email" placeholder="Ingrese su email" name="email" required>
            </div>
            <div class="inputBox">
                <span>metodo de pago</span>
                <select name="metodo">
                    <option value="efectivo o delivery" selected>efectivo o delivery</option>
                    <option value="tarjeta de credito">tarjeta de credito</option>
                    <option value="D1">deUna</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Direccion linea 1</span>
                <input type="text" placeholder="e.g. flat no." name="flat" required>
            </div>
            <div class="inputBox">
                <span>Direccion linea 2</span>
                <input type="text" placeholder="e.g. street name" name="calle" required>
            </div>
            <div class="inputBox">
                <span>Ciudad</span>
                <input type="text" placeholder="e.g. loja" name="ciudad" required>
            </div>
            <div class="inputBox">
                <span>Pais</span>
                <input type="text" placeholder="e.g. ecuador" name="pais" required>
            </div>
            <div class="inputBox">
                <span>codigo pin</span>
                <input type="text" placeholder="e.g. 123456s" name="pin_code" required>
            </div>
        </div>
        <input type="submit" value="order now" name="order_btn" class="btn">
    </form>
</section>

</div>

<!-- custom css file link  -->
<script src="js/script.js"></script>
</body>
</html>