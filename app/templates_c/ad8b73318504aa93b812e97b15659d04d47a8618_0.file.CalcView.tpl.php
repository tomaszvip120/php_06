<?php
/* Smarty version 3.1.30, created on 2021-01-07 14:00:40
  from "D:\xampp\htdocs\php_06_kontroler\app\calc\CalcView.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ff705f8ae4830_13658030',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ad8b73318504aa93b812e97b15659d04d47a8618' => 
    array (
      0 => 'D:\\xampp\\htdocs\\php_06_kontroler\\app\\calc\\CalcView.tpl',
      1 => 1610024425,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ff705f8ae4830_13658030 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13764566835ff705f8ad6635_69001585', 'footer');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1284596765ff705f8ae41c5_55252314', 'content');
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender(($_smarty_tpl->tpl_vars['conf']->value->root_path).("/templates/main.html"), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, true);
}
/* {block 'footer'} */
class Block_13764566835ff705f8ad6635_69001585 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
Kalkulator<?php
}
}
/* {/block 'footer'} */
/* {block 'content'} */
class Block_1284596765ff705f8ae41c5_55252314 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<h2 class="content-head is-center">Kalkulator kredytu oraz lokaty</h2>

<div class="pure-g">
<div class="l-box-lrg pure-u-1 pure-u-med-2-5">
	<form class="pure-form pure-form-stacked" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
calcCompute" method="post">
		<fieldset>

			<label for="x">Kwota</label>
			<input id="x" type="text" placeholder="kwota (zł)" name="x" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->x;?>
">
                        
                        <label for="y">Liczba lat</label>
			<input id="y" type="text" placeholder="liczba lat" name="y" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->y;?>
">
                        
                        <label for="z">Procent</label>
			<input id="z" type="text" placeholder="liczba procent (%)" name="z" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->z;?>
">

			<label for="op">Operacja</label>
					<select id="op" name="op">

<?php if (isset($_smarty_tpl->tpl_vars['res']->value->op_name)) {?>
<!--<option value="<?php echo $_smarty_tpl->tpl_vars['this']->value->form->op;?>
">ponownie: <?php echo $_smarty_tpl->tpl_vars['res']->value->op_name;?>
</option>-->
<option value="" disabled="true">---</option>
<?php }?>
						<option value="kredyt">kredyt</option>
						<option value="lokata">lokata </option>
					</select>
					

			<button type="submit" class="pure-button">Oblicz</button>
		</fieldset>
	</form>
</div>

<div class="l-box-lrg pure-u-1 pure-u-med-3-5">


<?php if ($_smarty_tpl->tpl_vars['msgs']->value->isError()) {?>
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getErrors(), 'err');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['err']->value) {
?>
	<li><?php echo $_smarty_tpl->tpl_vars['err']->value;?>
</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</ol>
<?php }?>


<?php if ($_smarty_tpl->tpl_vars['msgs']->value->isInfo()) {?>
	<h4>Informacje: </h4>
	<ol class="inf">
	<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getInfos(), 'inf');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['inf']->value) {
?>
	<li><?php echo $_smarty_tpl->tpl_vars['inf']->value;?>
</li>
	<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	</ol>
<?php }?>

<?php if (isset($_smarty_tpl->tpl_vars['res']->value->result)) {?>
	<h4>Wynik</h4>
	<p class="res">
	<?php echo $_smarty_tpl->tpl_vars['res']->value->result;?>
 
	</p>
<?php }?>





</div>
</div>

<?php
}
}
/* {/block 'content'} */
}
