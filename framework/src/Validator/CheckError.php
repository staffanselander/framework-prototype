<?php


namespace Selander\Framework\Validator;


class CheckError implements CheckInterface
{
    /**
     * @var bool
     */
    private $errorMessage;

    /**
     * Check constructor.
     * @param string $errorMessage
     */
    public function __construct(string $errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return bool
     */
    public function failed(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function errorMessage(): string
    {
        return $this->errorMessage;
    }
}
