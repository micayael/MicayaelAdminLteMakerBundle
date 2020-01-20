<?php

namespace Micayael\AdminLteMakerBundle\EventSubscriber;

use Micayael\AdminLteMakerBundle\Exception\RedirectException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;

/**
 * Este EventSubscriber detecta un RedirectException para redireccionar a la url definida mostrando un mensaje.
 *
 * Class RedirectExceptionSubscriber
 */
class RedirectExceptionSubscriber implements EventSubscriberInterface
{
    private $router;
    private $flashBag;

    public function __construct(RouterInterface $router, FlashBagInterface $flashBag)
    {
        $this->router = $router;
        $this->flashBag = $flashBag;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'onKernelException',
        ];
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof RedirectException) {
            if ($exception->getMessage()) {
                $this->flashBag->add($exception->getMessageType(), $exception->getMessage());
            }

            $redirectUrl = $this->router->generate($exception->getRoute(), $exception->getRouteParams());

            $event->setResponse(new RedirectResponse($redirectUrl));
        }
    }
}
