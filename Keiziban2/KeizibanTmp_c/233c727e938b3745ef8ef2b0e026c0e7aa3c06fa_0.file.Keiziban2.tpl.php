<?php
/* Smarty version 3.1.31, created on 2017-12-12 17:46:16
  from "C:\xampp\htdocs\selfphp2\Keiziban2\KeizibanTmp\Keiziban2.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a2f9758932839_30301310',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '233c727e938b3745ef8ef2b0e026c0e7aa3c06fa' => 
    array (
      0 => 'C:\\xampp\\htdocs\\selfphp2\\Keiziban2\\KeizibanTmp\\Keiziban2.tpl',
      1 => 1513068374,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a2f9758932839_30301310 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
    <title>ホーム <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
さん</title>
</head>
<form method = "POST" action = "Keiziban2.php">
    <p><?php echo $_smarty_tpl->tpl_vars['name']->value;?>
　さん</p>
    <input type = 'submit' name = 'Logoutbutton' value = 'ログアウト'>
</form>
<form method = "POST" action = "MyContribution.php">
    <input type = 'submit' name = 'MyConbutton' value = 'マイページ'>
</form>
<form method = "POST" action = "Keiziban2.php">
    <p>何してるなう？？(１００文字以内)</p>
    <textarea name = 'contribution' cols = '75' rows = '10' maxlength = "500" wrap = "hard"></textarea><br />
    <input type = 'submit' name = 'contributionbutton' value = '投稿!!'>
</form>
<body>

</body>
</html>
<?php }
}
