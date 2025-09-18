<?php
//because of the ob_start() in WP, we lose the variables, so I need to remake them here
function getmainurl1(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    //return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

//define the LP location
//$lp_location = base_url() . "custom-pages/alteracoesclimaticas/";
//NOTE: for now I'm hadrcoding the custom page!
$lp_location = getmainurl1() . "/" . "custom-pages/alteracoesclimaticas/";
?>
<div role="form" id="contacts-form-wrapper" style="display:none;" lang="pt-PT" dir="ltr">
	<div class="screen-reader-response">
		<p role="status" aria-live="polite" aria-atomic="true"></p>
		<ul></ul>
	</div>
	<form action="#" method="post" class="" novalidate="novalidate" id="contacts-form">
		<div style="display: none;">
			<input type="hidden" name="id_municipality" value="">
			<input type="hidden" name="consent_text" value="Concordo e aceito a política de privacidade.">
			<input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
		</div>
		<p><label>Nome *<br>
<span class="wpcf7-form-control-wrap nomeCompleto"><input type="text" name="name" value="" size="40" maxlength="160" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required" aria-required="true" aria-invalid="false"></span> </label>
		</p>
		<p><label>Email de contacto *<br>
<span class="wpcf7-form-control-wrap emailContacto"><input type="email" name="email" value="" size="40" maxlength="100" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false"></span> </label>
		</p>
		<p><label> Município *<br>
<span class="wpcf7-form-control-wrap select-municipios-wrapper"><select id="select_municipalities" name="municipality" class="wpcf7-form-control wpcf7-select select-municipios" aria-required="true" aria-invalid="false"><option value="">- Escolha o Município -</option></select></span> </label>
		</p>
		<p><label>Diga-nos o que o seu município pode fazer por si *<br>
<span class="wpcf7-form-control-wrap descricao"><textarea name="contacts_text" cols="40" rows="10" maxlength="1500" class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" aria-required="true"></textarea></span> </label>
		</p>
		<p><span class="wpcf7-form-control-wrap your-consent"><span class="wpcf7-form-control wpcf7-acceptance"><span class="wpcf7-list-item"><label><input type="checkbox" name="consent" value="1" aria-invalid="false" class="wpcf7-form-control consent"><span class="wpcf7-list-item-label">Concordo e aceito a <a href="/politica-de-privacidade-da-deco/" target="_blank" style="text-decoration: underline;"> política de privacidade</a>.</span>
			</label>
			</span>
			</span>
			</span><br><br>
			<input type="submit" value="Enviar" class="wpcf7-form-control has-spinner wpcf7-submit bt-send-contacts-form" disabled="disabled">
			<span class="wpcf7-spinner"></span><div id="contacts-captcha" class="captcha-element"></div>
		</p>
		<div class="wpcf7-response-output" aria-hidden="true" style="display: none;">Um ou mais campos com erros. Por favor, verifique e tente de novo.</div>
	</form>
</div>