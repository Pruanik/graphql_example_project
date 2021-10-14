# GraphQL Example Project

Проект представляет собой пример реализации GraphQL API с использованием фреймворка Symfony 5 и библиотеки 
GraphQLBundle (вендор Overblog). Проект состоит из четырех Docker контейнеров (php, mysql, nginx, mongodb).

## Установка и развертывание приложения
1. Клонируем репозиторий:

    `git@github.com:Pruanik/graphql_example_project.git`

2. Настраиваем .env файл:

   `cp .env_example .env`

3. Собираем контейнеры:

    `make build`

4. Запуск контейнеров

   `make up`

5. Устанавливаем зависимости:

   `make composer-install`

6. Разворачиваем миграции и заливаем фикстуры:

    `make init`

7. Смотрим результат: 

   [http://localhost:8080/](http://localhost:8080/)

## Список команд для управления проектом
**Для сборки контейнеров:**
`make build`

**Для установки всех composer зависимостей:**
`make composer-install`

**Для запуска контейнеров:**
`make up`

**Для запуска контейнеров приложения, если базы у Вас расположены локально:**
`up-without-databases`

**Для разворачивания миграции и заливания фикстур:**
`make init`

**Для остановки контейнеров:**
`make stop`

**Для входа в главный контейнер с приложением:**
`make enter`

## Полезные ссылки
* По умолчанию проект разворачивается на порту 8080, а значит ссылка будет 
[http://localhost:8080/](http://localhost:8080/) 
* В проект подключена библиотека overblog/graphiql-bundle для удобства тестирования запросов к GraphQL серверу. 
Для того чтобы воспользоваться ее интерактивным режимом необходимо перейти по ссылке: 
[http://localhost:8080/graphiql](http://localhost:8080/graphiql)
* Для обращения к развернутому GraphQL серверу при помощи клиента (например Postman), необходимо посылать запросы 
на адрес: [http://localhost:8080/graphql/](http://localhost:8080/graphql/)

## Схема модели данных приложения
![](public/assets/img/data_model.png)

## Структура приложения

* Схема GraphQL данных хранятся в *config/graphql/types/Domain/Input* и *config/graphql/types/Domain/Object* для мутаций
и объектов соответственно.
* В папке *migration* актуальные миграции для развертывания приложения.
* В папках *src/Document* и *src/Entity* описаны все сущности для MongoDb и Mysql соответственно.
* В папке *src/GraphQL* находятся все пользовательские классы для выстраивания логики работы GraphQL с нашим Symfony 
приложением.
* *src/Listener/ReferencesListener.php* - необходим для настройки релейшен связей между сущностями хранящимися в mysql и 
сущностями в MongoDb.
* В папке *src/Model* лежат все классы нашего Symfony приложения.
* *src/Security/ApiTokenAuthenticator.php* - тут реализован кастомный способ аутентификации пользователя по наличию 
ключа в заголовке запроса.

## Полезные ссылки
* [Официальный сайт](https://graphql.org/)
* [Блог разаработчиков](https://graphql.org/blog/graphql-a-query-language/)
* [Компании использующие GraphQL](https://landscape.graphql.org/)
* [Стандарты](https://graphql-rules.com/)
---
* [GraphQL w Symfony | Mariusz Bąk | Boldare](https://www.youtube.com/watch?v=V_XNG8upORY)
* [Павел Черторогов — Строим GraphQL-сервер](https://www.youtube.com/watch?v=NnnvOPdstzg)
* [Александр Демченко «Graphql + Symfony» | CODEiD (11.08.2018)](https://www.youtube.com/watch?v=Q-VMoE2bcag)
---
* [Сравнение архитектурных стилей API: SOAP vs REST vs GraphQL vs RPC](https://medium.com/nuances-of-programming/%D1%81%D1%80%D0%B0%D0%B2%D0%BD%D0%B5%D0%BD%D0%B8%D0%B5-%D0%B0%D1%80%D1%85%D0%B8%D1%82%D0%B5%D0%BA%D1%82%D1%83%D1%80%D0%BD%D1%8B%D1%85-%D1%81%D1%82%D0%B8%D0%BB%D0%B5%D0%B9-api-soap-vs-rest-vs-graphql-vs-rpc-68855deb3f4)
* [5 причин, по которым вам не стоит использовать GraphQL](https://medium.com/devschacht/esteban-herrera-5-reasons-you-shouldnt-use-graphql-bae94ab105bc)
* [What is the N+1 Problem in GraphQL?](https://medium.com/the-marcy-lab-school/what-is-the-n-1-problem-in-graphql-dd4921cb3c1a)
* [How to set up a GraphQL server with Symfony 4?](https://medium.com/assoconnect/how-to-set-up-a-graphql-server-with-symfony-4-14a9b977dc4c)
* [Setting up GraphQL with PHP: Defer field resolving](https://rcls.medium.com/setting-up-graphql-with-php-defer-field-resolving-d83c3c82f3e7)
---
* [Начало работы с GraphQL](https://frontend-stuff.com/blog/graphql/)
* [Solving the N+1 Problem for GraphQL through Batching](https://shopify.engineering/solving-the-n-1-problem-for-graphql-through-batching)
* [Почему в graphql есть проблема с N+1?](https://nodkz.github.io/conf-talks/articles/graphql/dataloader/N+1.html)
* [Adding a GraphQL API to your Symfony Flex application](https://symfony.fi/entry/adding-a-graphql-api-to-your-symfony-flex-app)

* [OverblogGraphQLBundle](https://github.com/overblog/GraphQLBundle)
* [OverblogGraphQLBundle Settings](https://github.com/overblog/GraphQLBundle/blob/master/docs/security/limiting-query-depth.md)
