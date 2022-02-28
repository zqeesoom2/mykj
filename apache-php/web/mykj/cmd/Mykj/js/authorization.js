//权限验证的作用
$(function(){
    //获取问号后面的参数
    username = window.parent.getUrlParam()['username'];
    if (typeof(username)=="undefined" || username=='' ){
        return window.parent.location.href = 'Login.html';
    }
            $.ajax({
                cache:false,
                async: false,//同步加载数据，锁定用户交互
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
                    //普通管理员没有审核的权力
                    if(user_master!=1){
                            $("#OneClickThrough").remove();
                    }
        }
    });
});