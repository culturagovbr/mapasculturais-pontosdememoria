<?php
namespace PontosMemoria;

use BaseMinc;
use MapasCulturais\App;

class Theme extends BaseMinc\Theme {
    public function _init() {
        $app = App::i();
        parent::_init();
    }

    static function getThemeFolder() {
        return __DIR__;
    }

    protected static function _getTexts() {
        return [
            'entities: Space' => 'Pontos de Memória',
        ];
    }
}