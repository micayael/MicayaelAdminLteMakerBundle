<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use <?= $entity_full_class_name ?>;
use Micayael\AdminLteMakerBundle\Event\MicayaelAdminLteMakerEvents;
use Micayael\AdminLteMakerBundle\Event\MicayaelAdminLteMakerCrudEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\<?= $parent_class_name ?>;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
* @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_<?= $entity_class_name_upper ?>_DELETE')")
*/
class <?= $class_name ?> extends <?= $parent_class_name; ?><?= "\n" ?>
{

    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(Request $request, <?= $entity_class_name ?> $<?= $entity_var_singular ?>): Response
    {
        if($request->isMethod('get')){

            return $this->render('<?= $templates_path ?>/delete.html.twig', [
                '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            ]);

        }

        if ($this->isCsrfTokenValid('delete'.$<?= $entity_var_singular ?>->get<?= ucfirst($entity_identifier) ?>(), $request->request->get('_token'))) {

            $event = new MicayaelAdminLteMakerCrudEvent($<?= $entity_var_singular ?>);
            $this->eventDispatcher->dispatch($event, MicayaelAdminLteMakerEvents::MICAYAEL_ADMIN_LTE_MAKER_DELETE_PRE_DELETE);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($<?= $entity_var_singular ?>);

            $this->addFlash('success', 'Registro eliminado con éxito');

        }

        return $this->redirectToRoute('<?= $route_name ?>_index');
    }

}
