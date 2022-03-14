<?php
function dd($var){
    echo '<pre>';
    var_dump($var).PHP_EOL;
    die();
}

function app($abstract = null , array $parameters = []){
    $app =  App::getInstance();
    return $app->make($abstract,$parameters);

}
/*在 "try" 代码块中调用 throw new \Exception 函数。如果有异常被抛出"catch" 代码块接收到该异常，并创建一个包含异常信息的对象 ($e)。
通过从这个 exception 对象调用 $e->getMessage()，输出来自该异常的错误消息*/

function checkException($msg)
{
    //在 "try" 代码块中触发异常
    try {
        //这里可以补充代码，用try就是担心代码出问题 ，比如业务代码出现了问题之后，先输出500
        throw new \Exception($msg, 500);

    } //捕获异常
    catch (Exception $e) {
        //这里可以写代码处理异常，
        echo 'Message: ' . $e->getMessage();
    }
}
//创建验证码
function verifyCode(){
    $chineseChar = array('功','其','笑','D','Z','C','案','5','S','苊','喜','中','国','辽','宁','Q','省','大','连','市','沙','河','口','区','五','一','路','嘉','进','鹅','福','羞','蔼','9');
    header('Content-type: image/png');
    //创建图片,宽120 高30
    $img = imagecreatetruecolor(120,50);
    //创建颜色
    $white = imagecolorallocate($img,255,255,255);
    $black = imagecolorallocate($img,0,0,0);

    //图像中画一个用 color 颜色填充了的矩形
    imagefilledrectangle($img, 0, 0, 120,  40, $white);

    //设置文字
    $text = '';
    for($i=0;$i<4;$i++){
        $rand_keys = array_rand($chineseChar,4);
        $text.=$chineseChar[$rand_keys[$i]];
    }


    $_SESSION['code'] = $text;

//此处一定要用中文字体
    $font = BASEDIR.'/cmd/simhei.ttf';

//添加文字, 转成UTF-8编码,否则是乱码
    imagettftext($img,18,2,11,30,$black,$font,iconv('GB2312','UTF-8',$text));


// 旋转字符随机角度
    $ag = rand(-10,10);
    $nimg = imagerotate($img, $ag,0);

// 产生5条混淆的线条
    for($i=0; $i<5; ++$i){
        $x = rand(0, 120);
        $y = rand(0, 50);
        $x1 = rand(0, 120);
        $y1 = rand(0, 50);
        imageline ($nimg, $x, $y, $x1, $y1, imagecolorallocate($nimg, rand(0,255), rand(0,255), rand(0,255)));
    }

//输出图片
    imagepng($nimg);
//销毁图片
    imagedestroy($img);
    imagedestroy($nimg);
}

//打印写日志
function logs($arr){

    file_put_contents('../logs.txt', '');
    file_put_contents('../logs.txt',var_export($arr ,TRUE).'==>'.PHP_EOL,FILE_APPEND);
}

//收集所有客户端的信息
function client_info(){
    $arr['PHP_SELF'] = $_SERVER['PHP_SELF'];//当前正在执行脚本的文件名，与 document root相关
    $arr['argv'] = $_SERVER['argv'];//传递给该脚本的参数。
    $arr['argc'] = $_SERVER['argc']; //包含传递给程序的命令行参数的个数（如果运行在命令行模式）。
    $arr['GATEWAY_INTERFACE'] = $_SERVER['GATEWAY_INTERFACE']; //服务器使用的 CGI 规范的版本。例如，“CGI/1.1”。
    $arr['SERVER_NAME'] = $_SERVER['SERVER_NAME']; //当前运行脚本所在服务器主机的名称。
    $arr['SERVER_SOFTWARE'] = $_SERVER['SERVER_SOFTWARE']; //服务器标识的字串，在响应请求时的头部中给出。
    $arr['SERVER_PROTOCOL'] = $_SERVER['SERVER_PROTOCOL']; //请求页面时通信协议的名称和版本。例如，“HTTP/1.0”。
    $arr['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD']; //访问页面时的请求方法。例如：“GET”、“HEAD”，“POST”，“PUT”。
    $arr['QUERY_STRING'] = $_SERVER['QUERY_STRING']; //查询(query)的字符串。
    $arr['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; //当前运行脚本所在的文档根目录。在服务器配置文件中定义。
    $arr['HTTP_ACCEPT'] = $_SERVER['HTTP_ACCEPT']; //当前请求的 Accept: 头部的内容。
    $arr['HTTP_ACCEPT_CHARSET'] = $_SERVER['HTTP_ACCEPT_CHARSET']; //当前请求的 Accept-Charset: 头部的内容。例如：“iso-8859-1,*,utf-8”。
    $arr['HTTP_ACCEPT_ENCODING'] = $_SERVER['HTTP_ACCEPT_ENCODING']; //当前请求的 Accept-Encoding: 头部的内容。例如：“gzip”。
    $arr['HTTP_ACCEPT_LANGUAGE'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];//当前请求的 Accept-Language: 头部的内容。例如：“en”。
    $arr['HTTP_CONNECTION'] = $_SERVER['HTTP_CONNECTION']; //当前请求的 Connection: 头部的内容。例如：“Keep-Alive”。
    $arr['HTTP_HOST'] = $_SERVER['HTTP_HOST']; //当前请求的 Host: 头部的内容。
    $arr['HTTP_REFERER'] = $_SERVER['HTTP_REFERER']; //链接到当前页面的前一页面的 URL 地址。
    $arr['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT']; //当前请求的 User_Agent: 头部的内容。
    $arr['HTTPS'] = $_SERVER['HTTPS'];// — 如果通过https访问,则被设为一个非空的值(on)，否则返回off
    $arr['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; //正在浏览当前页面用户的 IP 地址。
    $arr['REMOTE_HOST'] = $_SERVER['REMOTE_HOST']; //正在浏览当前页面用户的主机名。
    $arr['REMOTE_PORT'] = $_SERVER['REMOTE_PORT']; //用户连接到服务器时所使用的端口。
    $arr['SCRIPT_FILENAME'] = $_SERVER['SCRIPT_FILENAME']; //当前执行脚本的绝对路径名。
    $arr['SERVER_ADMIN'] = $_SERVER['SERVER_ADMIN']; //管理员信息
    $arr['SERVER_PORT'] = $_SERVER['SERVER_PORT'];  //服务器所使用的端口
    $arr['SERVER_SIGNATURE'] = $_SERVER['SERVER_SIGNATURE']; //包含服务器版本和虚拟主机名的字符串。
    $arr['PATH_TRANSLATED'] = $_SERVER['PATH_TRANSLATED']; //当前脚本所在文件系统（不是文档根目录）的基本路径。
    $arr['SCRIPT_NAME'] = $_SERVER['SCRIPT_NAME']; //包含当前脚本的路径。这在页面需要指向自己时非常有用。
    $arr['REQUEST_URI'] = $_SERVER['REQUEST_URI']; //访问此页面所需的 URI。例如，“/member.html”。
    $arr['PHP_AUTH_USER'] = $_SERVER['PHP_AUTH_USER']; //当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的用户名。
    $arr['PHP_AUTH_PW'] = $_SERVER['PHP_AUTH_PW'];  //当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是用户输入的密码。
    $arr['AUTH_TYPE'] = $_SERVER['AUTH_TYPE'];  //当 PHP 运行在 Apache 模块方式下，并且正在使用 HTTP 认证功能，这个变量便是认
    $arr['HTTP_X_FORWARDED_FOR'] = CIP;//获取客户端真实IP
    return $arr;
}

//curl模拟http请求。 POST方式的话，$data就是json字符串 '{ 'kf_account' : 'system@system','nickname' : '客服1'}'
function httpGet($url,$data='',$mark=false){ // 模拟提交数据函数

    $curl = curl_init(); // 启动一个CURL会话
    curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查

    //只有在cURL低于php7.28.1时CURLOPT_SSL_VERIFYHOST才支持使用1表示true，高于这个版本就需要使用2表示了
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // 从证书中检查SSL加密算法是否存在

    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
    if($mark){
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post提交的数据包
    }
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
    curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
    $tmpInfo = curl_exec($curl); // 执行操作
    if (curl_errno($curl)) {
        echo 'Errno'.curl_error($curl);//捕抓异常
    }
    curl_close($curl); // 关闭CURL会话
    return $tmpInfo; // 返回数据
}

//禁止非微信端访问
function allow_weixin(){

    //如果是微信开发者工具
    /*if(strpos($_SERVER['HTTP_USER_AGENT'],'wechatdevtools')){
        die('404');
    }*/


    // 非微信浏览器禁止浏览
    if(strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')===false){
        //logs($_SERVER);
        die('请先关注公众号！');
    }

}

//创建目录根据年月计算,$format = date('Y/m',TIME);
function mk_dir($format){
    // $format = date('Y/m',TIME);
    if(is_dir($format)){
        return $format;
    }else{
        if (mkdir($format,0777,true))
            return $format;
        else
            die('目录创建失败:'.$format);
    }
}

/**
 * 获取文件扩展名
 * @return string
 */
function getFileExt($filename)
{
    return strtolower(strrchr($filename, '.'));
}

//随机生成移动后的文件名
function randName() {

    return  date('YmdHis') .mt_rand(1,1000000);
}

/**
 * 单图或多图上传图片
 * $multipleFiles = true 如果上的是多图 ; false单张图片
 * $fileField 混合参数，如果是多图的就是一个图片信息的数组；如果是单张图片就是上传表单的name值
 * $dir STRING 字符串 指定上传到那个目录里
 * @return String  $filename;
 *
 */
function upFile($fileField,$multipleFiles=false,$dir='cover')
{
    if($multipleFiles){
        $file = $fileField;
    }else{
        $file = $_FILES[$fileField];
    }

    if (!$file) {
        die('找不到上传文件');
    }
    if ($file['error']) {
        die($file['error']);

    } else if (!file_exists($file['tmp_name'])) {
        die('找不到临时文件');
    } else if (!is_uploaded_file($file['tmp_name'])) {
        die('临时文件错误');

    }

    $oriName = $file['name'];
    $fileSize = $file['size'];
    $fileType = getFileExt($oriName);
    $fullName = randName().'.jpg';

    //目录
    $Y = date('Y',TIME);
    $format = '/static/upload/image/'.$Y.'/'.$dir;
    $dirname = mk_dir(BASEDIR.'/cmd'.$format);

    //检查文件大小是否超出8M限制
    if ($fileSize > 8048000) {
        die('文件大小为'.$fileSize.'B,超出网站限制:8048000B');
    }

    //检查是否不允许的文件格式
    $result = in_array($fileType, [ '.jpg', '.jpeg','.png','.gif']);
    if (!$result) {
        die('文件类型不允许');
    }

    //移动文件
    $filePath = $dirname.'/'.$fullName;
    if (!(move_uploaded_file($file['tmp_name'], $filePath) && file_exists($filePath))) { //移动失败
        die('文件保存时出错');
    } else { //移动成功，添加缩略

        list($width, $height) = getimagesize($filePath);
        if ($height > 700 || $width > 700){ //700图片压缩最长边限制
            $ratio = $width/$height;
            $new_height = 700;
            $new_width = $new_height * $ratio;

            if($fileType=='.png'){ //   png -> jpg
                $old_image = imagecreatefrompng($filePath);
            }elseif ($fileType=='.gif'){  //   gif -> jpg
                $old_image = imagecreatefromgif($filePath);
            }
            else{
                $old_image = imagecreatefromjpeg($filePath);
            }

            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_image,$old_image,0,0,0,0,$new_width, $new_height, $width, $height);
            imagejpeg($new_image, $filePath, 80);
            imagedestroy($new_image);
            imagedestroy($old_image);
        }

        // return '//'.HOST.$format.'/'.$fullName; 不要域名，因为域名更换了读数据库的URL就弄脏了。
        return $format.'/'.$fullName;
    }
}
//上传视频
function upVideo($fileField)
{
    $file = $fileField;

    if (!$file) {
        die('找不到上传文件');
    }
    if ($file['error']) {
        die($file['error']);

    } else if (!file_exists($file['tmp_name'])) {
        die('找不到临时文件');
    } else if (!is_uploaded_file($file['tmp_name'])) {
        die('临时文件错误');

    }

    $oriName = $file['name'];
    //$fileSize = $file['size'];
    $fileType = getFileExt($oriName);
    $fullName = randName().'.mp4';

    //目录
    $Y = date('Y',TIME);
    $format = '/static/upload/video/'.$Y.'/'.date('m',TIME);
    $dirname = mk_dir(BASEDIR.'/cmd'.$format);

    //检查文件大小是否超出8M限制
    /*if ($fileSize > 8048000) {
        die('文件大小为'.$fileSize.'B,超出网站限制:8048000B');
    }*/

    //检查是否不允许的文件格式
    /*$result = in_array($fileType, [ '.mp4']);
    if (!$result) {
        die('文件类型不允许');
    }*/

    //移动文件
    $filePath = $dirname.'/'.$fullName;
    if (!(move_uploaded_file($file['tmp_name'], $filePath) && file_exists($filePath))) { //移动失败
        die('文件保存时出错');
    } else { //移动成功，添加缩略

        // return '//'.HOST.$format.'/'.$fullName; 不要域名，因为域名更换了读数据库的URL就弄脏了。
        return $format.'/'.$fullName;
    }
}