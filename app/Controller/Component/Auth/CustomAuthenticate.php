<?php
App::uses('BaseAuthenticate', 'Controller/Component/Auth');
class CustomAuthenticate extends BaseAuthenticate {
    public $settings = array('fields' => array('username' => array('user_name'), 'password' => 'user_pass'), 'userModel' => 'User');
    public function authenticate(CakeRequest $request, CakeResponse $response) {
        $userModel = $this->settings['userModel'];
        list($plugin, $model) = pluginSplit($userModel);

        $fields = $this->settings['fields'];
        if (empty($request->data[$model]) || empty($request->data[$model][$fields['password']])) {
            return false;
        }
        if (!is_array($fields['username'])) $fields['username'] = array($fields['username']);
        foreach ($fields['username'] as $usernameField) {
            if (!empty($request->data[$model][$usernameField])) {
                return $this->_findUser($request->data[$model][$usernameField], $request->data[$model][$fields['password']]);
            }            
        }
        return false;
    }
    
    protected function _findUser($username, $password) {
        $userModel = $this->settings['userModel'];
        list($plugin, $model) = pluginSplit($userModel);
        $fields = $this->settings['fields'];

        if (!is_array($fields['username'])) $fields['username'] = array($fields['username']);
        $conditions = array();
        foreach ($fields['username'] as $usernameField) {
            $conditions['OR'][] = array(
                $model . '.' . $usernameField => $username,
                $model . '.' . $fields['password'] => $this->_password($password),
            );
        }
        
        if (!empty($this->settings['scope'])) $conditions = array_merge($conditions, $this->settings['scope']);
        $result = ClassRegistry::init($userModel)->find('first', array('conditions' => $conditions));
        if (empty($result) || empty($result[$model])) {
            return false;
        }
       
        unset($result[$model][$fields['password']]);
        return $result[$model];
    }
}
