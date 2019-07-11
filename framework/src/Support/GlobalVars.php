<?php


namespace Selander\Framework\Support;


class GlobalVars
{
    /**
     * @var array
     */
    public $server;

    /**
     * @var array
     */
    public $get;

    /**
     * @var array
     */
    public $post;

    /**
     * @var array
     */
    public $streams = [
        'stdin' => 'php://stdin',
        'stdout' => 'php://stdout',
        'stderr' => 'php://stderr',
        'input' => 'php://input',
    ];

    /**
     * Globals constructor.
     * @param array $server
     * @param array $get
     * @param array $post
     */
    public function __construct(array $server, array $get, array $post)
    {
        $this->server = $server;
        $this->get = $get;
        $this->post = $post;
    }
}
