<?php

require 'vendor/autoload.php';

echo "nb,memory,memoryPeak\n";

$i = 0;
$app = function ($request, $response) use(&$i) {
    $response->writeHead(200, array('Content-Type' => 'text/plain'));

    $objects = array();
    for ($j=0; $j < 1000; $j++) {
        $objects[] = new DateTime();
    }

    $response->end("Hello World\n");

    if (0 == $i % 100) {
        // echo sprintf("[%5.0f] Mem(c): %4.3fMb, Mem(p): %4.3fMb\n", $i, memory_get_usage()/(1024*1024), memory_get_peak_usage()/(1024*1024));
        echo sprintf("%s,%4.3f,%4.3f\n", $i, memory_get_usage()/(1024*1024), memory_get_peak_usage()/(1024*1024));
    }
    $i++;
};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket, $loop);

$http->on('request', $app);
// echo "Server running at http://127.0.0.1:1337\n";

$socket->listen(1337);
$loop->run();
