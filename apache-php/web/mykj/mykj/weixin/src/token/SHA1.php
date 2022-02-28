<?php
namespace WeiXin\token;
//include_once "ErrorCode.php";
use App;

/**
 * SHA1 class
 *
 * 计算公众平台的消息签名接口.
 */
class SHA1
{
	/**
	 * 用SHA1算法生成安全签名
	 * @param string $token 票据
	 * @param string $timestamp 时间戳
	 * @param string $nonce 随机字符串
	 * @param string $encrypt 密文消息
	 */
	public function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
	{
		//排序
		try {
			$array = array($encrypt_msg, $token, $timestamp, $nonce);
			sort($array, SORT_STRING);
			$str = implode($array);
			return array(ErrorCode::$OK, sha1($str));
		} catch (Exception $e) {
			//print $e . "\n";
			return array(ErrorCode::$ComputeSignatureError, null);
		}
	}

    /**
     * @param $signature 微信发过来的加密签名
     * @param $timeStamp 时间差
     * @param $nonce 随机数
     * @return bool
     */
    public function checkSignature($signature,$timeStamp,$nonce)
    {


        $token = app('config')->get('base.weixin.token');

        //将token、timestamp、nonce三个参数进行字典序排序 2）将三个参数字符串拼接成一个字符串进行sha1加密
        $tmpArr = array($token, $timeStamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){

            return true;
        }else{

            return false;
        }
    }

}


?>