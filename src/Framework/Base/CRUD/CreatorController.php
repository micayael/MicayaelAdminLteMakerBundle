<?php

namespace Micayael\AdminLteMakerBundle\Framework\Base\CRUD;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

abstract class CreatorController extends BaseController implements CRUDInterface
{
    private $subject;

    abstract protected function createSubject();

    abstract protected function getSubjectName(): string;

    abstract protected function getSubjectFormTypeClass(): string;

    abstract protected function getTargetRouteName(): string;

    abstract protected function getTemplateName(): string;

    public function __invoke(Request $request, TranslatorInterface $translator): Response
    {
        $this->subject = $this->createSubject();

        $form = $this->createForm($this->getSubjectFormTypeClass(), $this->getSubject());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $this->prePersist($this->subject);

            $entityManager->persist($this->getSubject());
            $entityManager->flush();

            $this->addFlash('success', $translator->trans('crud.msg.new', [], 'MicayaelAdminLteMakerBundle'));

            return $this->redirectToRoute($this->getTargetRouteName());
        }

        return $this->render($this->getTemplateName(), [
            $this->getSubjectName() => $this->getSubject(),
            'form' => $form->createView(),
        ]);
    }

    protected function getSubject()
    {
        return $this->subject;
    }

    protected function prePersist($subject)
    {
    }
}
