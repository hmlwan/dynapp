<?php
namespace Admin\Controller;
use Admin\Controller\AdminController;
class ConfigController extends AdminController {
	public function _initialize(){
		parent::_initialize();
	}
	//空操作
	public function _empty(){
		header("HTTP/1.0 404 Not Found");
		$this->display('Public:404');
	}
	
	public function index(){

        $string = I('get.string','','');
        $string = trim($string);
        $where = array();
        if($string){
            $where['_string'] = "`key`='{$string}' OR `name` like '%{$string}%'";
        }

        $list = M('config')->where($where)->select();
        $this->assign('list',$list);
        $this->display();
     }

     public function updateCofig(){
	    if(IS_POST){
	        $type = I('post.type','1','');
	        $title = I('post.title','','');
	        $en_name = I('post.en_name','','');
	        $sub_value = I('post.sub_value','','');
	        $sub_value_img = I('post.sub_value_img','','');
	        $sub_flag = I('post.sub_flag','','');

            if(!$title || !$en_name ){
                $this->error('请输入必填项');
            }

            if($type == 2){
                if($_FILES["sub_value_img"]["tmp_name"]){
                    $sub_value_img  = $this->upload($_FILES["sub_value_img"]);
                }
            }

	        $save_data = array(
	            'key' => $en_name,
                'value' => $type == 1? $sub_value : $sub_value_img,
                'type' => $type,
                'name' => $title
            );

	        if($sub_flag){ /*编辑*/
                if($type==2 && !$_FILES["sub_value_img"]["tmp_name"]){
                    unset($save_data['value']);
                }
                $res = M("config")->where(array('key'=>$en_name))->save($save_data);
            }else{ /*新增*/
                $is_exist = M("config")->where(array('key'=>$en_name))->find();
                if($is_exist){
                    $this->error('已存在英文字段名');
                }
                $res = M("config")->add($save_data);
            }
            if($res){
                $this->success('配置修改成功',U('index'));
            }else{
                $this->error('配置修改失败');
            }
        }else{
            $sub_flag = I('get.sub_flag');
            $key = I('get.key');
            $this->assign('sub_flag',$sub_flag);

            $res = M("config")->where(array('key'=>$key))->find();
            $this->assign('info',$res);
            $this->display();
        }
     }
     public function del(){
         $key = I('post.key');
         $res = M("config")->where(array('key'=>$key))->delete();
         if($res){
             $this->success('删除成功',U('index'));
         }else{
             $this->error('删除失败');
         }

     }

}