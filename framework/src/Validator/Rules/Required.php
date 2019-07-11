<?php


namespace Selander\Framework\Validator\Rules;


use Selander\Framework\Validator\CheckError;
use Selander\Framework\Validator\CheckInterface;
use Selander\Framework\Validator\CheckOk;
use Selander\Framework\Validator\RuleInterface;

class Required implements RuleInterface
{
    /**
     * @var string
     */
    private $key;

    /**
     * Required constructor.
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @param array $data
     * @return CheckInterface
     */
    public function check(array $data): CheckInterface
    {
        if (!array_key_exists($this->key, $data)) {
            return new CheckError(
                sprintf('%s is required', $this->key)
            );
        }

        return new CheckOk();
    }
}
