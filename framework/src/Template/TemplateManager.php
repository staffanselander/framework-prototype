<?php


namespace Selander\Framework\Template;


use Selander\Framework\Template\Exceptions\TemplateNotFoundException;

class TemplateManager implements TemplateManagerInterface
{
    /**
     * @var TemplateManagerConfigInterface
     */
    private $config;

    /**
     * TemplateManager constructor.
     * @param TemplateManagerConfigInterface $config
     */
    public function __construct(TemplateManagerConfigInterface $config)
    {
        $this->config = $config;
    }

    /**
     * @param $pat
     * @param array $data
     * @return string
     * @throws TemplateNotFoundException
     */
    public function compile($pat, array $data = []): string
    {
        $path = $this->config->get(TemplateManagerConfigInterface::ROOT) . '/' . $pat;

        if (!file_exists($path)) {
            throw new TemplateNotFoundException(sprintf('Template %s not found', $path));
        }

        extract($data);
        ob_start();
        include $path;
        return ob_get_clean();
    }
}
