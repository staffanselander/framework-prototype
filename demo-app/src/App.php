<?php

namespace Selander\DemoApp;

use Selander\Framework\Container\Container;
use Selander\Framework\Core\Core;
use Selander\Framework\Core\CoreConfig;
use Selander\Framework\Support\GlobalVarsFactory;

class App
{
    public function run()
    {
        $core = new Core(
            GlobalVarsFactory::create($_SERVER, $_GET, $_POST),
            new Container(),
            new CoreConfig(require __DIR__ . '/../_env.php')
        );

        $core->modules([

            /**
             * Framework Modules
             */
            \Selander\Framework\Http\Module::class,
            \Selander\Framework\Router\Module::class,
            \Selander\Framework\Database\Module::class,
            \Selander\Framework\Template\Module::class,
            \Selander\Framework\Validator\Module::class,


            /**
             * Application modules
             */
            \Selander\DemoApp\Modules\HttpModule::class,
            \Selander\DemoApp\Modules\ViewModule::class,
            \Selander\DemoApp\Modules\DatabaseModule::class,

        ]);

        $core->run();
    }
}
