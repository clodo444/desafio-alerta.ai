<?php
// Script para identificar alunos aprovados e simular envio de mensagem
// Uso: php contato_aprovados.php

$csvFile = __DIR__ . '/alunos.csv';

function lerAlunos($arquivo) {
    $alunos = [];
    if (!file_exists($arquivo)) {
        echo "Arquivo CSV não encontrado: $arquivo\n";
        exit(1);
    }
    if (($handle = fopen($arquivo, 'r')) !== false) {
        $cabecalho = fgetcsv($handle);
        while (($linha = fgetcsv($handle)) !== false) {
            $aluno = array_combine($cabecalho, $linha);
            $alunos[] = $aluno;
        }
        fclose($handle);
    }
    return $alunos;
}

