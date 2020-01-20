<?= $route_name; ?>_index:
    path: <?= $url_context; ?><?= $route_name; ?>

    controller: App\<?= $controller_base_namespace; ?>\IndexController
    methods: GET

<?= $route_name; ?>_new:
    path: <?= $url_context; ?><?= $route_name; ?>/new
    controller: App\<?= $controller_base_namespace; ?>\NewController
    methods: GET|POST

<?= $route_name; ?>_show:
    path: <?= $url_context; ?><?= $route_name; ?>/{id}
    controller: App\<?= $controller_base_namespace; ?>\ShowController
    methods: GET

<?= $route_name; ?>_edit:
    path: <?= $url_context; ?><?= $route_name; ?>/{id}/edit
    controller: App\<?= $controller_base_namespace; ?>\EditController
    methods: GET|POST

<?= $route_name; ?>_delete:
    path: <?= $url_context; ?><?= $route_name; ?>/{id}/delete
    controller: App\<?= $controller_base_namespace; ?>\DeleteController
    methods: GET|DELETE
