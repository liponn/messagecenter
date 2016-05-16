<?php /* Smarty version 3.1.27, created on 2016-05-16 19:03:40
         compiled from "/home/liuqi/www/messageCenter/app/template/admin/index/login.html" */ ?>
<?php
/*%%SmartyHeaderCode:7270950765739a90cda98c8_77350680%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '031b094d6312441faf803665b2ab45579b8ff093' => 
    array (
      0 => '/home/liuqi/www/messageCenter/app/template/admin/index/login.html',
      1 => 1463396618,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7270950765739a90cda98c8_77350680',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5739a90cdb1f41_83437080',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5739a90cdb1f41_83437080')) {
function content_5739a90cdb1f41_83437080 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '7270950765739a90cda98c8_77350680';
?>
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>网利宝 后台</title>

    <!-- Bootstrap core CSS -->
    <link href="admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="admin/css/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <?php echo '<script'; ?>
 src="admin/js/ie-emulation-modes-warning.js"><?php echo '</script'; ?>
>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <?php echo '<script'; ?>
 src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"><?php echo '</script'; ?>
>
      <?php echo '<script'; ?>
 src="//cdn.bootcss.com/respond.admin/js/1.4.2/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->

<style type="text/css">
#centerarchor {
    position:absolute;
    left:50%;
    top: 50%;

}
.centerbox {
    float:left;
    position:relative;
    right:50%;
    bottom: 50%;
    margin-top: -150px;
    border:1px solid silver;
    padding: 20px;
    background: white;
}

</style>
</head>

  <body style="background:#f5f5f5">

    <nav class="navbar navbar-inverse navbar-fixed-top navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">网利宝后台</a>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div id="centerarchor">
          <div class="centerbox">

          <form class="form-horizontal" method="post" action="">

            <div class="form-group">
              <label for="username" class="col-sm-4 control-label">用户名：</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="username" name="username" placeholder="用户名">
              </div>
            </div>

            <div class="form-group">
              <label for="password" class="col-sm-4 control-label">密码：</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" id="password" name="password" placeholder="密码">
              </div>
            </div>

            <div class="form-group">
              <p class="text-right col-sm-12">
                <button type="submit" class="btn btn-primary">登录</button>
              </p>
            </div>

          </form>

          </div>
        </div>

      </div>
    </div>

<!-- end onlineModal -->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php echo '<script'; ?>
 src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="//cdn.bootcss.com/bootstrap/3.3.5/admin/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="admin/js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="admin/js/bootstrap.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="admin/js/jquery_and_jqueryui.js"><?php echo '</script'; ?>
>


  </body>
</html>
<?php }
}
?>