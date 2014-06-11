<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Sanitize', 'Utility');

class UsersController extends AppController {
    
    public $name = "Users";
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login' );
    }
    
    public function addUser() {
		if( !$this->Session->read( 'Auth.User.is_admin' ) ) $this->redirect( array( 'controller' => 'videos', 'action' => 'index' ) );
        if($this->request->data) {
            if( $this->commonElements() ) {
                $data['User'] = $this->data;
                $this->set('data', $this->data );
            } else {
                $this->User->create();
                $data = Sanitize::clean( $this->request->data, array('encode' => false) );
                $data = array_merge($data, array( 'user_pass' => md5($data['user_pass'] ) ) ); 
                $this->User->save($data);
                $this->Session->setFlash(__('New user created'), 'default', array( 'class' => 'alert alert-success' ) );
                $this->redirect( array( 'action' => 'index' ) );
            }
        }
    }
    
    public function login() {
        $this->layout = "login";
        if( $this->Session->check('Auth.User') ) $this->redirect(array( 'controller' => 'videos', 'action' => 'index' ) );
        if( !empty($this->data) ) {
			if( !$this->Auth->login() ) {
				if($this->request->is( 'post') ) {
					$this->Session->setFlash(__('Invalid username or password, try again'), 'default', array( 'class' => 'alert alert-error' ) );
				}
			} else {
				if( !$this->Session->read( 'Auth.User.is_active' ) ) {
					$this->logout( 'block' );
				}
				if( $this->Session->read( 'Auth.User.is_admin' ) ) $this->redirect( array( 'controller' => 'videos', 'action' => 'index' ) );
				if( date( 'Y-m-d', strtotime( $this->Session->read( 'Auth.User.valid_till' ) ) ) < date( 'Y-m-d' ) ) {
					$this->logout( 'expire' );
				}
				$this->redirect( array( 'controller' => 'videos', 'action' => 'index' ) );
			}
        }
    }

    public function logout( $error = null ) {
        $this->Session->write('Core', false);
        $this->Session->write('Auth', false);
        $this->Session->destroy();
        $this->Auth->logout();
        switch( $error ) {
            case 'block' :
                $this->Session->setFlash(__('Your account is Not Active! Please contact ADMIN.'), 'default', array( 'class' => 'alert alert-error' )  );               
                break;
            case 'expire' :
                $this->Session->setFlash(__('Your account is Expired! Please contact ADMIN.'), 'default', array( 'class' => 'alert alert-error' )  );               
                break;
            case '':
                break;
        }
        $this->redirect( array( 'action' => 'login' ) );
    }
    
    public function view( $id = null ) {
		if( $this->Session->read( 'Auth.User.is_admin' ) || $this->Session->read( 'Auth.User.id' ) == $id ) {
			$userView = $this->User->find('first', array( 'conditions' => array( 'id' => $id ) ) );
			$this->set( 'userView', $userView );
		} else {
			$this->redirect( array( 'controller' => 'videos', 'action' => 'index' ) );
		}
    }
    
    public function index() {
		if( !$this->Session->read( 'Auth.User.is_admin' ) ) $this->redirect( array( 'controller' => 'videos', 'action' => 'index' ) );
        $users = $this->User->find('all', array( 'order' => array( 'created DESC' ) ) );
        $this->set('users', $users);
        $usersList = $this->User->find('list', array( 'fields' => array( 'id', 'first_name' ) ) );
        $this->set('usersList', $usersList);
    }
    
    public function setStatus( $userId = null, $status = null ) {
        $this->layout = 'ajax';
        $this->User->id = $userId;
        $this->User->save(array('is_active' => $status) );
        echo ($status+1)%2;
        exit;
    }
    
    public function edit( $id = null ) {
		if( !$this->Session->read( 'Auth.User.is_admin' ) ) $this->redirect( array( 'controller' => 'videos', 'action' => 'index' ) );
        $user = $this->User->find( 'first', array( 'conditions' => array( 'id' => $id ) ) );
        $this->set( 'user', $user );
        if($data = $this->request->data) {
            $pass = $data['user_pass'];
            if($data['user_pass'] != '') $password = md5( $data['user_pass'] );
            else $password = $user['User']['user_pass'];
            $data = array_merge( $data, array( 'user_pass' => $password ) );
            if( $this->commonElements( $id ) ) {
                $data['User'] = $this->data;
                $this->set('data', $this->data );
            } else {
                $this->User->save($data);
                $this->Session->setFlash(__('User Details updated.'), 'default', array( 'class' => 'alert alert-success' ) );
                $this->redirect( array( 'action' => 'view', $id ) );
            }
        }
    }
    
    public function commonElements( $id = null ) {
        if( $id )  $conditions = array( 'OR' => array( 'user_name' => $this->data['user_name'], 'id NOT' => $id ) );
        else $conditions = array( 'OR' => array( 'user_name' => $this->data['user_name'] ) );
        $userData = $this->User->find('first', array( 'fields' => array( 'user_name AS User_name', 'email AS Email_Id', 'mobile AS Mobile_No' ), 'conditions' => $conditions ) );
        if( $userData ) {
            $commonElements = array_intersect($userData['User'], array( $this->data['user_name'] ) );
            if( $commonElements ) {
                $message = null;
                foreach( $commonElements as $key => $value ) {
                    $message .= str_replace( '_', ' ', $key) . " ";
                }
                $message .= 'already exist!!';
                $this->Session->setFlash(__( $message ), 'default', array( 'class' => 'alert alert-error' )  );
            }
            return true;
        } else return false;
    }
    
    public function reset( $token = null ) {
        $this->layout = "login";
        if( $data = $this->request->data ) {
            if( $this->params->params['pass'] ) {
                $user = $this->User->find( 'first', array( 'fields' => array( 'id' , 'first_name' ), 'conditions' => array( 'token_hash' => $this->params->params['pass'] ) ) );
                if( $user ) {
                    $this->User->save( array( 'id' => $user['User']['id'], 'user_pass' => md5( $data['user_pass'] ), 'reset_password' => 0, 'token_hash' => '' ) );
                    $this->Session->setFlash(__('Password Changed'), 'default', array( 'class' => 'alert alert-success' ) );
                    $this->redirect( array( 'action' => 'login' ) );
                }
            }
            $user = $this->User->find( 'first', array( 'fields' => array( 'id', 'email' , 'first_name' ), 'conditions' => array( 'email' => $data['email'], 'mobile' => $data['mobile'] ) ) );
            if( $user ) {  
                $hash = sha1( $user['User']['first_name'] . time() . rand(0, 885466348) );
                $this->User->save( array( 'id' => $user['User']['id'], 'reset_password' => 1, 'token_hash' => $hash ) );
                $email = new CakeEmail('smtp');
                $email->viewVars(array('hash' => $hash, 'user' => $user['User'] ));
                $email->template( 'reset_password' )->emailFormat( 'html' )->to( $user['User']['email'] )->from( 'noreply@ordergully.com' )->subject('OrderGully - Reset your account password')->send();
                $this->Session->setFlash(__(RESET_LINK), 'default', array( 'class' => 'alert alert-success' ) );
                $this->redirect( array( 'action' => 'login' ) );
            } else {
                $this->Session->setFlash(__('No Record Found'), 'default', array( 'class' => 'alert alert-error' ) );
                $this->redirect( array( 'action' => 'login' ) );
            }
        }
        if( $token ) {
            $user = $this->User->find( 'first', array( 'fields' => array( 'id', 'user_name' ), 'conditions' => array( 'token_hash' => $token, 'reset_password' => 1 ) ) );
            $this->set( 'user', $user );
        }
    }
    
    public function verify( $hash = null ) {
        $userId = $this->User->find('first', array( 'fields' => array( 'id' ), 'conditions' => array( 'token_hash' => $hash ) ) );
        if( $userId ) {
            $this->User->save( array( 'id' => $userId['User']['id'], 'is_active' => 1, 'token_hash' => '' ) );
            $this->set('verify', true);
        }
        else $this->set('verify', false);
    }
}
