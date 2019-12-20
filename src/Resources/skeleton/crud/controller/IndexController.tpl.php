<?= "<?php\n"; ?>

namespace <?= $namespace; ?>;

use <?= $repository_full_class_name; ?>;
use Micayael\AdminLteMakerBundle\Framework\Base\CRUD\CriteriaSearchController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
* @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_<?= $entity_class_name_upper; ?>_READ')")
*/
class <?= $class_name; ?> extends CriteriaSearchController
{
    /**
    * @required
    */
    public function setRepository(<?= $repository_class_name; ?> $<?= $repository_var; ?>): void
    {
        $this->repository = $<?= $repository_var; ?>;
    }

    protected function getTemplateName(): string
    {
        return '<?= $templates_path; ?>/index.html.twig';
    }
}
