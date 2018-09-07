#### Primeiros testes do tema Pontos de Memoria

Para utilizar a versao do PHPUnit `(v4.8.36)` ja inicializada com o ambiente do mapas, 
execute com o seguinte comando, a partir do path `$raiz/src/protected`:

`vendor/phpunit/phpunit/phpunit ../protected/application/themes/mapasculturais-pontosdememoria/tests`

**OBS**: ate resolver de maneira definitiva a questao, deve-se comentar o extends de \PontosMemoria\Theme apenas no momento
de rodar os testes, para evitar ser necessario incluir uma serie de arquivos desnecessarios, pois nao serao usados/testados.