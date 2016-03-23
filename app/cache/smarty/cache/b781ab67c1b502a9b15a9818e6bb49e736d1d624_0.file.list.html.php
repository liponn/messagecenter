<?php /* Smarty version 3.1.27, created on 2016-03-11 14:38:56
         compiled from "/home/liuqi/www/wl_framework/app/template/admin/user/list.html" */ ?>
<?php
/*%%SmartyHeaderCode:3161764656e26800d8cc25_07413034%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b781ab67c1b502a9b15a9818e6bb49e736d1d624' => 
    array (
      0 => '/home/liuqi/www/wl_framework/app/template/admin/user/list.html',
      1 => 1457678333,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3161764656e26800d8cc25_07413034',
  'variables' => 
  array (
    'userList' => 0,
    'user' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_56e26800d93f54_28876967',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_56e26800d93f54_28876967')) {
function content_56e26800d93f54_28876967 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3161764656e26800d8cc25_07413034';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>用户列表</title>
</head>
<body>
<ul>
    <?php
$_from = $_smarty_tpl->tpl_vars['userList']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
$_smarty_tpl->tpl_vars['user']->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars['user']->value) {
$_smarty_tpl->tpl_vars['user']->_loop = true;
$foreach_user_Sav = $_smarty_tpl->tpl_vars['user'];
?>
    <li><?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
 : <?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
 </li>
    <?php
$_smarty_tpl->tpl_vars['user'] = $foreach_user_Sav;
}
?>
</ul>
</body>
</html><?php }
}
?>