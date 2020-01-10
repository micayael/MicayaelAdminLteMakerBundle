<?= "<?php\n"; ?>

namespace <?= $namespace; ?>;

use <?= $entity_full_class_name; ?>;
use <?= $form_full_class_name; ?>;
use Micayael\AdminLteMakerBundle\Framework\Base\CRUD\UpdaterController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
* @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_<?= $entity_class_name_upper; ?>_UPDATE')")
*/
class <?= $class_name; ?> extends UpdaterController
{
    protected function getSubjectClass(): string
    {
        return <?= $entity_class_name; ?>::class;
    }

    protected function getSubjectFormTypeClass(): string
    {
        return <?= $form_class_name; ?>::class;
    }

    protected function getSubjectName(): string
    {
        return '<?= $entity_twig_var_singular; ?>';
    }

    protected function getTargetRouteName(): string
    {
        return '<?= $route_name; ?>_index';
    }

    protected function getTemplateName(): string
    {
        return '<?= $templates_path; ?>/edit.html.twig';
    }
}
