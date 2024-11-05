 <div class="mantenimiento-kebab">
     <!-- Título principal centrado -->
     <div class="titulo-container">
         <h1 class="titulo-principal">Mantenimiento de Kebab</h1>
     </div>

     <div class="container-kebab">
         <!-- Sección izquierda -->
         <div class="left-section">
             <div class="foto">
                 <p>Foto</p>
             </div>
             <div class="precio">
                 <p>Precio</p>
             </div>
             <div class="descripcion">
                 <p>Descripción</p>
                 <textarea placeholder="Escribe la descripción aquí..."></textarea>
             </div>
         </div>

         <!-- Sección central -->
         <div class="middle-section">
             <div class="ingredientes">
                 <p>Ingredientes</p>
                 <div class="ingredientes-lista">
                     <div class="ingrediente">
                         <input type="checkbox" id="ing1">
                         <label for="ing1">Ingrediente 1</label>
                     </div>
                     <div class="ingrediente">
                         <input type="checkbox" id="ing2">
                         <label for="ing2">Ingrediente 2</label>
                     </div>
                     <div class="ingrediente">
                         <input type="checkbox" id="ing3">
                         <label for="ing3">Ingrediente 3</label>
                     </div>
                     <!-- Más ingredientes -->
                 </div>
             </div>
             <div class="precio-estimado">
                 <p>Precio estimado</p>
             </div>
         </div>

         <!-- Sección derecha -->
         <div class="right-section">
             <div class="filtro">
                 <p>Filtro</p>
                 <input type="text" placeholder="Buscar...">
                 <select>
                     <option>Añadir</option>
                     <!-- Más opciones -->
                 </select>
             </div>
         </div>

     </div>

     <!-- Sección de botones centrados -->
     <div class="botones-container">
         <button class="cancelar-btn">Cancelar</button>
         <button class="guardar-btn">Guardar</button>
     </div>
 </div>
 