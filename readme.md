# GraphQL Example Project

The project is an example of GraphQL API implementation using Symfony 5 framework and library
GraphQLBundle (vendor Overblog). The project consists of four Docker containers (php, mysql, nginx, mongodb).

## Installing the application
1. Cloning the repository:

    `git@github.com:Pruanik/graphql_example_project.git`

2. Configuring the .env file:

   `cp .env_example .env`

3. Building containers:

    `make build`

4. Starting containers

   `make up`

5. Installing dependencies:

   `make composer-install`

6. Running the migrations and filling the fixtures:

    `make init`

7. Let's see the result: 

   [http://localhost:8080/](http://localhost:8080/)

## List of commands for project management
**To build containers:**
`make build`

**To install all composer dependencies:**
`make composer-install`

**To start containers:**
`make up`

**To start application containers if you have databases locally:**
`up-without-databases`

**To run migrations and pour fixtures:**
`make init`

**For stopping containers:**
`make stop`

**To enter the main container with the application:**
`make enter`

## Useful links
* By default the project starts on port 8080, so the link will be 
[http://localhost:8080/](http://localhost:8080/) 
* Overblog/graphiql-bundle library is included into the project for easy testing of queries to GraphQL server.
To use interactive mode you should follow the link: 
[http://localhost:8080/graphiql](http://localhost:8080/graphiql)
* To access the GraphQL server using a client (e.g. Postman), you should send requests to:
[http://localhost:8080/graphql/](http://localhost:8080/graphql/)

## Application data model schema
![](public/assets/img/data_model.png)

## Application Structure

* GraphQL data schema are stored in *config/graphql/types/Domain/Input* and *config/graphql/types/Domain/Object* for mutations 
and objects.
* In the *migration* folder, the actual migrations for starting the application.
* The *src/Document* and *src/Entity* folders describe all entities for MongoDb and Mysql.
* The *src/GraphQL* folder contains all custom classes for building GraphQL logic for our Symfony application.
* *src/Listener/ReferencesListener.php* - is needed to configure relational links between entities stored in mysql and
entities in MongoDb.
* The *src/Model* folder contains all classes of our Symfony application.
* *src/Security/ApiTokenAuthenticator.php* - here we implement a custom way to authenticate a user by the presence of a key
in the request header.

## Useful links
* [Official Website](https://graphql.org/)
* [Developer Blog](https://graphql.org/blog/graphql-a-query-language/)
* [Companies Using GraphQL](https://landscape.graphql.org/)
* [Standards](https://graphql-rules.com/)
---
* [GraphQL w Symfony | Mariusz Bąk | Boldare](https://www.youtube.com/watch?v=V_XNG8upORY)
* [Павел Черторогов — Строим GraphQL-сервер](https://www.youtube.com/watch?v=NnnvOPdstzg)
* [Александр Демченко «Graphql + Symfony» | CODEiD (11.08.2018)](https://www.youtube.com/watch?v=Q-VMoE2bcag)
---
* [Comparison of API architectural styles: SOAP vs REST vs GraphQL vs RPC](https://medium.com/nuances-of-programming/%D1%81%D1%80%D0%B0%D0%B2%D0%BD%D0%B5%D0%BD%D0%B8%D0%B5-%D0%B0%D1%80%D1%85%D0%B8%D1%82%D0%B5%D0%BA%D1%82%D1%83%D1%80%D0%BD%D1%8B%D1%85-%D1%81%D1%82%D0%B8%D0%BB%D0%B5%D0%B9-api-soap-vs-rest-vs-graphql-vs-rpc-68855deb3f4)
* [5 reasons why you shouldn't use GraphQL](https://medium.com/devschacht/esteban-herrera-5-reasons-you-shouldnt-use-graphql-bae94ab105bc)
* [What is the N+1 Problem in GraphQL?](https://medium.com/the-marcy-lab-school/what-is-the-n-1-problem-in-graphql-dd4921cb3c1a)
* [How to set up a GraphQL server with Symfony 4?](https://medium.com/assoconnect/how-to-set-up-a-graphql-server-with-symfony-4-14a9b977dc4c)
* [Setting up GraphQL with PHP: Defer field resolving](https://rcls.medium.com/setting-up-graphql-with-php-defer-field-resolving-d83c3c82f3e7)
---
* [Getting started with GraphQL](https://frontend-stuff.com/blog/graphql/)
* [Solving the N+1 Problem for GraphQL through Batching](https://shopify.engineering/solving-the-n-1-problem-for-graphql-through-batching)
* [Why is there a problem with N+1 in graphql?](https://nodkz.github.io/conf-talks/articles/graphql/dataloader/N+1.html)
* [Adding a GraphQL API to your Symfony Flex application](https://symfony.fi/entry/adding-a-graphql-api-to-your-symfony-flex-app)

* [OverblogGraphQLBundle](https://github.com/overblog/GraphQLBundle)
* [OverblogGraphQLBundle Settings](https://github.com/overblog/GraphQLBundle/blob/master/docs/security/limiting-query-depth.md)
