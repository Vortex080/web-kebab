<div class="content">
    <!-- Contenedor principal -->
    <?php

    if (LogIn::statusLogin()) {

        echo '<h2 class="bienvenido">Bienvenido ' . $_SESSION['user']->nombre . '</h2>';
    }


    ?>
    <div class="carousel-container">
        <!-- Carousel de imágenes -->
        <div class="carousel">
            <div class="carousel-text">
                La carne de mejor calidad<br>
                Producción y distribución de kebab.
            </div>
            <button class="carousel-control-prev" onclick="prevSlide()">&#10094;</button>
            <button class="carousel-control-next" onclick="nextSlide()">&#10095;</button>
            <!---img src="https://dolciakebab.com/image/cache/catalog/DolciaKebab3/Banners/carne-de-kebab-960x450.jpg" alt="Kebab 1" id="carouselImage">--->
        </div>

        <!-- Productos a la derecha -->
        <div class="products">
            <div class="product-card">
                <!--<img src="https://dolciakebab.com/image/cache/catalog/DolciaKebab3/Banners/b1-320x210w-320x210.png" alt="Pinchos de Kebab id=" b1product-image">-->
                <div class="product-title">PINCHOS DE KEBAB</div>
                <p>Filete<br>Pollo<br>Ternera</p>
                <
                    </div>
                    <div class="product-card">
                        <!--<img src="https://dolciakebab.com/image/cache/catalog/DolciaKebab3/Banners/b1-320x21ddd0w-320x210.png" alt="Loncheado de Kebab" id="b1product-image">
                <div class="product-title">LONCHEADO DE KEBAB</div>
                <p>Carne de Kebab<br>Pollo<br>Ternera</p>
            </div>
        </div>
    </div>

    <!-- Sección de características -->
                        <div class="features">
                            <div class="feature-item">
                                <h4>Máxima calidad</h4>
                                <p>Nuestra carne cumple con los estándares en materia de seguridad alimentaria.</p>
                            </div>
                            <div class="feature-item">
                                <h4>Atención al Cliente</h4>
                                <p>Lunes a Viernes: 8:00 a 15:00<br>Oficinas: 952 435 277</p>
                            </div>
                            <div class="feature-item">
                                <h4>Compras Seguras</h4>
                                <p>Las mejores características de seguridad</p>
                            </div>
                            <div class="feature-item">
                                <h4>Entrega en 48-72 horas</h4>
                                <p>Consulta para tu población</p>
                            </div>
                        </div>
                    </div>