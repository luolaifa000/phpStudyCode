<?php 

class A {
    
    private $a = 1;
    
    public function __construct()
    {
        echo 'i am a';
    }
}


class B extends A {
    
    public function __construct()
    {
        parent::__construct();
        $this->a = 2;
        echo 'i am b';
    }
}

abstract class C {
    abstract public function a();
    
}

class D {
    public $_data;
    
    public function __construct($data)
    {
        $this->_data = $data;
    }
    
    public function sdfsdf()
    {
        echo '2';
    }
}

/* $d = new D(['aaa' => 1,'bbb' => 2]);

foreach ($d as $key=>$val) {
    echo $key.$val;
}
 */

if (!extension_loaded('sockets')) {
    die('The sockets extension is not loaded.');
}


/* $fp = fsockopen("tcp://192.168.1.103", 8000, $errno, $errstr);
if (!$fp) {
    echo "ERROR: $errno - $errstr<br />\n";
} else {
    while (true) {
        $read = fread($fp, 100);
        var_dump($read);
        $words = fgets(STDIN);
        $length = fwrite($fp,$words);
        if ($words=="bye\r\n") {
            break;
        }
    }
    fclose($fp);
}


exit(); */

$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
//var_dump($socket);exit();
//socket_set_nonblock($socket);
$con = socket_connect($socket,'127.0.0.1',8002);
//var_dump($con);
if (!$con) {
    socket_close($socket);
    exit;
}
echo "Link\n";
while ($con) {
    
    $words=fgets(STDIN);
    socket_write($socket,$words);
    if ($words=="bye\r\n") {
        break;
    }
    $hear = socket_read($socket,1024);
    var_dump($hear);
}
socket_shutdown($socket);
socket_close($socket);
?>