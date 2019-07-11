<?php


namespace Selander\Framework\Validator;


class Validator implements ValidatorInterface
{
    /**
     * @param array $data
     * @param RuleInterface[] $rules
     * @return string[]
     */
    public function validate(array $data, array $rules): array
    {
        $errors = [];

        foreach ($rules as $rule) {
            $check = $rule->check($data);

            if ($check->failed()) {
                $errors[] = $check->errorMessage();
            }
        }

        return $errors;
    }
}
