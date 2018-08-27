<?php

$core_space_types = include APPLICATION_PATH.'/conf/space-types.php';

$core_space_types["items"]["PontosMemoria"] = [
    'range' => array(130,136),
    'items' => [
        136 => array( 'name' => \MapasCulturais\i::__('Ponto de Memória')),
    ]
];

return $core_space_types;