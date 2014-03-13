<?php
Cache::config('default', array('engine' => 'File'));
Configure::write('Dispatcher.filters', array( 'AssetDispatcher', 'CacheDispatcher' ));
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array( 'engine' => 'FileLog', 'types' => array('notice', 'info', 'debug'), 'file' => 'debug', ));
CakeLog::config('error', array( 'engine' => 'FileLog', 'types' => array('warning', 'error', 'critical', 'alert', 'emergency'), 'file' => 'error',));
CakePlugin::load('Mongodb');
CakePlugin::load('Rest');

function dump( $var ) {
    echo '<pre>';
    if( is_object( $var ) || is_array( $var ) ) {
        print_r( $var );
    } else {
        echo $var;
    }
    echo '</pre>';
}

define( 'CMPNY', 'Demo' );
