<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {
    public $uses            = array( 'User'  );
    public $helpers         = array( 'Html', 'Form', 'Session', 'Xyz' );
    public $components      = array(
            'Session', 'Cookie', 'RequestHandler', 'Xyz',
            'Auth' => array('authorize' => array('Controller'), 'loginAction' => array('controller' => 'users', 'action' => 'login')),
    );
    public $allowedActions = array( "users" => array( "_processlogin", "randomstring"), "dashboard" => array( "index" ) );
    
    public function restlogFilter ($Rest, $log) {
        return $log;
    }
    
    public function beforeFilter() {
        Security::setHash('md5');
        $this->Auth->authenticate = array('Custom');
        $this->Auth->allow('login', 'logout', 'reset' );
        $this->Auth->authError = "Please login to continue.";
    }
    
    public function isAuthorized() {
        if( $this->Session->check( 'Auth.User' ) ) return true;
        $this->Session->setflash(__("Unauthorized access."), 'default', array( 'class' => 'alert alert-error' ) );
        return false;
    }
}
