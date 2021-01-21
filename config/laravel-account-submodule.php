<?php

return [

    /**
     * Default password for your application.
     */
    'default-password' => env('DEFAULT_PASSWORD', 'password'),


    /**
     * Default pagination for the application.
     */
    'pagination' => env('API_PAGINATION', 50),

    /*
    |--------------------------------------------------------------------------
    | Package Seeds
    |--------------------------------------------------------------------------
    |
    */

    /*
    * Permissions
    */
    'permissions' => [
        ['name' => 'admin', 'label' => 'Accéder au module Admin'],
        ['name' => 'list users', 'label' => 'Afficher la liste des utilisateurs'],
        ['name' => 'create user', 'label' => 'Créer un utilisateur'],
        ['name' => 'read user', 'label' => 'Voir le détail d’un utilisateur'],
        ['name' => 'update user', 'label' => 'Mettre à jour un utilisateur'],
        ['name' => 'delete user', 'label' => 'Supprimer un utilisateur'],
        ['name' => 'list accounts', 'label' => 'Afficher la liste des compte'],
        ['name' => 'create account', 'label' => 'Créer un compte'],
        ['name' => 'read account', 'label' => 'Voir le détail d’un compte'],
        ['name' => 'update account', 'label' => 'Mettre à jour un compte'],
        ['name' => 'delete account', 'label' => 'Supprimer un compte'],
    ],

    /*
    * Roles
    */
    'roles' => [
        ['name' => 'superadmin', 'label' => 'super administrateur'],
        ['name' => 'admin', 'label' => 'administrateur'],
        ['name' => 'user', 'label' => 'utilisateur'],
        ['name' => 'bot', 'label' => 'machine'],
    ],

    /*
    * Roles’ permissions
    */
    'roles_permissions' => [
        'user' => [
            'create account'
        ],
        'admin' => [
            'admin',
            'list users',
            'read user',
            'update user',
            'delete user',
            'read account',
            'update account',
            'delete account',
        ]
    ],

    /*
     * Accounts
     */
    'accounts' => [
        [
            'email' => 'hello@akkurate.com',
            'name' => 'Akkurate',
            'website' => 'https://www.akkurate.io/#welcome',
        ],
        [
            'parent_id' => 1,
            'name' => 'First Demo',
            'email' => 'hello@demo1.com',
        ],
        [
            'name' => 'Second Demo',
            'email' => 'hello@demo2.com',
        ],
    ],

    /*
    * Users
    */
    'users' => [
        [
            'role' => 'superadmin',
            'account_id' => 1,
            'firstname' => 'Username',
            'lastname' => 'Superadmin',
            'email' => [
                'type' => 'WORK',
                'address' => 'superadmin@test.com'
            ],
            'gender' => 'M'
        ],
        [
            'role' => 'admin',
            'account_id' => 1,
            'firstname' => 'Username',
            'lastname' => 'Admin',
            'email' => [
                'type' => 'WORK',
                'address' => 'admin@test.com'
            ],
            'gender' => 'M',
        ],
        [
            'role' => 'user',
            'account_id' => 1,
            'firstname' => 'Username',
            'lastname' => 'User',
            'email' => [
                'type' => 'WORK',
                'address' => 'user@test.com'
            ],
            'gender' => 'M'
        ],
    ]
];
