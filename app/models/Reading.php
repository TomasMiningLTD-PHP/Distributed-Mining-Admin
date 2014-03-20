<?php


/**
 * Description of Reading
 *
 * @author Kim
 */
class Reading {
	public $server, $temp, $hashSpeed, $time, $accepted, $rejected,$hardwareErrors,$stratumUrl;
    
    function __construct($server, $temp, $hashSpeed, $accepted, $rejected, $hardwareErrors, $stratumUrl = "-") {
        $this->server = $server;
        $this->temp = $temp;
        $this->hashSpeed = $hashSpeed;
        $this->time = new DateTime('UTC');
        $this->accepted = $accepted;
        $this->rejected = $rejected;
        $this->hardwareErrors = $hardwareErrors;
		$this->stratumUrl = $stratumUrl;
    }

}
