# KEBAB AMIGO

## Indice

- [KEBAB AMIGO](#kebab-amigo)
  - [Indice](#indice)
  - [Entidades (BD)](#entidades-bd)
  - [Relaciones](#relaciones)
  - [DIAGRAMA](#diagrama)
  - [Freatures](#freatures)
    - [Catalogo](#catalogo)
    - [Base de datos](#base-de-datos)
    - [Factura](#factura)
    - [Apis](#apis)
    - [Formato de la conexión con la API](#formato-de-la-conexión-con-la-api)
  - [Vistas](#vistas)
    - [Mantenimiento Kebab](#mantenimiento-kebab)
    - [Mantenimiento Usuario](#mantenimiento-usuario)
    - [Compra](#compra)

## Entidades (BD)

- Kebab
  - id
  - nombre
  - foto
  - ingredientes

- Ingredientes
  - id
  - nombre
  - alergenos [VARCHAR]

- Alergenos
  - ID
  - Nombre
  - Foto

- Usuario
  - id
  - foto
  - nombre
  - contraseña
  - dirección
  - monedero

- Linea de pedido

- Pedidos
  - Usuario
  - Linea de pedido
  - fecha, hora
  - Estado
  - Precio
  - Dirección

## Relaciones

- Kebab e Ingredientes (muchos a muchos)
-  Linea de pedido Kebabs 
- Alergenos e Ingredientes
- Alergenos y usuarios


## DIAGRAMA

![alt text](assets/img/data-base.png)

## Freatures

### Catalogo
- Creación de kebabs y muestra en el catalogo
- Copia y pega para la creación de kebab nuevo padre en el catalogo

### Base de datos

- Cambios en los kebabs se guarda como tupla nueva en la BD
- Guardar copia entera de los productos de la factura en la BD para evitar cambios de precios post compra
- Guarda nombre del kebab y concatena los ingredientes guardados o quitados 
- Array de productos de pedidos
  
```
{Orden de linea},cantidad, Nombre, Lista de ingredientes, precio total
```
```
{Orden de linea}, 4, kebab+queso+cebolla-lechuga, 2
```
```
[
	{
	"kebab": 3,
	"cantidad": 2,
	"ingredientes": "mixto+queso+cebolla",
	"precio": 2
	}
]
```




### Factura
- La linea de pedido es cada producto vendido con la factura (se detalla cada producto con ingredientes, precio, etc)

### Apis

**Api devuelta JSON**

```json
{
    "success": true, 
    "data": {
            "id": 1, 
            "nombre": "lechuga", 
            "alergenos": 1, 
            "precio": 130
    }, 
    "href" : "/App/Api/IngredienteApi.php?id=1"
}

```

### Formato de la conexión con la API
```js
async function NombreFuntion(variales) {

    try {
        // Asegurarnos de que los parámetros no sean undefined o null
        if (!variable || !variable) {
            throw new Error('Los valores son requeridos');
        }

        // Hacemos la solicitud GET usando fetch
        const response = await fetch(baseUrlUser, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ variable: variable })
        }); 
        // Verificamos si la respuesta fue exitosa
        if (!response.ok) {
            const errorMessage = await response.text(); // Obtener texto de la respuesta si hay error
            throw new Error(`Error ${response.status}: ${errorMessage}`);
        }

        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.log('Error al crear el user ', error);
    }
}

```

## Vistas

### Mantenimiento Kebab

![alt text](assets/img/mantenimiento_kebab.png)

Api Devuelve para lista ingregientes
- Ingredientes [Colección de objetos ingredientes]
- Kebab vacio
  
(Si se esta modifiando)
- Ingredientes 
- Kebab ya creado

>[!NOTE]
> Los ingregientes pasan del filtro de la derecha a la sección de ingredientes de la izquierda

### Mantenimiento Usuario
- ¿Mantenimiento de cuenta de usuario. Nombre, direcciones de envio, productos
usuales, etc….? => CLIENTE

### Compra

- Una vez añadido a mi pedido, puedo seguir añadiendo más Kebabs a mi pedido o
Finalizar la compra. (Tengo que poder editar los kebab que ya he añadido y poder
modificarlos) => CLIENTE (????)

- Si finalizo la compra correctamente, el administrador podrá ver que le ha llegado un
nuevo pedido y cambiar su estado como: Recibido, En preparación, Enviado o
Completado. => CLIENTE (????)

- Los usuarios podrán ver el estado de su pedido, además de ver los ítems de su pedido
y el desglose de ingredientes de cada item. => CLIENTE

- Si el usuario quiere cancelar el pedido, podrá hacerlo siempre que no entre en estado, si entra en ese estado no se puede devolver y no podrá
recuperar su dinero. => CLIENTE

>[!NOTE]
> Estados del pedido: Recibido, En preparación, Enviado o Completado ?????

**Pago**

- Para la simulación del pago, el usuario tendrá un “monedero”, donde se irá insertando
dinero en su cuenta de nuestra web y será con el que deba de hacer el pago y al que le
será devuelto en caso de pedido cancelado. => SERVIDOR


