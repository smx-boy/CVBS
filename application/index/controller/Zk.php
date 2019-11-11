<?php
namespace app\index\controller;

use think\Db;
use think\File;
use think\Controller;

class Zk extends Controller
{
    public function cjadd()
    {
        return view('cjadd');
    }
    public function add()
    {
        //返回视图
        return view('add');
    }
    public function add_list()
    {
        //获取表单上传文件	例如上传了001.jpg
        $file = request()->file('file');
        //移动到框架应用根目录/uploads/	目录下
        $info = $file->move('./uploads');
        echo $info->getExtension();
        echo $info->getSaveName();
        echo $info->getFilename();
        $data = [
            'name' => $_REQUEST['name'],
            'pinname' => $_REQUEST['pinname'],
            'gg' => $_REQUEST['gg'],
            'gj' => $_REQUEST['gj'],
            'weight' => $_REQUEST['weight'],
            'height' => $_REQUEST['height'],
            'hou' => $_REQUEST['hou'],
            'file' => md5($info->getSaveName()),
        ];
        //var_dump($data);die;
        $list = Db::table('sccj')->insert($data);
        if($list)
        {
            echo "<script>添加成功</script>";
        }
    }
    public function add_do()
    {
        //获取表单上传文件	例如上传了001.jpg
        $file = request()->file('file');
        //移动到框架应用根目录/uploads/	目录下
        $info = $file->move('./uploads');
        echo $info->getExtension();
        echo $info->getSaveName();
        echo $info->getFilename();
        $data = [
            'pinname' => $_REQUEST['pinname'],
            'gg' => $_REQUEST['gg'],
            'gj' => $_REQUEST['gj'],
            'weight' => $_REQUEST['weight'],
            'height' => $_REQUEST['height'],
            'hou' => $_REQUEST['hou'],
            'file' => md5($info->getSaveName()),
        ];
        //var_dump($data);die;
        $list = Db::table('cpgg')->insert($data);
        if($list)
        {
            echo "<script>添加成功</script>";
        }
    }
    public function show()
    {
        //查询数据库
        //$data = Db::table('cpgg')->select();
        $data = Db::name('cpgg')->paginate(3);
        // 把分页数据赋值给模板变量list
        $this->assign('data', $data);
        // 渲染模板输出
        return $this->fetch();


        //var_dump($data);
        //将数据返回到视图
        //return view('show',['data'=>$data]);
    }
    public function upd()
    {
        //获取id
        $id = $_REQUEST['id'];
        //var_dump($id);
        //通过获取的id查询这一条数据
        $list = Db::table('cpgg')->where('id',$id)->find();
        //var_dump($list);
        //将查询到的数据返回到视图
        return view('upd',['data'=>$list]);
    }
    public function upd_do()
    {
        //获取id
       $id = $_REQUEST['id'];
       //通过接到的id直接执行sql语句
        $list = Db::table('cpgg')->where('id',$id)->update();
        if ($list)
        {
            return view('show');
        }
    }
    public function del()
    {
        //获取id
        $id = $_REQUEST['id'];
        //var_dump($id);
        //通过获取到的id来执行sql语句
        $list = Db::table('cpgg')->where('id',$id)->delete();
        if($list)
        {
            echo "<script>location.href='show'</script>";
        }
    }
}