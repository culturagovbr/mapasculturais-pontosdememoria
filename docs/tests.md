### Primeiros testes do tema Pontos de Memória


Para utilizar a versão do PHPUnit `(v4.8.36)` já inicializada com o ambiente do mapas, 
execute com o seguinte comando, a partir do path `$raiz/src/protected`:

`vendor/phpunit/phpunit/phpunit ../protected/application/themes/mapasculturais-pontosdememoria/tests`

**OBS**: Até resolver de maneira definitiva essa questão, deve-se comentar o `extends` de \PontosMemoria\Theme apenas no momento de rodar os testes, para evitar ser necessaáio incluir uma série de arquivos desnecessários, pois não serão usados/testados.

#### Usando o script

Opcionalmente, e mais facilmente, rode o arquivo ``run-tests.sh``, localizado na raiz do projeto. 
