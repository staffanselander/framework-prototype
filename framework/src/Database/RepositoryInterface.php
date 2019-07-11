<?php


namespace Selander\Framework\Database;


interface RepositoryInterface
{
    public function get();
    public function find($id);
    public function update($model);
    public function create($model);
    public function delete($model);
}
