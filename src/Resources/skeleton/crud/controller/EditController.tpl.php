<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use <?= $entity_full_class_name ?>;
use <?= $form_full_class_name ?>;
use Micayael\AdminLteMakerBundle\Event\MicayaelAdminLteMakerEvents;
use Micayael\AdminLteMakerBundle\Event\MicayaelAdminLteMakerCrudEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\<?= $parent_class_name ?>;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
* @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_<?= $entity_class_name_upper ?>_UPDATE')")
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
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $event = new MicayaelAdminLteMakerCrudEvent($form->getData());
            $this->eventDispatcher->dispatch($event, MicayaelAdminLteMakerEvents::MICAYAEL_ADMIN_LTE_MAKER_EDIT_PRE_UPDATE);

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', 'Registro grabado con éxito');

            return $this->redirectToRoute('<?= $route_name ?>_index');
        }

        return $this->render('<?= $templates_path ?>/edit.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
        ]);
    }

}
