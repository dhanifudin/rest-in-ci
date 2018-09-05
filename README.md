# Rest In CI
This is a simple todo rest application based on CodeIgniter, [REST Server](https://github.com/chriskacerguis/codeigniter-restserver), [JWT Implementation](https://github.com/firebase/php-jwt).

# Setup
Please run `composer install` in `application` directory first.
You need to deploy database schema `todo.sql` into your mysql server. Then configure database configuration on `application/config/database.php`. Insert new user into database.

# Run
You can run using php built-in server
```
php -S 0.0.0.0:8000
```

> I don't use apache or xampp anymore, so don't ask me :D

Create JWT Token

```
URL: http://localhost:8000/auth/token
Method: POST
Multipart Form:
    username: <user>
    password: <user>(not encrypted)
```

Create Todo
You need to set jwt token into Authorization header.
```
URL: http://localhost:8000/todo
Method: POST
Multipart Form:
    todo: <todo>
    done: 0
```

List Todo
```
URL: http://localhost:8000/todo
Method: GET
```

