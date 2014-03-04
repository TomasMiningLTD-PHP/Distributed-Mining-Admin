<?php


/**
 * Description of Reading
 *
 * @author Kim
 */
class Reading {
    public $id,$server, $temp, $hashSpeed, $time;
    
    function __construct($server, $temp, $hashSpeed) {
        $this->server = $server;
        $this->temp = $temp;
        $this->hashSpeed = $hashSpeed;
        $this->time = new DateTime('UTC');
    }
    // TODO
    public function persist()
    {
        
    }
    
    public function delete()
    {
        
    }
    
    // TODO
    public static function find($id) {
        
    }
    
    // TODO
    public static function findallOrderedByDate() {
        
    }
}
