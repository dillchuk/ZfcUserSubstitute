<?php

namespace ZfcUserSubstitute\Service;

use Zend\Authentication\Storage\StorageInterface;
use Zend\Authentication\AuthenticationService;

class Substitute {

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var AuthenticationService
     */
    protected $authService;

    public function __construct(
    AuthenticationService $authService, StorageInterface $storage
    ) {
        $this->setAuthService($authService);
        $this->setStorage($storage);
    }

    public function substitute($userId) {
        $error['result'] = 'error';
        $success['result'] = 'success';

        $identity = $this->getAuthService()->getIdentity();
        if (!$identity) {
            return $error + ['message' => 'Not logged in'];
        }
        if (!$this->getStorage()->isEmpty()) {
            return $error + ['message' => 'Already substituted'];
        }
        $this->getStorage()->write($identity);

        $this->getAuthService()->getStorage()->write($userId);
        return $success;
    }

    public function unsubstitute() {
        $error['result'] = 'error';
        $success['result'] = 'success';

        if ($this->getStorage()->isEmpty()) {
            return $error + ['message' => 'Not substituted'];
        }
        $originalUser = $this->getStorage()->read();
        $this->getStorage()->clear();

        $this->getAuthService()->getStorage()->write($originalUser->getId());
        return $success;
    }

    public function isSubstituted() {
        return !$this->getStorage()->isEmpty();
    }

    public function getOriginalIdentity() {
        return $this->getStorage()->read();
    }

    public function clear() {
        $this->getStorage()->clear();
    }

    /**
     * @return StorageInterface
     */
    public function getStorage() {
        return $this->storage;
    }

    public function setStorage(StorageInterface $storage) {
        $this->storage = $storage;
        return $this;
    }

    /**
     * @return AuthenticationService
     */
    public function getAuthService() {
        return $this->authService;
    }

    public function setAuthService(AuthenticationService $authService) {
        $this->authService = $authService;
        return $this;
    }

}
