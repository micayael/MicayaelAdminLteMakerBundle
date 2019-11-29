{% extends 'admin.html.twig' %}

{% block page_title %}

    {{ 'crud.title.new'|trans({'%entity_class_name%': '<?= $entity_class_name ?>'}, 'MicayaelAdminLteMakerBundle') }}

{% endblock %}

{% block breadcrumb %}

    {% embed '@MicayaelAdminLteMaker/Widgets/breadcrumb.html.twig' %}

        {% block content %}
            <li><a href="{{ path('<?= $route_name ?>_index') }}"><?= $entity_class_name_plural ?></a></li>
            <li class="active">{{ 'crud.action.new'|trans({}, 'MicayaelAdminLteMakerBundle') }}</li>
        {% endblock %}

    {% endembed %}

{% endblock %}

{% block page_content %}

    <div class="row">
        <div class="col-md-12">

            {% embed '@MicayaelAdminLteMaker/Widgets/context_menu.html.twig' %}

                {% block actions %}
                    <li>
                        {{ create_link('index', '<?= $route_name ?>_index', {}, 'ROLE_<?= $entity_class_name_upper ?>_READ') }}
                    </li>
                {% endblock %}

            {% endembed %}

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            {{ form_start(form) }}

                {% embed '@AdminLTE/Widgets/box-widget.html.twig' %}

                    {% block box_body %}

                        {{ form_widget(form) }}

                    {% endblock %}

                    {% block box_footer %}

                        {{ create_extra_button('crud.action.save', 'ROLE_<?= $entity_class_name_upper ?>_CREATE', 'primary', 'fas fa-save') }}

                    {% endblock %}

                {% endembed %}

            {{ form_end(form) }}

        </div>
    </div>

{% endblock %}
