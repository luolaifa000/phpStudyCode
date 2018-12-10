<?php 


class SocketServer {
    
}


if (!extension_loaded('sockets')) {
    die('The sockets extension is not loaded.');
}

$socket = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Couldn't create socket: [$errorcode] $errormsg");
}


if (socket_bind($socket, '127.0.0.1',8002) === false) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Couldn't bind socket: [$errorcode] $errormsg");
}

if (socket_listen($socket) === false) {
    $errorcode = socket_last_error();
    $errormsg = socket_strerror($errorcode);
    
    die("Couldn't bind listen: [$errorcode] $errormsg");
}

socket_set_nonblock($socket);

while (true) {
    if(($newc = socket_accept($socket)) !== false) {
        
        echo "Client $newc has connected\n";
        socket_write($newc,"Client $newc has connected\n");
        $clients[] = $newc;
    } 
}

socket_shutdown($socket);
socket_close($socket);
