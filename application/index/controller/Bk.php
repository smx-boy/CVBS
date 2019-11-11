<?php
namespace app\index\controller;

use think\Db;
use think\Controller;

class Bk extends Controller
{
    public function show()
    {
        $data = Db::table('scores')->select();
        return view('show',['data'=>$data]);
//        $data = Db::table('scores')->paginate(3);
//        $this->assign('data',$data);
//        return $this->fetch();
    }
    public function add()
    {
        return view('add');
    }
    public function add_do()
    {
        $data = [
            'name'=>$_REQUEST['name'],
            'course'=>$_REQUEST['coures'],
            'score'=>$_REQUEST['score'],
        ];
        //var_dump($data);die;
        $list = Db::table('scores')->insert($data);
        if($list)
        {
            echo '<script> alert("添加成功");location.href="show"</script>';
        }
    }
    public function fen()
    {
        $data = Db::table('scores')->paginate(3);
        $this->assign('data',$data);
        return $this->fetch();
    }
    public function upd()
    {
        $id= $_REQUEST['id'];
        //var_dump($id);
        $list = Db::table('scores')->where('id',$id)->find();
        //var_dump($list);die;
        return view('upd',['list'=>$list]);
    }
    public function upd_do()
    {
//        $id = $_REQUEST['id'];
        $list = Db::table('scores')->where('id',$_REQUEST['id'])->update(['name'=>$_REQUEST['name'],'course'=>$_REQUEST['coures'],'score'=>$_REQUEST['score']]);
        if($list)
        {
            echo '<script> alert("修改成功");location.href="show"</script>';
        }
    }
    public function del()
    {
        $id = $_REQUEST['id'];
//        var_dump($id);die;
        $list = Db::table('scores')->where('id',$id)->delete();
        if($list)
        {
            echo '<script> alert("删除成功");location.href="show"</script>';
        }
    }
}