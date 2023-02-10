# DWH Query Bundle

## About

The DWH uses GraphQL specification to retrieve the data. It uses the package <a href="https://github.com/webonyx/graphql-php" target="_blank">webonyx/graphql-php</a>: a PHP implementation of the GraphQL specification based on the reference implementation in JavaScript to use GraphQL in PHP.

If you want to learn about GraphQL you can read the docs from the official website <a href="https://graphql.org/learn/" target="_blank">Introduction to GraphQL</a> or the documentation of the PHP package.

# Installation

Via composer:

```sh
composer require developmentwata/dwh-query-bundle
```

# Development

In case you want to extend the library, you can set up a local installation using docker:

Run `docker-compose up -d` to run app. By default, the `docker-compose.yml` is used.

Run `docker-compose exec php composer install` to install the vendors.

This docker-compose file is used for development. It starts the following container:

- php: it contains the application source code

# Documentation

## GraphQL

The main parts of GraphQL are:

### Types
You need to configure the data types where the DWH can use for queries. This is only a specification of what type of query the user can do. For example:

```
type ResultCompany {
    questionCode: String
    block: String
    scaleName: String
    scaleCode: String
    result: String
}
```

With this type defined in GraphQL you can search for the type ResultCompany and retrieve the fields you need.

Using GraphQL-PHP you can set the types as <a href="https://webonyx.github.io/graphql-php/data-fetching/" target="_blank">this</a>

### Resolver
When you query for a type using GraphQL you need to specify how the data is retrieved from the database, api, … or wherever you want.

The resolver is a function that gets the type you are querying and the arguments of you query. With these data you can do a search in the database, api, .. and return an array with the data.

Using GraphQL-PHP you can set the resolvers as <a href="https://webonyx.github.io/graphql-php/data-fetching/" target="_blank">this</a>

### Query
In order to retrieve the data using GraphQL you have to use a Query. The structure of a query is the following one:

```
{
  human(id: "1000") {
    name
    height
  }
}
```
With this query you are trying to fetch the type “human” where the “id” is 1000 and retrieving only the fields “name” and “height”.

## Dwh Query Bundle

With this bundle we can define the types we can query, the resolvers to fetch the data, and we have an endpoint to send the queries.

Dwh Query Bundle can be extended using <a href="https://github.com/developmentwata/dwh-query-doctrine-bundle" target="_blank">this bundle</a>

### Defining types

The bundle will automatically look in the config/dwh_query folder for all the files with the extension .graphql. Those files have the definition of the schemas using the Schema Definition Language. You can read about this <a href="https://webonyx.github.io/graphql-php/schema-definition-language/">here</a>

This is an example:
```
type Query {
allCompanyResult(limit: Int!): [CompanyResult]
}
type CompanyResult {
questionCode: String
block: String
scaleName: String
scaleCode: String
result: String
}
```
There is a special type named “Query” that is the root of the other ones.

You can change the schemas directory in the dwh_query.yaml file:

```
dwh_query:
schemas_dir: '%kernel.project_dir%/config/dwh_query'
```

### Defining resolvers

To define a resolver for a type you need to create a class that implements the interface ```Wata\DwhQueryBundle\Resolver\QueryResolverInterface``` with two methods:

* getAlias(): it returns the alias for this resolver. The alias must have the same name that the type you are writing the resolver for.
* __invoke(…): it receives the where clauses, the order by fields, the group by fields and an info variable with all the information about the query.

The bundle will automatically search for all the classes that implements this interface, and it will add it to the query resolver.

You can use any service using dependency injection in this class.

### Defining preinterceptors

You can define preinterceptors in order to add where clauses to the resolver or performs another type of checks such as permissions.

You only need to create a class that implements the interface ```Wata\DwhQueryBundle\Interceptor\PreInterceptorInterface``` and implement the method __invoke

### Query endpoint

The route for the endpoint is configured in the config/routes/dwh.yaml file.

By default, the endpoint is POST /dwh

You can add a url prefix setting:

```
dwh:
resource: "@DwhQueryBundle/Resources/config/routes.yaml"
prefix: /api
```

## License

See [LICENSE](LICENSE).
