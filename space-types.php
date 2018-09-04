<?php

$core_space_types = include APPLICATION_PATH.'/conf/space-types.php';

$core_space_types['metadata']['En_Estado'] = array(
    'label' => \MapasCulturais\i::__('Estado'),
    'type' => 'select',
    'options' => array(
        'AC'=>'Acre',
        'AL'=>'Alagoas',
        'AP'=>'Amapá',
        'AM'=>'Amazonas',
        'BA'=>'Bahia',
        'CE'=>'Ceará',
        'DF'=>'Distrito Federal',
        'ES'=>'Espírito Santo',
        'GO'=>'Goiás',
        'MA'=>'Maranhão',
        'MT'=>'Mato Grosso',
        'MS'=>'Mato Grosso do Sul',
        'MG'=>'Minas Gerais',
        'PA'=>'Pará',
        'PB'=>'Paraíba',
        'PR'=>'Paraná',
        'PE'=>'Pernambuco',
        'PI'=>'Piauí',
        'RJ'=>'Rio de Janeiro',
        'RN'=>'Rio Grande do Norte',
        'RS'=>'Rio Grande do Sul',
        'RO'=>'Rondônia',
        'RR'=>'Roraima',
        'SC'=>'Santa Catarina',
        'SP'=>'São Paulo',
        'SE'=>'Sergipe',
        'TO'=>'Tocantins',
    ),
    'validations' => array(
        'required' => \MapasCulturais\i::__('O estado é obrigatório')
    )
);
$core_space_types["items"]["PontosMemoria"] = [
    'range' => array(130,136),
    'items' => [
        136 => array( 'name' => \MapasCulturais\i::__('Ponto de Memória')),
    ]
];

return $core_space_types;