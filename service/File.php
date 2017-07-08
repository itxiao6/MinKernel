<?php
namespace Service;
/**
* 文件操作类
*/
class File{


	/**
	 * [_get_file_contents 获取远端文件]
	 * @param  [String]  $url          [目标地址]
	 * @param  [String]  $dirName      [下载到指定文件夹]
	 * @param  [String]  $fileName     [是否重命名]
	 * @param  Boolean $isBackground [是否开启在后台下载]
	 * @return [Boolean]                [是否下载成功]
	 */
	public static function _download($url,$dirName,$fileName='',$isBackground=false)
    {
		# 判断是否为Linux
		if(self::getOs()){
			# 执行Linux命令
			$command = 'wget -O'.($isBackground==true?'b':'').' '.rtrim($dirName,'/').'/'.$fileName.' '.$url;
			# 执行命令
			return self::execute($command);
		}else{
			# 执行Windows命令
			$result = file_get_contents($url);
			# 获取下载的文件名
			$suffix = strpos($url,strpos($url,'/'));
			# 下载文件
			file_put_contents($dirName.($fileName==''?$suffix:$fileName),$result);
		}
	}
	/**
	 * [_mkdir 创建文件夹]
	 * @param  [String] $dirname [文件夹名称]
	 * @param  string $Auth    [权限]
	 * @return [type]          [执行结果]
	 */
	public static function _mkdir($dirname,$Auth='755')
    {
		$command = 'mkdir -m '.$Auth.' '.$dirname;
		return self::execute($command);
	}
	/**
	 * [_touch 创建文件]
	 * @param  [String] $fileName [文件名]
	 * @param  string $dirName  [文件夹]
	 * @return [String]           [执行结果]
	 */
	public static function _touch($fileName,$dirName='./')
    {
		$command = 'touch '.rtrim($dirName,'/').'/'.$fileName;
		return self::execute($command);
	}
	/**
	 * [_delete 删除文件或文件夹]
	 * @param  [String]  $fileName [文件名]
	 * @param  boolean $isDir    [是否删除的为文件夹]
	 * @return [String]            [执行的结果]
	 */
	public static function _delete($fileName,$isDir=false)
    {
		$command = 'rm -f'.($isDir==true?'R':'').' '.$fileName;
		return self::execute($command);
	}
	/**
	 * [clearDir 清空指定文件夹]
	 * @param  [String] $dirName [要清空的目录]
	 * @return [String]          [执行的结果]
	 */
	public static function clearDir($dirName)
    {
		$command = 'direc="%%1" #$('.$dirName.')
					for dir2del in $direc/* ; do
					  rm -fR $dir2del
					done';
		return self::execute($command);
	}
	/**
	 * [_file_compress 压缩文件或文件夹]
	 * @param  [String]  $path   [要压缩的文件(或文件夹)]
	 * @param  [String]  $fileName   [压缩后的文件名]
	 * @return [String]              [生成路径]
	 */
	public static function _file_compress($path,$fileName="./",$par="-cvf")
    {
		$command = 'tar '.$par.' '.$fileName.' '.$path;
		return self::execute($command);
	}
	/**
	 * [_file_get_contents 获取文件内容]
	 * @param  [String]  $fileName   [文件路径]
	 * @param  Boolean $isRemotely [是否为远端文件]
	 * @return [Result]              [文件内容]
	 */
	public static function _file_get_contents($fileName,$isRemotely=false)
    {
		if($isRemotely){
			$command = 'curl '.$fileName;
		}else{
			$command = 'cat '.$fileName;
		}
		return self::execute($command);
	}

	public static function _file_exists($fileName)
    {
		# 拼接shell
		$command = '[ ! -d '.$fileName.'] && echo 1 || echo 2';
		# 判断文件是否存在
		if(self::execute($command)=='2'){
			# 不存在返回假
			return false;
		}else{
			# 存在返回真
			return true;
		}
	}

	/**
	 * [_file_property 获取文件属性]
	 * @param  [String]  $fileName   [文件路径]
	 * @return  [Array]  $file   [文件属性]
	 */
	public static function _file_property($fileName)
    {
		# 判断文件是否存在
		if(!self::_file_exists($fileName)){
			# 文件不存在
			return false;
		}
		#创建数组保存相关信息
		$file = [];
		#判断是否为一个目录 -d;
		$command = '[ -d '.$fileName.' ] && echo 1 || echo 2';
		if(self::execute($command) == '1'){
			$file['is_dir'] = true;
		}else{
			$file['i'] = false;
		}
		#是否拥有可读权限
		$command = '[ -r '.$fileName.' ] && echo 1 || echo 2';
		if(self::execute($command) == '1'){
			$file['r'] = true;
		}else{
			$file['r'] = false;
		}
		#是否拥有可写权限
		$command = '[ -w '.$fileName.' ] && echo 1 || echo 2';
		if(self::execute($command) == '1'){
			$file['w'] = true;
		}else{
			$file['w'] = false;
		}
		#是否拥有可执行权限
		$command = '[ -x '.$fileName.' ] && echo 1 || echo 2';
		if(self::execute($command) == '1'){
			$file['x'] = true;
		}else{
			$file['x'] = false;
		}
		# 返回文件信息
		return $file;
	}
	/**
	 * [_file_put_contents 写入文件]
	 * @param  [type] $fileName [文件名]
	 * @param  [type] $content  [要写入的内容]
	 * @param  [type] $append   [是否追加写入]
	 * @return [type]           [写入的结果]
	 */
	public static function _file_put_contents($fileName,$content,$append=ture)
    {
		# 拼接shell语句
		$command = 'echo '.$content.' '.($append==true?'>>':'>').' '.$fileName;
		# 执行并返回结果
		return self::execute($command);
	}
	/**
	 * 获取操作系统
	 */
	protected static function getOs()
    {
		# 判断是否为Linux
		if(PHP_OS=='Linux'){
			# 如果是则返回真
			return true;
		}else{
			# 否则返回假
			return false;
		}
	}
	/**
	 * [execute 执行shell语句]
	 * @param  [type] $command [Shell语句]
	 * @return [type]          [执行的结果]
	 */
	protected static function execute($command)
    {
		# 拼接shell头部
		$command = "#!/bin/bash\n".$command;
		# 输出语句
		// echo($command);
		# 执行shell语句
	    return system($command);
	}
}