## Detalles del proyecto

- Laravel 5.8
- PHP >= 7.3
- Mysql
- [Fuente de la prueba tecnica](https://hackmd.io/@afbc07/SyCYMdxMD)

## Instrucciones de Ejecución

Para realizar la verificación de los puntos de la prueba tenica se deben seguir los siguientes pasos:

- Despues de clonar el repositorio, ejecutar el comando ```composer update``` dentro de la carpeta del proyecto.

- Cambiar la conexion a la base de datos en Mysql en el archivo .env del proyecto. En este archivo se modifican las variables DB_HOST, DB_PORT, DB_DATABASE (pruebaquick fue el nombre asignado en la prueba), DB_USERNAME, DB_PASSWORD. Para la prueba tecnica se ha usado la herramiento SQLyog el cual proporciona unos parametros por defecto para la conexion a la base datos.

- Generar la base de datos en la herramienta a usar.  Dentro del proyecto se agregó el archivo sql **basedatos.sql** con la estructura y datos iniciales para verificar la prueba tecnica.

- Dentro de la verificacion de los servicios API rest se utilizó la herramienta Postman, pero no es obligatorio su uso. Si se desea usar dicha herramienta, en el proyecto existe un archivo llamado **PruebaQuick.postman_collection.json**, el cual contiene ejemplos para realizar la verificación de la prueba tecnica.

## Notas Adicionales

- Despues de ejecutar el servicio **/login** el token jwt generado se debe agregar como cabecera o header en las conexiones a los demas servicios api rest, el cual tiene como clave *Authorization* y su valor es _Bearer token_. Ejemplo: _Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3RcL1BydWViYVRlY25pY2FcL3B1YmxpY1wvYXBpXC9sb2dpbiIsImlhdCI6MTYwMzA0Mzc2NCwiZXhwIjoxNjAzMDQ3MzY0LCJuYmYiOjE2MDMwNDM3NjQsImp0aSI6ImYycEJ0ZGFkNmVVMjEwS20iLCJzdWIiOjEsInBydiI6Ijg3ZTBhZjFlZjlmZDE1ODEyZmRlYzk3MTUzYTE0ZTBiMDQ3NTQ2YWEifQ.PAjqrvZmjZMBcoD51gV1S9LfJDZp1ef0WOYB7b6lFgw_.

- Las contraseñas de los usuarios estan encriptadas con el método sha1. Por lo general se usó la palabras SECRET o 1234 como contraseña. Dentro del archivo de Postman están los ejemplos con las contraseñas.
