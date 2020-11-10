# How to create a Symfony 5 API

##### Stack 
- [Symfony skeleton](https://symfony.com/doc/current/setup.html#creating-symfony-applications)
- [API platform](https://api-platform.com/)
- [Lexik JWT Authentication](https://github.com/lexik/LexikJWTAuthenticationBundle) 
- [Generated React Frontend](https://api-platform.com/docs/client-generator/react/)

##### Steps
1. `composer create-project symfony/skeleton basic-api`
2. `composer req api`
3. `composer req lexik/jwt-authentication-bundle`
4. `composer require symfony/maker-bundle --dev`
5. `bin/console make:user` 
6. Ensure the User entity class has the `@ApiResource()` annotation
7.  configure [security.yaml](https://github.com/oratora/web-development-php/blob/master/symfony/api/basic/config/security.yaml)
8. configure [routes.yaml](https://github.com/oratora/web-development-php/blob/master/symfony/api/basic/config/routes.yaml)
9. `symfony server:start`
10. Make a request with [Postman](https://www.postman.com/) or [Insomnia](https://insomnia.rest/) to http://127.0.0.1:8000/api/users this should return: 
```
{
  "code": 401,
  "message": "JWT Token not found"
}
```
11. Create a user in your database
11. Make another request to http://127.0.0.1:8000/api/login
