<?php
/**
 * Created by PhpStorm.
 * User: intern
 * Date: 2017/11/27
 * Time: 下午8:57
 */
namespace app\common\lib\exception;

use think\Exception;
use Throwable;

//异常类
class ApiException extends Exception {
    //APIException http 状态码属性
    public $httpCode = 500;

    public $status = -1;//实例化的时候有这个属性
    public function __construct($message = "",$httpCode=500, $status=-1, $code = 0, Throwable $previous = null)

    {
        $this->httpCode = $httpCode;
        $this->status = $status;

        parent::__construct($message, $code, $previous);//这是系统返回的参数,$code返回不到return json($result,$HTTPCode),所以定义$HTTPCode
    }

}