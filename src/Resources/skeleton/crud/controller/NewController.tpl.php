<?= "<?php\n" ?>

namespace <?= $namespace ?>;

use App\Framework\Base\BaseController;
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
* @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_<?= $entity_class_name_upper ?>_CREATE')")
*/
class <?= $class_name ?> extends BaseController
{

    private $eventDispatcher;

    public function __construct(EventDispatcherInterface $eventDispatcher)
    {
        $this->eventDispatcher = $eventDispatcher;
    }

    public function __invoke(Request $request): Response
    {
        $<?= $entity_var_singular ?> = new <?= $entity_class_name ?>();
        $form = $this->createForm(<?= $form_class_name ?>::class, $<?= $entity_var_singular ?>);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $event = new MicayaelAdminLteMakerCrudEvent($form->getData());
            $this->eventDispatcher->dispatch($event, MicayaelAdminLteMakerEvents::MICAYAEL_ADMIN_LTE_MAKER_NEW_PRE_PERSIST);

            $entityManager->persist($<?= $entity_var_singular ?>);
            $entityManager->flush();

            $this->addFlash('success', 'Registro grabado con éxito');

            return $this->redirectToRoute('<?= $route_name ?>_index');
        }

        return $this->render('<?= $templates_path ?>/new.html.twig', [
            '<?= $entity_twig_var_singular ?>' => $<?= $entity_var_singular ?>,
            'form' => $form->createView(),
        ]);
    }

}
