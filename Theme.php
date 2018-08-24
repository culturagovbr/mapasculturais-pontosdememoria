<?php
namespace PontosMemoria;

use BaseMinc;
use MapasCulturais\App;

class Theme extends BaseMinc\Theme {
    public function _init() {
        $app = App::i();
        parent::_init();

        $app->hook('template(space.<<*>>.location-info):after', function(){
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

    public function getMetaConfig($meta,$cfg)
    {
        if ( array_key_exists($meta, $this->_getSpaceMetadata()) ) {
            return $this->_getSpaceMetadata()[$meta][$cfg];
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
                'description' => 'Inventário Participativo: processo de inventariação do patrimônio material e 
                                  imaterial em que os próprios grupos e comunidades locais atuam como protagonistas na
                                  identificação, seleção e registro das referências culturais mais significativas para 
                                  suas memórias e histórias sociais.',
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
                'description' => 'Conselho Gestor: instância deliberativa constituída por um grupo representativo da comunidade, 
                                  responsável pelo acompanhamento das ações de museologia social desenvolvidas e pela interlocução 
                                  com o estado e com os demais grupos e movimentos sociais, meios de comunicação locais e parceiros externos. 
                                  Para sua formalização são realizados relatórios e atas com registro e informações sobre os membros e reuniões.',
                'validations' => [
                    'required' => \MapasCulturais\i::__('Favor informar se este Ponto de Memória possui Conselho Gestor.')
                ]
            ]
        ];
    }

    public function renderAllMetas($entity)
    {
        foreach ($this->_getSpaceMetadata() as $key => $data) {
            $label = $this->getMetaConfig($key, 'label');
            $desc = $this->getMetaConfig($key, 'description');
            ?>
            <p class="privado">
                <span class="label required"> <?php echo $label; ?></span>
                <?php if ($this->isEditable() || $entity->getMetadata()[$key]): ?>
                    <editable-singleselect entity-property="<?php echo $key; ?>" empty-label="Selecione" 
                        allow-other="true" box-title="<?php echo $label; ?>"></editable-singleselect>
                <?php endif; ?>
            </p>
            <p style="padding-left: 10px; font-style: italic;margin-bottom: 10px;">
                <?php echo $desc; ?>
            </p>
        <?php 
        }
    }
}