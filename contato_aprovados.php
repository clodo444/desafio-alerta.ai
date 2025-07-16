<?php

$csvFile = __DIR__ . '/alunos.csv'; // Caminho para o arquivo CSV

function lerAlunos($arquivo) {
    $alunos = []; //funcao para ler os alunos do arquivo CSV
    if (!file_exists($arquivo)) {
        echo "Arquivo CSV não encontrado: $arquivo\n";
        exit(1);// se o arquivo não existir, exibe uma mensagem de erro e encerra
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

function alunosAprovados($alunos, $pontuacaoMinima = 70) {
    return array_filter($alunos, function($aluno) use ($pontuacaoMinima) {// filtra os alunos com pontuação maior ou igual à pontuação mínima

        return isset($aluno['Pontuação']) && $aluno['Pontuação'] >= $pontuacaoMinima;
        
    });
    
}
$a = lerAlunos($csvFile);
$aprovados = alunosAprovados($a);
foreach ($aprovados as $aluno) {
    echo "<br>EMAIL ENVIADO PARA: " . ($aluno['Email'] ?? 'N/A') . "<br>";
    echo "<br>Nome: " . ($aluno['Nome'] ?? 'N/A') . " | Pontuação: " . ($aluno['Pontuação'] ?? 'N/A') . "<br>";
    
}





