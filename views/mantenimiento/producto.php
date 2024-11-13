<style>
    .product-window {
        display: flex;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        max-width: 600px;
        margin: 20px auto;
        font-family: Arial, sans-serif;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-image img {
        max-width: 100%;
        border-radius: 5px;
    }

    .product-details {
        flex: 2;
        margin-left: 20px;
    }

    .product-title {
        font-size: 1.5em;
        font-weight: bold;
        margin: 0;
        color: #333;
    }

    .product-rating {
        margin: 10px 0;
        color: #ffa41c;
        font-size: 0.9em;
    }

    .product-price {
        font-size: 1.3em;
        font-weight: bold;
        color: #b12704;
        margin: 10px 0;
    }

    .product-description {
        margin: 15px 0;
        font-size: 0.9em;
        color: #555;
    }

    .product-ingredients,
    .product-allergens {
        margin: 15px 0;
    }

    .product-ingredients h2,
    .product-allergens h2 {
        font-size: 1.1em;
        color: #333;
        margin-bottom: 10px;
    }

    .product-ingredients ul {
        list-style: none;
        padding: 0;
        margin: 0;
        max-height: 100px;
        overflow-y: auto;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .product-ingredients ul li {
        font-size: 0.9em;
        color: #555;
        padding: 5px 0;
    }

    .product-allergens .allergen-icons {
        display: flex;
        gap: 10px;
    }

    .product-allergens .allergen-icons img {
        width: 40px;
        height: 50px;
        border-radius: 5px;
    }

    .product-options {
        margin: 15px 0;
        font-size: 0.9em;
    }

    .product-options select {
        padding: 5px;
        margin-left: 10px;
    }

    .buy-buttons {
        display: flex;
        gap: 10px;
    }

    .add-to-cart,
    .buy-now {
        flex: 1;
        padding: 10px;
        font-size: 1em;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .add-to-cart {
        background-color: #ffd814;
        color: #111;
    }

    .buy-now {
        background-color: #e47911;
        color: white;
    }

    .todos-ingredientes {
        display: none;
    }

    .ingredientes-list {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        max-width: 400px;
        height: auto;
        overflow-y: auto;
        background-color: #f9f9f9;
        margin-left: 50px;
    }

    .ingredientes-list .ingrediente {
        padding: 10px;
        background-color: #cac7c7;
        font-weight: bold;
        border: 1px solid #ff9100;
        border-radius: 5px;
        min-width: 100px;
        text-align: center;
        cursor: pointer;
        transition: 0.5s;
    }

    .ingredientes-list .ingrediente:hover {
        background-color: #ff9100;
    }
</style>

<?php

$id = $_GET['id'];
$kebab = KebabRep::getbyId($id);
$ingredientes = IngredientesRep::getAll();
?>
<div class="product-window" id="product-window">
    <input type="hidden" id="productophp" value='<?php echo json_encode($kebab->ingredientes); ?>'>
    <input type="hidden" id="allingredientes" value='<?php echo json_encode($ingredientes); ?>'>
    <div class="product-image">
        <img src="../../assets/img/<?php echo $kebab->foto; ?>" alt="Imagen del producto">
    </div>
    <div class="product-details">
        <h1 class="product-title"><?php echo $kebab->nombre; ?></h1>
        <div class="product-price">
            <span><?php echo $kebab->precio; ?> €</span>
        </div>

        <div class="product-ingredients">
            <h2>Ingredientes</h2>
            <ul id="ingredientes">
            </ul>
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
            <button class="add-to-cart">Agregar al carrito</button>
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



<script>
    const ingredientes = document.getElementById('ingredientes');
    const ingredientesLista = JSON.parse(document.getElementById('productophp').value);
    ingredientesLista.forEach(ingrediente => {
        const ingredienteLi = document.createElement('li');
        ingredienteLi.innerHTML = `- ${ingrediente.nombre} -> ${ingrediente.precio} €`;
        ingredientes.appendChild(ingredienteLi);
    });

    const allergen = document.getElementById('lista-alergenos');
    const allergens = JSON.parse('<?php echo json_encode($kebab->ingredientes); ?>');
    allergens.forEach(Ingrediente => {
        Ingrediente.alergenos.forEach(alergeno => {
            const icon = document.createElement('img');
            icon.src = '../../assets/img/alergenos/' + alergeno.foto;
            icon.alt = alergeno.nombre;
            icon.title = alergeno.nombre;
            allergen.appendChild(icon);
        });
    });

    const personalizarbtn = document.getElementById('per-btn');
    const allingredientes = JSON.parse(document.getElementById('allingredientes').value);
    const ingredientesdiv = document.getElementById('ingredientes-div');
    const ingredienteslist = document.getElementById('todos-ingredientes-list');
    const productdeatils = document.getElementById('product-window');
    let val = false;

    personalizarbtn.addEventListener('click', function() {
        productdeatils.style.maxWidth = "1000px";
        ingredientesdiv.style.display = 'block';

        if (val == false) {
            allingredientes.forEach(element => {
                val = true;
                // Crea un nuevo div para cada ingrediente
                const divIngrediente = document.createElement("div");

                // Asigna la clase "ingrediente" al div
                divIngrediente.className = "ingrediente";

                // Asigna el nombre del ingrediente como contenido del div
                divIngrediente.textContent = element.nombre + ' -> ' + element.precio + ' €';

                // Añade el div al contenedor
                ingredienteslist.appendChild(divIngrediente);
            });
        }

        personalizarbtn.textContent = "Guardar";

        personalizarbtn.addEventListener('click', function() {
            productdeatils.style.maxWidth = "600px";
            ingredientesdiv.style.display = 'none';
            val = false;
            personalizarbtn.textContent = "Personalizar";
        });


    });
</script>