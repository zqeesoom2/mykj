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
/*�� "try" ������е��� throw new \Exception ������������쳣���׳�"catch" �������յ����쳣��������һ�������쳣��Ϣ�Ķ��� ($e)��
ͨ������� exception ������� $e->getMessage()��������Ը��쳣�Ĵ�����Ϣ*/

function checkException($msg)
{
    //�� "try" ������д����쳣
    try {
        //������Բ�����룬��try���ǵ��Ĵ�������� ������ҵ��������������֮�������500
        throw new \Exception($msg, 500);

    } //�����쳣
    catch (Exception $e) {
        //�������д���봦���쳣��
        echo 'Message: ' . $e->getMessage();
    }
}
//������֤��
function verifyCode(){
    $chineseChar = array('��','��','Ц','D','Z','C','��','5','S','��','ϲ','��','��','��','��','Q','ʡ','��','��','��','ɳ','��','��','��','��','һ','·','��','��','��','��','��','��','9');
    header('Content-type: image/png');
    //����ͼƬ,��120 ��30
    $img = imagecreatetruecolor(120,50);
    //������ɫ
    $white = imagecolorallocate($img,255,255,255);
    $black = imagecolorallocate($img,0,0,0);

    //ͼ���л�һ���� color ��ɫ����˵ľ���
    imagefilledrectangle($img, 0, 0, 120,  40, $white);

    //��������
    $text = '';
    for($i=0;$i<4;$i++){
        $rand_keys = array_rand($chineseChar,4);
        $text.=$chineseChar[$rand_keys[$i]];
    }


    $_SESSION['code'] = $text;

//�˴�һ��Ҫ����������
    $font = BASEDIR.'/cmd/simhei.ttf';

//�������, ת��UTF-8����,����������
    imagettftext($img,18,2,11,30,$black,$font,iconv('GB2312','UTF-8',$text));


// ��ת�ַ�����Ƕ�
    $ag = rand(-10,10);
    $nimg = imagerotate($img, $ag,0);

// ����5������������
    for($i=0; $i<5; ++$i){
        $x = rand(0, 120);
        $y = rand(0, 50);
        $x1 = rand(0, 120);
        $y1 = rand(0, 50);
        imageline ($nimg, $x, $y, $x1, $y1, imagecolorallocate($nimg, rand(0,255), rand(0,255), rand(0,255)));
    }

//���ͼƬ
    imagepng($nimg);
//����ͼƬ
    imagedestroy($img);
    imagedestroy($nimg);
}

//��ӡд��־
function logs($arr){

    file_put_contents('../logs.txt', '');
    file_put_contents('../logs.txt',var_export($arr ,TRUE).'==>'.PHP_EOL,FILE_APPEND);
}

//�ռ����пͻ��˵���Ϣ
function client_info(){
    $arr['PHP_SELF'] = $_SERVER['PHP_SELF'];//��ǰ����ִ�нű����ļ������� document root���
    $arr['argv'] = $_SERVER['argv'];//���ݸ��ýű��Ĳ�����
    $arr['argc'] = $_SERVER['argc']; //�������ݸ�����������в����ĸ��������������������ģʽ����
    $arr['GATEWAY_INTERFACE'] = $_SERVER['GATEWAY_INTERFACE']; //������ʹ�õ� CGI �淶�İ汾�����磬��CGI/1.1����
    $arr['SERVER_NAME'] = $_SERVER['SERVER_NAME']; //��ǰ���нű����ڷ��������������ơ�
    $arr['SERVER_SOFTWARE'] = $_SERVER['SERVER_SOFTWARE']; //��������ʶ���ִ�������Ӧ����ʱ��ͷ���и�����
    $arr['SERVER_PROTOCOL'] = $_SERVER['SERVER_PROTOCOL']; //����ҳ��ʱͨ��Э������ƺͰ汾�����磬��HTTP/1.0����
    $arr['REQUEST_METHOD'] = $_SERVER['REQUEST_METHOD']; //����ҳ��ʱ�����󷽷������磺��GET������HEAD������POST������PUT����
    $arr['QUERY_STRING'] = $_SERVER['QUERY_STRING']; //��ѯ(query)���ַ�����
    $arr['DOCUMENT_ROOT'] = $_SERVER['DOCUMENT_ROOT']; //��ǰ���нű����ڵ��ĵ���Ŀ¼���ڷ����������ļ��ж��塣
    $arr['HTTP_ACCEPT'] = $_SERVER['HTTP_ACCEPT']; //��ǰ����� Accept: ͷ�������ݡ�
    $arr['HTTP_ACCEPT_CHARSET'] = $_SERVER['HTTP_ACCEPT_CHARSET']; //��ǰ����� Accept-Charset: ͷ�������ݡ����磺��iso-8859-1,*,utf-8����
    $arr['HTTP_ACCEPT_ENCODING'] = $_SERVER['HTTP_ACCEPT_ENCODING']; //��ǰ����� Accept-Encoding: ͷ�������ݡ����磺��gzip����
    $arr['HTTP_ACCEPT_LANGUAGE'] = $_SERVER['HTTP_ACCEPT_LANGUAGE'];//��ǰ����� Accept-Language: ͷ�������ݡ����磺��en����
    $arr['HTTP_CONNECTION'] = $_SERVER['HTTP_CONNECTION']; //��ǰ����� Connection: ͷ�������ݡ����磺��Keep-Alive����
    $arr['HTTP_HOST'] = $_SERVER['HTTP_HOST']; //��ǰ����� Host: ͷ�������ݡ�
    $arr['HTTP_REFERER'] = $_SERVER['HTTP_REFERER']; //���ӵ���ǰҳ���ǰһҳ��� URL ��ַ��
    $arr['HTTP_USER_AGENT'] = $_SERVER['HTTP_USER_AGENT']; //��ǰ����� User_Agent: ͷ�������ݡ�
    $arr['HTTPS'] = $_SERVER['HTTPS'];// �� ���ͨ��https����,����Ϊһ���ǿյ�ֵ(on)�����򷵻�off
    $arr['REMOTE_ADDR'] = $_SERVER['REMOTE_ADDR']; //���������ǰҳ���û��� IP ��ַ��
    $arr['REMOTE_HOST'] = $_SERVER['REMOTE_HOST']; //���������ǰҳ���û�����������
    $arr['REMOTE_PORT'] = $_SERVER['REMOTE_PORT']; //�û����ӵ�������ʱ��ʹ�õĶ˿ڡ�
    $arr['SCRIPT_FILENAME'] = $_SERVER['SCRIPT_FILENAME']; //��ǰִ�нű��ľ���·������
    $arr['SERVER_ADMIN'] = $_SERVER['SERVER_ADMIN']; //����Ա��Ϣ
    $arr['SERVER_PORT'] = $_SERVER['SERVER_PORT'];  //��������ʹ�õĶ˿�
    $arr['SERVER_SIGNATURE'] = $_SERVER['SERVER_SIGNATURE']; //�����������汾���������������ַ�����
    $arr['PATH_TRANSLATED'] = $_SERVER['PATH_TRANSLATED']; //��ǰ�ű������ļ�ϵͳ�������ĵ���Ŀ¼���Ļ���·����
    $arr['SCRIPT_NAME'] = $_SERVER['SCRIPT_NAME']; //������ǰ�ű���·��������ҳ����Ҫָ���Լ�ʱ�ǳ����á�
    $arr['REQUEST_URI'] = $_SERVER['REQUEST_URI']; //���ʴ�ҳ������� URI�����磬��/member.html����
    $arr['PHP_AUTH_USER'] = $_SERVER['PHP_AUTH_USER']; //�� PHP ������ Apache ģ�鷽ʽ�£���������ʹ�� HTTP ��֤���ܣ�������������û�������û�����
    $arr['PHP_AUTH_PW'] = $_SERVER['PHP_AUTH_PW'];  //�� PHP ������ Apache ģ�鷽ʽ�£���������ʹ�� HTTP ��֤���ܣ�������������û���������롣
    $arr['AUTH_TYPE'] = $_SERVER['AUTH_TYPE'];  //�� PHP ������ Apache ģ�鷽ʽ�£���������ʹ�� HTTP ��֤���ܣ��������������
    $arr['HTTP_X_FORWARDED_FOR'] = CIP;//��ȡ�ͻ�����ʵIP
    return $arr;
}

//curlģ��http���� POST��ʽ�Ļ���$data����json�ַ��� '{ 'kf_account' : 'system@system','nickname' : '�ͷ�1'}'
function httpGet($url,$data='',$mark=false){ // ģ���ύ���ݺ���

    $curl = curl_init(); // ����һ��CURL�Ự
    curl_setopt($curl, CURLOPT_URL, $url); // Ҫ���ʵĵ�ַ
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // ����֤֤����Դ�ļ��

    //ֻ����cURL����php7.28.1ʱCURLOPT_SSL_VERIFYHOST��֧��ʹ��1��ʾtrue����������汾����Ҫʹ��2��ʾ��
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2); // ��֤���м��SSL�����㷨�Ƿ����

    curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // ģ���û�ʹ�õ������
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // ʹ���Զ���ת
    curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // �Զ�����Referer
    if($mark){
        curl_setopt($curl, CURLOPT_POST, 1); // ����һ�������Post����
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // Post�ύ�����ݰ�
    }
    curl_setopt($curl, CURLOPT_TIMEOUT, 30); // ���ó�ʱ���Ʒ�ֹ��ѭ��
    curl_setopt($curl, CURLOPT_HEADER, 0); // ��ʾ���ص�Header��������
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // ��ȡ����Ϣ���ļ�������ʽ����
    $tmpInfo = curl_exec($curl); // ִ�в���
    if (curl_errno($curl)) {
        echo 'Errno'.curl_error($curl);//��ץ�쳣
    }
    curl_close($curl); // �ر�CURL�Ự
    return $tmpInfo; // ��������
}

//��ֹ��΢�Ŷ˷���
function allow_weixin(){

    //�����΢�ſ����߹���
    /*if(strpos($_SERVER['HTTP_USER_AGENT'],'wechatdevtools')){
        die('404');
    }*/


    // ��΢���������ֹ���
    if(strpos($_SERVER['HTTP_USER_AGENT'],'MicroMessenger')===false){
        //logs($_SERVER);
        die('���ȹ�ע���ںţ�');
    }

}

//����Ŀ¼�������¼���,$format = date('Y/m',TIME);
function mk_dir($format){
    // $format = date('Y/m',TIME);
    if(is_dir($format)){
        return $format;
    }else{
        if (mkdir($format,0777,true))
            return $format;
        else
            die('Ŀ¼����ʧ��:'.$format);
    }
}

/**
 * ��ȡ�ļ���չ��
 * @return string
 */
function getFileExt($filename)
{
    return strtolower(strrchr($filename, '.'));
}

//��������ƶ�����ļ���
function randName() {

    return  date('YmdHis') .mt_rand(1,1000000);
}

/**
 * ��ͼ���ͼ�ϴ�ͼƬ
 * $multipleFiles = true ����ϵ��Ƕ�ͼ ; false����ͼƬ
 * $fileField ��ϲ���������Ƕ�ͼ�ľ���һ��ͼƬ��Ϣ�����飻����ǵ���ͼƬ�����ϴ�����nameֵ
 * $dir STRING �ַ��� ָ���ϴ����Ǹ�Ŀ¼��
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
        die('�Ҳ����ϴ��ļ�');
    }
    if ($file['error']) {
        die($file['error']);

    } else if (!file_exists($file['tmp_name'])) {
        die('�Ҳ�����ʱ�ļ�');
    } else if (!is_uploaded_file($file['tmp_name'])) {
        die('��ʱ�ļ�����');

    }

    $oriName = $file['name'];
    $fileSize = $file['size'];
    $fileType = getFileExt($oriName);
    $fullName = randName().'.jpg';

    //Ŀ¼
    $Y = date('Y',TIME);
    $format = '/static/upload/image/'.$Y.'/'.$dir;
    $dirname = mk_dir(BASEDIR.'/cmd'.$format);

    //����ļ���С�Ƿ񳬳�8M����
    if ($fileSize > 8048000) {
        die('�ļ���СΪ'.$fileSize.'B,������վ����:8048000B');
    }

    //����Ƿ�������ļ���ʽ
    $result = in_array($fileType, [ '.jpg', '.jpeg','.png','.gif']);
    if (!$result) {
        die('�ļ����Ͳ�����');
    }

    //�ƶ��ļ�
    $filePath = $dirname.'/'.$fullName;
    if (!(move_uploaded_file($file['tmp_name'], $filePath) && file_exists($filePath))) { //�ƶ�ʧ��
        die('�ļ�����ʱ����');
    } else { //�ƶ��ɹ����������

        list($width, $height) = getimagesize($filePath);
        if ($height > 700 || $width > 700){ //700ͼƬѹ���������
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

        // return '//'.HOST.$format.'/'.$fullName; ��Ҫ��������Ϊ���������˶����ݿ��URL��Ū���ˡ�
        return $format.'/'.$fullName;
    }
}
//�ϴ���Ƶ
function upVideo($fileField)
{
    $file = $fileField;

    if (!$file) {
        die('�Ҳ����ϴ��ļ�');
    }
    if ($file['error']) {
        die($file['error']);

    } else if (!file_exists($file['tmp_name'])) {
        die('�Ҳ�����ʱ�ļ�');
    } else if (!is_uploaded_file($file['tmp_name'])) {
        die('��ʱ�ļ�����');

    }

    $oriName = $file['name'];
    //$fileSize = $file['size'];
    $fileType = getFileExt($oriName);
    $fullName = randName().'.mp4';

    //Ŀ¼
    $Y = date('Y',TIME);
    $format = '/static/upload/video/'.$Y.'/'.date('m',TIME);
    $dirname = mk_dir(BASEDIR.'/cmd'.$format);

    //����ļ���С�Ƿ񳬳�8M����
    /*if ($fileSize > 8048000) {
        die('�ļ���СΪ'.$fileSize.'B,������վ����:8048000B');
    }*/

    //����Ƿ�������ļ���ʽ
    /*$result = in_array($fileType, [ '.mp4']);
    if (!$result) {
        die('�ļ����Ͳ�����');
    }*/

    //�ƶ��ļ�
    $filePath = $dirname.'/'.$fullName;
    if (!(move_uploaded_file($file['tmp_name'], $filePath) && file_exists($filePath))) { //�ƶ�ʧ��
        die('�ļ�����ʱ����');
    } else { //�ƶ��ɹ����������

        // return '//'.HOST.$format.'/'.$fullName; ��Ҫ��������Ϊ���������˶����ݿ��URL��Ū���ˡ�
        return $format.'/'.$fullName;
    }
}