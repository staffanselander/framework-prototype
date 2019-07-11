<?php


namespace Selander\Framework\Core\Modules;


use Selander\Framework\Container\ContainerInterface;
use Selander\Framework\Core\CoreModuleInterface;
use Selander\Framework\Http\HeadersFactory;
use Selander\Framework\Http\RequestFactory;
use Selander\Framework\Http\RequestInterface;
use Selander\Framework\Http\RequestVarsFactory;
use Selander\Framework\Http\UrlFactory;
use Selander\Framework\Support\GlobalVars;

class HttpRequestModule implements CoreModuleInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var GlobalVars
     */
    private $globalVars;

    /**
     * HttpRequestModule constructor.
     * @param ContainerInterface $container
     * @param GlobalVars $globalVars
     */
    public function __construct(
        ContainerInterface $container,
        GlobalVars $globalVars
    ) {
        $this->container = $container;
        $this->globalVars = $globalVars;
    }

    public function warmUp()
    {
        $this->container->singleton(RequestInterface::class, function() {
            $requestFactory = new RequestFactory(
                new UrlFactory(),
                new HeadersFactory(),
                new RequestVarsFactory()
            );

            return $requestFactory->createFromGlobalVars($this->globalVars);
        });
    }

    public function execute()
    {
    }
}
