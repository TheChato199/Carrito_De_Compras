<?php 

include 'conexion.php';

    if(isset($_POST['agg_producto'])){
        $p_nombre = $_POST['p_nombre'];
        $p_precio = $_POST['p_precio'];
        $p_imagen = $_FILES['p_imagen']['name']; //revisar name o nombre
        $p_image_tmp_name = $_FILES['p_imagen']['tmp_name'];
        $p_image_folder = 'uploaded_img/'.$p_imagen;

        $insert_query = mysqli_query($con, "INSERT INTO `products`(nombre, precio, imagen) VALUES
        ('$p_nombre', '$p_precio', '$p_imagen')") or die('query failed');

        if($insert_query){
            move_uploaded_file($p_image_tmp_name, $p_image_folder);
            $message[] = 'producto agregado exitosamente';
        }else{
            $message[] = 'no se pudo agregar el producto';
        }
    };

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($con, "DELETE FROM `products` WHERE id = $delete_id ") or die('query failed');
        if($delete_query){
            header('location:admin.php');
            $message[] = 'el producto ha sido eliminado';
        }else{
            header('location:admin.php');
            $message[] = 'El producto no se pudo eliminar';
        };
    };

if(isset($_POST['update_product'])){
    $update_p_id = $_POST['update_p_id'];
    $update_p_nombre = $_POST['update_p_nombre'];
    $update_p_precio = $_POST['update_p_precio'];
    $update_p_imagen = $_FILES['update_p_imagen']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_imagen']['tmp_name'];
    $update_p_image_folder = 'uploaded_img/'.$update_p_imagen;

    $update_query = mysqli_query($con, "UPDATE `products` SET nombre = '$update_p_nombre', precio = '$update_p_precio', imagen = '$update_p_imagen' WHERE id = '$update_p_id'");
    if($update_query){
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[] = 'producto actualizado exitosamente';
        header('location:admin.php');
    }else{
        $message[] = 'el producto no se pudo actualizar';
        header('location:admin.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>

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
    <input type="number" name="p_precio" min="0" placeholder="Ingrese el precio del producto" class="box" required>
    <input type="file" name="p_imagen" accept="imagen/png, imagen/jpg, imagen/jpeg " class="box" required>
    <input type="submit" value="Agregar el producto" name="agg_producto" class="btn">
</form>

</section>

<section class="display-product-table">

    <table>

        <thead>

            <th>Nombre Imagen</th>
            <th>Nombre Producto</th>
            <th>Producto Precio</th>
            <th>action</th>

        </thead>

        <tbody>
            <?php
            
                $select_products = mysqli_query($con, "SELECT * FROM `products`");
                if (mysqli_num_rows($select_products) > 0){
                    while($row = mysqli_fetch_assoc($select_products)){
            ?>

            <tr>
                <td><img src="uploaded_img/<?php echo $row['imagen']; ?>" height="100" alt=""></td>
                <td><?php echo $row['nombre']; ?></td>
                <td><?php echo $row['precio']; ?>/-</td>
                <td>
                    <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" 
                    onclick="return confirm('¿Estás seguro de que quieres eliminar esto?');"> <i 
                    class="fas fa-trash"></i>Eliminar</a>
                    <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i>Editar</a>
                </td>
            </tr>

            <?php
                    };
                }else{
                    echo "<div class='empty'>No se agrego el producto</div>";
                }
            ?>
        </tbody>

    </table>

</section>

<section class="edit-form-container">

    <?php

    if(isset($_GET['edit'])){   
        $edit_id = $_GET['edit'];
        $edit_query = mysqli_query($con, "SELECT * FROM `products` WHERE id = $edit_id");
        if(mysqli_num_rows($edit_query) > 0){
            while($fetch_edit = mysqli_fetch_assoc($edit_query)){
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <img src="uploaded_img/<?php echo $fetch_edit['imagen']; ?>" height="200" alt="">
        <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
        <input type="text" class="box" required name="update_p_nombre" value="<?php echo $fetch_edit['nombre']; ?>">
        <input type="number" min="0" class="box" required name="update_p_precio" value="<?php echo $fetch_edit['precio']; ?>">
        <input type="file" class="box" required name="update_p_imagen" accept="imagen/png, imagen/jpg, imagen/jpeg">
        <input type="submit" value="actualizar el producto" name="update_product" class="btn">
        <input type="reset" value="cancel" id="close-edit" class="option-btn">
    </form>

    <?php
                };
            };
            echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
        };  
    ?>

</section>

</div>

<!-- custom css file link  -->
<script src="js/script.js"></script>

</body>
</html>