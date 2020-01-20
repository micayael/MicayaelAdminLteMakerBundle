<?= "<?php\n"; ?>

namespace <?= $namespace; ?>;

use Micayael\AdminLteMakerBundle\Framework\Base\BaseActionsViewHelper;
use Twig\TwigFunction;

class <?= $class_name; ?> extends BaseActionsViewHelper
{
    public function getFunctions()
    {
        return [
            new TwigFunction('<?= $entity_twig_var_singular; ?>_actions', [$this, 'create'], ['is_safe' => ['html']]),
        ];
    }

    protected function getActions($data, array $actions)
    {
        $actions['show'] = $this->createAction($this->actions['show']['name'], 'ROLE_<?= $entity_class_name_upper; ?>_READ', '<?= $route_name; ?>_show', [
        'id' => $data->getId(),
        ], $this->actions['show']['icon'], $this->actions['show']['class']);

        $actions['edit'] = $this->createAction($this->actions['edit']['name'], 'ROLE_<?= $entity_class_name_upper; ?>_UPDATE', '<?= $route_name; ?>_edit', [
        'id' => $data->getId(),
        ], $this->actions['edit']['icon'], $this->actions['edit']['class'], true);

        $actions['delete'] = $this->createAction($this->actions['delete']['name'], 'ROLE_<?= $entity_class_name_upper; ?>_DELETE', '<?= $route_name; ?>_delete', [
        'id' => $data->getId(),
        ], $this->actions['delete']['icon'], $this->actions['delete']['class'], true);

        return $actions;
    }
}