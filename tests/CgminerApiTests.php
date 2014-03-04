<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cgminer_api_tests
 *
 * @author kikko
 */
class CgminerApiTests extends PHPUnit_Framework_TestCase {

    //put your code here


    public function testCanGetVersionNr() {
        $cgminer = new Miner('localhost', 4028);
        $res = $cgminer->request('{"command":"version","parameter":""}');
        $this->assertEquals('4.0.0', $res['VERSION'][0]['SGMiner']);
        
        
        
    }

}
