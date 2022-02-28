wx.ready(function () {

    //��֤�ӿ�
    /*wx.checkJsApi({
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
                    '<img src="../images/sound.gif" width="100%" ></div>';
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

//�ύ��Ϣ
    function submit () {
        var quiz =  $('#textarea').val();

        if(quiz.length<2){
            //console.log(quiz.length);
            alert('��������2���ַ�');
            return false;
        }

        $.showLoading();
        //�����ʽ�����ֲ㣺
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
                async: false,//ͬ���������ݣ������û������� Ĭ����true�첽��ʽ
                url:'',
                type:'post',
                datatype:'text',
                data:{param:JSON.stringify(data)},
                success:function(res){
                    $.hideLoading();
                    div.remove();
                    var info = '��Ϣ�ύʧ�ܣ�';
                    if(res=='OK'){
                        info = '�ύ�ɹ���';
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