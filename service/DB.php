<?php
namespace Service;
use Illuminate\Database\Capsule\Manager;
class DB extends Manager{
    public static function callStatic($a,$b){
        die('1');
    }
}