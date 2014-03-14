<?php
App::uses('AppController', 'Controller');
class VideosController extends AppController {
    public $name = "Videos";
    public $uses = array( 'Video', 'User' );
    
    public function index() {
	}
	
	public function upload() {
		$users = $this->User->find( 'list', array( 'fields' => array( 'id', 'user_name' ), 'conditions' => array( 'is_admin' => 0 ) ) );
		$this->set( 'users', $users );
	}
	
}
