<div class="product-container" id="productContainer"></div>
<?php

    if(isset($_SESSION['user'])){
        echo '<script type="module" src="../../assets/js/menu-registrado.js"></script>';
    }else{
        echo '<script type="module" src="../../assets/js/menu-noregistrado.js"></script>';
    }

?>
