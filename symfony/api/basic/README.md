# How to create a Symfony 5 API with JWT authentication

##### Stack 
- [Symfony skeleton](https://symfony.com/doc/current/setup.html#creating-symfony-applications)
- [API platform](https://api-platform.com/)
- [Lexik JWT Authentication](https://github.com/lexik/LexikJWTAuthenticationBundle) 
- [Generated React Frontend](https://api-platform.com/docs/client-generator/react/)

##### Steps
1. `composer create-project symfony/skeleton basic-api`
2. `composer req api`
3. `composer req lexik/jwt-authentication-bundle` and [generate the keys](https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#generate-the-ssh-keys) use the `JWT_PASSPHRASE` in the .env file as the pass phrase
4. `composer require symfony/maker-bundle --dev`
5. `bin/console make:user` 
6. Ensure the User entity class has the `@ApiResource()` annotation
7.  configure [security.yaml](https://github.com/oratora/web-development-php/blob/master/symfony/api/basic/config/security.yaml)
8. configure [routes.yaml](https://github.com/oratora/web-development-php/blob/master/symfony/api/basic/config/routes.yaml)
9. `symfony server:start`
10. Make a GET request with [Postman](https://www.postman.com/) or [Insomnia](https://insomnia.rest/) to http://127.0.0.1:8000/api/users this should return: 
```
{
  "code": 401,
  "message": "JWT Token not found"
}
```
11. Connect to a database by configuring the `DATABASE_URL` inside the .env file
12. `bin/console make:migration` then `bin/console doctrine:migrations:migrate`
13. Configure [RegisterController.php](https://github.com/oratora/web-development-php/blob/master/symfony/api/basic/controller/RegisterController.php)
14. Make POST request to http://127.0.0.1:8000/register with a JSON body:

```
{
"email" : "example@gmail.com",
"password" : "12345678"
}
```

15. Check your database for a new user with the email `example@gmail.com`
16. Make a POST request http://127.0.0.1:8000/api/login_check with a JSON body:
```
{
"username" : "example@gmail.com",
"password" : "12345678"
}
```

This should return: 

```
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2MDUwMDcyMTQsImV4cCI6MTYwNTAxMDgxNCwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoiZXhhbXBsZUBnbWFpbC5jb20ifQ.SIBGOfAfSGb-Afy6guARVg4kz2pY7PGKxm3D4icHbWD_209pi2Dl0MJ8F6-8LueOj-1GSFjym9T5gZKaGJddmcBYxHf-mUIl_2Pkqpq3zBiVx8XrSEtUyckfpJGhoeFyRCptwKwmyq4nqpudv40kmWND1FQKNz2UAKs0xtBdCvjZdFqtkQj0AFzHuz8SpiaqfI_URb16oBIvLcZ5JMuvuSXIs7sQ8hfVaa3phhEAWmfI-mGRURBY__T0SQSmCCMKjQhw5cfedIQrYyn0SGhyTFZlfh9EA2bALYpSBtNcS1IGq0202mB4MNGSbM_cN4CTtovByx1uB2fL26CvL_QcByoG6C-KJePRRJlOo92ux3yKzsEtOIHYCeLzreve00nQt_oXT7vVxV8ivAgG5IBXJdaOPkSDyISfLlNS0lYx6ifDc-zuBcGKStnjCoe9z5TrDjfTJG_tWeBywB8-tqxUnpxwz3eX3Qo9A9m6HmwfJmIuYO5rX2vF-7qdmQXQX0sxrluSCg68Ky0IQ1f7InNJgo-9t-YPVbMX5XqFuTza5VAjQP_gHVGgDLJpwhD6MuMcslC5ek8iFdlBKnkkYDkUyyPwpsKGbP_cdZR1zVytivuFhK2N5xP7zC0_9qEMsZrkpASXGI4XtuHKnpBvr6-BxZic-gUP5j6q_1f-uLMLK9c"
}
```

17. Copy the token excluding the double quotations. Make a GET request to http://127.0.0.1:8000/api/users for the authentication use a bearer token, paste in the token and for the prefix write `BEARER`

This should return:

```
{
  "@context": "\/api\/contexts\/User",
  "@id": "\/api\/users",
  "@type": "hydra:Collection",
  "hydra:member": [
    {
      "@id": "\/api\/users\/1",
      "@type": "User",
      "id": 1,
      "email": "example@gmail.com",
      "username": "example@gmail.com",
      "roles": [
        "ROLE_USER"
      ],
      "password": "$argon2id$v=19$m=65536,t=4,p=1$4lsDGhp+TL3vY4Gk26DgNw$YnDVcA5uOMACD2H22QVFAwTIkk8u2FpT\/uQxHaTGcFA"
    }
  ],
  "hydra:totalItems": 1
}
```

