<?php

function lerArquivo($arquivo_nome) {
    $arquivo = fopen($arquivo_nome, "r");
    if (!$arquivo) {
        return [];
    }
    //se tiver arquivo pra abrir ele abre

    $resultado = []; 

    while (($linha = fgets($arquivo)) !== false) {
        
        $linha = trim($linha);
        //trim tira o espaço do fim da linha

        if ($linha === '') {
            continue;
        }
        //le linha por linha

        $resultado[] = explode('###', $linha);
       // explode a linha e coloca no resultado
    }

    fclose($arquivo); 
    //fecha o arquivo

    return $resultado;
}

function salvarArquivo($arquivo_nome, $conteudo) {
    $arquivo = fopen($arquivo_nome, "w");

    if ($arquivo) {
        if (is_array($conteudo)) {
            foreach ($conteudo as $linha_dados) {
                if (is_array($linha_dados)) {
                    $texto = implode('###', $linha_dados) . PHP_EOL;
                } else {
                    $texto = $linha_dados . PHP_EOL;
                }
                fwrite($arquivo, $texto);
            }
        } else {
            fwrite($arquivo, $conteudo);
        }
        
        fclose($arquivo);
    }
}

function proximoId($lista_itens) {
    if (empty($lista_itens)) {
        return 1;
    }
    if($lista_itens == false) return 1;

    $maior_id = 0;

    foreach ($lista_itens as $item) {
        if (isset($item->id)) {
            $id_atual = (int)$item->id;
            
            if ($id_atual > $maior_id) {
                $maior_id = $id_atual;
            }
        }
    }

    return $maior_id + 1;
}