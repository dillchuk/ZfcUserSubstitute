<?php

namespace ZfcUserSubstitute;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            Service\Substitute::class => Service\SubstituteFactory::class,
            Listener\LogoutListener::class => InvokableFactory::class,
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\Substitute::class => Controller\SubstituteFactory::class,
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\OriginalIdentity::class => View\Helper\OriginalIdentityFactory::class,
        ],
        'aliases' => [
            'originalIdentity' => View\Helper\OriginalIdentity::class,
        ],
    ],
    'router' => [
        'routes' => [
            'zfcusersubstitute' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/admin/user',
                    'defaults' => [
                        'controller' => Controller\Substitute::class,
                    ],
                ],
                'may_terminate' => false,
                'child_routes' => [
                    'substitute' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/[:action]/:user',
                            'constraints' => [
                                'action' => 'substitute'
                            ],
                        ],
                    ],
                    'unsubstitute' => [
                        'type' => Literal::class,
                        'options' => [
                            'route' => '/unsubstitute',
                            'defaults' => [
                                'action' => 'unsubstitute',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
];
