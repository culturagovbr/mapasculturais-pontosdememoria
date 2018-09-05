<?php
namespace PontosMemoria;

use BaseMinc;
use MapasCulturais\App;
use MapasCulturais\i;

class Theme extends BaseMinc\Theme {
    public function _init() {
        $app = App::i();
        parent::_init();

        $app->hook('template(space.<<create|edit|single>>.tabs):end', function(){
            $this->part('tab-pontos-memoria', ['entity' => $this->data->entity]);
        });

        $app->hook('template(space.<<create|edit|single>>.tabs-content):end', function(){
            $this->part('tab-espacos', ['entity' => $this->data->entity]);
        });

        $app->hook("template(space.create.type):after", function() {
            $this->part('type', ['label' => $this->dict('entities: Space',false)]);
        });
    }

    static function getThemeFolder() {
        return __DIR__;
    }

    protected static function _getTexts() {
        return [
            'entities: Space' => 'Ponto de Memória',
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
                'type' => 'multiselect',
                'options' => [
                    'Acervo e centro de memória',
                    'Arquivo/Arquivo Digital',
                    'Arte de rua',
                    'Artes visuais',
                    'Artesanato',
                    'Audiovisual',
                    'Cinema',
                    'Circo',
                    'Conhecimento e tradições orais',
                    'Cultura Cigana',
                    'Cultura Digital',
                    'Cultura Estrangeira',
                    'Cultura LGBT',
                    'Culturas Afro-brasileiras',
                    'Culturas Indígenas',
                    'Culturas Populares',
                    'Dança',
                    'Economia Criativa',
                    'Educação patrimonial',
                    'Fotografia',
                    'Literatura',
                    'Mídias Comunitárias',
                    'Música',
                    'Patrimônio Imaterial',
                    'Pesquisa em Memória Social',
                    'Povos e comunidades tradicionais',
                    'Produção Cultural',
                    'Rádio Comunitária',
                    'Teatro',
                    'Televisão Comunitária',
                    'Turismo Comunitário',
                ],
                'validations' => [
                    'required' => \MapasCulturais\i::__('É obrigatório informar a temática do ponto de memória')
                ]
            ]
        ];
    }

    public function renderAllMetas($entity)
    {
        foreach ($this->_getSpaceMetadata() as $key => $data) {
            $tipo = $this->getMetaConfig($key,'type');
            if ("select" === $tipo) {
               $selectType = "singleselect";
            } else if ("multiselect" === $tipo) {
                $selectType = "multiselect";
            }
            $label = $this->getMetaConfig($key, 'label');
            $desc = $this->getMetaConfig($key, 'description');
            ?>
            <p class="privado">
                <span class="label required"> <?php echo $label; ?></span>
                <?php if ($this->isEditable() || isset($entity->getMetadata()[$key])): ?>
                    <editable-<?php echo $selectType ?> entity-property="<?php echo $key; ?>" empty-label="Selecione" allow-other="true" box-title="<?php echo $label; ?>"></editable-<?php echo $selectType ?>>
                <?php endif; ?>
            </p>
            <p class="descricao-meta-ponto-memoria"> <?php echo $desc; ?> </p>
            <?php
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
                    'value' => 'ILIKE(*{val}*)'
                ],
                'validations' => [
                    'required' => 'Preencher a temática'
                ]
            ],
            [
                'fieldType' => 'checklist',
                'label' => 'Estado',
                'placeholder' => 'Selecione os Estados',
                'filter' => [
                    'param' => 'En_Estado',
                    'value' => 'IN({val})'
                ],
            ],
            [
                'fieldType' => 'text',
                'label' => 'Município',
                'isArray' => false,
                'placeholder' => 'Pesquisar por Município',
                'isInline' => false,
                'filter' => [
                    'param' => 'En_Municipio',
                    'value' => 'ILIKE(*{val}*)'
                ]
            ],
            'verificados' => [
                'label' => $this->dict('search: verified results', false),
                'tag' => $this->dict('search: verified', false),
                'placeholder' => 'Exibir somente ' . $this->dict('search: verified results', false),
                'fieldType' => 'checkbox-verified',
                'addClass' => 'verified-filter',
                'isArray' => false,
                'filter' => [
                    'param' => '@verified',
                    'value' => '1'
                ]
            ]
        ];

        App::i()->applyHookBoundTo($this, 'search.filters', [&$filters]);

        return $filters;
    }
    
    function register() {
        parent::register();
        $app = App::i();
        $app->hook('app.register', function(&$registry) {
            $group = null;
            $registry['entity_type_groups']['MapasCulturais\Entities\Space'] = array_filter($registry['entity_type_groups']['MapasCulturais\Entities\Space'], function($item) use (&$group) {
                if ($item->name === 'PontosMemoria') {
                    $group = $item;
                    return $item;
                } else {
                    return null;
                }
            });

            $registry['entity_types']['MapasCulturais\Entities\Space'] = array_filter($registry['entity_types']['MapasCulturais\Entities\Space'], function($item) use ($group) {
                if ($item->id ==136) {
                    return $item;
                } else {
                    return null;
                }
            });

        });
    }

    public function getSiteBackGround()
    {
        if ($this->subsiteInstance->getBackground()) {
            $bg = $this->subsiteInstance->getBackground()->url;
            echo "<section id='home-watermark' style='background: url($bg);background-position: 80% bottom;background-repeat: no-repeat;'></section>";
        }
    }
}