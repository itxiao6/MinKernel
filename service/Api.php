<?php
namespace Service;
/**
* API接口
*/
class Api{
	# 用户登录url
	protected static $login_api_url = 'http://60.205.137.210:9090/wyt/sysUserLogin/app/login.do';
	# 用户注册
	protected static $register_api_url = 'http://60.205.137.210:9090/wyt/sysUserLogin/app/register.do';
	# 请求省市区接口
	protected static $get_city_api_url = 'http://60.205.137.210:9090/wyt/tDictionarys/app/getAppTree.do';
	# 短信接口
	protected static $get_code_api_url = 'http://60.205.137.210:9090/wyt/sms/sendVerificationCode.do';
	# 请求类型字典
	protected static $get_dictionary_api_url = 'http://60.205.137.210:9090/wyt/tDictionarys/app/getDictList.do';

	# 发布车源
	protected static $send_car_source_api_url = 'http://60.205.137.210:9090/wyt/wytCyxxb/app/cyFbwx.do';
	# 查询我发布的车源
	protected static $get_car_api_url = 'http://60.205.137.210:9090/wyt/wytCyxxb/app/yfCyList.do';
	# 查询车源
	protected static $get_inquiryCar_api_url = 'http://60.205.137.210:9090/wyt/wytCyxxb/app/cyList.do';
	# 查询车源详情
	protected static $get_carInfo_api_url = 'http://60.205.137.210:9090/wyt/wytCyxxb/app/getCyById.do';
	# 删除已发车源
	protected static $delete_userCar_api_url = 'http://60.205.137.210:9090/wyt/wytCyxxb/app/delCywx.do';
	# 成交已发车
	protected static $deal_userCar_api_url = 'http://60.205.137.210:9090/wyt/wytCyxxb/app/cjcy.do';
	# 重发已发车
	protected static $again_userCar_api_url = 'http://60.205.137.210:9090/wyt/wytCyxxb/app/cfCywx.do';
	# 清空已发车
	protected static $emptied_userCar_api_url = 'http://60.205.137.210:9090/wyt/wytCyxxb/app/clearCywx.do';

	# 查询我发布的货源
	protected static $get_goods_api_url = 'http://60.205.137.210:9090/wyt/wytHyxxb/app/yfHyList.do';
	# 发布货源
	protected static $send_goods_source_api_url = 'http://60.205.137.210:9090/wyt/wytHyxxb/app/hyFb.do';
	# 查询货源
	protected static $get_inquiryGoods_api_url = 'http://60.205.137.210:9090/wyt/wytHyxxb/app/hyList.do';
	# 查询货源详情
	protected static $get_goodsInfo_api_url = 'http://60.205.137.210:9090/wyt/wytHyxxb/app/getHyById.do';
	# 删除已发货源
	protected static $delete_userGoods_api_url = 'http://60.205.137.210:9090/wyt/wytHyxxb/app/delHywx.do';
	# 成交已发货
	protected static $deal_userGoods_api_url = 'http://60.205.137.210:9090/wyt/wytHyxxb/app/cjHy.do';
	# 重发已发货
	protected static $again_userGoods_api_url = 'http://60.205.137.210:9090/wyt/wytHyxxb/app/hyFbswx.do';
	# 清空已发货
	protected static $emptied_userGoods_api_url = 'http://60.205.137.210:9090/wyt/wytHyxxb/app/clearHywx.do';

	/**
	 * [inquiryCar 清空已发车]
	 * @param  [String] $phone
	 */
	public static function emptyCar($phone){
		$result = json_decode(http(self::$emptied_userCar_api_url,$phone,'POST'),true);
		return $result;
	}
	/**
	 * [inquiryCar 清空已发货]
	 * @param  [String] $phone
	 */
	public static function emptyGoods($phone){
		$result = json_decode(http(self::$emptied_userCar_api_url,$phone,'POST'),true);
		return $result;
	}
	/**
	 * [inquiryCar 重发已发车]
	 * @param  [String] $id ·
	 * @param  [String] $phone ·
	 */
	public static function againCar($id,$phone){
		$result = json_decode(http(self::$again_userCar_api_url,['id'=>$id,$phone=>$phone],'POST'),true);
		return $result;
	}
	/**
	 * [inquiryCar 重发已发货]
	 * @param  [String] $id ·
	 * @param  [String] $phone ·
	 */
	public static function againGoods($id,$phone){
		$result = json_decode(http(self::$again_userGoods_api_url,['id'=>$id,$phone=>$phone],'POST'),true);
		return $result;
	}
	/**
	 * [inquiryCar 成交已发货]
	 * @param  [String] $id
	 */
	public static function dealGoods($id){
		$result = json_decode(http(self::$deal_userGoods_api_url,$id,'POST'),true);
		return $result;
	}
	/**
	 * [inquiryCar 成交已发车]
	 * @param  [String] $id
	 */
	public static function dealCar($id){
		$result = json_decode(http(self::$deal_userCar_api_url,$id,'POST'),true);
		return $result;
	}
	/**
	 * [inquiryCar 删除已发货源]
	 * @param  [String] $id ·
	 * @param  [String] $phone ·
	 */
	public static function deleteGoods($id,$phone){
		$result = json_decode(http(self::$delete_userGoods_api_url,['id'=>$id,$phone=>$phone],'POST'),true);
		return $result;
	}
	/**
	 * [inquiryCar 删除已发车源]
	 * @param  [String] $id ·
	 * @param  [String] $phone ·
	 */
	public static function deleteCar($id,$phone){
		$result = json_decode(http(self::$delete_userCar_api_url,['id'=>$id,$phone=>$phone],'POST'),true);
		return $result;
	}
	/**
	 * [inquiryCar 车源详细信息]
	 * @param  [String] $id ·
	 */
	public static function carInfo($id){
		$result = json_decode(http(self::$get_carInfo_api_url,['id'=>$id],'POST'),true);
		return $result;
	}
	/**
	 * [inquiryCar 车源货源信息]
	 * @param  [String] $id ·
	 */
	public static function goodsInfo($id){
		$result = json_decode(http(self::$get_goodsInfo_api_url,['id'=>$id],'POST'),true);
		return $result;
	}


	/**
	 * [check_login 验证账号密码]
	 * @param  [String] $username [用户名]
	 * @param  [String] $password [密码]
	 * @return [Bool]           [验证结果]
	 */
	public static function check_login($username,$password){
		# 登录账号
		$data['dlzh'] = $username;
		# 登录密码
		$data['pwd'] = $password;
		# 定义要传的信息
		$result = json_decode(http(self::$login_api_url,$data,'POST'),true);
		# 判断是否存在
		if($result['code']!=1){
			// 账号密码不正确
			return false;
		}else{
			// 账号密码正确
			return true;
		}
	}
	/**
	 * [check_login 验证账号密码]
	 * @param  [String] $username [用户名]
	 * @param  [String] $password [密码]
	 * @return [Int]           [返回注册ID]
	 */
	public static function register($username,$password,$name,$mail,$company,$phone,$code){
		# 登录账号
		$data['dlzh'] = $username;
		# 登录密码
		$data['pwd'] = $password;
		# 姓名
		$data['xm'] = $name;
		# 邮箱
		$data['email'] = $mail;
		# 公司名称
		$data['gsmc'] = $company;
		# 推荐人手机号码
		$data['tjrsjhm'] = $phone;
		# 验证码参数
		$data['code'] = $code;
		# 定义要传的信息
		$result = json_decode(http(self::$register_api_url,$data,'POST'),true);
		# 判断是否发送成功
        if($result['code']==1){
        	# 绑定微信
        	M('users') -> where(['id'=>$_SESSION['home']['user']['id']]) -> update(['phone'=>$result['data']['dlzh']]);
        	# 更新手机号
        	$_SESSION['home']['user']['phone'] = $username;
         	return true;
        }else{
         	return $result['msg'];
        }
	}
	/**
	 * [send_code 发送验证码]
	 * @param  [String] $phone [手机号]
	 * @return  [Bool] [是否成功]
	 */
	public static function send_code($phone){
         $result = json_decode(http(self::$get_code_api_url,['phone'=>$phone],'POST'),true);
         # 判断是否发送成功
         if($result['code']==1){
         	return true;
         }else{
         	return $result['msg'];
         }
	}

	/**
	 * [select_car_source 查询我发布车源信息]
	 * @param  [String] $departure [出发地省市区，数据参考字典表描述]
	 * @param  [String] $destination [目的地]
	 * @param  [String] $carType [车辆类型]
	 * @param  [String] $line [线路]
	 * @param  [Int] $page [当前页]
	 * @param  [Int] $rows [页大小]
	 */
	public static function select_car_source($data){
		if(is_array($data)){
			$result = json_decode(http(self::$get_car_api_url,$data,'POST'),true);
		return $result;
		}else{
			return false;
		}
	}
	/**
	 * [car_source 发布车源信息]
	 * @param  [String] $id [修改需要传id]
	 * @param  [String] $phone [手机号]
	 * @param  [String] $cfdssq [出发地址]
	 * @param  [String] $cfdxxdz [出发地详细地址]
	 * @param  [String] $mddssq [目的地省市区，数据参考字典表描述]
	 * @param  [String] $mddxxdz [目的地详细地址]
	 * @param  [String] $cllx [车辆类型]
	 * @param  [String] $hwzl [货物种类]
	 * @param  [String] $clzztjdw [车辆载重体积单位]
	 * @param  [String] $clzztj [车辆载重体积]
	 * @param  [String] $jgdw [价格单位]
	 * @param  [String] $jg [价格]
	 * @param  [String] $xllx [线路]
	 * @param  [String] $clsl [车辆数量]
	 * @param  [String] $hwmc [货物名称]
	 * @param  [String] $lxrxm [联系人姓名]
	 * @param  [String] $lxrdh [联系人电话]
	 * @param  [String] $lxryx [联系人邮箱]
	 * @param  [String] $lxrqq [联系人qq]
	 * @param  [String] $bz [备注]
	 */

	public static function car_source($data){
		if(is_array($data)){
			$result = json_decode(http(self::$send_car_source_api_url,$data,'POST'),true);
			return $result;
		}else{
			return false;
		}
	}
	/**
	 * [inquiryCar 查询车源信息]
	 * @param  [String] $departure [出发地省市区，数据参考字典表描述]·
	 * @param  [String] $destination [目的地省市区，数据参考字典表描述]·
	 * @param  [String] $carType [车辆类型]·
	 * @param  [String] $goodsType [货物类型]·
	 * @param  [String] $vlvu(Vehicle load volume unit) [车辆载重体积单位]·
	 * @param  [String] $volume [车辆载重体积]·
	 * @param  [String] $line [线路类型]·
	 * @param  [String] $goodsname [货物名称]·
	 * @param  [Int] $page [当前页]·
	 * @param  [Int] $rows [页大小]·
	 * @param  [Int] $jgStart [价格下限]·
	 * @param  [Int] $res14 [价格区间单位]·
	 * @param  [Int] $jgEnd [价格上限]·
	 * @param  [String] $sjStart [开始时间]·
	 * @param  [String] $sjEnd [结束时间]·
	 */
	public static function inquiryCar($page=''){
		if(is_array($page)){
			$data['page'] = $page['page'];
			$data['rows'] = $page['rows'];
			$data['cfdssq'] = $page['departure'];
			$data['mddssq'] = $page['destination'];
			$data['cllx'] = $page['carType'];
			$data['hwzl'] = $page['goodsType'];
			$data['clzztjdw'] = $page['vlvu'];
			$data['clzz'] = $page['volume'];
			$data['xllx'] = $page['line'];
			$data['hwmc'] = $page['goodsname'];
			$data['jgStart'] = $page['jgStart'];
			$data['res14'] = $page['res14'];
			$data['jgEnd'] = $page['jgEnd'];
			$data['sjStart'] = $page['sjStart'];
			$data['sjEnd'] = $page['sjEnd'];
			foreach ($data as $key => $value) {
				if($value == null || $value == ''){
					unset($data[$key]);
				}
			}
		}
		// dump($data);die;
		$result = json_decode(http(self::$get_inquiryCar_api_url,$data,'GET'),true);
		return $result;
	}
	/**
	 * [select_goods_source 查询我发布货源信息]
	 * @param  [String] $departure [出发地省市区，数据参考字典表描述]
	 * @param  [String] $destination [目的地]
	 * @param  [String] $carType [车辆类型]
	 * @param  [String] $line [线路]
	 * @param  [Int] $page [当前页]
	 * @param  [Int] $rows [页大小]
	 */
	public static function select_goods_source($data){
		if(is_array($data)){
			$result = json_decode(http(self::$get_goods_api_url,$data,'POST'),true);
			return $result;
		}else{
			return false;
		}
	}

	/**
	 * [goods_source 发布货源信息]
	 * @param  [String] $id [修改需要传id]
	 * @param  [String] $phone [手机号]
	 * @param  [String] $cfdssq [出发地址]
	 * @param  [String] $cfdxxdz [出发地详细地址]
	 * @param  [String] $mddssq [目的地省市区，数据参考字典表描述]
	 * @param  [String] $mddxxdz [目的地详细地址]
	 * @param  [String] $cllx [车辆类型]
	 * @param  [String] $hwzl [货物种类]
	 * @param  [String] $clzztjdw [车辆载重体积单位]
	 * @param  [String] $clzz [车辆载重体积]
	 * @param  [String] $jgdw [价格单位]
	 * @param  [String] $jg [价格]
	 * @param  [String] $xllx [线路]
	 * @param  [String] $clsl [货品类别]
	 * @param  [String] $hwmc [货物名称]
	 * @param  [String] $lxrxm [联系人姓名]
	 * @param  [String] $lxrdh [联系人电话]
	 * @param  [String] $lxryx [联系人邮箱]
	 * @param  [String] $lxrqq [联系人qq]
	 * @param  [String] $bz [备注]
	 * @param  [String] $res12 [是否可燃油，1是，2否]
	 * @param  [String] $res13 [是否可大载，1是，2否]
	 */

	public static function goods_source($data){
		if(is_array($data)){
			$result = json_decode(http(self::$send_goods_source_api_url,$data,'POST'),true);
			return $result;
		}else{
			return false;
		}
	}

	/**
	 * [inquiryGoods 查询货源信息]
	 * @param  [String] $departure [出发地省市区，数据参考字典表描述]·
	 * @param  [String] $destination [目的地省市区，数据参考字典表描述]·
	 * @param  [String] $carType [车辆类型]·
	 * @param  [String] $goodsType [货物类型]·
	 * @param  [String] $clsl [货物类别]·
	 * @param  [String] $vlvu(Vehicle load volume unit) [车辆载重体积单位]·
	 * @param  [String] $volume [车辆载重体积]·
	 * @param  [String] $xllx [线路类型]·
	 * @param  [String] $goodsname [货物名称]·
	 * @param  [Int] $page [当前页]·
	 * @param  [Int] $rows [页大小]·
	 * @param  [Int] $jgStart [价格下限]·
	 * @param  [Int] $res14 [价格区间单位]·
	 * @param  [Int] $jgEnd [价格上限]·
	 * @param  [String] $sjStart [开始时间]·
	 * @param  [String] $sjEnd [结束时间]·
	 */

	public static function inquiryGoods($page=''){
		if(is_array($page)){
			$data['page'] = $page['page'];
			$data['rows'] = $page['rows'];
			$data['cfdssq'] = $page['departure'];
			$data['mddssq'] = $page['destination'];
			$data['cllx'] = $page['carType'];
			$data['hwzl'] = $page['goodsType'];
			$data['clzztjdw'] = $page['vlvu'];
			$data['clsl'] = $page['clsl'];
			$data['clzz'] = $page['volume'];
			$data['xllx'] = $page['line'];
			$data['hwmc'] = $page['goodsname'];
			$data['jgStart'] = $page['jgStart'];
			$data['res14'] = $page['res14'];
			$data['jgEnd'] = $page['jgEnd'];
			$data['sjStart'] = $page['sjStart'];
			$data['sjEnd'] = $page['sjEnd'];
			foreach ($data as $key => $value) {
				if($value == null || $value == ''){
					unset($data[$key]);
				}
			}
		}
		$result = json_decode(http(self::$get_inquiryGoods_api_url,$data,'GET'),true);
		return $result;
	}
	/**
	 * [get_city 请求省市区接口]
	 */
	public static function get_city(){
		$result = json_decode(http(self::$get_city_api_url,'POST'),true);
		return $result;
	}

	/**
	 * [dictionary 字典信息]
	 * @param  [Int] $groupid [字典ID 1:货物种类2:车辆载重单位3:线路类型4:车辆载重体积5:价格单位6:收藏类型7:货物数量单位8:车辆类型9:是否10:时间单位11:投诉申诉状态12:套餐类型13:提现类型14:提现状态15:消息类型16:行政区划17:行政区划港澳台18:银行类型19:招标类型20:资料类型21:职位类型22:是否可燃油23:是否可大载24价格区间单位25货物类型]
	 */
	public static function dictionary($groupid){
		switch ($groupid) {
			case 1:
				$groupid = 'hwzl';
				break;
			case 2:
				$groupid = 'clzzdw';
				break;
			case 3:
				$groupid = 'xllx';
				break;
			case 4:
				$groupid = 'clzztj';
				break;
			case 5:
				$groupid = 'jgdw';
				break;
			case 6:
				$groupid = 'sclx';
				break;
			case 7:
				$groupid = 'hwsldw';
				break;
			case 8:
				$groupid = 'cllx';
				break;
			case 9:
				$groupid = 'sf';
				break;
			case 10:
				$groupid = 'sjdw';
				break;
			case 11:
				$groupid = 'stzt';
				break;
			case 12:
				$groupid = 'tclx';
				break;
			case 13:
				$groupid = 'txlx';
				break;
			case 14:
				$groupid = 'txzt';
				break;
			case 15:
				$groupid = 'xxlx';
				break;
			case 16:
				$groupid = 'xzqh';
				break;
			case 17:
				$groupid = 'xzqh_gat';
				break;
			case 18:
				$groupid = 'yhlx';
				break;
			case 19:
				$groupid = 'zblx';
				break;
			case 20:
				$groupid = 'zllx';
				break;
			case 21:
				$groupid = 'zwlx';
				break;
			case 22:
				$groupid = 'res12';
				break;
			case 23:
				$groupid = 'res13';
				break;
			case 24:
				$groupid = 'jgdw';
				break;
			case 25:
				$groupid = 'hwlx';
				break;
			default:
				return false;
				break;
		}
		// dump($groupid);die;
		$result = json_decode(http(self::$get_dictionary_api_url,['groupid'=>$groupid],'POST'),true);
		return $result;
	}
}