# How to create a basic API

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
6.  configure [security.yaml](https://github.com/oratora/web-development-php/blob/master/symfony/api/basic/config/security.yaml)
7. configure [routes.yaml](https://github.com/oratora/web-development-php/blob/master/symfony/api/basic/config/routes.yaml)
8. `symfony server:start`

