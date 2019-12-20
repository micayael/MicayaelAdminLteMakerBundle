<?php

namespace Micayael\AdminLteMakerBundle\Framework\Base\CRUD;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class UpdaterController extends BaseController implements CRUDInterface
{
    private $subject;

    /**
     * @var ServiceEntityRepository $repository
     */
    protected $repository;

    abstract protected function getSubjectName(): string;

    abstract protected function getSubjectFormTypeClass(): string;

    abstract protected function getTemplateName(): string;

    abstract protected function getTargetRouteName(): string;

    public function __invoke(Request $request, TranslatorInterface $translator): Response
    {
        $this->subject = $this->getRepository()->find($request->get('id'));

        if (!$this->getSubject()) {
            throw $this->createNotFoundException();
        }

        $form = $this->createForm($this->getSubjectFormTypeClass(), $this->getSubject());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->preUpdate($this->getSubject());

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash('success', $translator->trans('crud.msg.edit', [], 'MicayaelAdminLteMakerBundle'));

            return $this->redirectToRoute($this->getTargetRouteName());
        }

        return $this->render($this->getTemplateName(), [
            $this->getSubjectName() => $this->getSubject(),
            'form' => $form->createView(),
        ]);
    }

    protected function preUpdate($subject)
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
