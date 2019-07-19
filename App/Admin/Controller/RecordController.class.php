<?php
/*
 * 后台理财管理
 */
namespace Admin\Controller;
use Admin\Controller\AdminController;
class RecordController extends AdminController {
    // 空操作
    public function _empty() {
        header ( "HTTP/1.0 404 Not Found" );
        $this->display ( 'Public:404' );
    }
    /*预约阿姨*/
    public function order_ayi() {
        $model = M ('order_ayi' );
        $string = I('string');

        $where = array();
        if($string){
            $where["_string"] = "name like %$string% OR phone like %$string%" ;
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
            $jober_list = M("jober")->where(array('id'=>array('in',trim($value['jober_id']))))->getField('name',true);
            $jober_name = implode(',',$jober_list);
            $value["jober_name"] = $jober_name;
        }

        $this->assign ('info', $info ); // 赋值数据集
        $this->assign ('page', $show ); // 赋值分页输出
        $this->display ();
    }

    /*我要培训*/
    public function join_train() {
        $model = M ('join_train' );
        $string = I('string');

        $where = array();
        if($string){
            $where["_string"] = "name like %$string% OR phone like %$string%" ;
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
            $course_list = M("train_course")->where(array('id'=>array('in',trim($value['courses']))))->getField('course_name',true);
            $courses_name = implode(',',$course_list);
            $value["courses_name"] = $courses_name;
        }

        $this->assign ('info', $info ); // 赋值数据集
        $this->assign ('page', $show ); // 赋值分页输出
        $this->display ();
    }

    /*我要应聘*/
    public function apply_task() {
        $model = M ('apply_task' );
        $string = I('string');

        $where = array();
        if($string){
            $where["_string"] = "name like %$string% OR phone like %$string%" ;
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
            $value["task_name"] =  M("pub_task")->where(array('id'=>$value['task_id']))->getField('title');
        }

        $this->assign ('info', $info ); // 赋值数据集
        $this->assign ('page', $show ); // 赋值分页输出
        $this->display ();
    }



    /*推荐记录*/
    public function recommend() {
        $model = M ('recommend_record' );
        $string = I('string');

        $where = array();
        if($string){
            $where["_string"] = "train_name like %$string% OR recommend_name like %$string%" ;
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
            $value["op_name"] = json_decode($value['op_name'],true);
        }
        $this->assign ('info', $info ); // 赋值数据集
        $this->assign ('page', $show ); // 赋值分页输出
        $this->display ();
    }



}
?>