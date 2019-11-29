Instalación
===========
- Crear admin.html.twig
- instalar y configurar KnpPaginatorBundle sobreescribiendo el archivo templates/bundles/KnpPaginatorBundle

Para usar el bundle
===================

micayael_admin_lte_maker.yaml

micayael_admin_lte_maker:
    url_context: /

Falta
=====

- control de concurrencia en modificaciones
- agregar fire de eventos
- agregar opciones al comando
    - indicar que cosa crear
        - solo form
        - solo templates
        - solo routes
        - solo controllers
    - con o sin permisos
