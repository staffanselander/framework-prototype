<?php


namespace Selander\Framework\Validator\Rules;


use Selander\Framework\Validator\CheckError;
use Selander\Framework\Validator\CheckInterface;
use Selander\Framework\Validator\CheckOk;
use Selander\Framework\Validator\RuleInterface;

class DisallowHtml implements RuleInterface
{
    const REGEX = '/<[a-z][\s\S]*>/';

    /**
     * @var string
     */
    private $key;

    /**
     * DisallowMatch constructor.
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
        if (preg_match(self::REGEX, $data[$this->key] ?? '')) {
            return new CheckError(
                sprintf('%s is not allowed to contain html', $this->key)
            );
        }

        return new CheckOk();
    }

}
