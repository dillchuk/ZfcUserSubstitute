<?php

namespace ZfcUserSubstitute\Authentication\Adapter;

use ZfcUser\Authentication\Adapter\AbstractAdapter;
use Zend\Authentication\Result as AuthenticationResult;
use ZfcUser\Authentication\Adapter\AdapterChainEvent as AuthEvent;

class Substitute extends AbstractAdapter {

    public function authenticate(AuthEvent $event) {
        $event->setCode(AuthenticationResult::FAILURE)
        ->setMessages(['Not implemented']);
        return false;
    }

}
