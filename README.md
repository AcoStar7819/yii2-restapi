# Тестовое REST API на Yii2

## Про проект
API позволяет взаимодействовать с тестовой БД содержащей список вакансий.

SQL код для базы данных включен в проект, не забудьте указать тестовую БД в конфиге ``config/db.php`` и запустить миграции с помощью команды ``yii migrate``

## Эндпоинты API

Реазилованы в соответствии с [документацией по REST API](https://www.yiiframework.com/doc/guide/2.0/ru/rest-quick-start), доступы по ссылке вида ``адрес-сайта/api/vacancy``

### Получение списка вакансий
``GET /vacancy``

Отображаемые поля:
- *name* - Название вакансии
- *description* - Описание вакансии
- *salary* - Зарплата

GET параметр fields позволяет менять отображаемые поля, например - ``GET /vacancy?fields=name,salary``

Дополнительные поля:
- *id* - Id вакансии в базе данных
- *date_created* - Дата создания вакансии

Дополнительные поля скрыты по-умолчанию, для их отображения используется GET параметр expand. Пример:<br>
``GET /vacancy?expand=id,date_created``<br>
``GET /vacancy?fields=name&expand=date_created``

На каждой странице отображается по 10 вакансий, для переключения страниц используется GET параметр page - ``GET /vacancy?page=2``

Для сортировки записей используется GET параметр sort вместе с именем столбца.<br>
Сортировка от самой маленькой зарплаты к самой большой - ``GET /vacancy?sort=salary``<br>
Сортировка от самой большой зарплаты к самой маленькой - ``GET /vacancy?sort=-salary``

### Получение конкретной вакансии по Id
``GET /vacancy/{id}``

Например - ``GET /vacancy/1``, ``GET /vacancy/94``

Также применимы GET параметры fields и expand.

### Создание вакансии
``POST /vacancy``

Обязательные POST параметры:
- *name* - Название вакансии
- *description* - Описание вакансии
- *salary* - Зарплата

После создания вакансии будет возвращён её ``id`` и параметр ``success = true``<br>
В случае неудачного создания будет возвращён ``success = false`` и список ошибок в параметре ``errors``
