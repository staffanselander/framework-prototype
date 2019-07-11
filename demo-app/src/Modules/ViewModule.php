<?php


namespace Selander\DemoApp\Modules;


use Selander\Framework\Core\CoreModuleInterface;
use Selander\Framework\Template\TemplateManagerConfigInterface;

class ViewModule implements CoreModuleInterface
{
    /**
     * @var TemplateManagerConfigInterface
     */
    private $templateManagerConfig;

    public function __construct(TemplateManagerConfigInterface $templateManagerConfig)
    {
        $this->templateManagerConfig = $templateManagerConfig;
    }

    public function warmUp()
    {
        $this->templateManagerConfig->set(TemplateManagerConfigInterface::ROOT, __DIR__ . '/../Views');
    }

    public function execute()
    {
    }

}
