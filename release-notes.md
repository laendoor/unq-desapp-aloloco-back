# aLoLoco :: Grupo E :: Di Lorenzo - Matkorski

## Tag Entrega-1

### New Features

#### Checklist de la entrega

 - [x] Creación de [repositorios](https://github.com/Grupo-E-012017/aloloco)
 - [x] Configuración en [Travis](https://travis-ci.org/Grupo-E-012017/aloloco)
 - [x] Estado de build en verde
 - [x] Configrar el proyecto en [codacy](https://www.codacy.com/app/Grupo-E-012017/aLoLoco/dashboard)
 - [ ] Coverage al 90% (_REVISAR ANTES DE TAGGEAR_)
 - [x] [Diagrama UML](https://raw.githubusercontent.com/Grupo-E-012017/aloloco/master/doc/design.png)
 - [x] 2 [Mockup](https://raw.githubusercontent.com/Grupo-E-012017/aloloco/master/doc/mockups.png) de las ventanas de la aplicación
 - [x] [Pantalla prototipo](https://aloloco-grupo-e.herokuapp.com/) del uso de la API de gmaps
 - [x] Deploy automático utlizando Heroku
 - [ ] TAG en GitHub (_TODO_)
 - [x] Confeccionar Release Notes de entrega 1
 - [x] Clean Code según la materia (todo en Ingles)
 - [x] Testing según las pautas de la materia
 
#### Modelo

 - Existen dos tipos de _User_: Client & Admin.
   * Client puede administrar listas, productos umbrales. Pueden ir al supermercado con una lista
     y tildar y destildar productos de esa lista.
   * Admin puede establecer stock.
 - Las listas de compras están establecidas por _ShoppingList_ con estado (ver UML)
 - Los _Product_ pueden ser:
    * _Wished_ (aquellos administrador por el Client)
    * _Stocked_ (aquellos administrador por el Admin para el Market)
 - Cada _WishedProduct_ tiene un estado similara las ShoppingList (ver UML)
 - Los _Threshold_ definen los umbrales en base a un precio
 - El _Price_ encapsula el comportamiento del valor del producto para evitar errores de manipulación de valores flotantes
 - El _Market_ permite administrar el stock y agregar Cajas de pago. También puede calcular
   el tiempo estimado de espera en base al tiempo promedio de espera de cada caja.
 - Cada _Box_ cuenta con una lista de _BoxTime_ que permite abstraer la lógica del tiempo que tardó cada cliente
   en esa caja. Cada _BoxTime_ registra la fecha-hora de comienzo de atención y el tiempo que duró la operación.

#### Testing

 La construcción del modelo se realizó bajo la práctica TDD, con lo cual el modelo
 descripto cuenta con los tests unitarios correspondientes.

#### Notas

 - El Client no cuenta con todo el comportamiento deseado. Si bien puede administrar
   sus elementos (listas, umbrales, productos), no establece el comportamiento con
   respecto a las siguientes actividades: pedir turno en caja, pagar lista, pedir delivery.
 - Si bien el Market cuenta con su comportamiento deseado, no está completamente testeado.
 - Al Market le falta el comportamiento correspondiente a las ofertas.
 - Si bien el Box cuenta con su comportamiento, no está exhaustivamente testeado por unos inconvenientes con los Mocks.
 - Las Offers no cuentan con su comportamiento propio.
 
 ## Tag Entrega-2
 
 #### Checklist de la entrega
 
 ##### Core 
 - [ ] Estado de build en "Verde"
 - [ ] Memory SQLite
 - [ ] Datos "fake" para probar la aplicación
 - [ ] I18n- US_ES
 - [ ] Implementación de Layout de backend según la arquitectura definida
 - [ ] Implementación del tier de Presentación como aplicación independiente (que levante)
 - [ ] TAG en GitHub
 - [ ] Confeccionar Release Notes de entrega 1 (https://drive.google.com/file/d/0BxyNm_rQ4Q8vZU52eF9QeXR4X3M/view)
 
 ##### Funcionalidad
 - [x] Listar productos
 - [ ] Agregar productos al carrito de compras 
 - [ ] Encolar Pedido para su posterior pago
 - [x] Subir archivo de productos Batch <ID, Nombre, Marca, Stock, Precio, Imagen>
 
 #### Front End
 
Se creó un nuevo proyecto para desarrollar el front end, el repositorio del mismo se encuentra en <url>. 
Para gestionar las dependencias de desarrollo utilizamos Npm y para las del front end, Bower. 

El framework integrado para desarrollar la aplicación fue Angular, principalmente hicimos uso del router 
e integramos Restangular para interactuar con la API Rest del back end. Para darle estilos al front end
utilizamos Bootstrap y Fontawesome. Si bien no en su totalidad, la aplicación ya cuenta con un gran 
soporte para dispositivos moviles. 

Las vistas desarrolladas para esta entrega son:

- Home: Permite ver el listado de wishlists del usuario (asumimos que ya se encuentra logeado).
- Wishlist: Vista interna de una wishlist desde la cual se pueden ver los productos de la misma.
- Creación de wishlists: Permite asignar un nombre y productos para la creacion de nuevas wishlists, aun no se realiza
el guardado y falta mejorar la UX. 
- Mapa: Integración con Google Maps para mostrar el camino de un punto a otro y la distancia entre estos. 
- Carga por Batch: Formulario con un input para realizar la carga de productos desde un CSV.
 