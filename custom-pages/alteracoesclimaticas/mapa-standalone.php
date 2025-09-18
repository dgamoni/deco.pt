<?php
/**
 * Componente de Mapa Autónomo - Versão Robusta
 *
 * Inclui o mapa e o conteúdo completo do formulário. O formulário é depois
 * ocultado de forma acessível com CSS, garantindo que todos os scripts
 * encontram os elementos de que necessitam para funcionar.
 */

// 1. Inclui o conteúdo completo do mapa.
$caminho_mapa = __DIR__ . '/item-map.php';
if ( file_exists( $caminho_mapa ) ) {
    include $caminho_mapa;
}

// 2. Inclui o conteúdo COMPLETO do ficheiro de contactos.
// Isto garante que o JS tem todos os elementos de que precisa.
$caminho_contactos = __DIR__ . '/item-contacts.php';
if ( file_exists( $caminho_contactos ) ) {
    // Envolvemos o conteúdo numa div com uma classe específica para o podermos ocultar.
    echo '<div class="componente-oculto-para-js">';
    include $caminho_contactos;
    echo '</div>';
}
?>
