<?php
namespace PontosMemoria;

use BaseMinc;
use MapasCulturais\App;

class Theme extends BaseMinc\Theme {
    public function _init() {
        $app = App::i();
        parent::_init();

        $app->hook('template(space.<<create|edit|single>>.tabs-content):end', function(){
            $this->part('tab-espacos', ['entity' => $this->data->entity]);
        });
    }

    static function getThemeFolder() {
        return __DIR__;
    }

    protected static function _getTexts() {
        return [
            'entities: Space' => 'Pontos de Memória',
        ];
    }

    public function getMetaLabel($meta)
    {
        if ( array_key_exists($meta, $this->_getSpaceMetadata()) ) {
            return $this->_getSpaceMetadata()[$meta]['label'];
        }
    }

    protected function _getSpaceMetadata()
    {
        return [
            'inventario_participativo' => [
                'label' => 'Já realizou o inventário participativo?',
                'type' => 'select',
                'options' => [
                    'sim' => 'Sim',
                    'nao' => 'Não'
                ],
                'validations' => [
                    'required' => \MapasCulturais\i::__('Favor informar sobre esta questão')
                ]
            ],
            'conselho_gestor' => [
                'label' => 'Possui Conselho Gestor?',
                'type' => 'select',
                'options' => [
                    'sim' => 'Sim',
                    'nao' => 'Não'
                ],
                'validations' => [
                    'required' => \MapasCulturais\i::__('Favor informar se este Ponto de Memória possui Conselho Gestor.')
                ]
            ]
        ];
    }

    public function renderAllMetas($entity)
    {
        foreach ($this->_getSpaceMetadata() as $key => $data) {
            $label = $this->getMetaLabel($key);
            ?>
            <p class="privado">
                <span class="label required"><?php echo $label; ?></span>
                <?php if ($this->isEditable() || $entity->getMetadata()[$key]): ?>
                    <editable-singleselect entity-property="<?php echo $key; ?>" empty-label="Selecione" 
                        allow-other="true" box-title="<?php echo $label; ?>"></editable-singleselect>
                <?php endif; ?>
            </p>
        <?php 
        }
    }
}