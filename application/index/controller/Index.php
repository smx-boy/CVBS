<?php
namespace app\index\controller;

use think\Db;
use think\File;
use think\Controller;
class Index extends Controller
{
    public function index()
    {
        return view('register');
    }
    public function register_do()
    {
        $data = [
            'name'=>$_REQUEST['name'],
            'pwd'=>$_REQUEST['pwd'],
            'file'=>['file'],
        ];
        //var_dump($data);die;
        $list = Db::table('user')->insert($data);
        var_dump($list);
    }
    public function add()
    {
        return view('add');
    }
    public function add_do()
    {
        $name = $_REQUEST['name'];
        $pwd = $_REQUEST['pwd'];
//        var_dump($name,$pwd);die;
        $file = request()->file('file');
        $info = $file->move( './uploads');
//        var_dump($info);die;
        echo  $info->getFilename();
        echo $info->getSaveName();
        echo $info->getFilename();
        //var_dump($info);die;
        $data = [
            'name'=>$name,
            'pwd'=>$pwd,
            'file'=>'http://www.smx66.com/uploads/'.$info->getSaveName(),
        ];
        //var_dump($data);die;
        $list = Db::table('user')->insert($data);
        if($list)
        {
            echo '<script> alert("添加成功"); location.href="show_do"</script>';
        }
    }
    public function show_do()
    {
        $list = Db::table('user')->select();
        //var_dump($list);
        return view('show',['data'=>$list]);
    }
    public function upd()
    {
        $id = $_REQUEST['id'];
        //var_dump($id);
        $list = Db::table('user')->where('id',$id)->find();
        //var_dump($list);
        return view('upd',['data'=>$list]);
    }
    public function upd_do()
    {
//        $id = $_REQUEST['id'];
        //var_dump($id);die;
        $file = request()->file('file');
        $info = $file->move( './uploads');
//        var_dump($info);die;
        echo  $info->getFilename();
        echo $info->getSaveName();
        echo $info->getFilename();
        $list = Db::table('user')->where('id',$_REQUEST['id'])
            ->update([
                'name'=>$_REQUEST['name'],
                'pwd'=>$_REQUEST['pwd'],
                'file'=>'http://www.smx66.com/uploads/'.$info->getSaveName()
                ]);
        if($list)
        {
            echo '<script> alert("修改成功");location.href="show_do"</script>';
        }
    }
    public function del()
    {
        $id = $_REQUEST['id'];
//        var_dump($id);
        $list = Db::table('user')->where('id',$id)->delete();
        if($list)
        {
            echo '<script> alert("删除成功");location.href="show_do"</script>';
        }

    }
    public function fenye()
    {
        // 查询状态为1的用户数据 并且每页显示10条数据
        $list = User::where('status',1)->paginate(10);
        // 获取分页显示
        $page = $list->render();
        // 模板变量赋值
        $this->assign('list', $list);
        $this->assign('page', $page);
        // 渲染模板输出
        return $this->fetch();
    }

}