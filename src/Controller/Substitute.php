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
        $errorOption = $this->substituteService->substitute($this->params('user'));
        foreach ($errorOption as $error) {
            return new JsonModel(['error' => $error]);
        }
        return $this->redirect()->toRoute('zfcuser');
    }

    public function unsubstituteAction() {
        $errorOption = $this->substituteService->unsubstitute();
        foreach ($errorOption as $error) {
            return new JsonModel(['error' => $error]);
        }
        return $this->redirect()->toRoute('zfcuser');
    }

}
