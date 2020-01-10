<?= "<?php\n"; ?>

namespace <?= $namespace; ?>;

use <?= $entity_full_class_name; ?>;
use Micayael\AdminLteMakerBundle\Framework\Base\CRUD\CriteriaSearchController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
* @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_<?= $entity_class_name_upper; ?>_READ')")
*/
class <?= $class_name; ?> extends CriteriaSearchController
{
    protected function getSubjectClass(): string
    {
        return <?= $entity_class_name; ?>::class;
    }

    protected function getTemplateName(): string
    {
        return '<?= $templates_path; ?>/index.html.twig';
    }
}
