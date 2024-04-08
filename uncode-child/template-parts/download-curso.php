<?php

global $post;

$file = get_field('regulamento_da_formacao', $post->ID);

if ( has_term('acoes-de-formacao', 'cursos', $post->ID) && $file ) : ?>

	<div class="row limit-width row-parent dowload-row" data-imgready="true">
		<div class="wpb_row row-inner">
			<div class="wpb_column col-lg-12">

				<div class="download_formacao">
					<h3><span style="color: #339966;">REGULAMENTO DA FORMAÇÃO</span></h3>

					<div class="download_formacao_links">
						<a href="<?php echo $file['url']; ?>" class="pdf_link">
							<svg xmlns="http://www.w3.org/2000/svg" width="50" height="60.9" xmlns:v="https://vecta.io/nano"><linearGradient  gradientUnits="userSpaceOnUse" x1="-272.511" y1="-390.008" x2="-271.804" y2="-389.301"><stop offset="0" stop-color="#e6e6eb"/><stop offset=".174" stop-color="#e2e2e6"/><stop offset=".352" stop-color="#d5d4d8"/><stop offset=".532" stop-color="#c0bfc2"/><stop offset=".714" stop-color="#a4a2a4"/><stop offset=".895" stop-color="#828282"/><stop offset="1" stop-color="#6b6e6e"/></linearGradient><g fill="#1d7b3c"><path d="M38.3 48.5h-5V37.3H25v11.2h-5c-.5 0-.8.6-.5 1l9.2 11.2c.3.3.7.3 1 0l9.2-11.2c.3-.4 0-1-.6-1zM7.4 17.7h-.9v2.6h.8c.2 0 .5 0 .7-.1.2 0 .4-.1.5-.2a.78.78 0 0 0 .4-.4c.1-.2.1-.4.1-.6 0-.4-.1-.8-.4-1-.4-.2-.8-.3-1.2-.3z"/><path d="M29.7 26.9V14.1c0-.7-.6-1.2-1.2-1.2H1.2c-.7 0-1.2.6-1.2 1.2v12.8c0 .7.6 1.2 1.2 1.2h27.3c.7 0 1.2-.5 1.2-1.2zm-19.2-6.8c-.2.3-.4.6-.7.9-.3.2-.7.4-1.1.5s-.8.2-1.3.2h-1v3.1H4.6v-8.4h3c.5 0 .9.1 1.3.2s.7.3 1 .5.5.5.6.8c.2.3.2.7.2 1.1a1.39 1.39 0 0 1-.2 1.1zm8.6 2.2c-.3.5-.6 1-1 1.4s-.9.6-1.5.8-1.2.3-1.8.3h-2.6v-8.4h2.9a5.23 5.23 0 0 1 1.8.3c.5.2 1 .4 1.4.8.4.3.7.8.9 1.3s.3 1.1.3 1.8c-.1.5-.2 1.2-.4 1.7zm7.1-4.6h-3.5v2.2h3.2v1.4h-3.2v3.4h-1.8v-8.4h5.4v1.4zm-11.4 0H14v5.6h.6c.4 0 .7 0 1.1-.1s.7-.3.9-.5c.3-.2.5-.5.6-.9.2-.4.2-.9.2-1.4 0-.8-.2-1.5-.7-1.9-.4-.6-1.1-.8-1.9-.8z"/></g><path d="M9.9 17c-.3-.2-.6-.4-1-.5s-.8-.2-1.3-.2h-3v8.4h1.8v-3.1h1c.5 0 .9-.1 1.3-.2s.8-.3 1.1-.5.6-.5.7-.9c.2-.3.3-.8.3-1.2s-.1-.8-.2-1.1c-.2-.2-.4-.5-.7-.7zm-1.1 2.6a.78.78 0 0 1-.4.4c-.2.1-.3.2-.5.2s-.4.1-.7.1h-.7v-2.6h.9c.5 0 .8.1 1.1.3s.4.5.4 1c0 .2 0 .4-.1.6zm9.4-2.3c-.4-.3-.8-.6-1.4-.8-.5-.2-1.1-.3-1.8-.3h-2.9v8.4h2.6c.6 0 1.3-.1 1.8-.3.6-.2 1.1-.4 1.5-.8s.8-.8 1-1.4.4-1.2.4-2c0-.7-.1-1.3-.3-1.8-.2-.2-.5-.7-.9-1zm-.9 4.5c-.2.4-.4.7-.6.9-.3.2-.6.4-.9.5-.4.1-.7.1-1.1.1H14v-5.6h.9c.8 0 1.5.2 1.9.7.5.5.7 1.1.7 1.9 0 .6-.1 1.1-.2 1.5zm3.6 2.9h1.8v-3.3h3.2v-1.5h-3.2v-2.2h3.5v-1.4h-5.3z" fill="#fff"/><path d="M49.5 13.2L36.8.5c-.3-.3-.7-.5-1.1-.5H14.5C11 0 8.2 2.8 8.2 6.3v4.4h2.6V6.3a3.76 3.76 0 0 1 3.7-3.7h19.9v11.6c0 .7.6 1.3 1.3 1.3h11.6 0H50v-1.2c0-.4-.2-.8-.5-1.1zM37.1 4.5l8.4 8.4h-8.4V4.5zM14.5 53.4a3.76 3.76 0 0 1-3.7-3.7V30.3H8.2v19.3c0 3.5 2.8 6.3 6.3 6.3H22l-2.2-2.6h-5.3zm32.9-3.7a3.76 3.76 0 0 1-3.7 3.7h-5.2L36.3 56h7.3c3.5 0 6.3-2.8 6.3-6.3v-32h-2.6v32z" fill="#1d7b3c"/></svg>
						</a>
						<a href="<?php echo $file['url']; ?>" class="curso_link">
							<?php echo $file['filename']; ?>
						</a>
					</div>

				</div>

			</div>
		</div>
	</div>				

<?php endif; ?>