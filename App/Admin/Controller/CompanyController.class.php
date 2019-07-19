<?php
/*
 * 后台理财管理
 */
namespace Admin\Controller;
use Admin\Controller\AdminController;
class CompanyController extends AdminController {
    // 空操作
    public function _empty() {
        header ( "HTTP/1.0 404 Not Found" );
        $this->display ( 'Public:404' );
    }
    /*分公司管理*/
    public function index() {
        $model = M ('sub_company' );
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

    public function index_add(){
        $model= D('sub_company');
        if(IS_POST){
            $id = I("post.id");

            if($r = $model->create()){
                $r['op_time'] = time();
                $r['op_man'] = M("admin")->where(array('admin_id'=>$_SESSION['admin_userid']))->getField('username');
                if($id){
                    $res = $model->where(array('id'=>$id))->save($r);
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
            $info = $model->where(array('id'=>$id))->find();
            $this->assign('info',$info);
            $this->display();
        }
    }

    /*公司信息*/
    public function info() {
        $model = M ('company_info' );
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

    public function info_add(){
        $model= D('company_info');
        if(IS_POST){
            $img_arr = array();

            if($_FILES){
                foreach ($_FILES as $key =>$value){
                    $k = array_pop(explode('_',$key));
                    if($_FILES[$key]['tmp_name']){
                        $img  = $this->upload($_FILES[$key]);
                    }else{
                        $img = I('post.img_'.$k);
                    }
                    $img_arr[] = $img;
                }
            }
            $id = I("post.id");

            if($r = $model->create()){
                $r['op_time'] = time();
                $r['img'] = json_encode($img_arr);
                $r['op_man'] = M("admin")->where(array('admin_id'=>$_SESSION['admin_userid']))->getField('username');

                if($id){

                    $res = $model->where(array('id'=>$id))->save($r);
                }else{
                    if($model->where(array('status'=>1))->count()>0){
                        $this->error('已存在公司信息，请关闭');
                    }
                    $res = $model->add($r);
                }
                if($res){
                    $this->success('操作成功',U('info'));
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
            $info['img_arr'] = json_decode($info['img'],true);
            $this->assign('info',$info);
            $this->display();
        }
    }


    /*特色服务内容*/
    public function special() {
        $model = M ('special_service' );
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


    public function special_add(){
        $model= D('special_service');
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
                    $this->success('操作成功',U('special'));
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