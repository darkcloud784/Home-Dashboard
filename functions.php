<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'config.php';
function authenticate() {
    global $cfg_array;
    $username = $cfg_array['Torrent_username'];
    $password = $cfg_array['Torrent_password'];
    $ci = curl_init();
    $creds = 'username=' . urlencode($username) . '&password=' . urldecode($password);
    $url = $host . ":" . $port . "/login";
    

    curl_setopt($ci, CURLOPT_URL, $url);
    curl_setopt($ci, CURLOPT_POST, 1);
    curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ci, CURLOPT_HEADER, true);
    curl_setopt($ci, CURLOPT_POSTFIELDS, $creds);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ci, CURLOPT_TIMEOUT, 20);
    try {
        $response = curl_exec($ci);
        $buffer = explode("\n", $response);
        if (count($buffer) < 4) {
            return array($response, null);
        }
        $start = strpos($buffer[4], "SID=");
        $stop = strpos($buffer[4], "; path");
        $sid = substr($buffer[4], $start + 4, strlen($buffer[4]) - $stop - $start - 6);
        return array($sid, $ci);
    } catch (Exception $e) {
        return array($e->getMessage(), null);
    }
}

function getRequests($query) {
    global $cfg_array;
    global $errors;
    $url = $url = $host . ":" . $port . $query;
    $content = authenticate();


    if ($content[1] == null) {
        array_push($errors, "Error authenticating to torrent client. " . $content[0]);
        return null;
    }
    $sid = $content[0];
    $ci = $content[1];
    curl_setopt($ci, CURLOPT_URL, $url);
    curl_setopt($ci, CURLOPT_POST, 0);
    curl_setopt($ci, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ci, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ci, CURLOPT_HTTPHEADER, array("Cookie: SID=" . $sid));
    curl_setopt($ci, CURLOPT_HEADER, 0);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ci, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ci, CURLOPT_TIMEOUT, 20);
    try {
        $response = curl_exec($ci);
        $response = json_decode($response, true);
        curl_close($ci);
        return $response;
    } catch (Exception $e) {
        array_push($errors, "Error contacting api. " . error_get_last()['message']);
        return array(null);
    }
}

function transmissionAll() {
    global $cfg_array;
    $username = $cfg_array['Torrent_username'];
    $password = $cfg_array['Torrent_password'];
    $creds = $username . ":" . $password;
    $json = array("method" => "session-stats");
    $host = $cfg_array['Torrent_Server_IP'];
    $port = $cfg_array['Torrent_Server_Port'];
    
    $a = json_encode($json);
    $ci = curl_init();
    curl_setopt($ci, CURLOPT_HEADER, 1);
    curl_setopt($ci, CURLOPT_URL, "http://$host:$port/transmission/rpc");
    curl_setopt($ci, CURLOPT_POST, 1);
    curl_setopt($ci, CURLOPT_POSTFIELDS, $a);
    curl_setopt($ci, CURLOPT_HTTPAUTH, 1);
    curl_setopt($ci, CURLOPT_USERPWD, $creds);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
    try {
        $r = curl_exec($ci);
        $ret = preg_match("%.*\r\n(X-Transmission-Session-Id: .*?)(\r\n.*)%", $r, $result);
        $X_Transmission_Session_Id = $result[1];
        
        curl_setopt($ci, CURLOPT_HEADER, 0);
        curl_setopt($ci, CURLOPT_HTTPHEADER, array($X_Transmission_Session_Id));
        $r = curl_exec($ci);
        curl_close($ci);
        $stats = json_decode($r, true);
        $stats = $stats ["arguments"];
        return $stats;
    } catch (Exception $e) {
        array_push($errors, "Error contacting api. " . error_get_last()['message']);
        return array(null);
    }
}

function transmissionTorrents() {
    global $cfg_array;
    $username = $cfg_array['Torrent_username'];
    $password = $cfg_array['Torrent_password'];
    $host = $cfg_array['Torrent_Server_IP'];
    $port = $cfg_array['Torrent_Server_Port'];
    $creds = $username . ":" . $password;
    $json = array(
        "arguments" => array("fields" => array("name", "uploadRatio", "status")), "method" => "torrent-get");
    $a = json_encode($json);
    $ci = curl_init();
    curl_setopt($ci, CURLOPT_HEADER, 1);
    curl_setopt($ci, CURLOPT_URL, "http://$host:$port/transmission/rpc");
    curl_setopt($ci, CURLOPT_POST, 1);
    curl_setopt($ci, CURLOPT_POSTFIELDS, $a);
    curl_setopt($ci, CURLOPT_HTTPAUTH, 1);
    curl_setopt($ci, CURLOPT_USERPWD, $creds);
    curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);
    try {
        $r = curl_exec($ci);
        $ret = preg_match("%.*\r\n(X-Transmission-Session-Id: .*?)(\r\n.*)%", $r, $result);
        $X_Transmission_Session_Id = $result[1];
        curl_setopt($ci, CURLOPT_HEADER, 0);
        curl_setopt($ci, CURLOPT_HTTPHEADER, array($X_Transmission_Session_Id));
        $r = curl_exec($ci);
        curl_close($ci);
        $stats = json_decode($r, true);
        $stats = $stats ["arguments"];
        return $stats;
    } catch (Exception $e) {
        array_push($errors, "Error contacting api. " . error_get_last()['message']);
        return array(null);
    }
}
