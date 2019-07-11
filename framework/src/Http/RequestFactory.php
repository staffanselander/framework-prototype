<?php


namespace Selander\Framework\Http;


use Selander\Framework\Support\GlobalVars;

class RequestFactory
{
    /**
     * @var UrlFactory
     */
    private $urlFactory;

    /**
     * @var HeadersFactory
     */
    private $headersFactory;

    /**
     * @var RequestVarsFactory
     */
    private $requestVarsFactory;

    /**
     * RequestFactory constructor.
     * @param UrlFactory $urlFactory
     * @param HeadersFactory $headersFactory
     * @param RequestVarsFactory $requestVarsFactory
     */
    public function __construct(
        UrlFactory $urlFactory,
        HeadersFactory $headersFactory,
        RequestVarsFactory $requestVarsFactory
    ) {
        $this->urlFactory = $urlFactory;
        $this->headersFactory = $headersFactory;
        $this->requestVarsFactory = $requestVarsFactory;
    }

    /**
     * @param GlobalVars $globalVars
     * @return RequestInterface
     */
    public function createFromGlobalVars(GlobalVars $globalVars): RequestInterface
    {
        return new Request(
            $globalVars->server['REQUEST_METHOD'],
            $this->urlFactory->createFromGlobalVars($globalVars),
            $this->headersFactory->createFromGlobalVars($globalVars),
            $this->requestVarsFactory->createGet($globalVars),
            $this->requestVarsFactory->createPost($globalVars)
        );
    }
}
