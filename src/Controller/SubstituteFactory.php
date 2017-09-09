<?php

namespace ZfcUserSubstitute\Controller;

use ZfcUserSubstitute\Service\Substitute as SubstituteService;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class SubstituteFactory implements FactoryInterface {

    public function __invoke(
    ContainerInterface $container, $requestedName, array $options = null
    ) {
        return new Substitute($container->get(SubstituteService::class));
    }

}
