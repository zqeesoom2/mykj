/*�ı乺�ﳵ���� start
var tapParams = {
    timer: {},
    element: {},
    tapStartTime: 0,
    type: 'increment'
};

function clearTapTimer() {
    clearTimeout(tapParams.timer);
}

function clearTapHandlers() {
    clearTapTimer();


    $(tapParams.element).unbind('touchend', clearTapTimer)
        .unbind('touchcencel', clearTapHandlers);
}

function tapEvent(aEvent, aType) {

    //��ֹĬ���¼������ð�� *!/
    aEvent.preventDefault();
    aEvent.stopPropagation();

    tapParams = {
        element: aEvent.target,
        startTime: new Date().getTime() / 1000,
        type: aType
    };




    $(tapParams.element).bind('touchend', clearTapTimer)
        .bind('touchcencel', clearTapHandlers);

    changeNumber();
}

function changeNumber() {

    var currentDate = new Date().getTime() / 1000;
    var intervalTime = currentDate - tapParams.startTime;

    /!* ���ݳ�����ʱ��ı���ֵ�仯���� *!/
    if (intervalTime < 1) {
        intervalTime = 0.5;
    }
    var secondCount = intervalTime * 10;
    if (intervalTime == 3) {
        secondCount = 50;
    }
    if (intervalTime >= 4) {
        secondCount = 100;
    }

    var numberElement = $('.number');
    var currentNumber = parseInt(numberElement.val());

    if (tapParams.type == 'increment') {
        currentNumber += 1;
    } else if (tapParams.type == 'decrement') {
        currentNumber -= 1;
    }

    numberElement.val(currentNumber <= 0 ? 1 : currentNumber);

    tapParams.timer = setTimeout('changeNumber()', 1000 / secondCount);
}
// Ԫ�ص��÷�ʽ���������+ - �ı乺�ﳵ������ontouchstart="tapEvent(event, 'increment') || ontouchstart="tapEvent(event, 'decrement')
�ı乺�ﳵ���� end*/

wx.ready(function () {

/*��֤�ӿ�
      wx.checkJsApi({
            jsApiList: [
                'chooseImage','uploadImage','startRecord','stopRecord','translateVoice'
            ],
            success: function (res) {
                alert(JSON.stringify(res));
            }
        });*/

// 3 ���ܽӿ�
    var voice = {
        localId: '',
        serverId: ''
    };

    //��������
    $('#startRecord').on({
        touchstart: function(e){

            // ������ʱ��ǰ�������ʱ������ֹ�ظ�����
           // clearTimeout(timeOutEvent);

            //���ı���ʧȥ���㣬�����ǽ�ֹ���ð���ϵͳ�ĸ���ճ���ܣ�������ܻ����̧���¼�ʧЧ��
            $('#textarea').attr('disabled',true);

            timeOutEvent = setTimeout(function () {

                var div = '<div  id="lasts" class="weui-toast" style="visibility:visible;opacity: 1;background:none;">' +
                    '<img src="Home/images/sound.gif" width="100%" ></div>';
                $('body').append(div);
                wx.startRecord({//��ʼ¼��
                    cancel: function () {
                        alert('�û��ܾ���Ȩ¼��');
                    }
                });
            },1000);


        },
        touchmove: function(e){
            clearTimeout(timeOutEvent); // ���������У���ָ�ǲ����ƶ��ģ����ƶ��������ʱ�����жϳ����߼�
            timeOutEvent = 0; //��ǼǺţ������ǳ����¼�����ΪtimeOutEvent�������
            e.preventDefault();//����ֹĬ���¼������ڳ���Ԫ���ϻ���ʱ��ҳ���ǲ�������,����preventDefault() ������ֹ������
        },
        touchend: function(e){
            $('#textarea').attr('disabled',false);
            clearTimeout(timeOutEvent);// ����ָ�뿪��Ļʱ��ʱ��С���������õĳ���ʱ�䣬��Ϊ����¼��������ʱ�������������߼�
            $('#lasts').remove();
            setTimeout(function(){
                wx.stopRecord({//ֹͣ¼��
                    success: function (res) {
                        voice.localId = res.localId;
                        //ʶ����Ƶ������ʶ����
                        wx.translateVoice({
                            localId: voice.localId,
                            isShowProgressTips: 1,// Ĭ��Ϊ1����ʾ������ʾ
                            complete: function (res) {
                                if (res.hasOwnProperty('translateResult')) {
                                    $('#textarea').val(res.translateResult);
                                } else {
                                    alert('�޷�ʶ��');
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

//����¼���Զ�ֹͣ
    wx.onVoiceRecordEnd({
        complete: function (res) {
            voice.localId = res.localId;
            //translateVoice();
           alert('¼��ʱ���ѳ���һ����');
        }
    });


    // 5 ͼƬ�ӿ�
    var images = {
        localId: [],
        serverId: []
    };

    //�������ѡ��һ��ͼƬ
    $('#upimg').on('click',function () {
        wx.chooseImage({
            success: function (res) {
                // ����ѡ����Ƭ�ı���ID�б�localId������Ϊimg��ǩ��src������ʾͼƬ,��ʱ�زű������졣
                images.localId = res.localIds;
                //alert('��ѡ�� ' + res.localIds.length + ' ��ͼƬ');
                uploadImage();
                previewImage();

            }
        });
    });

    //ͼƬԤ��
    function previewImage () {

        var length = images.localId.length;
        var ioc = $('#previewImage');

        if (length != 0) {

            for (var i=0 ; i<length;i++){
               var div =  '<div class="img-up pos-rel fl ml0-2">\n' +
                '<img src="'+images.localId[i]+'" style="width:5rem" class="circular">\n' +
                '<div class="close-img" id="close-'+i+'" alt="'+i+'">X</div></div>';
                ioc.append(div);

                //ɾ��ͼƬ
                $('#close-'+i).on('click',function(){
                    $(this).parent().remove();
                    var index = $(this).attr('alt');
                    images.localId.splice(index, 1);//ɾ������ splice(����������1����ɾ��һ��)

                });
            }
        }

    };

    // 5.3 �ϴ�ͼƬ
     function uploadImage () {
        if (images.localId.length == 0) {
            alert('����ѡ��ͼƬ');
            return 0;
        }
        var i = 0, length = images.localId.length;

        //images.serverId = [];
        function upload() { //�ذ�����
            wx.uploadImage({
                localId: images.localId[i],
                isShowProgressTips: 1,
                success: function (res) {

                    i++;
                    //alert('���ϴ���' + i + '/' + length);
                    images.serverId.push(res.serverId);
                    if (i < length) {
                        upload();
                    }
                },
                fail: function (res) {
                   // alert(JSON.stringify(res));
                    alert('��'+i+'ͼƬ�ϴ�ʧ��');
                }
            });
        }
        upload();

       // return images.serverId.length;
    };

    // 5.4 ����ͼƬ
    $('#downloadImage').onclick = function downloadImage () {
        if (images.serverId.length === 0) {
            alert('����ʹ�� uploadImage �ϴ�ͼƬ');
            return;
        }
        var i = 0, length = images.serverId.length;
        images.localId = [];
        function download() {
            wx.downloadImage({
                serverId: images.serverId[i],
                success: function (res) {
                    i++;
                    alert('�����أ�' + i + '/' + length);
                    images.localId.push(res.localId);
                    if (i < length) {
                        download();
                    }
                }
            });
        }
        download();
    };


    //�ύ��Ϣ
    function submit () {
        var quiz =  $('#textarea').val();
        var mobile = $('#mobile').val();

        if(quiz.length<2){
            //console.log(quiz.length);
            alert('��������2���ַ�');

            return false;
        }
        if(!(/^1[3456789]\d{9}$/.test(mobile))){
            alert("�ֻ���������������");
            return false;
        }

        $.showLoading();
        //�����ʽ�����ֲ㣺
        var div = $('<div id="lasts" class="weui-mask_transparent"></div>');
        $('body').append(div);

        var data ={'quiz':quiz,'mobile':mobile};

        //var serverId_length =  uploadImage();
        var serverId_length = images.serverId.length;
        setTimeout(function(){
            if(serverId_length>0){
                data.media_ids = images.serverId;
            }
            //
            $.ajax({
                cache:false,
                async: false,//ͬ���������ݣ������û������� Ĭ����true�첽��ʽ
                url:'/',
                type:'post',
                datatype:'text',
                data:{param:JSON.stringify(data)},
                success:function(res){
                    $.hideLoading();
                    div.remove();
                    var info = '��Ϣ�ύʧ�ܣ�';
                    if(res=='OK'){
                        info = '�����ĵȴ�רҵ���ʸ�����, �ύ�ɹ���';
                        $('#textarea').val('');
                        $('#mobile').val('');
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




