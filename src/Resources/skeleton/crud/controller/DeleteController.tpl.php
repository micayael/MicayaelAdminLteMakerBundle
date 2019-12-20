<?= "<?php\n"; ?>

namespace <?= $namespace; ?>;

use <?= $repository_full_class_name; ?>;
use Micayael\AdminLteMakerBundle\Framework\Base\CRUD\DestructorController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
* @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_<?= $entity_class_name_upper; ?>_DELETE')")
*/
class <?= $class_name; ?> extends DestructorController
{
    /**
    * @required
    */
    public function setRepository(<?= $repository_class_name; ?> $<?= $repository_var; ?>): void
    {
        $this->repository = $<?= $repository_var; ?>;
    }

    protected function getSubjectName(): string
    {
        return '<?= $entity_twig_var_singular; ?>';
    }

    protected function getTemplateName(): string
    {
        return '<?= $templates_path; ?>/delete.html.twig';
    }

    protected function getTargetRouteName(): string
    {
        return '<?= $route_name; ?>_index';
    }
}
