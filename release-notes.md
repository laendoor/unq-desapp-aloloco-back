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
   * Client puede administrar listas, productos umbrales
   * Admin puede establecer stock
 - Las listas de compras están establecidas por _ShoppingList_ con estado (ver UML)
 - Los _Product_ pueden ser:
    * _Wished_ (aquellos administrador por el Client)
    * _Stocked_ (aquellos administrador por el Admin para el Market)
 - Cada _WishedProduct_ tiene un estado similara las ShoppingList (ver UML)
 - Los _Threshold_ definen los umbrales en base a un precio
 - El _Price_ encapsula el comportamiento del valor del producto para evitar errores de manipulación de valores flotantes

#### Testing

 La construcción del modelo se realizó bajo la práctica TDD, con lo cual el modelo
 descripto cuenta con los tests unitarios correspondientes.

#### Notas

 - El Client no cuenta con todo el comportamiento deseado. Si bien puede administrar
   sus elementos (listas, umbrales, productos), no establece el comportamiento con
   respecto a sus actividades: ir al supermercado, agregar producto al carrito,
   pedir turno en caja, pagar lista, pedir delivery, etc.
 - El Market no cuenta con su comportamiento propio
 - Las Box no cuentan con su comportamiento propio
 - No está generado el algoritmo de calculo de tiempo estimado de espera al solicitar caja
 - Las Offers no cuentan con su comportamiento propio