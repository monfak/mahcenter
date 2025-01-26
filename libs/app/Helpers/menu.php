<?php
if (!(function_exists('user_has'))) {
    /**
     * Determine if the current user has any of the specific permissions.
     *
     * @param $permissions array permission needed to be check
     * @param $userPermissions array permissions of a specific user
     * @return bool
     */
    function user_has($permissions, $userPermissions)
    {
        return !empty(array_intersect($permissions, $userPermissions));
    }
}

if (!(function_exists('menu_build'))) {
    /**
     * @param  array  $menus
     * @return array menu with items
     */
    function menu_build(array $menus) {
        return \App\Utilities\MenuFactory::build($menus);
    }
}

if (!(function_exists('user_permissions'))) {
    /**
     * @return array permissions of user
     */
    function user_permissions() {
        return \App\Utilities\MenuFactory::userPermissions();
    }
}

if(!function_exists('user_roles')) {
    /**
     * @return string
     */
    function user_roles() {
        $userRolesArray = auth()->user()->roles->pluck('display_name');
        $userRoles = '';
        foreach ($userRolesArray as $index => $role) {
            $userRoles .= $role;
            ($index < count($userRolesArray) - 1) ? $userRoles .= ', ' : '';
        }
        return $userRoles;
    }
}

if(!function_exists('admin_menu')) {
    /**
     * @return array[]
     */
    function admin_menu(): array {
        return [
            [
                'name'          => 'dashboard',
                'label'         => __('Dashboard'),
                'permissions'   => ['access-admin'],
                'icon'          => 'pie-chart',
                'route_name'    => 'admin.app.index',
                'children'      => [
                    [
                        'route_name'    => 'admin.app.index',
                        'label'         => __('Dashboard'),
                        'permissions'   => ['access-admin'],
                    ],
                ],
            ],
            [
                'name'          => 'name',
                'label'         => __('Blog'),
                'permissions'   => ['comments-manage', 'articles-create',  'articles-manage'],
                'icon'          => 'pencil',
                'route_name'    => 'admin.blog.index',
                'children'      => [
                    [
                        'route_name'    => 'admin.blog.index',
                        'label'         => __('All articles'),
                        'permissions'   => ['articles-manage'],
                    ],
                    [
                        'route_name'    => 'admin.blog.index',
                        'route_params'  => ['my'],
                        'label'         => __('My articles'),
                        'permissions'   => ['articles-create'],
                    ],
                    [
                        'route_name'    => 'admin.blog.index',
                        'route_params'  => ['draft'],
                        'label'         => __('Drafts'),
                        'permissions'   => ['articles-create'],
                    ],
                    [
                        'route_name'    => 'admin.blog.index',
                        'route_params'  => ['pending'],
                        'label'         => __('Pending'),
                        'permissions'   => ['articles-manage'],
                    ],

                    [
                        'route_name'    => 'admin.blog.index',
                        'route_params'  => ['seo'],
                        'label'         => __('Seo'),
                        'permissions'   => ['articles-manage'],
                    ],
                    [
                        'route_name'    => 'admin.blog.index',
                        'route_params'  => ['review'],
                        'label'         => __('Review'),
                        'permissions'   => ['articles-manage'],
                    ],
                    [
                        'route_name'    => 'admin.blog.index',
                        'route_params'  => ['scheduled'],
                        'label'         => __('Scheduled'),
                        'permissions'   => ['articles-manage'],
                    ],
                    [
                        'route_name'    => 'admin.blog.index',
                        'route_params'  => ['published'],
                        'label'         => __('Published'),
                        'permissions'   => ['articles-manage'],
                    ],
                    [
                        'route_name'    => 'admin.blog.index',
                        'route_params'  => ['trash'],
                        'label'         => __('Trash'),
                        'permissions'   => ['articles-manage'],
                    ],
                    [
                        'route_name'    => 'admin.blog.edit',
                        'label'         => __('Edit'),
                        'permissions'   => ['articles-manage'],
                    ],
                ]
            ],
            [
                'name'          => 'series',
                'label'         => __('Series'),
                'permissions'   => [
                    'series-create', 'series-edit', 'series-delete',
                    'categories-create', 'categories-edit', 'categories-delete'
                ],
                'icon'          => 'blackboard',
                'route_name'    => 'admin.series.index',
                'children'      => [
                    [
                        'route_name'    => 'admin.series.index',
                        'label'         => __('Series'),
                        'permissions'   => ['series-create', 'series-edit', 'series-delete'],
                    ],
                    [
                        'route_name'    => 'admin.skills.index',
                        'label'         => __('Skills'),
                        'permissions'   => ['categories-create', 'categories-edit', 'categories-delete'],
                    ],
                    [
                        'route_name'    => 'admin.students.index',
                        'label'         => __('Students'),
                        'permissions'   => ['access-admin'],
                    ],
                ]
            ],
            [
                'name'          => 'content',
                'label'         => __('Content'),
                'permissions'   => [
                    'terminologies-create', 'terminologies-edit', 'terminologies-delete',
                    'documents-create', 'documents-edit', 'documents-delete',
                    'pages-create', 'pages-edit', 'pages-delete',
                ],
                'icon'          => 'book',
                'route_name'    => 'admin.terminologies.index',
                'children'      => [
                    [
                        'name'          => 'terminologies',
                        'label'         => __('Terminologies'),
                        'permissions'   => ['terminologies-create', 'terminologies-edit', 'terminologies-delete'],
                        'route_name'    => 'admin.terminologies.index',
                    ],
                    [
                        'name'          => 'documents',
                        'label'         => __('Documents'),
                        'permissions'   => ['documents-create', 'documents-edit', 'documents-delete'],
                        'route_name'    => 'admin.docs.index',
                    ],
                    [
                        'name'          => 'pages',
                        'label'         => __('Pages'),
                        'permissions'   => ['pages-create', 'pages-edit', 'pages-delete'],
                        'route_name'    => 'admin.pages.index',
                    ],
                    [
                        'name'          => 'tags',
                        'label'         => __('Tags'),
                        'permissions'   => ['tags-create', 'tags-edit', 'tags-delete'],
                        'route_name'    => 'admin.tags.index',
                    ],
                    [
                        'route_name'    => 'admin.terminologies.edit',
                        'label'         => __('Edit'),
                        'permissions'   => ['terminologies-create', 'terminologies-edit', 'terminologies-delete'],
                    ],
                    [
                        'route_name'    => 'admin.pages.edit',
                        'label'         => __('Edit'),
                        'permissions'   => ['pages-create', 'pages-edit', 'pages-delete'],
                    ],
                    [
                        'route_name'    => 'admin.pages.create',
                        'label'         => __('Create'),
                        'permissions'   => ['pages-create', 'pages-edit', 'pages-delete'],
                    ],
                ],
            ],
            [
                'name'          => 'users',
                'label'         => __('Users'),
                'permissions'   => ['users-create', 'users-edit', 'users-delete',],
                'icon'          => 'user',
                'route_name'    => 'admin.users.index',
                'children'      => [
                    [
                        'label'         => __('Users'),
                        'permissions'   => ['users-create', 'users-edit', 'users-delete',],
                        'route_name'    => 'admin.users.index',
                    ],
                    [
                        'label'         => __('Roles'),
                        'permissions'   => ['roles-create', 'roles-edit', 'roles-delete',],
                        'route_name'    => 'admin.roles.index',
                    ],
                    [
                        'label'         => __('Create user'),
                        'permissions'   => ['users-create', 'users-edit', 'users-delete',],
                        'route_name'    => 'admin.users.create',
                    ],
                    [
                        'label'         => __('Edit user'),
                        'permissions'   => ['users-create', 'users-edit', 'users-delete',],
                        'route_name'    => 'admin.users.edit',
                    ],
                    [
                        'label'         => __('Create user'),
                        'permissions'   => ['roles-create', 'roles-edit', 'roles-delete',],
                        'route_name'    => 'admin.roles.create',
                    ],
                    [
                        'label'         => __('Edit user'),
                        'permissions'   => ['roles-create', 'roles-edit', 'roles-delete',],
                        'route_name'    => 'admin.roles.edit',
                    ],
                    [
                        'label'         => __('Assign permission'),
                        'permissions'   => ['roles-create', 'roles-edit', 'roles-delete',],
                        'route_name'    => 'admin.permissions.edit',
                    ],
                ]
            ],
            [
                'name'          => 'interview',
                'label'         => __('Interview'),
                'permissions'   => [
                    'interviews-categories-create', 'interviews-categories-edit', 'interviews-categories-delete',
                    'interviews-questions-create', 'interviews-questions-edit', 'interviews-questions-delete',
                    'participants-create', 'participants-edit', 'participants-delete',
                ],
                'icon'          => 'marker-alt',
                'route_name' => 'admin.interviews.categories.index',
                'children'      => [
                    [
                        'label'         => __('Categories'),
                        'permissions'   => ['interviews-categories-create', 'interviews-categories-edit', 'interviews-categories-delete',],
                        'route_name'    => 'admin.interviews.categories.index',
                    ],
                    [
                        'label'         => __('Questions'),
                        'permissions'   => ['interviews-questions-create', 'interviews-questions-edit', 'interviews-questions-delete',],
                        'route_name'    => 'admin.interviews.questions.index',
                    ],
                    [
                        'label'         => __('Participants'),
                        'permissions'   => ['participants-manage',],
                        'route_name'    => 'admin.interviews.participants.index',
                    ],
                ]
            ],
            [
                'name'          => 'finance',
                'label'         => __('Finances'),
                'permissions'   => ['users-create', 'users-edit', 'users-delete',],
                'icon'          => 'money',
                'route_name' => 'admin.users.index',
            ],
        ];
    }
}

if(!function_exists('panel_menu')) {
    /**
     * @return array[]
     */
    function panel_menu(): array {
        return [
            [
                'name'          => 'dashboard',
                'label'         => __('Dashboard'),
                'permissions'   => ['access-panel'],
                'icon'          => 'pie-chart',
                'route_name'    => 'admin.app.index',
            ],
        ];
    }
}

if(!function_exists('admin_menu_build')) {
    /**
     * Build admin menu.
     *
     * @return array
     */
    function admin_menu_build() {
        return menu_build(admin_menu());
    }
}

if(!function_exists('panel_menu_build')) {
    /**
     * Build panel menu.
     *
     * @return array
     */
    function panel_menu_build() {
        return menu_build(panel_menu());
    }
}
