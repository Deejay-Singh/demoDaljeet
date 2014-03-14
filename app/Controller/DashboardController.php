<?php
App::uses('AppController', 'Controller');
class DashboardController extends AppController {
    public $name = "Dashboard";
    public $uses = array( 'Video' );
    
    public function index() {
		if( $this->Session->read( 'Auth.User.is_admin' ) ) {
			$videos = $this->Video->find( 'count' );
			$this->set( 'videos', $videos );
		} else {
			$videos = $this->Video->find( 'count', array( 'conditions' => array( 'is_active' => '1', 'user_id' => $this->Session->read( 'Auth.User.id' ) ) ) );
			$this->set( 'videos', $videos );
		}
	}
	
}
