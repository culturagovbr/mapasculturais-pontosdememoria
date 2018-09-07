<?php
require_once ( __DIR__ ."/../Theme.php");

use PHPUnit\Framework\TestCase;
use PontosMemoria\Theme;

final class ThemeTest extends TestCase
{
	public function testGetMetaConfig() {
		$m = new PontosMemoria\Theme;

		$val = $m->getMetaConfig('inventario_participativo','type');
		$this->assertEquals('select',$val);

        $val = $m->getMetaConfig('conselho_gestor','label');
        $this->assertEquals('Possui Conselho Gestor?',$val);
	}
}
