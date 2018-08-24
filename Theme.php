<?php
namespace PontosMemoria;

use BaseMinc;
use MapasCulturais\App;
use MapasCulturais\i;

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
        if (array_key_exists($meta, $this->_getSpaceMetadata())) {
            $value = "";
            if (isset($this->_getSpaceMetadata()[$meta][$cfg])) {
                $value = $this->_getSpaceMetadata()[$meta][$cfg];
            }

            return $value;
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
            ],

            'tematica_ponto_memoria' => [
                'label' => 'Temática dos Pontos de Memória',
                'type' => 'select',
                'options' => [
                    'Acervo e centro de memória',
                    'Conhecimento e tradições orais',
                    'Povos e comunidades tradicionais',
                    'Culturas Afro-brasileiras',
                    'Culturas Indígenas',
                    'Culturas Populares',
                    'Cultura Cigana',
                    'Cultura LGBT',
                    'Cultura Digital',
                    'Cultura Estrangeira',
                    'Patrimônio Imaterial',
                    'Educação patrimonial',
                    'Turismo Comunitário',
                    'Pesquisa em Memória Social',
                    'Mídias Comunitárias',
                    'Arquivo/Arquivo Digital',
                    'Produção Cultural',
                    'Audiovisual',
                    'Artes visuais',
                    'Arte de rua',
                    'Rádio Comunitária',
                    'Televisão Comunitária',
                    'Economia Criativa',
                    'Artesanato',
                    'Circo',
                    'Dança',
                    'Música',
                    'Cinema',
                    'Fotografia',
                    'Teatro',
                    'Literatura',
                ],
                'validations' => [
                    'required' => \MapasCulturais\i::__('É obrigatório informar a temática do ponto de memória')
                ]
            ],

        ];
    }

    public function renderAllMetas($entity)
    {
        foreach ($this->_getSpaceMetadata() as $key => $data) {
            $tipo = $this->getMetaConfig($key,'type');
            if ("select" === $tipo) {
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
                <p class="descricao-meta-ponto-memoria"> <?php echo $desc; ?> </p>
                <?php
            }
        }
    }

    protected function _getFilters()
    {
        $filters = parent::_getFilters();
        $filters['space'] = [
            [
                'label' => 'Temática dos Pontos de Memoria',
                'placeholder' => 'Selecione as Temáticas',
                'filter' => [
                    'param' => 'tematica_ponto_memoria',
                    'value' => 'IN({val})'
                ],
                'validations' => [
                    'required' => 'Preencher a temática'
                ]
            ]
        ];

        App::i()->applyHookBoundTo($this, 'search.filters', [&$filters]);

        return $filters;
    }
}