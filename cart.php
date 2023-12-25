<?php

include 'conexion.php';

if(isset($_POST['update_update_btn'])){
    $update_value = $_POST['update_cantidad'];
    $update_id = $_POST['update_cantidad_id'];
    $update_quantity_query = mysqli_query($con, "UPDATE `cart` SET cantidad = '$update_value' WHERE id = '$update_id'");
    if($update_quantity_query){
        header('location:cart.php');
    };
};
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id'");
    header('location:cart.php');
};
if(isset($_GET['delete_all'])){
    mysqli_query($con, "DELETE FROM `cart`");
    header('location:cart.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="shopping-cart">

    <h1 class="heading">Shopping Cart</h1>

    <table>
        <thead>
            <th>imagen</th>
            <th>nombre</th>
            <th>precio</th>
            <th>cantidad</th>
            <th>precio total</th>
            <th>accion</th>
        </thead>

        <tbody>

            <?php
    
            $select_cart = mysqli_query($con, "SELECT * FROM `cart`");
            $grand_total = 0;
            if(mysqli_num_rows($select_cart) > 0){
                while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>

            <tr>
                <td><img src="uploaded_img/<?php echo $fetch_cart['imagen']; ?>" height="100" alt=""></td>
                <td><?php echo $fetch_cart['nombre']; ?></td>
                <td>$<?php echo number_format($fetch_cart['precio']); ?>/-</td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="update_cantidad_id"  value="<?php echo $fetch_cart['id']; ?>" >
                        <input type="number" name="update_cantidad" min="1"  value="<?php echo $fetch_cart['cantidad']; ?>" >
                        <input type="submit" value="update" name="update_update_btn">
                    </form>   
                </td>
                <td>$<?php echo $sub_total = number_format($fetch_cart['precio'] * $fetch_cart['cantidad']); ?>/-</td>
                <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('¿Eliminar artículo del carrito?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
            </tr>

            <?php
                $grand_total += $sub_total;  
                };
            };
            ?>
            <tr class="table-bottom">
                <td><a href="products.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
                <td colspan="3">gran total</td>
                <td>$<?php echo $grand_total; ?>/-</td>
                <td><a href="cart.php?delete_all" onclick="return confirm('¿Estás seguro de que quieres eliminar todo?');" class="delete-btn"> <i class="fas fa-trash"></i> Eliminar todo </a></td>
            </tr>

        </tbody>
    </table>
    <div class="checkout-btn">
        <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceder al pago</a>
    </div>
</section>

</div>

<!-- custom css file link  -->
<script src="js/script.js"></script>
    
</body>
</html>