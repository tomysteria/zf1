<?php

class Core_Plugin_AccessHandler extends Zend_Controller_Plugin_Abstract
{

    /**
     * Pre dispatch hook -- check for exceptions and dispatch access handler if
     * necessary
     * Checks if the current user identified by roleName has rights to the
     * requested url (module/controller/action)
     *
     * @param Zend_Controller_Request_Abstract $request         
     */
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
        //Récupération des erreurs si existante
        $errors = $request->getParam('error_handler');

        if (! $errors || ! $errors instanceof ArrayObject) {
            $this->_handleAccess($request);
        }
    }

    /**
     * Check if the controller/action can be accessed by the current user
     */
    protected function _handleAccess (Zend_Controller_Request_Abstract $request)
    {
        //Check disabled AccessHandler
        $frontController = Zend_Controller_Front::getInstance();
        if ($frontController->getParam('noAccessHandler')) {
            return;
        }

        // Get exception information
        $access = new ArrayObject(array(), ArrayObject::ARRAY_AS_PROPS);

        $module = $request->getModuleName();
        if($module == null) $module = Zend_Controller_Front::getInstance()->getDispatcher()->getDefaultModule();

        $controller = $request->getControllerName();
        $action = $request->getActionName();
        $acl = Zend_Registry::get('Zend_Acl');

        $auth = Zend_Auth::getInstance();

        if ($auth->hasIdentity()) {
            $userAuth = $auth->getIdentity();
        } else {
            //Initialisation avec un Role User correspondant à  GUEST (Non connecté)
            $mapperUser = new Model_Mapper_User();
            $userAuth = $mapperUser->createRow ( array ('role' => Model_User::GUEST ) );
        }

        $roleAuth = $userAuth->getRoleid();

        // action/resource does not exist in ACL -> 404
        if (! $acl->has($module . '::' . $controller . '::' . $action)) {
            throw new Zend_Controller_Dispatcher_Exception('_ERR_page_not_found');
        } else if (! $acl->isAllowed($userAuth, $module . '::' . $controller . '::' . $action, 'access')) { // resource does exist, check ACL
            throw new Lbj_Acl_Exception($acl, $userAuth, $module . '::' . $controller . '::' . $action, 'access');               
        }
    }
}
?>