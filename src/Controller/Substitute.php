<?php

namespace ZfcUserSubstitute\Controller;

use ZfcUserSubstitute\Service\Substitute as SubstituteService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

class Substitute extends AbstractActionController {

    /**
     * @var SubstituteService
     */
    protected $substituteService;

    public function __construct(SubstituteService $substituteService) {
        $this->substituteService = $substituteService;
    }

    public function substituteAction() {
        $result = $this->substituteService->substitute($this->params('user'));
        return new JsonModel($result);
    }

    public function unsubstituteAction() {
        $result = $this->substituteService->unsubstitute();
        return new JsonModel($result);
    }

}
