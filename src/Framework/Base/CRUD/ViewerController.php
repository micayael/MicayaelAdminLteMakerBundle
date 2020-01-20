<?php

namespace Micayael\AdminLteMakerBundle\Framework\Base\CRUD;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class ViewerController extends BaseController implements CRUDInterface
{
    private $subject;

    /**
     * @var ServiceEntityRepository $repository
     */
    protected $repository;

    abstract protected function getSubjectClass(): string;

    abstract protected function getSubjectName(): string;

    abstract protected function getTemplateName(): string;

    public function __invoke(Request $request): Response
    {
        $this->subject = $this->getSubjectRepository()->find($request->get('id'));

        $this->throw404IfNotFound($this->getSubject());

        return $this->render($this->getTemplateName(), [
            $this->getSubjectName() => $this->getSubject(),
        ]);
    }

    protected function getSubjectRepository(): ServiceEntityRepository
    {
        if (!$this->repository) {
            $this->repository = $this->getDoctrine()->getRepository($this->getSubjectClass());
        }

        return $this->repository;
    }

    protected function getSubject()
    {
        return $this->subject;
    }
}
