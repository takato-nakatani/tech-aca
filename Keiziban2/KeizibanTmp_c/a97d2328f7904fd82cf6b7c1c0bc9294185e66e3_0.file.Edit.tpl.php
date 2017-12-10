<?php
/* Smarty version 3.1.31, created on 2017-12-11 01:58:34
  from "C:\xampp\htdocs\selfphp2\Keiziban2\KeizibanTmp\Edit.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.31',
  'unifunc' => 'content_5a2d67ba59a230_27031011',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a97d2328f7904fd82cf6b7c1c0bc9294185e66e3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\selfphp2\\Keiziban2\\KeizibanTmp\\Edit.tpl',
      1 => 1512925102,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5a2d67ba59a230_27031011 (Smarty_Internal_Template $_smarty_tpl) {
?>
<html>
<head>
    <title>投稿文の編集 <?php echo $_smarty_tpl->tpl_vars['name']->value;?>
さん</title>
</head>
<form method = "POST" action = "EditContents.php">
    <input type = 'submit' name = 'Logoutbutton' value = 'ログアウト'>
</form>
<form method = "POST" action = "EditContents.php">
    <input type = 'submit' name = 'backtomypagebutton' value = 'マイページに戻る'>
</form>
<form method = "POST" action = "EditContents.php">
    <p>編集後、完了ボタンを押してください。</p>
    <textarea name = 'contribution' cols = '75' rows = '10' maxlength = "500" wrap = "hard"><?php echo $_smarty_tpl->tpl_vars['before_edit']->value;?>
</textarea><br />
    <input type = 'submit' name = 'editcompletebutton' value = '編集を完了する'>
</form>
<body>

</body>
</html>
<?php }
}
