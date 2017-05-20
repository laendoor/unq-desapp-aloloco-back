# aLoLoco :: Grupo E :: Di Lorenzo - Matkorski

## Tag Entrega-1

### New Features

#### Checklist de la entrega

 - [x] Creación de [repositorios](https://github.com/Grupo-E-012017/aloloco)
 - [x] Configuración en [Travis](https://travis-ci.org/Grupo-E-012017/aloloco)
 - [x] Estado de build en verde
 - [x] Configrar el proyecto en [codacy](https://www.codacy.com/app/Grupo-E-012017/aLoLoco/dashboard)
 - [x] Coverage al 90%
 - [x] [Diagrama UML](https://raw.githubusercontent.com/Grupo-E-012017/aloloco/master/doc/design.png)
 - [x] 2 [Mockup](https://raw.githubusercontent.com/Grupo-E-012017/aloloco/master/doc/mockups.png) de las ventanas de la aplicación
 - [x] [Pantalla prototipo](https://aloloco-grupo-e.herokuapp.com/) del uso de la API de gmaps
 - [x] Deploy automático utlizando Heroku
 - [x] TAG en GitHub
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
 - [x] Estado de build en "Verde"
 - [x] Memory SQLite
 - [x] Datos "fake" para probar la aplicación
 - [ ] I18n- US_ES
 - [x] Implementación de Layout de backend según la arquitectura definida
 - [x] Implementación del tier de Presentación como aplicación independiente (que levante)
 - [x] TAG en GitHub
 - [x] Confeccionar Release Notes de entrega 1 (https://drive.google.com/file/d/0BxyNm_rQ4Q8vZU52eF9QeXR4X3M/view)
 
 ##### Funcionalidad
 - [x] Listar productos
 - [x] Agregar productos al carrito de compras 
 - [x] Encolar Pedido para su posterior pago
 - [x] Subir archivo de productos Batch <ID, Nombre, Marca, Stock, Precio, Imagen>
 
 #### Front End
 
Se creó un nuevo proyecto para desarrollar el front end, el repositorio del mismo se encuentra en 
https://github.com/Grupo-E-012017/aloloco-front y la aplicación se puede utilizar en https://aloloco-grupo-e-front.herokuapp.com/. 

Para gestionar las dependencias de desarrollo utilizamos Npm y para las del front end, Bower. 

El framework integrado para desarrollar la aplicación fue Angular, principalmente hicimos uso del router 
e integramos Restangular para interactuar con la API Rest del back end (todos los datos que se pueden ver 
en la aplicacion servidos por el back end. Para darle estilos al front end utilizamos Bootstrap y Fontawesome. 
La aplicación ya cuenta con un gran soporte para dispositivos móviles aunque no en su totalidad. Se integró angular-i18n
el cual se encargar del formateo y traduccion de distintas cuestiones como los días y formatos de hora y fechas entre otras.

Las vistas desarrolladas para esta entrega son:

- Home: Permite ver el listado de wishlists del usuario (asumimos que ya se encuentra logeado).

- Wishlist: Vista interna de una wishlist desde la cual se pueden ver los productos de la misma.

- Creación de wishlists: Permite asignar un nombre y productos para la creación de nuevas wishlists, todavía no 
se persiste y falta mejorar la UX. 

- Mapa: Integración con Google Maps para mostrar el camino de un punto a otro y la distancia entre estos. 

- Carga por Batch: Formulario con un input para realizar la carga de productos desde un CSV.
 
#### Back End

 - La aplicación de backend cumple ahora el rol de API REST. Se establecieron las siguientes rutas:

 * `GET /`: Retorna información de la aplicación.
 * `GET /client`: Retorna datos del usuario autenticado.
 * `GET /client/wishlists`: Retorna las listas de compras del usuario autenticado;
    cada lista despliega los productos de la misma.
 * `GET /stock`: Retorna la lista de productos en stock
 * `POST|PUT /stock`: Recibe el archivo csv de productos y actualiza el stock

 - Se logró incorporar correctamente Doctrine como ORM, aplicándolo en las clases de usuario, cliente, listas y productos.
 
 - Se generaron los test necesarios para verificar el funcionamiento del ORM en las clases descriptas.
 
 - Se generaron servicios _bindeados_ que cumplen con _Repository Pattern_ para la manipulación de los objetos
   persistentes, a la vez que fueron incorporados al IoC para permitir la inyección de los mismos en los Controladores.
   
 - Se establecieron _Seeders_ con valores de prueba para lograr contar con una aplicación funcional.
 
 - Se logró configurar correctamente el servidor en Heroku, permitiendo la correcta comunicación entre
   el frontend y el backend.