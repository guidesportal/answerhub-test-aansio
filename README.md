## Test Laravel BLE "answerHub"

Este repositorio está preparado para que se deba completar el flujo de código entre el controller
`app/Http/Controllers/External/SurveyAnswerController.php` y el método perform del Servicio
`app/Services/Surveys/SurveyAnswerService.php`

Se puede usar cualquier herramienta, no hay limitaciones en este sentido.
Podeis añadir tests de feature si sobra tiempo, no es obligatorio.
Esta prueba en concreto está pensada para que dure alrededor de una hora/hora y media, así que de todas las formas posibles,
deberías elegir la que encaje dentro del tiempo de desarrollo previsto. Si consideras que teniendo más tiempo lo harías de forma distinta,
puedes añadirlo al archivo NOTES.md especificando como lo harías y porqué.

### Procedimiento de la prueba
 - Cambiar a la rama testBranch y hacer rebase en main
 - Crear el archivo NOTES.md para poder escribir cualquier aclaración de tu parte
 - Hacer los commits necesarios en el código

### Prerequisitos
 - Docker actualizado (probado con 4.42.1)
 - Postman (Opcional, para poder realizar pruebas manuales)

### Instalación / Build
El repositorio está preparado para levantar la infrastructura local solamente con docker ejecutando el siguiente comando:
```shell
$ docker compose up -d
```

### Otros comandos útiles
Si tenéis problemas con las migraciones, podeis lanzar de forma manual:
Reiniciar los servicios de compose:
```shell
$ docker compose down && docker compose up -d
```
Re-lanzar migraciones manual:
```shell
$ docker compose run --rm app php artisan migrate:fresh
```

