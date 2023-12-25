<header class="header">

    <div class="flex">

        <a href="#" class="logoC">Comida</a>

        <nav class="navbar">
            <a href="admin.php">Agregar Productos</a>
            <a href="products.php">Ver Productos</a>
        </nav>

        <?php

        $select_rows = mysqli_query($con, "SELECT * FROM `cart`") or die('query failed');
        $row_count = mysqli_num_rows($select_rows);

        ?>

        <a href="cart.php" class="carrito">carrito <span><?php echo $row_count; ?></span></a>

        <div id="menu-btn" class="fas fa-bars"></div>

    </div>

</header>