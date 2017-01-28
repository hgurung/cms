<?php
return [
    //List of modules are defined here
    'modules'     => [
        'home'    => "Admin Dashboard",
        'config'  => 'Admin Config',
        'user'    => "User Management",
        'log'     => 'Log Management',
        'templates'     => 'Page Templates'
    ],
    //Module sub modules contains here
    'modulepages' =>  [
        'home'    =>  ['home' => 'Admin Dashboard'],
        'config'  =>  ['settings' => 'Settings','language'=>'Language'],
        'user'    =>  ['permission' => 'Permissions','roles'=>'Roles','users'=>'Users'],
        'log'     =>  ['log' => 'Log Management'],
        'templates'     =>  ['list' => 'List View','form'=>'Form View']
    ],
    //Permissions for each module is defined here
    'modulepermissions' => [
        'config'   => [
                        //Settings Sub Module
                        'config.settings.view'     =>  'View Settings',
                        'config.settings.create'   =>  'Create Settings',
                        'config.settings.edit'     =>  'Edit Settings',
                        'config.settings.delete'   =>  'Delete Settings',
                        //Language Sub Module
                        'config.language.view'     =>  'View Language',
                        'config.language.create'   =>  'Create Language',
                        'config.language.edit'     =>  'Edit Language',
                        'config.language.delete'   =>  'Delete Language'
                      ],
        'user'   => [
                        //Permission Sub Module
                        'user.permission.view'   =>  'View Permission',
                        'user.permission.create' =>  'Create Permission',
                        'user.permission.edit'   =>  'Edit Permission',
                        'user.permission.delete' =>  'Delete Permission',
                        //Roles Sub Module
                        'user.roles.view'        =>  'View Roles',
                        'user.roles.create'      =>  'Create Roles',
                        'user.roles.edit'        =>  'Edit Roles',
                        'user.roles.delete'      =>  'Delete Roles',
                        //Users Sub Module
                        'user.users.view'        =>  'View Users',
                        'user.users.create'      =>  'Create Users',
                        'user.users.edit'        =>  'Edit Users',
                        'user.users.delete'      =>  'Delete Users'
                      ],
        'log'      => [
                        'log.log.view'          =>  'Log View',
                        'log.log.delete'        =>  'Log Delete'
                      ],
        'templates'   => [
                          'templates.list.view'          =>  'List View',
                          'templates.form.view'          =>  'Form View',
                        ]
    ],
    //Permissions for each module is defined here
    //Icons for eash modules is defined here
    'moduleicons' =>  [
        'home'    => 'icon-home',
        'user'    => 'icon-users',
        'config'  => 'icon-gear',
        'log'     => 'icon-file-o',
        'templates'     => 'icon-file-o'
    ],
    //Icons for eash modules is defined here
    'cmsTitle'    => 'Ekcms', //Cms Title
    'logotitle'   => 'Ekbana' // Logo title
];


?>
