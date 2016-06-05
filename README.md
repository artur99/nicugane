# NicuGane.ro
### Despre
Repo-ul oficial de la noua versiune a siteului nicugane.ro



### Versiune
1.0.0

### Tehnologii
* [Composer]
* [Node.js]
* [Bower]
* [Grunt]
* [Silex Micro Framework]
* [jQuery]
* [Underscore.js]
* [MaterializeCSS]

### Limbaje
* HTML (+twig)
* CSS
* JavaScript
* PHP (mvc)
* SQL (dbal)

### Instalare
Cerințe: `git`, `composer`, `node.js`.

Configurații la: `app/conf.yaml`.

```sh
$ git init
$ git pull https://github.com/artur99/nicugane.git
$ npm install -g bower grunt-cli
$ npm update
$ bower update
$ grunt
$ composer install
$ mysql -u root -p < db_structure.sql
```

### Dezvoltare

```sh
$ grunt prep && grunt watch
```

   [Composer]: <https://getcomposer.org/>
   [node.js]: <http://nodejs.org>
   [bower]: <http://bower.io/>
   [materializecss]: <http://materializecss.com/>
   [Silex Micro Framework]: <http://silex.sensiolabs.org/>
   [grunt]: <http://gruntjs.com/>

   [Twitter Bootstrap]: <http://twitter.github.com/bootstrap/>
   [keymaster.js]: <https://github.com/madrobby/keymaster>
   [jQuery]: <http://jquery.com>
   [Underscore.js]: <http://underscorejs.org/>
   [Gulp]: <http://gulpjs.com>
   [daysplit.artur99.net]: <http://daysplit.artur99.net/account>
