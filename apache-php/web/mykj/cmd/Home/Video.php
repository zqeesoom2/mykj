<!DOCTYPE html>
<html>
<head>
    <title>����ƽ̨</title>
    <meta charset="gbk">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">

    <link rel="stylesheet" href="./css/weui.min.css">
    <link rel="stylesheet" href="./css/jquery-weui.min.css">
    <link rel="stylesheet" href="./css/index.css">

</head>
<body>
<div class="weui-uploader__input-box">�ϴ���Ƶ��
<form method="post" action="" enctype="multipart/form-data" name="void_form"  id="void_form">
    <input type="hidden" name="video" value="1"/>
    <input id="uploaderInput" name="video[]" class="weui-uploader__input" type="file" accept="video/*" multiple="">
</form>

</div>
<div class="demos-content-padded mt0-5 " >
    <a href="javascript:;" id="submit" class="weui-btn bule-bg w85">�ϴ���Ƶ</a>
</div>

<br>
�ϴ�ͼƬ��
<div class="w100">
    <!--Ԥ��ͼƬ--><ul class="weui-uploader__files" id="preview"></ul>
</div>

<div class="weui-uploader__input-box">
    <form method="post" action="" enctype="multipart/form-data" name="img_form" target="uploadImg" id="img_form">
        <input type="hidden" name="img" value="1"/>
        <input id="uploaderInput" name="FileImgs[]" class="weui-uploader__input" onchange="fileUpImgs()" type="file" accept="image/*" multiple="">
    </form>
    <iframe  name="uploadImg" width="0" height="0" marginwidth="0" frameborder="0" src="about:blank"></iframe>
</div>

<script src="./js/jquery-2.1.4.js"></script>
<script>
    //�ϴ���Ƶ
    $("#submit").click(function(){
        $('#void_form').submit();
    });

    //�첽�ϴ�ͼƬ
    function fileUpImgs(){
        var form = $('#img_form');
        form.submit();
    }
 </script>
</body></html>

