<?php

namespace ZfcUserSubstitute;

use Zend\EventManager\EventInterface;

class Module {

    public function getConfig() {
        return include __DIR__ . '/../config/module.config.php';
    }

    public function onBootstrap(EventInterface $event) {
        $application = $event->getApplication();
        $logoutListener = $application->getServiceManager()->get(
        Listener\LogoutListener::class
        );
        $logoutListener->attach($application->getEventManager());
    }

}
