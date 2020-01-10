<?php

namespace Micayael\AdminLteMakerBundle\Framework\Base\CRUD;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class CriteriaSearchController extends BaseController implements CRUDInterface
{
    /**
     * @var ServiceEntityRepository $repository
     */
    protected $repository;

    abstract protected function getSubjectClass(): string;

    abstract protected function getTemplateName(): string;

    public function __invoke(Request $request, PaginatorInterface $paginator): Response
    {
        $qb = $this->createQueryBuilder();

        $query = $qb->getQuery();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            $this->getPaginatorLimit()
        );

        return $this->render($this->getTemplateName(), [
            'pagination' => $pagination,
        ]);
    }

    protected function getSubjectRepository(): ServiceEntityRepository
    {
        if (!$this->repository) {
            $this->repository = $this->getDoctrine()->getRepository($this->getSubjectClass());
        }

        return $this->repository;
    }

    protected function createQueryBuilder()
    {
        return $this->getSubjectRepository()->createQueryBuilder('o');
    }

    protected function getPaginatorLimit()
    {
        return 10;
    }
}
