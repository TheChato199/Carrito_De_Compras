<?php
include 'conexion.php';

if(isset($_POST['add_to_cart'])){

    $product_nombre = $_POST['product_nombre'];
    $product_precio = $_POST['product_precio'];
    $product_imagen = $_POST['product_imagen'];
    $product_cantidad = 1;

    $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE nombre = '$product_nombre'");

    if(mysqli_num_rows($select_cart) > 0){
        $message[] = 'El producto ya se ha añadido al carrito';
    }else{
        $insert_product = mysqli_query($con, "INSERT INTO `cart`(nombre, precio, imagen, cantidad) VALUES('$product_nombre', '$product_precio', '$product_imagen', '$product_cantidad')");
        $message[] = 'Producto añadido a la cesta con éxito';
    }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php

if(isset($message)){
    foreach($message as $message){
        echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
    };
};

?>

<?php include 'header.php'; ?>


<div class="continer">

<section class="products">

    <h1 class="heading">últimos productos</h1>

    <div class="box-container">

        <?php
        
            $select_products = mysqli_query($con, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_product = mysqli_fetch_assoc($select_products)){
        ?>
        <form action="" method="post">
            <div class="box">
                <img src="uploaded_img/<?php echo $fetch_product['imagen']; ?>" alt="">
                <h3><?php echo $fetch_product['nombre']; ?></h3>
                <div class="price">$<?php echo $fetch_product['precio']; ?>/-</div>
                <input type="hidden" name="product_nombre" value="<?php echo $fetch_product['nombre']; ?>">
                <input type="hidden" name="product_precio" value="<?php echo $fetch_product['precio']; ?>">
                <input type="hidden" name="product_imagen" value="<?php echo $fetch_product['imagen']; ?>">
                <input type="submit" class="btn" value="agregar al carrito" name="add_to_cart">
            </div>
        </form>
        <?php
            };
        };
        ?>

    </div>

</section>

</div>

<!-- custom css file link  -->
<script src="js/script.js"></script>
    
</body>
</html>