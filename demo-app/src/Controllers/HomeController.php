<?php

namespace Selander\DemoApp\Controllers;

use Selander\Framework\Template\TemplateManagerInterface;

class HomeController
{
    /**
     * @var TemplateManagerInterface
     */
    private $templateManager;

    /**
     * HomeController constructor.
     * @param TemplateManagerInterface $templateManager
     */
    public function __construct(TemplateManagerInterface $templateManager)
    {
        $this->templateManager = $templateManager;
    }

    /**
     * @Route\Path("/")
     * @Route\Method("GET")
     */
    public function index()
    {
        echo $this->templateManager->compile('template.php', [
            'body' => $this->templateManager->compile('index.php')
        ]);
    }
}
