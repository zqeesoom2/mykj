//Ȩ����֤������
$(function(){
    //��ȡ�ʺź���Ĳ���
    username = window.parent.getUrlParam()['username'];
    if (typeof(username)=="undefined" || username=='' ){
        return window.parent.location.href = 'Login.html';
    }
            $.ajax({
                cache:false,
                async: false,//ͬ���������ݣ������û�����
                url:'/Mykj/Login.html',
                type:'post',
                datatype:'json',
                data:{
                    param:JSON.stringify({username:username,islogin:1})
                },
                success:function(okstr){
            if(okstr!=1 && okstr!=3){
                    console.log('reload');
              //  return window.parent.location.href = 'Login.html';
            }
                    user_master = okstr;
                    //��ͨ����Աû����˵�Ȩ��
                    if(user_master!=1){
                            $("#OneClickThrough").remove();
                    }
        }
    });
});