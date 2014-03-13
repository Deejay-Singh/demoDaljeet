<?php
App::uses('AppHelper', 'View/Helper');
App::uses('CakeResponse', 'Network');
App::uses('ClassRegistry', 'Utility');
App::uses('Hash', 'Utility');
App::uses('BestylishComponent', 'Controller/Component');

class XyzHelper extends AppHelper {
    
    public $helpers = array( 'Html', 'Form' );
    
    public function  beautifulDate( $date = null, $time = false ) {
        if( $time ) {
            if( is_int( $date ) ) return date( 'M d, Y \a\t H:i:s ', $date );
            return date( 'M d, Y \a\t H:i:s ', strtotime( $date ) );
        } else {
            if( is_int( $date ) ) return date( 'M d, Y', $date );
            else return date( 'M d, Y', strtotime( $date ) );
        }
    }
    
    public function convertNumber( $no = null ) {
        $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
        if($no == 0) return '';
        else {
            $novalue = '';
            $highno = $no;
            $remainno = 0;
            $value = 100;
            $value1 = 1000;       
            while($no >= 100)    {
                if(($value <= $no) &&($no  < $value1)) {
                    $novalue=$words["$value"];
                    $highno = (int)($no/$value);
                    $remainno = $no % $value;
                    break;
                }
                $value= $value1;
                $value1 = $value * 100;
            }       
            if(array_key_exists("$highno", $words))
                return $words["$highno"] ." ". $novalue ." ". $this->convertNumber( $remainno );
            else {
                $unit=$highno%10;
                $ten =(int)($highno/10)*10;            
                return $words["$ten"]." ".$words["$unit"]." ".$novalue." ". $this->convertNumber($remainno);
            }
        }
    }

    public function getLabel($status) {
        $status = strtolower( $status );
        $array = array(
            'new' => array('style' => 'label-success', 'text' => 'New'),
            'canceled' => array('style' => 'label-danger', 'text' => 'Cancelled'),
            'cancelled' => array('style' => 'label-danger', 'text' => 'Cancelled'),
            'closed' => array('style' => 'label-warning', 'text' => 'Completed'),
            'open' => array('style' => 'label-success', 'text' => 'Open'),
            'ready_to_ship' => array('style' => 'label-default', 'text' => 'Ready to Ship'),
            'invoiced' => array('style' => 'label-warning', 'text' => 'Invoiced'),
            'processing' => array('style' => 'label-info', 'text' => 'Processing'),
            'shipped' => array('style' => 'label-success', 'text' => 'Shipped'),
            'partial_shipped' => array('style' => 'label-success', 'text' => 'Partially Shipped'),
            'returned' => array('style' => 'label-warning', 'text' => 'Returned'),
            'pass' => array('style' => 'label-success', 'text' => 'Passed'),
            'fail' => array('style' => 'label-danger', 'text' => 'Failed'),
            'dispatched' => array('style' => 'label-success', 'text' => 'Dispatched'),
        );
        // return $array[$status] ? $array[$status] : array( 'style' => 'label-info', 'text' => $status );
        return '<span class="badge ' . $array[$status]['style'] . '">' . $array[$status]['text'] . '</span>';
    }

    public function u( $controller = 'dashboard', $action = 'index', $param = false ) {
        if( !$param )
            return $this->Html->url( array( 'controller' => $controller, 'action' => $action ) );
        else 
            return $this->Html->url( array( 'controller' => $controller, 'action' => $action, $param ) );
    }

    public function getAttrLabel( $key ) {
        $array = array();
        $attrs = ClassRegistry::init( 'Attribute' )->find( 'all' );
        foreach( $attrs as $attr ) {
            $array[$attr['Attribute']['attr_code']] = $attr['Attribute']['name']; 
        }
        return ($array[$key] != '') ? $array[$key] : $key;
    }
}