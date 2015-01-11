<?php
// dans le fichier gestion des metabox

$text = <<<TEXT
 je suis un text avec [link]christophe[/link] et encore avec [link]caroline[/link] dans le texte et christophe et caroline
TEXT;

$text = preg_replace('/(\[link\])?(christophe|caroline)(\[\/link\])?/i', '[link]$2[/link]', $text);
var_dump($text);

// Dans le fichier functions.php
function rg_link_page_agence($content) {
    
    if (is_page('page-agence')) {
        
        $url = get_url_site();
        
        return preg_replace('/\[link\](christophe|caroline)\[\/link\]/i', '<a href="'.$url.'">$1</a>', $content);
    }
    
    return $content;
}

add_filter( 'the_content', 'rg_link_page_agence' );
