<?= $route_name; ?>_index:
    path: <?= $url_context; ?><?= $route_name; ?>

    controller: App\Controller\<?= $entity_class_name; ?>\IndexController
    methods: GET

<?= $route_name; ?>_new:
    path: <?= $url_context; ?><?= $route_name; ?>/new
    controller: App\Controller\<?= $entity_class_name; ?>\NewController
    methods: GET|POST

<?= $route_name; ?>_show:
    path: <?= $url_context; ?><?= $route_name; ?>/{id}
    controller: App\Controller\<?= $entity_class_name; ?>\ShowController
    methods: GET

<?= $route_name; ?>_edit:
    path: <?= $url_context; ?><?= $route_name; ?>/{id}/edit
    controller: App\Controller\<?= $entity_class_name; ?>\EditController
    methods: GET|POST

<?= $route_name; ?>_delete:
    path: <?= $url_context; ?><?= $route_name; ?>/{id}/delete
    controller: App\Controller\<?= $entity_class_name; ?>\DeleteController
    methods: GET|DELETE
