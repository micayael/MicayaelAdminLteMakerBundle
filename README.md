Instalación
===========

- Requerir versión minima de php en composer.json: "php": "^7.3",
- Agregar archivo .php-version con la versión 7.3
- Instalar dependencias de desarrollo

~~~
composer require --dev friendsofphp/php-cs-fixer sensiolabs/security-checker
~~~

- Agregar excepciones al archivo .php_cs.dist

~~~
->exclude(['bin', 'var', 'vendor', 'node_modules'])
~~~

- Agregar scripts en el composer.json

~~~
        "check-cs": [
            "php-cs-fixer fix --dry-run"
        ],
        "check-sec": [
            "security-checker -vv security:check"
        ],
        "check": [
            "@check-cs",
            "@check-sec"
        ],
        "fix-cs": [
            "php-cs-fixer fix"
        ]
~~~

- Permitir contribs

~~~
composer config extra.symfony.allow-contrib true
~~~

- Instalar dependencias

~~~
composer require symfony/apache-pack
~~~

- Comitear proyecto

- Instalar kevinpapst/adminlte-bundle. ver en su paǵina

~~~
composer require "kevinpapst/adminlte-bundle:^3.0"
~~~

- Bloquear twig a la versión 2 en composer.json

~~~
        "twig/twig": "2.*"
~~~

- Instalar composer require micayael/admin-lte-maker-bundle:*@dev

~~~
composer require micayael/admin-lte-maker-bundle:*@dev
~~~

- Crear admin.html.twig

~~~
cp vendor/micayael/admin-lte-maker-bundle/doc/examples/admin.html.twig templates/
~~~

- instalar y configurar KnpPaginatorBundle sobreescribiendo el archivo templates/bundles/KnpPaginatorBundle

~~~
composer require knplabs/knp-paginator-bundle:^4.1

cp vendor/micayael/admin-lte-maker-bundle/doc/examples/knp_paginator.yaml config/packages/
mkdir -p templates/bundles/KnpPaginatorBundle/Pagination/
cp vendor/micayael/admin-lte-maker-bundle/doc/examples/twitter_bootstrap_v3_sortable_link.html.twig templates/bundles/KnpPaginatorBundle/Pagination/
~~~

- Configurar base de datos en .env

- Preparar autenticación

    - Instalar doctrine extensions
    
    ~~~
    composer require stof/doctrine-extensions-bundle
    ~~~
  
  - Configurar doctrine extensions
  
    ~~~
    stof_doctrine_extensions:
      default_locale: es
      orm:
          default:
              timestampable:  true
              blameable:  true
    
    ~~~
    
    - Configurar idioma translation.yaml
     
    ~~~
    framework:
        default_locale: es
        translator:
            default_path: '%kernel.project_dir%/translations'
            fallbacks:
                - es

    ~~~
  
    - Crear objeto User para fos user bundle
    
    ~~~
    cp vendor/micayael/admin-lte-maker-bundle/doc/examples/Usuario.php src/Entity/
    cp vendor/micayael/admin-lte-maker-bundle/doc/examples/UsuarioRepository.php src/Repository/
    ~~~
    
    - Configurar .env
    
    ~~~
    ###> friendsofsymfony/user-bundle ###
    FROM_EMAIL_ADDRESS=micayael@hotmail.com
    FROM_EMAIL_SENDER_NAME=webmaster
    ###< friendsofsymfony/user-bundle ###
    ~~~
    
    - Configurar security.yaml
    
    ~~~
    mkdir -p src/Security
    cp vendor/micayael/admin-lte-maker-bundle/doc/examples/Security/CustomUserProvider.php src/Security/
    cp vendor/micayael/admin-lte-maker-bundle/doc/examples/routes/fos_user.yaml config/routes/
    cp vendor/micayael/admin-lte-maker-bundle/doc/examples/security.yaml config/packages/security.yaml
    cp vendor/micayael/admin-lte-maker-bundle/doc/examples/fos_user.yaml config/packages/
    ~~~
    
    - Crear base de datos y tablas para el usuario
    
    ~~~
    bin/console cache:clear
    bin/console doctrine:database:create
    bin/console doctrine:schema:create
    bin/console fos:user:create --super-admin
    ~~~
    
- Crear entities

    - Tener en cuenta el autonumérico de la PK

    ~~~
    @ORM\GeneratedValue(strategy="IDENTITY")
    ~~~

    - Crear siempre una propiedad $revision en cada entity
    
    ~~~
        /**
         * @ORM\Column(type="integer", options={"default":1})
         *
         * @ORM\Version()
         */
        private $revision;
    ~~~

- Generar CRUD

~~~
bin/console make:app:crud
~~~

- Crear ruta para home en routes.yaml

~~~
home:
    path: /
    controller: App\Controller\HomeController
    methods: GET
~~~

- Crear controller para el home

~~~
cp vendor/micayael/admin-lte-maker-bundle/doc/examples/Controller/HomeController.php src/Controller/
mkdir templates/admin
cp vendor/micayael/admin-lte-maker-bundle/doc/examples/templates/home.html.twig templates/admin/
~~~

- Crear controller para el index

~~~
cp vendor/micayael/admin-lte-maker-bundle/doc/examples/Controller/IndexController.php src/Controller/
mkdir templates/public
cp vendor/micayael/admin-lte-maker-bundle/doc/examples/templates/index.html.twig templates/public/
~~~
- Require assets en el admin.js principal

~~~
require('../../vendor/micayael/admin-lte-maker-bundle/src/Resources/assets/crud.scss');
~~~

- Instalar encriptación de urls

~~~
composer require nzo/url-encryptor-bundle:^4.2
~~~

Para usar el bundle
===================

micayael_admin_lte_maker.yaml

micayael_admin_lte_maker:
    url_context: /

Falta
=====

- agregar fire de eventos
- agregar opciones al comando
    - indicar que cosa crear
        - solo form
        - solo templates
        - solo routes
        - solo controllers
    - con o sin permisos
 