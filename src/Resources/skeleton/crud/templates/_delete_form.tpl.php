{% if is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_<?= $entity_class_name_upper ?>_DELETE') %}

    <form method="post" action="{{ path('<?= $route_name ?>_delete', {'<?= $entity_identifier ?>': <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>}) }}">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="_token" value="{{ csrf_token('delete' ~ <?= $entity_twig_var_singular ?>.<?= $entity_identifier ?>) }}">
        <button class="btn btn-danger"><i class="fas fa-trash-alt"></i> {{ 'crud.action.delete_confirm'|trans({}, 'MicayaelAdminLteMakerBundle') }}</button>
    </form>

{% endif %}
