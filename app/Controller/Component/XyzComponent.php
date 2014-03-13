<?php
App::uses('CakeEmail', 'Network/Email');
App::uses('Component', 'Controller');

class XyzComponent extends Component {

    public $uses = array( 'User' );
    
    public function findApiUser( $data = array() ) {
        $this->User = ClassRegistry::init('User');
        $user = $this->User->find( 'first', array( 'conditions' => array( 'user_name' => $data['user_name'], 'user_pass' => $data['user_pass'], 'is_active' => '1' ) ) );
        if( $user) {
            $fetchedUser = $user['User'];
            $fetchedUser['pushOrder'] = $data['key'];
            return( $fetchedUser );
        }
        return false;
    }

    public function createId($in, $to_num = false, $pad_up = false) {
        $index = "Q4W35RTY8PKJHGFDS26ZXC7VBN9M";
        $base  = strlen($index);

        if ($to_num) {
            $in  = strrev($in);
            $out = 0;
            $len = strlen($in) - 1;
            for ($t = 0; $t <= $len; $t++) {
                $bcpow = bcpow($base, $len - $t);
                $out   = $out + strpos($index, substr($in, $t, 1)) * $bcpow;
            }

            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) $out -= pow($base, $pad_up);
            }
            $out = sprintf('%F', $out);
            $out = substr($out, 0, strpos($out, '.'));
        } else {
            if (is_numeric($pad_up)) {
                $pad_up--;
                if ($pad_up > 0) $in += pow($base, $pad_up);
            }
            $out = "";
            for ($t = floor(log($in, $base)); $t >= 0; $t--) {
                $bcp = bcpow($base, $t);
                $a   = floor($in / $bcp) % $base;
                $out = $out . substr($index, $a, 1);
                $in  = $in - ($a * $bcp);
            }
            $out = strrev($out);
        }
        return $out;
    }
}
