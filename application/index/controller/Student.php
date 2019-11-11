<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Student extends Controller
{
    public function sql()
    {

        $list = Db::table('stuscore')->where('name',"张三")->sum('score');
        var_dump($list);


    }
}