<?php
App::uses('AppController', 'Controller');
class VideosController extends AppController {
    public $name = "Videos";
    public $uses = array( 'Video', 'User' );
    
    public function index() {
		$users = $this->User->find( 'list', array( 'fields' => array( 'id', 'user_name' ) ) );
		$this->set( 'users', $users );
		$cmpny = $this->User->find( 'list', array( 'fields' => array( 'id', 'company_name' ), 'conditions' => array( 'is_admin' => 0 ) ) );
		$this->set( 'cmpny', $cmpny );
		if( $this->Session->read( 'Auth.User.is_admin' ) ) { 
			$vids = $this->Video->find( 'all', array( 'conditions' => array( 'is_active' => 1 ) ) );
			$this->set( 'vids', $vids );
		} else {
			$vids = $this->Video->find( 'all', array( 'conditions' => array( 'user_id' => $this->Session->read( 'Auth.User.id' ), 'is_active' => 1 ) ) );
			$this->set( 'vids', $vids );
		}
	}
	
	public function upload() {
		if( !$this-> Session->read( 'Auth.User.is_admin' ) ) {
			$this->Session->setFlash(__( 'Action not allowed' ), 'default', array( 'class' => 'alert alert-error' ) );
			$this->redirect( array( 'action' => 'index' ) );
		}
		if( $data = $this->request->data ) {
			if( !isset( $data['file_name'] ) ||  $data['file_name'] == '' ) {
				if( $_FILES['upload_file']['type'] != 'application/x-shockwave-flash' ) {
					$this->Session->setFlash(__( 'Only SWF Files' ), 'default', array( 'class' => 'alert alert-error' ) );
					$this->redirect( array( 'action' => 'index' ) );
				}
				$fileExtension = "." . end(explode( '.', $_FILES['upload_file']['name']));
				$dir = WWW_ROOT . 'vids/';
				if (!is_dir($dir)) {
					mkdir($dir);
				}
				$video = null;
				foreach( $_FILES as $k => $file ) {
					if( !empty( $file['name'] ) ) {
						if( $fileExtension != '') {
							$fileName = sha1( $data['name'] . time() . rand(0, 885466348) ) . "_video";
							move_uploaded_file( $file['tmp_name'], $dir. $fileName . $fileExtension );
							$video = $fileName . $fileExtension;
						}
					}
				}
				$data['file_name'] = $video;
			}
			$this->Video->create();
			$this->Video->save( $data );
			$this->Session->setFlash(__( 'Video Uploaded' ), 'default', array( 'class' => 'alert alert-success' ) );
			$this->redirect( array( 'action' => 'index' ) );
		}
		$users = $this->User->find( 'list', array( 'fields' => array( 'id', 'company_name' ), 'conditions' => array( 'is_admin' => 0 ) ) );
		$this->set( 'users', $users );
	}
	
	public function view( $videoId ) {
		if( $this-> Session->read( 'Auth.User.is_admin' ) ) $video = $this->Video->find( 'first', array( 'conditions' => array( 'id' => $videoId ) ) );
		else $video = $this->Video->find( 'first', array( 'conditions' => array( 'id' => $videoId, 'user_id' => $this->Session->read( 'Auth.User.id' ), 'is_active' => '1' ) ) );
		if( count($video) == 0 ) {
			$this->Session->setFlash(__( 'No Video Found' ), 'default', array( 'class' => 'alert alert-error' ) );
			$this->redirect( array( 'action' => 'index' ) );
		}
		$this->set( 'video', $video );
	}
	
	public function delete( $videoId = null ) {
		if( !$this-> Session->read( 'Auth.User.is_admin' ) ) {
			$this->Session->setFlash(__( 'Action not allowed' ), 'default', array( 'class' => 'alert alert-error' ) );
			$this->redirect( array( 'action' => 'index' ) );
		}
		$vid = $this->Video->find( 'first', array( 'conditions' => array( 'id' => $videoId ) ) );
		dump($vid);
		$this->Video->updateAll( array( 'is_active' => "0" ), array( 'id' => $vid['Video']['id'] ) );
		$dir = WWW_ROOT . 'vids/' . $vid['Video']['file_name'];
		unlink($dir);
		$this->Session->setFlash(__( 'Video Deleted' ), 'default', array( 'class' => 'alert alert-success' ) );
		$this->redirect( array( 'action' => 'index' ) );
	}
	
}
