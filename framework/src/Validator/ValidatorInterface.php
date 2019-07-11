<?php


namespace Selander\Framework\Validator;


interface ValidatorInterface
{
    /**
     * @param array $data
     * @param array $rules
     * @return mixed
     */
    public function validate(array $data, array $rules): array;
}
