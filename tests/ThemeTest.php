<?php
require_once ( __DIR__ ."/../Theme.php");

use PHPUnit\Framework\TestCase;
use PontosMemoria\Theme;

final class ThemeTest extends TestCase
{
	public function testGetMetaConfig() {
		$tema = new Theme;

		$val = $tema->getMetaConfig('inventario_participativo','type');
		$this->assertEquals('select',$val);

        $val = $tema->getMetaConfig('conselho_gestor','label');
        $this->assertEquals('Possui Conselho Gestor?',$val);

        // Valida contagem total das temáticas fixas dos pontos de memória
        $val = $tema->getMetaConfig('tematica_ponto_memoria','options');
        $this->assertCount(31,$val);

        // Valida ordem alfabética das temáticas fixas dos pontos de memória
        $this->assertEquals('Acervo e centro de memória',$val[0]);
        $this->assertEquals('Turismo Comunitário',$val[30]);
	}

	public function testGetSpaceMetadata()
    {
        $tema = new Theme;
        $metadados = $tema->_getSpaceMetadata();

        $this->assertArrayHasKey('inventario_participativo',$metadados);
        $this->assertArrayHasKey('conselho_gestor',$metadados);
        $this->assertArrayHasKey('tematica_ponto_memoria',$metadados);

        // Valida total de metadados próprios dos pontos de memória
        $this->assertEquals(3,count($metadados));
    }
}
