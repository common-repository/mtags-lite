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

	<div class="icon-mtags"></div><h2>Mtags Lite / <?php _e("Opções Avançadas","mtags"); ?></h2>

	<form method="post" action="options.php">

		<?php wp_nonce_field('update-options'); ?>

		<h4><?php _e("Keywords","mtags"); ?></h4>

		<p><?php _e("Qual dos comportamentos abaixo você deseja para suas keywords?","mtags"); ?></p>

		<p><select name="mtags_opt_keywords">
			<option value="0" 	<?php if (get_option('mtags_opt_keywords') == "0") 	{ echo " selected='true' "; }?>> <?php _e( "Padrão","mtags" ); ?>			</option>
			<option value="1" 	<?php if (get_option('mtags_opt_keywords') == "1")	{ echo " selected='true' "; }?>> <?php _e( "Tags + Padrão","mtags" ); ?> 	</option>
			<option value="2" 	<?php if (get_option('mtags_opt_keywords') == "2")	{ echo " selected='true' "; }?>> <?php _e( "Tags","mtags" ); ?>	</option>
		</select></p>

        <h4><?php _e("Descrição","mtags"); ?></h4>

		<p><?php _e("Qual dos comportamentos abaixo você deseja para seus single posts?","mtags"); ?></p>
        
		<p><select name="mtags_opt_description">
			<option value="0" 	<?php if (get_option('mtags_opt_description') == "0")	{ echo " selected='true' "; }?>> <?php _e( "Padrão","mtags" ); ?>			</option>
			<option value="1" 	<?php if (get_option('mtags_opt_description') == "1")	{ echo " selected='true' "; }?>> <?php _e( "Resumo + Padrão","mtags" ); ?> 	</option>
			<option value="2" 	<?php if (get_option('mtags_opt_description') == "2")	{ echo " selected='true' "; }?>> <?php _e( "Resumo","mtags" ); ?> 			</option>
		</select></p>

        <h4><?php _e("Opções adicionais","mtags"); ?></h4>

		<p><?php _e("Marque o que não deseja exibir dentro do &lt;head&gt;","mtags"); ?></p>

		<p>
			<label><input type="checkbox" name="mtags_opt_rsd" value="1" 				<?php if (get_option('mtags_opt_rsd') == "1")				{ echo 'checked="checked"'; }?> />	<?php _e("RSD Link","mtags"); ?>				</label> <br />
			<label><input type="checkbox" name="mtags_opt_wlwmanifest" value="1" 		<?php if (get_option('mtags_opt_wlwmanifest') == "1")		{ echo 'checked="checked"'; }?> />	<?php _e("WLW Manifest","mtags"); ?>			</label> <br />
			<label><input type="checkbox" name="mtags_opt_generator" value="1" 			<?php if (get_option('mtags_opt_generator') == "1")			{ echo 'checked="checked"'; }?> />	<?php _e("WP Generator","mtags"); ?>			</label> <br />
            <label><input type="checkbox" name="mtags_opt_start_post_rel" value="1" 	<?php if (get_option('mtags_opt_start_post_rel') == "1")	{ echo 'checked="checked"'; }?> />	<?php _e("Start Post Rel Link","mtags"); ?>		</label> <br />
            <label><input type="checkbox" name="mtags_opt_index_rel" value="1" 			<?php if (get_option('mtags_opt_index_rel') == "1")			{ echo 'checked="checked"'; }?> />	<?php _e("Index Rel Link","mtags"); ?>			</label> <br />
            <label><input type="checkbox" name="mtags_opt_adjacent_posts_rel" value="1" <?php if (get_option('mtags_opt_adjacent_posts_rel') == "1"){ echo 'checked="checked"'; }?>	/>	<?php _e("Adjacent Post Rel Link","mtags"); ?>	</label> <br />
		</p>

		<p class="submit">
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="mtags_opt_keywords,mtags_opt_description,mtags_opt_rsd,mtags_opt_wlwmanifest,mtags_opt_generator,mtags_opt_start_post_rel,mtags_opt_index_rel,mtags_opt_adjacent_posts_rel" />
			<input type="submit" name="submit" value="<?php _e("Atualizar","mtags"); ?> &raquo" />
        </p>

    </form>

	<h4><?php _e("Doação","mtags"); ?></h4>

	<p><?php _e("Pague uma xícara de café caso tenha gostado do plugin e queira contribuir para a continuação do projeto.","mtags"); ?></p>

	<p><?php _e("<form target='pagseguro' action='https://pagseguro.uol.com.br/checkout/doacao.jhtml' method='post'><input type='hidden' name='email_cobranca' value='wander@wanderlima.com' /><input type='hidden' name='moeda' value='BRL' /><input type='image' src='https://p.simg.uol.com.br/out/pagseguro/i/botoes/doacoes/120x53-doar.gif' name='submit' alt='Pague com PagSeguro - é rápido, grátis e seguro!' /></form>","mtags"); ?></p>

</div>