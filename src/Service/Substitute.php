<?php

namespace ZfcUserSubstitute\Service;

use Zend\Authentication\Storage\StorageInterface;
use Zend\Authentication\AuthenticationService;
use ZfcUser\Mapper\User as UserMapper;
use PhpOption\Option as PhpOption;

class Substitute {

    /**
     * @var StorageInterface
     */
    protected $storage;

    /**
     * @var AuthenticationService
     */
    protected $authService;

    /**
     * @var UserMapper
     */
    protected $userMapper;

    public function __construct(
    AuthenticationService $authService, UserMapper $userMapper,
    StorageInterface $storage
    ) {
        $this->setAuthService($authService);
        $this->setUserMapper($userMapper);
        $this->setStorage($storage);
    }

    /**
     * @param string $userId
     * @return PhpOption error reason
     */
    public function substitute($userId) {
        $identity = $this->getAuthService()->getIdentity();
        if (!$identity) {
            return PhpOption::ensure('Not logged in');
        }
        if (!$this->getStorage()->isEmpty()) {
            return PhpOption::ensure('Already substituted');
        }
        if (!$this->getUserMapper()->findById($userId)) {
            return PhpOption::ensure('Substitution user does not exist');
        }

        $this->getStorage()->write($identity);
        $this->getAuthService()->getStorage()->write($userId);
        return PhpOption::ensure(null);
    }

    /**
     * @return PhpOption error reason
     */
    public function unsubstitute() {
        if ($this->getStorage()->isEmpty()) {
            return PhpOption::ensure('Not substituted in the first place');
        }
        $originalUser = $this->getStorage()->read();
        $this->getStorage()->clear();

        $this->getAuthService()->getStorage()->write($originalUser->getId());
        return PhpOption::ensure(null);
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

    /**
     * @return UserMapper
     */
    public function getUserMapper() {
        return $this->userMapper;
    }

    public function setUserMapper(UserMapper $userMapper) {
        $this->userMapper = $userMapper;
        return $this;
    }

}
