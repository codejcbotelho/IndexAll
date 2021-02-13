<?php

// TESTAR A FUNÇÃO
function access_site($url) {
    $timeout = 0;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $conteudo = curl_exec ($ch);
    curl_close($ch);
    return $conteudo;
}