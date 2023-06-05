## Getting Started localhost

First, install composer

Open [https://getcomposer.org/download/](https://getcomposer.org/download/) to install composer.

### Set you Symfony project in your project folder

```bash
$ composer create-project symfony/skeleton your_project_name
```
Open [https://www.apachefriends.org/fr/index.html](https://www.apachefriends.org/fr/index.html) to Install xampp

Set `Apache` and `MySQL` to start on xampp controller pannel.

Open [http://localhost](http://localhost:3000) with your browser to see the result.

## Create an admin user in your local database

You will need to install Symfony maker bundle

```bash
$ composer require --dev symfony/maker-bundle
```
Then, in your .env file you should config your database url

<ins>DATABASE_URL="postgresql://user@127.0.0.1:3306/database_name?serverVersion=14&charset=utf8"</ins>

### Create your user entity

```bash
$ symfony console make:User
```

On xampp controller pannel click on MySQL `admin` button to get access to PhpMyAdmin.

That will open your database controller their [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)

In your database insert the following SQL command :

```bash
INSERT INTO user (email, roles, password, is_checked)
VALUES ('admin@email.com', "['ROLE_ADMIN']", '$2a$12$XSxLs43czhAvDGW85xE3Fud.iFuusX2FdARoI/M8Zh2rkzsjxt2b2', true);
```

#### Please note for security reason you should never add a clear password in database

Its done your admin user is create and ready to be use