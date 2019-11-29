{% extends 'admin.html.twig' %}

{% block page_title %}

    {{ 'crud.title.show'|trans({'%entity_class_name%': '<?= $entity_class_name ?>'}, 'MicayaelAdminLteMakerBundle') }}

{% endblock %}

{% block breadcrumb %}

    {% embed '@MicayaelAdminLteMaker/Widgets/breadcrumb.html.twig' %}

        {% block content %}
            <li><a href="{{ path('<?= $route_name ?>_index') }}"><?= $entity_class_name_plural ?></a></li>
            <li class="active">{{ 'crud.action.show'|trans({}, 'MicayaelAdminLteMakerBundle') }}</li>
        {% endblock %}

    {% endembed %}

{% endblock %}

{% block page_content %}

    <div class="row">
        <div class="col-md-12">

            {% embed '@MicayaelAdminLteMaker/Widgets/context_menu.html.twig' %}

                {% block actions %}
                    <li>
                        {{ create_link('edit', '<?= $route_name ?>_edit', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}, 'ROLE_<?= $entity_class_name_upper ?>_UPDATE') }}
                    </li>
                    <li>
                        {{ create_link('index', '<?= $route_name ?>_index', {}, 'ROLE_<?= $entity_class_name_upper ?>_READ') }}
                    </li>
                {% endblock %}

            {% endembed %}

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            {% embed '@AdminLTE/Widgets/box-widget.html.twig' %}

                {% block box_body %}

                    <table class="table">
                        <tbody>
<?php foreach ($entity_fields as $field): ?>
<?php if($field['fieldName'] === 'id') continue; ?>

<?php if($field['type'] === 'boolean'): ?>
                            <tr>
                                <th class="col-lg-2"><?= ucfirst($field['fieldName']) ?>:</th>
                                <td>{{ boolean_value($field) }}</td>
                            </tr>
<?php else: ?>
                            <tr>
                                <th class="col-lg-2"><?= ucfirst($field['fieldName']) ?>:</th>
                                <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field) ?> }}</td>
                            </tr>
<?php endif ?>
<?php endforeach; ?>
                        </tbody>
                    </table>

                {% endblock %}

                {% block box_footer %}

                    <span class="pull-right">
                        {{ create_button('delete', '<?= $route_name ?>_delete', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}, 'ROLE_<?= $entity_class_name_upper ?>_DELETE') }}
                    </span>

                {% endblock %}

            {% endembed %}

        </div>
    </div>

{% endblock %}
