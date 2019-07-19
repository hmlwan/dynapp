<?php
/*
 * 后台理财管理
 */
namespace Admin\Controller;
use Admin\Controller\AdminController;
class JobController extends AdminController {
    // 空操作
    public function _empty() {
        header ( "HTTP/1.0 404 Not Found" );
        $this->display ( 'Public:404' );
    }
    /*工作类型管理*/
    public function index() {
        $model = M ('job_type' );
        $string = I('string');

        $where = array();
        if($string){
            $where["type_name"] = array('like','%'.$string.'%') ;
        }

        // 查询满足要求的总记录数
        $count = $model->where ( $where )->count ();
        // 实例化分页类 传入总记录数和每页显示的记录数
        $Page = new \Think\Page ( $count, 20 );
        //将分页（点击下一页）需要的条件保存住，带在分页中
        // 分页显示输出
        $show = $Page->show ();
        //需要的数据
        $field = "*";
        $info = $model->field ( $field )
            ->where ( $where )
            ->order ("type_id desc" )
            ->limit ( $Page->firstRow . ',' . $Page->listRows )
            ->select ();

        $this->assign ('info', $info ); // 赋值数据集
        $this->assign ('page', $show ); // 赋值分页输出
        $this->display ();
    }

    public function job_add(){
        $model= D('job_type');
        if(IS_POST){
            $id = I("post.id");
            if($_FILES["img"]["tmp_name"]){
                $img  = $this->upload($_FILES["img"]);
            }else{
                $img = I('img1');
            }
            if($r = $model->create()){
                $r['op_time'] = time();
                $r['img'] = $img;
                $r['op_man'] = M("admin")->where(array('admin_id'=>$_SESSION['admin_userid']))->getField('username');
                if($id){
                    $res = $model->where(array('type_id'=>$id))->save($r);
                }else{
                    $res = $model->add($r);
                }
                if($res){
                    $this->success('操作成功',U('index'));
                    return;
                }else{
                    $this->error('服务器繁忙,请稍后重试');
                    return;
                }
            }else{
                $this->error($model->getError());
                return;
            }
        }else{
            $id = I("get.id");
            $info = $model->where(array('type_id'=>$id))->find();
            $this->assign('info',$info);
            $this->display();
        }
    }

    /*阿姨管理*/
    public function ayi() {
        $model = M ('jober' );
        $string = I('string');

        $where = array();
        if($string){
            $where["name"] = array('like','%'.$string.'%') ;
        }

        // 查询满足要求的总记录数
        $count = $model->where ( $where )->count ();
        // 实例化分页类 传入总记录数和每页显示的记录数
        $Page = new \Think\Page ( $count, 20 );
        //将分页（点击下一页）需要的条件保存住，带在分页中
        // 分页显示输出
        $show = $Page->show ();
        //需要的数据
        $field = "*";
        $info = $model->field ( $field )
            ->where ( $where )
            ->order ("id desc" )
            ->limit ( $Page->firstRow . ',' . $Page->listRows )
            ->select ();

        foreach ($info as &$value){
            $value['type_name'] = M('job_type')->where(array('task_id'=>$value['task_id']))->getField('type_name');
        }

        $this->assign ('info', $info ); // 赋值数据集
        $this->assign ('page', $show ); // 赋值分页输出
        $this->display ();
    }

    public function ayi_add(){
        $model= D('jober');
        if(IS_POST){
            $id = I("post.id");

            if($_FILES["head_img"]["tmp_name"]){
                $head_img  = $this->upload($_FILES["head_img"]);
            }else{
                $head_img = I('head_img1');
            }
            if($_FILES["life_img"]["tmp_name"]){
                $life_img  = $this->upload($_FILES["life_img"]);
            }else{
                $life_img = I('life_img1');
            }
            if($r = $model->create()){
                $r['op_time'] = time();
                $r['head_img'] = $head_img;
                $r['life_img'] = $life_img;
                $r['op_man'] = M("admin")->where(array('admin_id'=>$_SESSION['admin_userid']))->getField('username');

                if($id){
                    $res = $model->where(array('id'=>$id))->save($r);
                }else{
                    $res = $model->add($r);
                }
                if($res){
                    $this->success('操作成功',U('ayi'));
                    return;
                }else{
                    $this->error('服务器繁忙,请稍后重试');
                    return;
                }
            }else{
                $this->error($model->getError());
                return;
            }
        }else{
            $id = I("get.id");
            $info = $model->where(array('id'=>$id))->find();
            $this->assign('info',$info);

            /*工作类型*/
            $type_list = M('job_type')->where(array('status'=>1))->select();
            $this->assign('job_type',$type_list);
            $this->display();
        }
    }

    /*高单管理*/
    public function pub_task() {
        $model = M ('pub_task' );
        $string = I('string');

        $where = array();
        if($string){
            $where["name"] = array('like','%'.$string.'%') ;
        }

        // 查询满足要求的总记录数
        $count = $model->where ( $where )->count ();
        // 实例化分页类 传入总记录数和每页显示的记录数
        $Page = new \Think\Page ( $count, 20 );
        //将分页（点击下一页）需要的条件保存住，带在分页中
        // 分页显示输出
        $show = $Page->show ();
        //需要的数据
        $field = "*";
        $info = $model->field ( $field )
            ->where ( $where )
            ->order ("id desc" )
            ->limit ( $Page->firstRow . ',' . $Page->listRows )
            ->select ();

        foreach ($info as &$value){
            $value['type_name'] = M('job_type')->where(array('task_id'=>$value['task_id']))->getField('type_name');
        }

        $this->assign ('info', $info ); // 赋值数据集
        $this->assign ('page', $show ); // 赋值分页输出
        $this->display ();
    }

    public function pub_task_add(){
        $model= D('pub_task');
        if(IS_POST){
            $id = I("post.id");

            if($_FILES["head_img"]["tmp_name"]){
                $head_img  = $this->upload($_FILES["head_img"]);
            }else{
                $head_img = I('head_img1');
            }
            if($_FILES["life_img"]["tmp_name"]){
                $life_img  = $this->upload($_FILES["life_img"]);
            }else{
                $life_img = I('life_img1');
            }
            if($r = $model->create()){
                $r['create_tome'] = time();
                $r['head_img'] = $head_img;
                $r['life_img'] = $life_img;
                $r['op_man'] = M("admin")->where(array('admin_id'=>$_SESSION['admin_userid']))->getField('username');

                if($id){
                    $res = $model->where(array('id'=>$id))->save($r);
                }else{
                    $res = $model->add($r);
                }
                if($res){
                    $this->success('操作成功',U('pub_task'));
                    return;
                }else{
                    $this->error('服务器繁忙,请稍后重试');
                    return;
                }
            }else{
                $this->error($model->getError());
                return;
            }
        }else{
            $id = I("get.id");
            $info = $model->where(array('id'=>$id))->find();
            $this->assign('info',$info);

            /*工作类型*/
            $type_list = M('job_type')->where(array('status'=>1))->select();
            $this->assign('job_type',$type_list);
            $this->display();
        }
    }

    public function del(){

        if(empty($_POST['id'])){
            $info['status'] = -1;
            $info['info'] ='传入参数有误';
            $this->ajaxReturn($info);
        }

        $id = I('post.id','','intval');
        $model = I('post.model','','intval');
        $r = M($model)->delete($id);

        if(!$r){
            $info['status'] = 0;
            $info['info'] ='删除失败';
            $this->ajaxReturn($info);
        }
        $info['status'] = 1;
        $info['info'] ='删除成功';
        $this->ajaxReturn($info);
    }

}
?>