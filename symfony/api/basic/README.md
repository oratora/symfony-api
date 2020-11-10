# How to create a basic API with authentication

Stack 
- [Symfony skeleton](https://symfony.com/doc/current/setup.html#creating-symfony-applications)
- [API platform](https://api-platform.com/)
- [Lexik JWT Authentication](https://github.com/lexik/LexikJWTAuthenticationBundle) 


Steps
1. `composer create-project symfony/skeleton basic-api`
2. `composer req api`
3. `composer req lexik/jwt-authentication-bundle`
4. `composer require symfony/maker-bundle --dev`
5. `bin/console make:user` 
6. Ensure the security.yaml looks like [documentation](https://github.com/oratora/web-development-php/blob/master/symfony/api/basic/config/security.yaml)
