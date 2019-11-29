<?= "<?php\n" ?>

namespace <?= $namespace ?>;

<?php if (isset($repository_full_class_name)): ?>
use <?= $repository_full_class_name ?>;
<?php endif ?>
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\<?= $parent_class_name ?>;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
* @Security("is_granted('ROLE_SUPER_ADMIN') or is_granted('ROLE_<?= $entity_class_name_upper ?>_READ')")
*/
class <?= $class_name ?> extends <?= $parent_class_name; ?><?= "\n" ?>
{

    private $paginator;

    private $<?= $repository_var ?>;

    public function __construct(PaginatorInterface $paginator, <?= $repository_class_name ?> $<?= $repository_var ?>)
    {
        $this->paginator = $paginator;
        $this-><?= $repository_var ?> = $<?= $repository_var ?>;
    }

    public function __invoke(Request $request): Response
    {
        $qb = $this-><?= $repository_var ?>->createQueryBuilder('<?= substr($route_name, 0, 1) ?>');

        $query = $qb->getQuery();

        $pagination = $this->paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('<?= $templates_path ?>/index.html.twig', [
            'pagination' => $pagination,
        ]);
    }

}
