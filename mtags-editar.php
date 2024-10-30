<?php
/*
	.
	Package: Mtags Lite
	Version: 1.0
	Description: Simple plugin that put description and keywords for all pages and posts of your blog and clean unnecessary info in wp_head() for secure reasons.
	Author: Wander Lima
	Author URI: http://wanderlima.com/
	License: GPL2
	.
	Keywords: tags, user default and tags + user default
	Description: excerpt, user default and excerpt + user default
	Remove: rsd_link, wlwmanifest_link, wp_generator, start_post_rel_link, index_rel_link, adjacent_posts_rel_link
	.
*/
?>

<style type="text/css">

	<?php include_once('css/mtags.css'); ?>

</style>

<div class="wrap">

	<div class="icon-mtags"></div><h2>Mtags Lite / <?php _e("Editar","mtags"); ?></h2>

	<form method="post" action="options.php">

		<?php wp_nonce_field('update-options'); ?>

		<h4><?php _e("Keywords","mtags"); ?></h4>
		<p><?php _e("Adicione palavras chaves para o seu website separados por vírgula.","mtags"); ?></p>
		<p><input type="text" name="mtags_keywords" style="width:80%;" value="<?php echo get_option('mtags_keywords'); ?>" maxlength="255" /><br />
		<small><?php _e("Limite: 255 caracteres.","mtags"); ?></small></p>

		<h4><?php _e("Descrição do Website","mtags"); ?></h4>
		<p><?php _e("Adicione uma breve descrição do seu website.","mtags"); ?></p>
		<p><input type="text" name="mtags_description" style="width:80%;" value="<?php echo get_option('mtags_description'); ?>" maxlength="255" /><br />
		<small><?php _e("Limite: 255 caracteres.","mtags"); ?></small></p>

		<h4><?php _e("Atualização do Site","mtags"); ?></h4>
		<p><?php _e("Selecione honestamente o período que mais se encaixe a suas atualizações.","mtags"); ?></p>
		
		<p><select name="mtags_update">
			<option value="1" 	<?php if (get_option('mtags_update') == "1") 	{ echo " selected='true' "; }?>><?php _e("Diaria","mtags"); ?></option>
			<option value="7" 	<?php if (get_option('mtags_update') == "7")	{ echo " selected='true' "; }?>><?php _e("Semanal","mtags"); ?></option>
			<option value="15" 	<?php if (get_option('mtags_update') == "15")	{ echo " selected='true' "; }?>><?php _e("Quinzenal","mtags"); ?></option>
			<option value="30" 	<?php if (get_option('mtags_update') == "30")	{ echo " selected='true' "; }?>><?php _e("Mensal","mtags"); ?></option>
			<option value="90" 	<?php if (get_option('mtags_update') == "90")	{ echo " selected='true' "; }?>><?php _e("Trimestral","mtags"); ?></option>
			<option value="180"	<?php if (get_option('mtags_update') == "180")	{ echo " selected='true' "; }?>><?php _e("Semestral","mtags"); ?></option>
			<option value="365" <?php if (get_option('mtags_update') == "365")	{ echo " selected='true' "; }?>><?php _e("Anual","mtags"); ?></option>
		</select></p>

		<p class="submit">
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="mtags_keywords,mtags_description,mtags_update,mtags_opt_description,mtags_opt_keywords" />
			<input type="submit" name="submit" value="<?php _e("Atualizar","mtags"); ?> &raquo" />
		</p>

	</form>

</div>