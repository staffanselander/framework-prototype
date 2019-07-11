<?php


namespace Selander\Framework\Database;


interface RepositoryFactoryInterface
{
    public function create($model): RepositoryInterface;
}
