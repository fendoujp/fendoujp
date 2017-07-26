<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

/*
 * 通用操作类
*/

class Files {
	
	//检查文件存储
	private $file_system; 
	private $ci; //系统副本
	private $oss_config = array(); //oss配置
	private $oss; //oss对象
	private $oss_max_object_count = 100;//oss循环一次最大取值.
	private $path; //上传文件主目录

	public function __construct(){
 		//获取系统框架副本
 		$this->ci =& get_instance(); 		 		
 		//尝试获取系统常量..检查存储类型
		$this->file_system = defined('STORAGE_SYSTEM') ? STORAGE_SYSTEM : false;
		//配置文件存储类型
		if($this->file_system != 'disk' && $this->file_system != 'oss' && $this->file_system != 's3'){
			//文件系统类型初始化失败
			exit('storage_system_error!');
		}
		
	//	$this->file_system = 'disk';
		
		//本地磁盘上传主路径
		$this->path = PATH.DIR;
		//如果是OSS存储，加载OSS对象
		if($this->file_system == 'oss') $this->oss_init();
	}
	
	//私有方法。当文件系统是oss时，获取oss的ID和Key
	//初始化files
	private function oss_init(){
		$this->ci->load->config('oss_access');	
		$this->oss_config = $this->ci->config->item('oss_access');
		//加载oss类库
		require_once PATH.DIR.TOOLS.DIR.$this->file_system.DIR.'oss.php';
		$this->oss = new ALIOSS($this->oss_config['id'],  //access_id
								$this->oss_config['key'], //access_key
								$this->oss_config['host_in'], //内网主机地址
								$this->oss_config['lang']);   //错误语言包
	}
	//将oss返回信息转为数组
	private function format_oss_response($response){
// 		echo '<pre>';
// 		print_r(json_decode(json_encode($response),true));
// 		echo '</pre>';
		return json_decode(json_encode($response),true);
	}
		
	//检查一个文件
	public function is_f($path = ''){
		if(!$path) return false;
		//Oss系统检查文件是否存在
		if($this->file_system == 'oss') return $this->is_f_oss($path);
		//磁盘检查
		else return is_file($path);
	}
	//oss系统 检查文件
	private function is_f_oss($path){
		//上传主路径以外的路径
		$file_path_without_disk = str_replace($this->path,'',$path);
		$res = $this->format_oss_response($this->oss->is_object_exist($this->oss_config['bucket'],$file_path_without_disk));
		//status等于200 且 文件长度大于0
		if($res['status'] == 200 && $res['header']['_info']['download_content_length'] > 0) return true;
		return false;
	}
	//检查是否文件夹
	public function is_d($path = ''){
		if(!$path) return false;
		//Oss系统检查是否文件夹
		if($this->file_system == 'oss') return $this->is_d_oss($path);
		//磁盘检查
		else return is_dir($path);
	}
	//oss系统 检查是否文件夹
	private function is_d_oss($path){
		
		//上传主路径以外的路径
		$file_path_without_disk = str_replace($this->path,'',$path);
		//去掉最后一个斜线
		if($file_path_without_disk[strlen($file_path_without_disk) - 1] == DIR){
			$file_path_without_disk = substr($file_path_without_disk,0,-1);
		}
		$res = $this->format_oss_response($this->oss->is_object_exist($this->oss_config['bucket'],$file_path_without_disk.DIR));
		if($res['status'] == 200 && $res['header']['_info']['download_content_length'] == 0) return true;
		return false;
	}
	
	//创建文件夹
	public function make_d($dir = ''){
		if(!$dir) return false;
		//路径必须以 /文件存储主路径开头
		if(strpos($dir,$this->path.UPLOAD.DIR) !== 0 )return false;
		//检查文件夹是否已经存在
		if($this->is_d($dir)) return false;
		//如果文件夹不存在。创建文件夹
		if($this->file_system == 'oss') return $this->make_d_oss($dir);
		//磁盘创建文件夹
		else {
			//递归
			if($this->is_d(dirname($dir)) == false){
				$this->make_d(dirname($dir));
			}
			return mkdir($dir);
		}
	}
	//OSS创建文件夹
	private function make_d_oss($dir){
		//上传主路径以外的路径
		$file_path_without_disk = str_replace($this->path,'',$dir);
		//去掉最后一个斜线
		if($file_path_without_disk[strlen($file_path_without_disk) - 1] == DIR){
			$file_path_without_disk = substr($file_path_without_disk,0,-1);
		}
		$res = $this->format_oss_response($this->oss->create_object_dir($this->oss_config['bucket'],$file_path_without_disk));
		if($res['status'] == 200) return true;
		return false;
	}
	//删除文件
	public function del_f($path = ''){
		if(!$path) return false;
		//判断文件是否存在
		if(!$this->is_f($path)) return false;
		//执行删除
		if($this->file_system == 'oss') return $this->del_f_oss($path);
		else return unlink($path);
	}
	//oss删除文件
	private function del_f_oss($path){
		//上传主路径以外的路径
		$file_path_without_disk = str_replace($this->path,'',$path);
		$res = $this->format_oss_response($this->oss->delete_object($this->oss_config['bucket'],$file_path_without_disk));
		if($res['status'] == 204) return true;
		return false;
	}
	//删除文件夹
	public function del_d($dir = ''){
		if(!$dir) return false;
		//路径必须以 /文件存储主路径开头
		if(strpos($dir,$this->path.UPLOAD.DIR) !== 0 )return false;
		//执行删除
		if($this->file_system == 'oss') return $this->del_d_oss($dir);
		//清除本地文件夹
		else return $this->del_d_disk($dir);
	}
	//清除本地文件夹
	private function del_d_disk($dir){
		//判断需要清理的路径是不是以 路径开头的
		if(!$this->is_d($dir)) return false;
				
		$dh=opendir($dir);
		if(!$dh){
			return false;
		}
		while ($file=readdir($dh)) {
			if($file!="." && $file!="..") {
				$fullpath=$dir."/".$file;
				if(!is_dir($fullpath)) {
					unlink($fullpath);
				} else {
					$this->del_d_disk($fullpath);
				}
			}
		}
		closedir($dh);	
		return rmdir($dir);	
	}
	
	//oss 删除文件夹
	private function del_d_oss($dir){
		//上传主路径以外的路径
		$file_path_without_disk = str_replace($this->path,'',$dir);
		
		//去掉最后一个斜线
		if($file_path_without_disk[strlen($file_path_without_disk) - 1] == DIR){
			$file_path_without_disk = substr($file_path_without_disk,0,-1);
		}
	
		$options = array(
				'delimiter' => DIR,
				'prefix' => $file_path_without_disk.DIR, //路径
				'max-keys' => $this->oss_max_object_count, //每次最多获取的对象数量
				//'marker' => 'myobject-1330850469.pdf', //这个不知道干嘛的...
		);
		$res = $this->oss->list_object($this->oss_config['bucket'],$options);
		//文件夹和文件
		$dir_info = simplexml_load_string($res->body);
		//将xml对象转为数组
		$dir_info = $this->format_oss_response($dir_info);

		//装载文件夹列表
		if(@$dir_info['CommonPrefixes']){
			//有多个子文件夹时，返回二维数组
			if(@$dir_info['CommonPrefixes'][0]){
				foreach($dir_info['CommonPrefixes'] as $k=>$v){
					$more_dir = rtrim($this->path.$v['Prefix'],DIR);
					//递归删除子文件夹
					$this->del_d_oss($more_dir);
				}
			//如果只有一个子文件夹，返回的不是二维数组***
			}else{
				$more_dir = rtrim($this->path.$dir_info['CommonPrefixes']['Prefix'],DIR);
				//递归删除子文件夹
				$this->del_d_oss($more_dir);
			}
			//如果有子文件夹，程序执行到这里就返回.
			//递归到没有子文件夹为止
			$this->del_d_oss($file_path_without_disk);
			return true;
		}

		if(@$dir_info['Contents']){		
			//如果只有一个文件 或者空文件夹 返回的不是二维数组***
			if(@$dir_info['Contents'][0]){
				foreach($dir_info['Contents'] as $k=>$v){
					$file_list[] = $v['Key'];
				}
				//把以 斜线结尾的 文件名(文件夹对象)从队列中去除
				//这里也许会出问题，基本上是强制pop掉了index[0]
				//如果出问题，循环取值，如果是文件夹对象，continue
				foreach($file_list as $k=>$v){
					if($v[strlen($v)-1] == DIR){
						unset($file_list[$k]);
						break;
					}
				}

				//删除所有文件
				$this->oss->delete_objects($this->oss_config['bucket'],$file_list);
				//递归继续查询 ，直到无文件为止
				$this->del_d_oss($file_path_without_disk);
			}else{

				//如果只有一个文件  肯定是文件夹对象(因为每次都跳过文件夹对象来删除文件)
				$dir_object = $dir_info['Contents']['Key'];
				//删除文件夹
				$this->oss->delete_object($this->oss_config['bucket'],$dir_object);
				//删除文件夹后返回
				return true;
			}
		}
		return true;
	}
	
	//保存上传文件
	public function save_f($file = array(),$save_path = ''){
		//检查是否是上传的文件
		if(!is_uploaded_file(@$file['tmp_name']) || @$file['error'] !== 0) return false;
		//文件是否存在
		if(!$save_path) return false;
		//文件不能存储在存储主目录下
		if(dirname($save_path) == $this->path) return false;
		//文件名不能以斜线结尾
		if(substr($save_path,-1) == DIR) return false;		
		//检查save path是否存在 或者 是否可写
		if(!$this->is_d(dirname($save_path)) || $this->is_f($save_path)) return false;
		//oss系统保存文件
		if($this->file_system == 'oss') return $this->save_f_oss($file,$save_path);
		//磁盘保存文件
		else {
			return move_uploaded_file($file['tmp_name'],$save_path);
		}
	}
	//oss保存上传文件
	private function save_f_oss($file,$save_path){
		//上传主路径以外的路径
		$file_path_without_disk = str_replace($this->path,'',$save_path);
		$res = $this->oss->upload_file_by_file($this->oss_config['bucket'],$file_path_without_disk,$file['tmp_name']);
		$res = $this->format_oss_response($res);
		if($res['status'] == 200) return true;
		return false;		
	}
	//获取文件信息
	public function get_f_info($file = ''){
		//查询不到文件信息
		if(!$file) return false;
		//oss系统查看文件信息
		if($this->file_system == 'oss')	return $this->get_f_info_oss($file);
		//本地存储
		else{
			if(!$this->is_f($file)) return false;
			$return = array();
			$return['size'] = filesize($file);
			$return['ct'] = filectime($file);
			return $return;
		}
	}
	//oss获取文件信息
	private function get_f_info_oss($file){
		$file_path_without_disk = str_replace($this->path,'',$file);
		$res = $this->oss->is_object_exist($this->oss_config['bucket'],$file_path_without_disk);
		$res = $this->format_oss_response($res);
		//文件不存在
		if($res['status'] != 200 || $res['header']['_info']['download_content_length'] == 0) return false;
		$return = array();
		$return['size'] = $res['header']['_info']['download_content_length'];
		$return['ct'] = $res['header']['_info']['filetime'];
		return $return;
	}
	
	//copy文件
	public function copy_f($file = '',$to_file = ''){
		//查询不到文件信息
		if(!$file || !$this->is_f($file)) return false;
		//目标文件已经存在
		if(!$to_file || $this->is_f($to_file)) return false;
		//目标文件文件夹不存在
		if(!$this->is_d(dirname($to_file))) return false;
			
		if($this->file_system == 'oss')	return $this->copy_f_oss($file,$to_file);
		//本地存储
		else{
			return copy($file,$to_file);
		}
	}
	//oss copy文件
	private function copy_f_oss($file,$to_file){
		$file_path_without_disk = str_replace($this->path,'',$file);
		$to_file_path_without_disk = str_replace($this->path,'',$to_file);
		$res = $this->oss->copy_object($this->oss_config['bucket'],$file_path_without_disk,
										$this->oss_config['bucket'],$to_file_path_without_disk);
		$res = $this->format_oss_response($res);
		if($res['status'] == 200) return true;
		return false;
	}
	
	
}