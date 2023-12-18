<?php 

@include 'config.php';

if(isset($_POST['agg_producto'])){
    $p_nombre = $_POST['p_nombre'];
    $p_precio = $_POST['p_precio'];
    $p_imagen = $_FILES['p_imagen']['name']; //revisar name o nombre
    $p_image_tmp_name = $_FILES['p_imagen']['tmp_name'];
    $p_image_folder = 'uploaded_img/'.$p_imagen;

    $insert_query = mysqli_query($conn, "INSERT INTO `products`(nombre, precio, imagen) VALUES
    ('$p_nombre', '$p_precio', '$p_imagen')") or die('query failed');

    if($insert_query){
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $message[] = 'product add succesfully';
    }else{
        $message[] = 'could not add the product';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Pagina</title>

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
    
<div class="container">

<section>

<form action="" method="post" class="add-producto-form" enctype="multipart/form-data">
    <h3>Agregar nuevo Producto</h3>
    <input type="text" name="p_nombre" placeholder="Ingrese el nombre del producto" class="box" required>
    <input type="number" name="p_precio" min="0" placeholder="Ingrese el nombre del producto" class="box" required>
    <input type="file" name="p_imagen" accept="imagen/png, imagen/jpg, imagen/jpeg " class="box" required>
    <input type="submit" value="Agregar el producto" name="agg_producto" class="btn">
</form>

</section>

</div>











<!-- custom css file link  -->
<script src"js/script.js"></script>

</=>
</html>