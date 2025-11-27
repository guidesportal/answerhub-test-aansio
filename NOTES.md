# Notas

## Lo que hice

Implementé en el controller `SurveyAnswerController` 6 endpoints para recibir respuestas de encuestas. Cada uno tiene su propio formato:

- **systemA**: JSON simple con `email`, `survey`, `qid`/`q`, `score`, `submitted_at`
- **systemB**: JSON anidado con `participant.email`, `survey_code`, `external_qid`, `rating.value`, `created_at` (timestamp)
- **systemC**: JSON con email separado (`email_recipient` + `email_host`), estructura anidada `survey.surveyId`, `survey.questionId`, fecha en formato `d/m/Y H:i`
- **systemD**: XML con `participant`, `survey`, `question`, `score`, `date`
- **systemE**: CSV con múltiples respuestas: `question_id,survey_id,email,answer,date`
- **systemF**: Parámetros GET: `email`, `survey`, `question_id`, `answer`, `answered_at`

Todos los métodos hacen básicamente lo mismo: extraen los datos según el formato, convierten las fechas con Carbon, normalizan todo a un formato común y llaman al servicio `SurveyAnswerService::perform()`.

El servicio busca el usuario por email, la encuesta por su identificador (no por ID numérico), y para cada respuesta busca la pregunta y crea el registro.

## Rutas

Están en `routes/api.php` bajo `/api/external/survey-responses/`:

- POST `/system-a` hasta `/system-e`
- GET `/system-f`

Se incluye el archivo `postman_collection.json` en el proyecto con todas las consultas de ejemplo para facilitar las pruebas de los endpoints en Postman.

## Decisiones

- Respuesta JSON simple con `success: true/false` para compatibilidad
