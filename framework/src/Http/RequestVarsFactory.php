<?php


namespace Selander\Framework\Http;


use Selander\Framework\Support\GlobalVars;

class RequestVarsFactory
{
    /**
     * @param array $data
     * @return RequestVars
     */
    public function create(array $data): RequestVars
    {
        return new RequestVars($data);
    }

    /**
     * @param GlobalVars $globalVars
     * @return RequestVars
     */
    public function createGet(GlobalVars $globalVars): RequestVars
    {
        return $this->create($globalVars->get);
    }

    /**
     * @param GlobalVars $globalVars
     * @return RequestVars
     */
    public function createPost(GlobalVars $globalVars): RequestVars
    {
        return $this->create($globalVars->post);
    }
}
