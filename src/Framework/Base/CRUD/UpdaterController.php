<?php

namespace Micayael\AdminLteMakerBundle\Framework\Base\CRUD;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Micayael\AdminLteMakerBundle\Exception\RedirectException;
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

    abstract protected function getSubjectClass(): string;

    abstract protected function getSubjectName(): string;

    abstract protected function getSubjectFormTypeClass(): string;

    abstract protected function getTargetRouteName(): string;

    abstract protected function getTemplateName(): string;

    public function __invoke(Request $request, EntityManagerInterface $em, TranslatorInterface $translator): Response
    {
        $this->subject = $this->getSubjectRepository()->find($request->get('id'));

        $this->throw404IfNotFound($this->getSubject());

        $form = $this->createForm($this->getSubjectFormTypeClass(), $this->getSubject());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try {
                $em->lock($this->getSubject(), LockMode::OPTIMISTIC, $form->getData()->getRevision());

                $this->preUpdate($this->getSubject());

                $em->flush();

                $this->addSuccessMessage($translator->trans('crud.msg.edit', [], 'MicayaelAdminLteMakerBundle'));

                return $this->redirectToRoute($this->getTargetRouteName());
            } catch (OptimisticLockException $e) {
                throw $this->createRedirectException($request, $translator);
            }
        }

        return $this->render($this->getTemplateName(), [
            $this->getSubjectName() => $this->getSubject(),
            'form' => $form->createView(),
        ]);
    }

    protected function createRedirectException(Request $request, TranslatorInterface $translator)
    {
        $routeData = $this->getOptimisticLockRedirectionRouteData($request);

        $routeName = $routeData['route'];
        $routeParams = $routeData['route_params'];

        $message = $translator->trans('crud.msg.optimistic_lock_detected', [], 'MicayaelAdminLteMakerBundle');

        return new RedirectException($message, $routeName, $routeParams);
    }

    protected function getOptimisticLockRedirectionRouteData(Request $request): array
    {
        return [
            'route' => $request->get('_route'),
            'route_params' => [
                'id' => $this->getSubject()->getId(),
            ],
        ];
    }

    protected function preUpdate($subject)
    {
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
