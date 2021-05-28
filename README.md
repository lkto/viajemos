#DESARROLLADOR PHP SENIOR
##Prueba práctica
El proyecto esta elaborado en Symfony 5.2, PHP 7.2 y node v12.16.0 

Una vez descargado el proyecto es necesario correr en la consola
- composer install
- php bin/console doctrine:database:create (para crear la bd)
- php bin/console doctrine:schema:update --force (para crear tablas y  columnas)
- php bin/console doctrine:fixtures:load (para crear data en las tablas)
- npm install o yarn install
- npx encore dev o yarn encore dev-server

para correr el proyecto es necesario instalar symfony https://symfony.com/download
- luego, en la consola correr: symfony server:start
