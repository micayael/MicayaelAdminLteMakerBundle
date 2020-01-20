<table class="table">
    <tbody>
<?php foreach ($entity_fields as $field): ?>
<?php if ('id' === $field['fieldName']) {
    continue;
} ?>
        <tr>
            <th class="col-lg-2"><?= ucfirst($field['fieldName']); ?>:</th>
<?php if ('boolean' === $field['type']): ?>
                <td>{{ boolean_value(<?= $entity_twig_var_singular; ?>.<?= $field['fieldName']; ?>) }}</td>
<?php elseif (in_array($field['type'], ['datetime_immutable', 'datetime'])): ?>
                <td>{{ <?= $entity_twig_var_singular; ?>.<?= $field['fieldName']; ?>|date('d-m-Y H:i:s') }}</td>
<?php elseif (in_array($field['type'], ['date_immutable', 'date'])): ?>
                <td>{{ <?= $entity_twig_var_singular; ?>.<?= $field['fieldName']; ?>|date('d-m-Y') }}</td>
<?php elseif (in_array($field['type'], ['time_immutable', 'time'])): ?>
                <td>{{ <?= $entity_twig_var_singular; ?>.<?= $field['fieldName']; ?>|date('H:i:s') }}</td>
<?php else: ?>
                <td>{{ <?= $helper->getEntityFieldPrintCode($entity_twig_var_singular, $field); ?> }}</td>
<?php endif; ?>
        </tr>
<?php endforeach; ?>
    </tbody>
</table>