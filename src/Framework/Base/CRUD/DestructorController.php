<?php

namespace Micayael\AdminLteMakerBundle\Framework\Base\CRUD;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class DestructorController extends BaseController implements CRUDInterface
{
    private $subject;

    /**
     * @var ServiceEntityRepository $repository
     */
    protected $repository;

    abstract protected function getSubjectName(): string;

    abstract protected function getTemplateName(): string;

    abstract protected function getTargetRouteName(): string;

    public function __invoke(Request $request, TranslatorInterface $translator): Response
    {
        $this->subject = $this->getRepository()->find($request->get('id'));

        if (!$this->getSubject()) {
            throw $this->createNotFoundException();
        }

        if ($request->isMethod('get')) {
            return $this->render($this->getTemplateName(), [
                $this->getSubjectName() => $this->getSubject(),
            ]);
        }

        if ($this->isCsrfTokenValid('delete'.$this->getSubject()->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();

            $this->preRemove($this->getSubject());

            $entityManager->remove($this->getSubject());
            $entityManager->flush();

            $this->addFlash('success', $translator->trans('crud.msg.delete', [], 'MicayaelAdminLteMakerBundle'));
        }

        return $this->redirectToRoute($this->getTargetRouteName());
    }

    protected function preRemove($subject)
    {
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
