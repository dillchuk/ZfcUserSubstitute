<?php

namespace ZfcUserSubstitute\View\Helper;

use ZfcUserSubstitute\Service\Substitute;
use Zend\View\Helper\AbstractHelper;

class OriginalIdentity extends AbstractHelper {

    /**
     * @var Substitute
     */
    protected $substituteService;

    public function __construct(Substitute $substituteService) {
        $this->setSubstituteService($substituteService);
    }

    public function __invoke() {
        return $this->getSubstituteService()->getOriginalIdentity();
    }

    /**
     * @return Substitute
     */
    public function getSubstituteService() {
        return $this->substituteService;
    }

    public function setSubstituteService(Substitute $substituteService) {
        $this->substituteService = $substituteService;
        return $this;
    }

}
