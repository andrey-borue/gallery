Simple photo gallery
=======

An example of Symfony project.
## setup
- clone sources `git clone git://github.com/andrey-borue/gallery.git gallery`
- install dependencies `cd gallery && composer install`
- crate database schema `app/console doctrine:schema:update --force`
- load fixtures `app/console doctrine:fixtures:load`
- run simple web server for dev `app/console server:run`

## Server API documentation 
Enjoy auto-generated api documentation http://127.0.0.1:8000/api/doc
 
## Examples of requests
- http://127.0.0.1:8000/api/gallery/list?medias=2
- http://127.0.0.1:8000/api/gallery/album?id=64&page=1
 
## PHP tests 
`./bin/phpunit`

## TODO for PHP part
- Improve validation for input data
- Improve error handling 
- Add `sonata-admin` bundle 

## TODO for FE part
- use Marionette.js

## About the author
- Andrey Borue
- https://www.linkedin.com/in/andreyborue
- http://youtube.com/makeitnow
- http://www.makeitnow.ru
- https://www.facebook.com/andrey.borue
- andrey.borue@gmail.com
