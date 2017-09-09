<?php

namespace ZfcUserSubstitute\View\Helper;

use ZfcUserSubstitute\Service\Substitute;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class OriginalIdentityFactory implements FactoryInterface {

    public function __invoke(
    ContainerInterface $container, $requestedName, array $options = null
    ) {
        return new OriginalIdentity($container->get(Substitute::class));
    }

}
