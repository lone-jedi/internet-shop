<?php


namespace ishop;


class ErrorHandler
{

    public function __construct()
    {
        if(DEBUG === 1) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }

        set_exception_handler([$this, 'exceptionHandler']);
    }

    public function exceptionHandler($e) {

        $this->logErrors($e->getMessage(), $e->getFile(), $e->getLine());
        $this->displayError('Исключение', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode());
    }

    protected function logErrors($message = '', $file = '', $line = '') {
        error_log("[" . date('Y-m-d H:i:s') . "] Error message:
         {$message} | File: {$file} | Line: {$line}\n=========================\n", 3, ROOT . '/tmp/errors.log');
    }

    protected function displayError($errno, $errstr, $errfile, $errline, $response = 404) {
        http_response_code($response);
        if($response === 404 && DEBUG === 0) {
            require WWW . '/errors/404.php';
            die;
        }

        if(DEBUG === 1) {
            require WWW . '/errors/dev.php';
        } else {
            require WWW . '/errors/prod.php';
        }

        die;
    }
}