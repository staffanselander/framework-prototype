<?php


namespace Selander\Framework\Http;


class RequestVars implements RequestVarsInterface
{
    /**
     * @var array
     */
    private $vars;

    /**
     * RequestVars constructor.
     * @param array $vars
     */
    public function __construct(array $vars)
    {
        $this->vars = $vars;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->vars;
    }

    /**
     * @param string $key
     * @return string
     */
    public function get(string $key)
    {
        return $this->vars[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->vars);
    }

}
