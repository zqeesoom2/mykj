wx.ready(function () {

    //验证接口
    /*wx.checkJsApi({
            jsApiList: [
                'chooseImage','uploadImage','startRecord','stopRecord','translateVoice'
            ],
            success: function (res) {
               alert(JSON.stringify(res));
            }
        });*/

// 3 智能接口
    var voice = {
        localId: '',
        serverId: ''
    };

    //语音功能
    $('#startRecord').on({
        touchstart: function(e){

            // 开启定时器前先清除定时器，防止重复触发
            // clearTimeout(timeOutEvent);

            //让文本框，失去焦点，作用是禁止调用安桌系统的复制粘功能（这个功能会造成抬起事件失效）
            $('#textarea').attr('disabled',true);

            timeOutEvent = setTimeout(function () {

                var div = '<div  id="lasts" class="weui-toast" style="visibility:visible;opacity: 1;background:none;">' +
                    '<img src="../images/sound.gif" width="100%" ></div>';
                $('body').append(div);
                wx.startRecord({//开始录音
                    cancel: function () {
                        alert('用户拒绝授权录音');
                    }
                });
            },1000);


        },
        touchmove: function(e){
            clearTimeout(timeOutEvent); // 长按过程中，手指是不能移动的，若移动则清除定时器，中断长按逻辑
            timeOutEvent = 0; //标记记号，代表不是长按事件，因为timeOutEvent被清除了
            e.preventDefault();//若阻止默认事件，则在长按元素上滑动时，页面是不滚动的,调用preventDefault() 可以阻止滚动。
        },
        touchend: function(e){
            $('#textarea').attr('disabled',false);
            clearTimeout(timeOutEvent);// 若手指离开屏幕时，时间小于我们设置的长按时间，则为点击事件，清除定时器，结束长按逻辑
            $('#lasts').remove();
            setTimeout(function(){
                wx.stopRecord({//停止录音
                    success: function (res) {
                        voice.localId = res.localId;
                        //识别音频并返回识别结果
                        wx.translateVoice({
                            localId: voice.localId,
                            isShowProgressTips: 1,// 默认为1，显示进度提示
                            complete: function (res) {
                                if (res.hasOwnProperty('translateResult')) {
                                    $('#textarea').val(res.translateResult);
                                } else {
                                    alert('无法识别');
                                }
                            }
                        });

                    },
                    fail: function (res) {
                        //alert(JSON.stringify(res));
                    }
                });
            },500);
            return false;
        }
    });

//监听录音自动停止
    wx.onVoiceRecordEnd({
        complete: function (res) {
            voice.localId = res.localId;
            //translateVoice();
            alert('录音时间已超过一分钟');
        }
    });
    // 5 图片接口
    var images = {
        localId: [],
        serverId: []
    };

    //从相机里选择一个图片
    $('#upimg').on('click',function () {
        wx.chooseImage({
            success: function (res) {
                // 返回选定照片的本地ID列表，localId可以作为img标签的src属性显示图片,临时素才保存三天。
                images.localId = res.localIds;
                //alert('已选择 ' + res.localIds.length + ' 张图片');
                uploadImage();
                previewImage();

            }
        });
    });

    //图片预览
    function previewImage () {

        var length = images.localId.length;
        var ioc = $('#previewImage');

        if (length != 0) {

            for (var i=0 ; i<length;i++){
                var div =  '<div class="img-up pos-rel fl ml0-2">\n' +
                    '<img src="'+images.localId[i]+'" style="width:5rem" class="circular">\n' +
                    '<div class="close-img" id="close-'+i+'" alt="'+i+'">X</div></div>';
                ioc.append(div);

                //删除图片
                $('#close-'+i).on('click',function(){
                    $(this).parent().remove();
                    var index = $(this).attr('alt');
                    images.localId.splice(index, 1);//删除数组 splice(索引，长度1代表删除一个)

                });
            }
        }

    };

    // 5.3 上传图片
    function uploadImage () {
        if (images.localId.length == 0) {
            alert('请先选择图片');
            return 0;
        }
        var i = 0, length = images.localId.length;

        //images.serverId = [];
        function upload() { //关包函数
            wx.uploadImage({
                localId: images.localId[i],
                isShowProgressTips: 1,
                success: function (res) {

                    i++;
                    //alert('已上传：' + i + '/' + length);
                    images.serverId.push(res.serverId);
                    if (i < length) {
                        upload();
                    }
                },
                fail: function (res) {
                    // alert(JSON.stringify(res));
                    alert('第'+i+'图片上传失败');
                }
            });
        }
        upload();

        // return images.serverId.length;
    };

    // 5.4 下载图片

//提交信息
    function submit () {
        var quiz =  $('#textarea').val();

        if(quiz.length<2){
            //console.log(quiz.length);
            alert('不能少于2个字符');
            return false;
        }

        $.showLoading();
        //这个样式是遮罩层：
        var div = $('<div id="lasts" class="weui-mask_transparent"></div>');
        $('body').append(div);

        var data ={'quiz':quiz};

        //var serverId_length =  uploadImage();
        var serverId_length = images.serverId.length;
        setTimeout(function(){
            if(serverId_length>0){
                data.media_ids = images.serverId;
            }
            //
            $.ajax({
                cache:false,
                async: false,//同步加载数据，锁定用户交互。 默认是true异步方式
                url:'',
                type:'post',
                datatype:'text',
                data:{param:JSON.stringify(data)},
                success:function(res){
                    $.hideLoading();
                    div.remove();
                    var info = '信息提交失败！';
                    if(res=='OK'){
                        info = '提交成功！';
                        $.closePopup();
                        $('#textarea').val('');
                        $('#previewImage').empty();
                        images = {
                            localId: [],
                            serverId: []
                        };
                    }
                    $.alert(info);
                }
            });
        },1000);


    }

    $('#submit').on('click',function(){
        submit();
    });

});

wx.error(function (res) {
    alert(res.errMsg);
});