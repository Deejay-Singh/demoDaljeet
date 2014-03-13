<?php
    if($this->Session->read('Auth.User') && ( $this->params[ 'action' ] !='otp' && $this->params[ 'action' ] !='status' && $this->params[ 'action' ] !='verify' ) ) {
        echo $this->element('menu');
    } else if( $this->params[ 'controller' ] == 'checklists' && $this->params[ 'action' ] =='verify' ) echo $this->element('menu');
?>
<br/>
