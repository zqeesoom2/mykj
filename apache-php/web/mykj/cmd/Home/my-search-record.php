<!--header start-->
<!DOCTYPE html>
<html>
  <head>
    <title>法律平台</title>
    <meta charset="gbk">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    
    <link rel="stylesheet" href="../css/weui.min.css">
    <link rel="stylesheet" href="../css/jquery-weui.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <style>
	.tr{text-align:right;}
	.border-bottom{border-bottom: 1px solid #ccc;}
	.pt03{padding-top:0.3rem;}.pt01{padding-top:0.1rem;}.pl03{padding-left:0.3rem;}.pr03{padding-right:0.3rem;} .pb03{padding-bottom:0.3rem;}
	.fgray{color:#ccc;}
	.evaluate{ border-bottom:1px solid #ccc;border-top:1px solid #ccc;}
	.green-f{color:#093}
	.org-f{color:#FD901B}
	.border-red{border:2px solid #900; color:#900}
	.l{left:13rem;top:0.3rem;}
	.bg-gray{background:#eee}
    </style>
</head>
<body ontouchstart>

<?php foreach ($arr as $item) {?>
<div class="ub white-bg  border-bottom mt0-5">
	<div class="ub-f1 ">&nbsp;<?php echo date('Y-m-d H:s',$item['newstime']); ?></div>
	<div>0人回复&nbsp;</div>
</div>
    <div class="white-bg pt03">&nbsp;<a href="Consult.html?id=<?php echo $item['id']; ?>"><?php echo $item['quiz']; ?></a></div>
<?php }?>

<script src="../js/jquery-2.1.4.js"></script>
<script src="../js/fastclick.js"></script>
<script src="../js/jquery-weui.min.js"></script>
<script>
  $(function() {
    FastClick.attach(document.body);
  });
</script>
</body>
</html>