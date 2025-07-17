<?php

use Hanafalah\ModuleEvent\{
    Models as ModuleEventModels,
    Commands as ModuleEventCommands,
    Contracts
};

return [
    'namespace' => 'Hanafalah\ModuleEvent',
    'app' => [
        'contracts' => [
            // ADD YOUR CONTRACTS HERE
        ],
    ],
    'commands' => [
        ModuleEventCommands\InstallMakeCommand::class
    ],
    'libs'       => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas',
        'database' => 'Database',
        'data' => 'Data',
        'resource' => 'Resources',
        'migration' => '../assets/database/migrations'
    ],
    'database' => [
        'models' => [
            // ADD YOUR MODELS HERE
        ]
    ],
    'occupation' => null,
    'reference' => null
];
