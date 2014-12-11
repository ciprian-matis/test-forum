<?php
return [
    'default' => '/list',
    'errors' => '/error',
    'routes' => [
		'/vote(/:action(/:id))' => [
        'controller' => '\Suggestotron\Controller\Votes',
		],
		'(/:action(/:id))' => [
            'controller' => '\Suggestotron\Controller\Topics',
            'action' => 'list',
        ],
        '/:controller(/:action)' => [
            'controller' => '\Suggestotron\Controller\:controller',
            'action' => 'index',
        ],
    ]
];