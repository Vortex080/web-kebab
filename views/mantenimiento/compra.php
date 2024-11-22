<link rel="stylesheet" href="../../assets/css/compra.css">
<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <input type="text" id="dineroinp" placeholder="Dinero a añadir ...">
        <button id="cerrarbtn">Cerrar</button>
    </div>
</div>
<div class="cart-overlay">
    <div class="checkout-container">
        <!-- Sección izquierda -->
        <div class="left-section">
            <div class="styled-box">
                <h3>Dirección de entrega</h3>
                <!-- Nuevo div para Dirección, Estado y el botón -->
                <div class="address-info">
                    <p id="direccion">Dirección</p>
                    <p class="line-break" id="estado-dir">Estado</p> <!-- Esta clase ayudará a añadir un salto de línea -->
                    <!-- Botón dentro de address-info -->
                    <!-- <button class="address-button" id="">Cambiar Dirección</button> -->
                </div>
            </div>
            <div class="styled-box">
                <h3>Monedero</h3>
                <!-- Nuevo div para Dirección, Estado y el botón -->
                <div class="address-info" id="dinero">
                    <p>Dinero en el monedero:</p>
                    <span id="monedero">0€</span>
                    <p>Flujo de la cuenta:</p> <!-- Esta clase ayudará a añadir un salto de línea -->
                    <span id="flujo-cuenta">0€€</span>
                    <!-- Botón dentro de address-info -->
                    <!-- <button class="address-button" id="">Cambiar Dirección</button> -->
                </div>
            </div>
        </div>

        <!-- Sección derecha -->
        <div class="right-section" id="right-section">
            <h3>Resumen de la compra</h3>
            <div class="cart-container" id="cart-container">
                <!-- Contenedor para los productos -->
            </div>

            <div class="summary-container">
                <div class="summary-total">
                    <p>Total: <span id="total">0</span> €</p>
                    <button class="address-button" id="checkout-btn">Finalizar Compra</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="module" src="../../assets/js/compra.js"></script>