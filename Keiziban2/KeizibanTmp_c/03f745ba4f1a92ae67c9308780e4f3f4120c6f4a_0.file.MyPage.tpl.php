<?php
/* Smarty version 3.1.31, created on 2017-12-10 07:25:07
  from "C:\xampp\htdocs\selfphp2\Keiziban2\KeizibanTmp\MyPage.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a2c62c33c04f1_82021770',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '03f745ba4f1a92ae67c9308780e4f3f4120c6f4a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\selfphp2\\Keiziban2\\KeizibanTmp\\MyPage.tpl',
      1 => 1512858172,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a2c62c33c04f1_82021770 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
    <title>掲示版2 <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
</title>
</head>
<form method = "POST" action = "MyContribution.php">
    <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
　さんのマイページ
    <input type = 'submit' name = 'Logoutbutton' value = 'ログアウト'>
</form>
<form method = "POST" action = "Keiziban2.php">
    <input type = 'submit' name = 'Logoutbutton' value = 'ホームに戻る'>
</form>
<body>

</body>
</html><?php }
}
