<?php


namespace Selander\Framework\Support;


abstract class GlobalVarsFactory
{
    /**
     * @param array $server
     * @param array $get
     * @param array $post
     * @return GlobalVars
     */
    public static function create(array $server, array $get, array $post): GlobalVars
    {
        return new GlobalVars($server, $get, $post);
    }
}
