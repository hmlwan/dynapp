<?php
/*
 * 后台理财管理
 */
namespace Admin\Controller;
use Admin\Controller\AdminController;
class TrainController extends AdminController {
    // 空操作
    public function _empty() {
        header ( "HTTP/1.0 404 Not Found" );
        $this->display ( 'Public:404' );
    }
    /*师资管理*/
    public function teacher() {
        $model = M ('teacher_power' );
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

        $this->assign ('info', $info ); // 赋值数据集
        $this->assign ('page', $show ); // 赋值分页输出
        $this->display ();
    }

    public function teacher_add(){
        $model= D('teacher_power');
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
                    $res = $model->where(array('id'=>$id))->save($r);
                }else{
                    $res = $model->add($r);
                }
                if($res){
                    $this->success('操作成功',U('teacher'));
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
            $this->display();
        }
    }

    /*课程管理*/
    public function course() {
        $model = M ('train_course' );
        $string = I('string');

        $where = array();
        if($string){
            $where["course_name"] = array('like','%'.$string.'%') ;
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

        $this->assign ('info', $info ); // 赋值数据集
        $this->assign ('page', $show ); // 赋值分页输出
        $this->display ();
    }

    public function course_add(){
        $model= D('train_course');
        if(IS_POST){
            $id = I("post.id");
            if($_FILES["course_img"]["tmp_name"]){
                $img  = $this->upload($_FILES["course_img"]);
            }else{
                $img = I('course_img1');
            }
            if($r = $model->create()){
                $r['op_time'] = time();
                $r['course_img'] = $img;
                $r['op_man'] = M("admin")->where(array('admin_id'=>$_SESSION['admin_userid']))->getField('username');
                if($id){
                    $res = $model->where(array('id'=>$id))->save($r);
                }else{
                    $res = $model->add($r);
                }
                if($res){
                    $this->success('操作成功',U('course'));
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