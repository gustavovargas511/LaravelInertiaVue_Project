Para ejecutar este proyecto es necesario clonarlo, crear el archivo .env con la siguiente informacion:

DB_CONNECTION=mysql
DB_HOST=[your_mysql_ip]
DB_PORT=3306
DB_DATABASE=LaravelInertiaVue_Schema
DB_USERNAME=[your_user]
DB_PASSWORD=[your_password]

Ejecutar las migraciones.

php artisan migrate

(los seeds no son necesarios, es mejor crear usuarios y empezar a crear tasks)

Happy Testing!
