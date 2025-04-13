<?php

return [
    // Spatie Package Configuration (keep existing)
    'models' => [
        'permission' => Spatie\Permission\Models\Permission::class,
        'role' => Spatie\Permission\Models\Role::class,
    ],

    'table_names' => [
        'roles' => 'roles',
        'permissions' => 'permissions',
        'model_has_permissions' => 'model_has_permissions',
        'model_has_roles' => 'model_has_roles',
        'role_has_permissions' => 'role_has_permissions',
    ],

    'column_names' => [
        'role_pivot_key' => null,
        'permission_pivot_key' => null,
        'model_morph_key' => 'model_id',
        'team_foreign_key' => 'team_id',
    ],

    // Our Custom Permission Configuration
    'allowed_permissions' => [
        // Application Management
        'manage_listings',
        'manage_internships',
        'manage_pupillages',
        'manage_post_pupillages',
        
        // User Management
        'manage_users',
        'assign_roles',
        'edit_permissions',
        
        // Content Moderation
        'moderate_content',
        'approve_submissions',
        'manage_reports',
        
        // System Administration
        'view_audit_logs',
        'manage_system_settings',
        'backup_database'
    ],

    'permission_groups' => [
        'application' => [
            'manage_listings',
            'manage_internships',
            'manage_pupillages',
            'manage_post_pupillages'
        ],
        'user_management' => [
            'manage_users',
            'assign_roles',
            'edit_permissions'
        ],
        'content' => [
            'moderate_content',
            'approve_submissions',
            'manage_reports'
        ],
        'system' => [
            'view_audit_logs',
            'manage_system_settings',
            'backup_database'
        ]
    ],

    // Spatie Package Features (keep existing)
    'register_permission_check_method' => true,
    'register_octane_reset_listener' => false,
    'teams' => false,
    'use_passport_client_credentials' => false,
    'display_permission_in_exception' => false,
    'display_role_in_exception' => false,
    'enable_wildcard_permission' => false,

    'cache' => [
        'expiration_time' => \DateInterval::createFromDateString('24 hours'),
        'key' => 'spatie.permission.cache',
        'store' => 'default',
    ],
];