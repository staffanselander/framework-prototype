<?php


namespace Selander\Framework\Http;


class Request implements RequestInterface
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var UrlInterface
     */
    private $url;

    /**
     * @var HeadersInterface
     */
    private $headers;

    /**
     * @var RequestVarsInterface
     */
    private $get;

    /**
     * @var RequestVarsInterface
     */
    private $post;

    /**
     * Request constructor.
     * @param string $method
     * @param UrlInterface $url
     * @param HeadersInterface $headers
     * @param RequestVarsInterface $get
     * @param RequestVarsInterface $post
     */
    public function __construct(
        string $method,
        UrlInterface $url,
        HeadersInterface $headers,
        RequestVarsInterface $get,
        RequestVarsInterface $post
    ) {
        $this->method = $method;
        $this->url = $url;
        $this->headers = $headers;
        $this->get = $get;
        $this->post = $post;
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * @return UrlInterface
     */
    public function url(): UrlInterface
    {
        return $this->url;
    }

    /**
     * @return HeadersInterface
     */
    public function headers(): HeadersInterface
    {
        return $this->headers;
    }

    /**
     * @return RequestVarsInterface
     */
    public function get(): RequestVarsInterface
    {
        return $this->get;
    }

    /**
     * @return RequestVarsInterface
     */
    public function post(): RequestVarsInterface
    {
        return $this->post;
    }

}
