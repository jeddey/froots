
# Froots API

The API provides four main endpoints to be consumed.
A security layer using JSON Web Tokens (with a TTL of 3600 seconds) has been implemented to ensure
only authorized users have access to resources.

## Table of Contents

- [Overview](#overview)
- [Getting Started](#getting-started)
  - [Installation](#installation)
  - [Coding Standards](#coding-standards)
  - [PHPUnit](#phpunit)
  - [Services](#services)
- [Endpoints](#endpoints)
  - [Authentication: `POST /api/login_check`](#authentication)
  - [Endpoint 1: `GET /api/products`](#endpoint-1)
  - [Endpoint 2: `GET /api/orders`](#endpoint-2)
  - [Endpoint 3: `GET /api/orders/{id}/products`](#endpoint-3)

### Overview
Two approaches were used to develop the API: the main one using DTO and data transformers, and the second one is commented and uses the controller action.

- The API is running under: http://localhost/api
- Swagger interface is available under: http://localhost/api

The API exposes resources related to e-commerce business with a specific relation between entities to be flexible for additional attributes like quantity that need to be tracked.

### Getting Started
The required tool for the project to run successfully in the dev environment is the Docker engine dependency.

### Installation
Install project dependencies using the command:
- `docker-compose up -d --build`

### Coding Standards

To ensure compatibility and coding design consistency, two main tools were used to maintain the project:
cs-fix and PHPStan. Both can be executed inside the container using the composer script command. Later, we could create a Makefile later for more much easier integration.
- `composer cs-fix`
- `composer phpstan`

### PHPUnit

PHPUnit is essential to ensure new changes do not break old working features, especially for new team members or when changing a complex area with significant business logic.
The command to run PHPUnit for this API is:
- `composer phpunit`

### Services

Three services using Docker containers are required to successfully run the API:
- PHP 8
- NGINX
- MySQL

# REST API Reference

### Authentication
#### Credentials
- Email: user@froots.com
- Password: user

#### Request to Retrieve Token

```
  POST /api/login_check
```

    curl --location 'http://localhost/api/login_check'     --header 'Content-Type: application/json'     --data-raw '{
      "email" : "user@froots.com",
      "password" : "user"
    }'

### Endpoints

#### Endpoint 1: Products

```
  GET /api/products
```
    curl --location 'http://localhost/api/products'     --header 'accept: application/json'     --header 'Authorization: Bearer ABCDEF...'

#### Endpoint 2: Orders

```
  GET /api/orders
```
    curl --location 'http://localhost/api/orders'     --header 'accept: application/json'     --header 'Authorization: Bearer ABCDEF...'

#### Endpoint 3: Products in Order

```
  GET /api/orders/{id}/products
```
    curl --location 'http://localhost/api/orders/{1}/products'     --header 'accept: application/json'     --header 'Authorization: Bearer ABCDEF...'