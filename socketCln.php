<?php
$fp = stream_socket_client("tcp://mydesk.desktops.utk.edu:8001", $errno, $errstr, 30);
if (!$fp) {
    echo "$errstr ($errno)<br />\n";
} else {
    fwrite($fp, "Aloha");
    while (!feof($fp)) {
        var_dump(fgets($fp, 1024));
    }
    fclose($fp);
}
?>
