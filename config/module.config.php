<?php

namespace ZfcUserSubstitute;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'service_manager' => [
        'factories' => [
            Authentication\Adapter\Substitute::class => InvokableFactory::class,
        ],
    ],
];
