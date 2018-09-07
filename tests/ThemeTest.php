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
	}

	public function testGetSpaceMetadata()
    {
        $tema = new Theme;
        $metadados = $tema->_getSpaceMetadata();

        $this->assertArrayHasKey('inventario_participativo',$metadados);
        $this->assertArrayHasKey('conselho_gestor',$metadados);
        $this->assertArrayHasKey('tematica_ponto_memoria',$metadados);

        $this->assertEquals(3,count($metadados));
    }
}
