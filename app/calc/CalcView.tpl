{extends file=$conf->root_path|cat:"/templates/main.html"}

{block name=footer}Kalkulator{/block}

{block name=content}

<h2 class="content-head is-center">Kalkulator kredytu oraz lokaty</h2>

<div class="pure-g">
<div class="l-box-lrg pure-u-1 pure-u-med-2-5">
	<form class="pure-form pure-form-stacked" action="{$conf->action_root}calcCompute" method="post">
		<fieldset>

			<label for="x">Kwota</label>
			<input id="x" type="text" placeholder="kwota (zł)" name="x" value="{$form->x}">
                        
                        <label for="y">Liczba lat</label>
			<input id="y" type="text" placeholder="liczba lat" name="y" value="{$form->y}">
                        
                        <label for="z">Procent</label>
			<input id="z" type="text" placeholder="liczba procent (%)" name="z" value="{$form->z}">

			<label for="op">Operacja</label>
					<select id="op" name="op">

{if isset($res->op_name)}
<option value="{$form->op}">ponownie: {$res->op_name}</option>
<option value="" disabled="true">---</option>
{/if}
						<option value="kredyt">kredyt</option>
						<option value="lokata">lokata </option>
					</select>
					

			<button type="submit" class="pure-button">Oblicz</button>
		</fieldset>
	</form>
</div>

<div class="l-box-lrg pure-u-1 pure-u-med-3-5">

{* wyświeltenie listy błędów, jeśli istnieją *}
{if $msgs->isError()}
	<h4>Wystąpiły błędy: </h4>
	<ol class="err">
	{foreach $msgs->getErrors() as $err}
	{strip}
		<li>{$err}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{* wyświeltenie listy informacji, jeśli istnieją *}
{if $msgs->isInfo()}
	<h4>Informacje: </h4>
	<ol class="inf">
	{foreach $msgs->getInfos() as $inf}
	{strip}
		<li>{$inf}</li>
	{/strip}
	{/foreach}
	</ol>
{/if}

{if isset($res->result)}
	<h4>Wynik</h4>
	<p class="res">
	{$res->result} 
	</p>
{/if}





</div>
</div>


{/block}