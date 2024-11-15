<link rel="stylesheet" href="../../assets/css/producto.css">

<?php

$id = $_GET['id'];
$kebab = KebabRep::getbyId($id);
$ingredientes = IngredientesRep::getAll();
?>
<div class="product-window" id="product-window">
    <input type="hidden" id="productophp" value='<?php echo json_encode($kebab->ingredientes); ?>'>
    <input type="hidden" id="allingredientes" value='<?php echo json_encode($ingredientes); ?>'>
    <input type="hidden" id="productosql" value='<?php echo json_encode($kebab); ?>'>
    <div class="product-image">
        <img src="../../assets/img/<?php echo $kebab->foto; ?>" id="foto" alt="Imagen del producto">
    </div>
    <div class="product-details">
        <h1 class="product-title" id="product-title"><?php echo $kebab->nombre; ?></h1>
        <div class="product-price">
            <span id="product-price"><?php echo $kebab->precio; ?> €</span>
        </div>

        <div class="product-ingredients">
            <h2>Ingredientes</h2>
            <div id="ingredientes"></div>
        </div>

        <div class="product-allergens">
            <h2>Alérgenos</h2>
            <div class="allergen-icons" id="lista-alergenos">

            </div>
        </div>

        <div class="product-options">
            <label for="quantity">Cantidad:</label>
            <select id="quantity">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
        </div>

        <div class="buy-buttons">
            <button class="add-to-cart" id="carrito-btn">Agregar al carrito</button>
            <button class="buy-now" id="per-btn">Personalizar</button>
        </div>



    </div>
    <div>
        <div class="todos-ingredientes" id='ingredientes-div'>
            <label>Todos los Ingredientes</label>
            <div class="ingredientes-list" id="todos-ingredientes-list">
            </div>
        </div>
    </div>

</div>



<script type="module" src="../../assets/js/producto.js"></script>