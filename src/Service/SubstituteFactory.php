<?php

namespace ZfcUserSubstitute\Service;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Authentication\Storage\Session;

class SubstituteFactory implements FactoryInterface {

    public function __invoke(
    ContainerInterface $container, $requestedName, array $options = null
    ) {
        $service = new Substitute(
        $container->get('zfcuser_auth_service'),
        $container->get('zfcuser_user_mapper'),
        new Session(Substitute::class, 'storage')
        );
        return $service;
    }

}
