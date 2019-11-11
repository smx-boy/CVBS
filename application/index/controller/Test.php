<?php
namespace app\index\controller;

use think\Collection;
use think\Controller;
use think\Db;

class Test extends Controller
{
    public function show()
    {
        $data = Db::table('user')->select();
        return view('show',['data'=>$data]);
    }
    public function add()
    {
         return view('add');
    }
    public function add_do()
    {
        $data = [
            'name'=>$_REQUEST['name'],
            'pwd'=>$_REQUEST['pwd'],
        ];
        $arr = Db::table('user')->insert($data);
        if($arr)
        {
            $data = Db::table('user')->select();
            echo '<script> alert("添加成功！");location.href="show";</script>';
        }
        else
        {
            echo '<script> alert("添加失败!");location.href="add"</script>';
        }
    }
    public function del()
    {
        $list = Db::table('user')->delete($_REQUEST['id']);
        if($list)
        {
            echo '<script> alert("删除成功");location.href="show"</script>';
        }
        else{
            echo '<script> alert("删除失败");location.href="show"</script>';
        }
    }
    public function upd()
    {
        $id = $_GET['id'];
        $list = Db::table('user')->where('id',$id)->find();
        return view('upd',['list'=>$list]);
    }
    public function upd_do()
    {
        $list = Db::table('user')->where('id',$_REQUEST['id'])->update(['name'=>$_REQUEST['name'],'pwd'=>$_REQUEST['pwd']]);
        if($list)
        {
            echo '<script> alert("修改成功");location.href="show"</script>';
        }
        else
        {
            echo '<script> alert("修改失败");location.href="upd"</script>';
        }
    }
    public function sou()
    {
        $s = $_REQUEST['s'];
       $data = Db::table('user')->where('name',$s)->select();
        return view('show',['data'=>$data]);
    }

}