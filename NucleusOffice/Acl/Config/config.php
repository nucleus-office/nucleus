<?php

return [
    'name' => 'Acl',

    'default_actions' => ['create', 'read', 'update', 'destroy'],

    'permissions' => [
        'role',
        'user',
    ]
];
