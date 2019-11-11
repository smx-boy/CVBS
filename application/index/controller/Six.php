<?php
namespace app\index\controller;
use think\Controller;
use think\Db;

class Six extends Controller
{
    public function index()
    {
        return view('rigst');
    }
    public function rigst_do()
    {
        $data = [
            'na'=>$_REQUEST['na'],
            'me'=>$_REQUEST['me'],
            'sr'=>$_REQUEST['sr'],
            'email'=>$_REQUEST['email'],
            'pwd'=>$_REQUEST['pwd'],
            'gj'=>$_REQUEST['gj'],
            'xb'=>$_REQUEST['xb'],
        ];
        var_dump($data);die;
    }
}