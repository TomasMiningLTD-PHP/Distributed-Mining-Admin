<?php

/**
 * Miner class
 * Allows for communication with CGMiner/SGMiner instance through
 * provided socket API
 * @author Kim
 */
class Miner {
    private $addr, $port;
    function __construct($addr, $port) {
        $this->addr = $addr;
        $this->port = $port;
    }
	public function listPools() {
		$pools = $this->request('{"command":"pools"}');
		return $pools['POOLS'];
	}
	public function switchPoolByName($name) {
		$pool = Pool::findByName($name);
		$pools = $this->listPools();
		$id = FALSE;
		foreach($pools as $key=>$currPool){
			if($currPool['URL'] == $pool->url){
				$id = $currPool['POOL'];
			}	
		}
		// Pool is not in miner list, must add it
		if ($id == FALSE){
			$this->request("{\"command\": \"addpool\",\"parameter\": \"$pool->url,$pool->username,$pool->password\"}");
			$pools = $this->listPools();

			foreach($pools as $key=>$currPool){
				if($currPool['URL'] == $pool->url){
					$id = $currPool['POOL'];
				}	
			}
		}
		if($id != FALSE){
			$this->switchPool($id);
		}
	}
	public function switchPool($poolNumber) {
		$this->request('{"command":"switchpool", "parameter":"' . $poolNumber .'"}');
	}	
	public function getActiveStratum(){
		$pools = $this->listPools();
		$stratumUrl = "-"; 
		foreach($pools as $pool){
			if($pool['Priority'] == 0){
				$stratumUrl = $pool['URL'];
				break;
			}
		}
		return $stratumUrl;
	}
    public function getReading() {
        $sum = $this->request('{"command":"summary","parameter":""}');
        $hash = $sum['SUMMARY'][0]['MHS 5s'];
        $accepted = $sum['SUMMARY'][0]['Accepted'];
        $rejected = $sum['SUMMARY'][0]['Rejected'];
        $hardwareErrors = $sum['SUMMARY'][0]['Hardware Errors'];
        $dev = $this->request('{"command":"devs","parameter":""}');
        $temp = array();
        for ($i =0; $i < sizeof($dev['DEVS']); $i++) {
            $temp[$i] = $dev['DEVS'][$i]['Temperature'];
        }
		$stratumUrl = $this->getActiveStratum();
		return new Reading($this->addr,$temp, $hash, $accepted, $rejected, $hardwareErrors, $stratumUrl);
    }

    public function printReadableResponse($response) {
        print_r($response);
    }

    public function request($cmd) {
 
        $socket = $this->getsock($this->addr, $this->port);
        if ($socket != null) {
            socket_write($socket, $cmd , strlen($cmd));
            $line = $this->readsockline($socket);

            if (strlen($line) == 0) {
                return $line;
            }
            socket_close($socket);


            if (substr($line, 0, 1) == '{')
                return json_decode($line, true);

            // Backup in case using old format of returning value
            // From API documentation
            $data = array();
            $objs = explode('|', $line);
            foreach ($objs as $obj) {
                if (strlen($obj) > 0) {
                    $items = explode(',', $obj);
                    $item = $items[0];
                    $id = explode('=', $items[0], 2);
                    if (count($id) == 1 or !ctype_digit($id[1]))
                        $name = $id[0];
                    else
                        $name = $id[0] . $id[1];

                    if (strlen($name) == 0)
                        $name = 'null';

                    if (isset($data[$name])) {
                        $num = 1;
                        while (isset($data[$name . $num]))
                            $num++;
                        $name .= $num;
                    }

                    $counter = 0;
                    foreach ($items as $item) {
                        $id = explode('=', $item, 2);
                        if (count($id) == 2)
                            $data[$name][$id[0]] = $id[1];
                        else
                            $data[$name][$counter] = $id[0];

                        $counter++;
                    }
                }
            }

            return $data;
        }

        return null;
    }

    private function readsockline($socket) {
        $line = '';
        while (true) {
            $byte = socket_read($socket, 1);
            if ($byte === false || $byte === '')
                break;
            if ($byte === "\0")
                break;
            $line .= $byte;
        }
        return $line;
    }

    private function getsock($addr, $port) {
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if ($socket === false || $socket === null) {
            $error = socket_strerror(socket_last_error());
            $msg = "socket create(TCP) failed";
            echo "ERR: $msg '$error'\n";
            return null;
        }
        $res = socket_connect($socket, $addr, $port);
        if ($res === false) {
            $error = socket_strerror(socket_last_error());
            $msg = "socket connect($addr,$port) failed";
            echo "ERR: $msg '$error'\n";
            socket_close($socket);
            return null;
        }
        return $socket;
    }

}
