<?php

require 'vendor/autoload.php';

$bancoBrasil = new \MGM\BancoBrasil(
    "eyJpZCI6ImExZjMzMGYtNGZiNC00ODRhLSIsImNvZGlnb1B1YmxpY2Fkb3IiOjAsImNvZGlnb1NvZnR3YXJlIjoxNTUzMywic2VxdWVuY2lhbEluc3RhbGFjYW8iOjF9",
    "eyJpZCI6IjMyNiIsImNvZGlnb1B1YmxpY2Fkb3IiOjAsImNvZGlnb1NvZnR3YXJlIjoxNTUzMywic2VxdWVuY2lhbEluc3RhbGFjYW8iOjEsInNlcXVlbmNpYWxDcmVkZW5jaWFsIjoxLCJhbWJpZW50ZSI6ImhvbW9sb2dhY2FvIiwiaWF0IjoxNjIwMTcxNjI3NjY2fQ",
    "d27b177907ffabf01367e17d50050d56b9d1a5be",
    "sandbox"
);

$registro = [
    'numeroConvenio' => '3128557',
    'numeroCarteira' => '17',
    'numeroVariacaoCarteira' => '35',
    'codigoModalidade' => '01', //Identifica a característica dos boletos dentro das modalidades de cobrança existentes no banco. Domínio: 01 - SIMPLES; 04 - VINCULADA
    'dataEmissao' => '03.09.2022', //Data de emissão do boleto (formato "dd.mm.aaaaa").
    'dataVencimento' => '31.12.2022', //Data de vencimento do boleto (formato "dd.mm.aaaaa").
    'valorOriginal' => '10', //Valor de cobrança > 0.00, emitido em Real (formato decimal separado por "."). Valor do boleto no registro. Deve ser maior que a soma dos campos “VALOR DO DESCONTO DO TÍTULO” e “VALOR DO ABATIMENTO DO TÍTULO”, se informados. Informação não passível de alteração após a criação. No caso de emissão com valor equivocado, sugerimos cancelar e emitir novo boleto.
    'valorAbatimento' => '0',
    'quantidadeDiasProtesto' => '',
    'quantidadeDiasNegativacao' => '',
    'orgaoNegativador' => '',
    'indicadorAceiteTituloVencido' => 'S',
    'numeroDiasLimiteRecebimento' => '90',
    'codigoAceite' => 'A',
    'codigoTipoTitulo' => '2',
    'descricaoTipoTitulo' => 'DUPLICATA MERCANTIL',
    'indicadorPermissaoRecebimentoParcial' => 'N',
    'numeroTituloBeneficiario' => '1',
    'campoUtilizacaoBeneficiario' => 'UM TEXTO',
    'numeroTituloCliente' => '00031285571245124141',
    'mensagemBloquetoOcorrencia' => '',
    'desconto' => [
        'tipo' => '',
        'dataExpiracao' => '',
        'porcentagem' => '',
        'valor' => '',
    ],
    'segundoDesconto' => [
        'dataExpiracao' => '',
        'porcentagem' => '',
        'valor' => '',
    ],
    'terceiroDesconto' => [
        'dataExpiracao' => '',
        'porcentagem' => '',
        'valor' => '',
    ],
    'jurosMora' => [
        'tipo' => '',
        'porcentagem' => '',
        'valor' => '',
    ],
    'multa' => [
        'tipo' => '',
        'data' => '',
        'porcentagem' => '',
        'valor' => '',
    ],
    'pagador' => [
        'tipoInscricao' => '1',
        'numeroInscricao' => '97965940132 ',
        'nome' => 'Teste Teste',
        'endereco' => 'R. Teste',
        'cep' => '10110000',
        'cidade' => 'São Paulo',
        'bairro' => 'Centro',
        'uf' => 'SP',
        'telefone' => '1112345678',
    ],
//    'beneficiarioFinal' => [
//        'tipoInscricao' => '1',
//        'numeroInscricao' => '',
//        'nome' => '',
//    ],
    'indicadorPix' => 'S'
];
$boletoRegistrado = $bancoBrasil->register($registro);

$id_boleto = '00031285571245124141';
$data = [
    'numeroConvenio' =>  '3128557',
    'indicadorNovaDataVencimento' => 'S',
    'alteracaoData' => [
        'novaDataVencimento' => '01.01.2023',
    ],
    'indicadorAtribuirDesconto' => 'N',
    'desconto' => [
        'tipoPrimeiroDesconto' => '',
        'valorPrimeiroDesconto' => '',
        'percentualPrimeiroDesconto' => '',
        'dataPrimeiroDesconto' => '',
        'tipoSegundoDesconto' => '',
        'valorSegundoDesconto' => '',
        'percentualSegundoDesconto' => '',
        'dataSegundoDesconto' => '',
        'tipoTerceiroDesconto' => '',
        'valorTerceiroDesconto' => '',
        'percentualTerceiroDesconto' => '',
        'dataTerceiroDesconto' => '',
    ],
    'indicadorAlterarDesconto' => 'N',
    'alteracaoDesconto' => [
        'tipoPrimeiroDesconto' => '',
        'novoValorPrimeiroDesconto' => '',
        'novoPercentualPrimeiroDesconto' => '',
        'novaDataLimitePrimeiroDesconto' => '',
        'tipoSegundoDesconto' => '',
        'novoValorSegundoDesconto' => '',
        'novoPercentualSegundoDesconto' => '',
        'novaDataLimiteSegundoDesconto' => '',
        'tipoTerceiroDesconto' => '',
        'novoValorTerceiroDesconto' => '',
        'novoPercentualTerceiroDesconto' => '',
        'novaDataLimiteTerceiroDesconto' => '',
    ],
    'indicadorAlterarDataDesconto' => 'N',
    'alteracaoDataDesconto' => [
        'novaDataLimitePrimeiroDesconto' => '',
        'novaDataLimiteSegundoDesconto' => '',
        'novaDataLimiteTerceiroDesconto' => '',
    ],
    'indicadorProtestar' => 'N',
    'protesto' => [
        'quantidadeDiasProtesto' => '',
    ],
    'indicadorSustacaoProtesto' => 'N',
    'indicadorCancelarProtesto' => 'N',
    'indicadorIncluirAbatimento' => 'N',
    'abatimento' => [
        'valorAbatimento' => '',
    ],
    'indicadorCancelarAbatimento' => 'N',
    'alteracaoAbatimento' => [
        'novoValorAbatimento' => '',
    ],
    'indicadorCobrarJuros' => 'N',
    'juros' => [
        'tipoJuros' => '',
        'valorJuros' => '',
        'taxaJuros' => '',
    ],
    'indicadorDispensarJuros' => 'N',
    'indicadorCobrarMulta' => 'N',
    'multa' => [
        'tipoMulta' => '',
        'valorMulta' => '',
        'dataInicioMulta' => '',
        'taxaMulta' => '',
    ],
    'indicadorDispensarMulta' => 'N',
    'indicadorNegativar' => 'N',
    'negativacao' => [
        'quantidadeDiasNegativacao' => '',
        'tipoNegativacao' => '',
    ],
    'indicadorAlterarSeuNumero' => 'N',
    'alteracaoSeuNumero' => [
        'codigoSeuNumero' => '',
    ],
    'indicadorAlterarEnderecoPagador' => 'N',
    'alteracaoEndereco' => [
        'enderecoPagador' => '',
        'bairroPagador' => '',
        'cidadePagador' => '',
        'UFPagador' => '',
        'CEPPagador' => '',
    ],
    'indicadorAlterarPrazoBoletoVencido' => 'N',
    'alteracaoPrazo' => [
        'quantidadeDiasAceite' => '',
    ]
];
$boletoAlterado = $bancoBrasil->alter($id_boleto, $data);

$lerBoleto = $bancoBrasil->read("00031285571245124141", "3128557");

$baixa = [
    "numeroConvenio" => "3128557"
];
$baixarBoleto = $bancoBrasil->baixar("00031285571245124141", $baixa);