<?php

require 'settings.php';

$delay = 8; // segundos

ob_start();

while (true) {
    // consulta os endereços
    $stmt = $conn->query('SELECT * FROM mem_site WHERE blocked != 1 ORDER BY date_last_view ASC LIMIT 10');
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($results as $key => $site) {
        $page = @file_get_contents($site['url']);

        // Captura de informações
        preg_match_all(REG_URL_IMG, $page, $images);
        preg_match_all(REG_URL_LINK, $page, $links);

        echo "\nCapturando todos as urls do $site[url]\n\n";

        // Links
        foreach ($links[1] as $key => $value) {
            if ($site['condition_start_with']) {
                if (strpos($value, $site['condition_start_with']) !== false) {
                    if ($conn->exec("INSERT INTO mem_site (`url`, condition_start_with) VALUES ('$value', '$site[condition_start_with]')")) {
                        echo "$value -\e[32m salvo com condição\e[0m\n";
                    } else {
                        echo "$value -\e[33m ignorado\e[0m\n";
                    }
                    ob_flush();
                }
                continue;
            }

            if ($conn->exec("INSERT INTO mem_site (`url`) VALUES ('$value')") !== false) {
                echo "$value -\e[32m url salva\e[0m\n";
            } else {
                echo "$value -\e[33m ignorado\e[0m\n";
            }
            ob_flush();
        }

        echo "\nProcurando por imagens no $site[url]\n\n";

        // Imagens
        foreach ($images[1] as $key => $value) {
            $image = getimagesize($value);

            // Pega imagens maiores que 500x300
            if ($image[0] > 500 && $image[1] > 300) {
                $details = pathinfo(parse_url($value, PHP_URL_PATH));
                $filename = SAVE_DIRECTORY . $details['basename'];
                if (copy($value, $filename)) {
                    echo "$filename -\e[32m copiado\e[0m\n";
                } else {
                    echo "$filename -\e[31m falha ao copiar\e[0m\n";
                }
                ob_flush();
            }
        }

        // atualiza da data/hora da URL varrida
        $conn->query("UPDATE mem_site SET date_last_view = NOW() WHERE id_url = $site[id_url] LIMIT 1");

        echo "\n\e[5m\e[34m Aguardando delay de " . $delay . "s ...\e[0m\n\n";
        ob_flush();
        sleep($delay);
    }
}

ob_end_clean();