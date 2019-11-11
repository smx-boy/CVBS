<?php
namespace app\index\controller;

use think\console\Table;
use think\Controller;
use think\Db;

class Yuekao extends Controller
{
    public function show()
    {
        //查库
        $data = Db::table('information')->select();
        //var_dump($data);die;
        //将查到的数据返回到视图
        return view('show',['data' => $data]);
    }
    public function add()
    {
        //返回添加页面
        return view('add');
    }
    public function add_do()
    {
        //接表单提交过来的值
        $data =[
            'name'=>$_REQUEST['name'],
            'old'=>$_REQUEST['old'],
            'xb'=>$_REQUEST['xb'],
            'phone'=>$_REQUEST['phone'],
            'zy'=>$_REQUEST['zy'],
            'cw'=>$_REQUEST['cw'],
            'birth'=>$_REQUEST['birth'],
            'death'=>$_REQUEST['death'],
        ];
        //sql入库
        $arr = Db::table('information')->insert($data);
//        var_dump($arr);
        //判断入库是否成功
        if($arr)
        {
            echo '<script> alert("添加成功!");location.href="show"</script>';
        }
        else
        {
            echo '<script> alert("添加失败!");location.href="add"</script>';
        }
    }
    public function del()
    {
        //sql执行删除
        $Db = Db::table('information')->delete($_REQUEST['id']);
        //判断是否成功
        if($Db)
        {
            echo '<script> alert("删除成功!");location.href="show"</script>';
        }
        else
        {
            echo '<script> alert("删除失败!");location.href="show"</script>';
        }
    }
    public function upd()
    {
        //接要修改数据的ID
        $id = $_REQUEST['id'];
        //通过ID查询数据库
        $list = Db::table('information')->where('id',$id)->find();
        //var_dump($list);
        //将数据返回到视图层
        return view('upd',['list' => $list]);
    }
    public function upd_do()
    {
        //sql修改页面数据
//        $list = Db::table('inforation')->where('id',$id)->update('name'=>$_REQUEST['name']);

    }
    public function sou()
    {
        //接要搜索的值
        $arr = $_POST['s'];
        //var_dump($arr);
        //通过接到的值查库
        $data = Db::table('information')->where('name',$arr)->find();
        //将查询的结果返回到视图
        //return view('show',['data' => $data]);
        var_dump($data);
    }
    public function login()
    {
        //返回登录视图页面
        return view('login');
    }
    public function login_do()
    {
        //判断登录是否成功
        if($_POST['name'] != null || $_POST['pwd'] != null)
        {
            echo '<script> alert("登录成功!");location.href="show"</script>';
        }
        else
        {
            echo '<script> alert("登录失败!");location.href="show"</script>';
        }
    }
}