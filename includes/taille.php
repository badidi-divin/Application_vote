<?php
function file_on_ko($octets) {
    $resultat = $octets;
    for ($i=0; $i < 8 && $resultat >= 1024; $i++) {
        $resultat = $resultat / 1024;
    }
    if ($i > 0) {
        return preg_replace('/,00$/', '', number_format($resultat, 2, '.', ''))
. ' ' . substr('KMGTPEZY',$i-1,1) . 'o';
    } else {
        return $resultat . ' o';
    }
}

//echo taille_fichier(2048);  // affiche : 1 Ko
?>