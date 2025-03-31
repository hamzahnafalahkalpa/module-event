<?php

use Hanafalah\ModuleEvent\{
    Models as ModuleEventModels,
    Commands as ModuleEventCommands,
    Contracts
};

return [
    'app' => [
        'contracts' => [
            // ADD YOUR CONTRACTS HERE
        ],
    ],
    'commands' => [
        ModuleEventCommands\InstallMakeCommand::class
    ],
    'libs' => [
        'model' => 'Models',
        'contract' => 'Contracts',
        'schema' => 'Schemas'
    ],
    'database' => [
        'models' => [
            // ADD YOUR MODELS HERE
        ]
    ]
];
