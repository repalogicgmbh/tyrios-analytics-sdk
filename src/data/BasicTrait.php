<?php
namespace repalogic\tyrios\analytics\data;

trait BasicTrait {
    public function getAnonymizeIP(string $ip){
        return preg_replace(
            ['/\.\d*$/', '/[\da-f]*:[\da-f]*$/'],
            ['.XXX', 'XXXX:XXXX'],
            $ip
        ) ?? null;
    }

    public function getBrowserAgent(){
        return $_SERVER['HTTP_USER_AGENT'] ?? null;
    }
}