<?php

namespace OpenCart;
require('./OpenCartAPI/CurlRequest.php');


//--------------------------------------------------
//--------------------------------------------------
class OpenCart {

    private $url;
    private $cookie;
    private $token;
    private $lastError = '';
    public $curl;

    public function log($msg) {
        file_put_contents(DIR_ROOT . 'import/import.log', date('Y-m-d G:i:s') .' : '. print_r($msg, true) . "\n", FILE_APPEND);
    }

    public function __construct($url, $sessionFile = '') {
        $this->url = (!preg_match('/^https?\:\/\//', $url) ? 'http://' : '') . rtrim($url, '/') . '/index.php?';
        $this->curl = new CurlRequest($sessionFile);
    }

    public function getUrl($method) {
//        return $this->url . 'api_token=' . $this->token . '&route=api/' . $method;
        return $this->url . 'route=api/' . $method;
    }

    public function getCookie() {
        return $this->cookie;
    }

    public function getToken() {
        return $this->token;
    }

    public function getLastError() {
        return $this->lastError;
    }

    public function addTask() {
        $this->curl->setUrl($this->getUrl('axapta/addtask'));
        $this->curl->setData(array('task' => 'full','comment' => 'Полное обновление (POST)'));
        $this->curl->makeRequest();

        return $this->curl->getResponse();
    }
    
    public function login() {

        $args = func_get_args();
        $argsCount = count($args);

        $this->curl->setUrl($this->getUrl('login'));

        switch ($argsCount) {
        case 0:
            throw new InvalidCredentialsException("Login called with no parameters! Please provide either an API key, or username and password for OpenCart versions older than 2.0.3.1");
            break;
        case 1:
            $apiKey = $args[0];
            if (empty($apiKey)) throw new InvalidCredentialsException("API key cannot be empty");

            $this->curl->setData(array(
                'key' => $apiKey,
            ));
            break;
        case 2:
            list($username, $password) = $args;
            if (empty($username) || empty($password)) throw new InvalidCredentialsException("Username and password cannot be empty");

            $this->curl->setData(array(
                'username' => $username,
                'password' => $password,
                'key' => $password
            ));
            break;
        default:
            throw new InvalidCredentialsException("Login called with invalid number of parameters! Please provide either an API key, or username and password for OpenCart versions older than 2.0.3.1");
            break;
        }
        


        $this->curl->makeRequest();
        $response = $this->curl->getResponse();
    

        if (isset($response['success'])) {

            if (isset($response['cookie'])) {
                $this->cookie = $response['cookie'];
            } else if (isset($response['token'])) {
                $this->token = $response['token'];
            } else if (isset($response['api_token'])) {
                $this->token = $response['api_token'];
            }

            return $response;
        } else if (isset($response['error'])) {
            $this->lastError = $response['error'];
        }

        return false;
    }

}

class InvalidCredentialsException extends \Exception {}
class InvalidDataException extends \Exception {}
class InvalidProductException extends \Exception {}
class UnknownOpenCartVersionException extends \Exception {}
