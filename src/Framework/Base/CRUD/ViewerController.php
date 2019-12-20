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

    abstract protected function getSubjectName(): string;

    abstract protected function getTemplateName(): string;

    public function __invoke(Request $request): Response
    {
        $this->subject = $this->getRepository()->find($request->get('id'));

        if (!$this->getSubject()) {
            throw $this->createNotFoundException();
        }

        return $this->render($this->getTemplateName(), [
            $this->getSubjectName() => $this->getSubject(),
        ]);
    }

    protected function getRepository(): ServiceEntityRepository
    {
        return $this->repository;
    }

    protected function getSubject()
    {
        return $this->subject;
    }
}
