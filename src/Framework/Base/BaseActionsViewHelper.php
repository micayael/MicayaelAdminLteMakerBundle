<?php

namespace Micayael\AdminLteMakerBundle\Framework\Base;

use Nzo\UrlEncryptorBundle\UrlEncryptor\UrlEncryptor;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;

abstract class BaseActionsViewHelper extends AbstractExtension
{
    abstract protected function getActions($data, array $actions);

    protected $router;
    protected $translator;
    protected $authorizationChecker;
    protected $twig;
    protected $urlEncryptor;

    protected $actions = [
        'index' => [
            'name' => 'crud.action.index',
            'icon' => 'fas fa-list',
            'class' => 'default',
        ],
        'new' => [
            'name' => 'crud.action.new',
            'icon' => 'fa fa-plus-circle',
            'class' => 'default',
        ],
        'show' => [
            'name' => 'crud.action.show',
            'icon' => 'fas fa-eye',
            'class' => 'default',
        ],
        'edit' => [
            'name' => 'crud.action.edit',
            'icon' => 'fas fa-edit',
            'class' => 'warning',
        ],
        'delete' => [
            'name' => 'crud.action.delete',
            'icon' => 'fas fa-trash-alt',
            'class' => 'danger',
        ],
    ];

    public function __construct(
        RouterInterface $router,
        TranslatorInterface $translator,
        AuthorizationCheckerInterface $authorizationChecker,
        Environment $twig,
        UrlEncryptor $urlEncryptor
    ) {
        $this->router = $router;
        $this->translator = $translator;
        $this->authorizationChecker = $authorizationChecker;
        $this->twig = $twig;
        $this->urlEncryptor = $urlEncryptor;
    }

    /**
     * Crea el código HTML para el combo de acciones de una lista.
     *
     * @param mixed $data
     *
     * @return string
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function create($data, $inline = false)
    {
        $actions = $this->getActions($data, []);

        $template = '@MicayaelAdminLteMaker/ViewHelpers/view_helper.html.twig';

        if ($inline) {
            $template = '@MicayaelAdminLteMaker/ViewHelpers/view_helper_inline.html.twig';
        }

        return $this->twig->render($template, [
            'actions' => $actions,
        ]);
    }

    /**
     * Retorna la plantilla a utilizar.
     *
     * @return string
     */
    protected function getTemplate()
    {
        return '@MicayaelAdminLteMaker/ViewHelpers/view_helper.html.twig';
    }

    /**
     * Helper para crear un action aplicando la seguridad básica.
     *
     * @param $text
     * @param $role
     * @param $route
     * @param array  $routeParams
     * @param string $icon
     * @param null   $type
     * @param bool   $divider
     *
     * @return array
     */
    protected function createAction($text, $role, $route, $routeParams = [], $icon = '', $type = null, $divider = false)
    {
        $action = [
            'text' => $this->translator->trans($text),
            'url' => $this->router->generate($route, $routeParams),
            'role' => $role,
            'extras' => [
                'route' => $route,
            ],
        ];

        if ($icon) {
            $action['icon'] = $icon;
        }

        if ($type) {
            $action['type'] = $type;
        }

        if ($divider) {
            $action['divider'] = $divider;
        }

        return $action;
    }

    protected function arrayKeysToSnakeCase(array $array)
    {
        foreach ($array as $key => $value) {
            if (is_array($array[$key])) {
                $array[$key] = $this->arrayKeysToSnakeCase($array[$key]);
            }

            unset($array[$key]);
            $key = strtolower(preg_replace(['/([a-z\d])([A-Z])/', '/([^_])([A-Z][a-z])/'], '$1_$2', $key));
            $array[$key] = $value;
        }

        return $array;
    }
}
