# GraphQL Example Project

Проект представляет собой пример реализации GraphQL API с ипользованием фреймворка Symfony 5 и библиотеки 
GraphQLBundle (вендор Overblog). Проект состоит из четырех Docker контейнеров (php, mysql, nginx, mongodb).

**Для сборки контейнеров:**
`make build`

**Для запуска контейнеров:**
`make up`

**Для остановки контейнеров:**
`make stop`

**Для входа в главный контейнер с приложением:**
`make enter`

**Для разворачивания миграции и заливания фикстур:**
`make init`

В проект подключена библиотека overblog/graphiql-bundle для удобства тестирования запросов к GraphQL серверу. 
Сам GraphQL сервер располагается по адресу http://localhost:8080/graphql/