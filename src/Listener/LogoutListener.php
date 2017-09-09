<?php

namespace ZfcUserSubstitute\Listener;

use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\EventManager\ListenerAggregateTrait;
use ZfcUserSubstitute\Service\Substitute;

class LogoutListener implements ListenerAggregateInterface {

    use ListenerAggregateTrait;

    public function attach(EventManagerInterface $events, $priority = 1) {
        $this->listeners[] = $events->attach(
        MvcEvent::EVENT_FINISH, [$this, 'clearOnLogout']
        );
    }

    public function clearOnLogout(MvcEvent $event) {
        $serviceManager = $event->getApplication()->getServiceManager();

        /* @var $substitute Substitute */
        $substitute = $serviceManager->get(Substitute::class);
        if (!$substitute->getAuthService()->getIdentity()) {
            $substitute->clear();
        }
    }

}
