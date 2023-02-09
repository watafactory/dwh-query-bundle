<?php

declare(strict_types=1);

namespace Wata\DwhQueryBundle\Tests\Resources\Entity;

class SampleEntity
{
    public string $fieldOne;
    private string $fieldTwo;
    private bool $fieldThree;
    private bool $fieldFour;

    /**
     * @param string $fieldOne
     * @param string $fieldTwo
     * @param bool $fieldThree
     * @param bool $fieldFour
     */
    public function __construct(string $fieldOne, string $fieldTwo, bool $fieldThree, bool $fieldFour)
    {
        $this->fieldOne = $fieldOne;
        $this->fieldTwo = $fieldTwo;
        $this->fieldThree = $fieldThree;
        $this->fieldFour = $fieldFour;
    }

    /**
     * @return string
     */
    public function getFieldOne(): string
    {
        return $this->fieldOne;
    }

    /**
     * @param string $fieldOne
     */
    public function setFieldOne(string $fieldOne): void
    {
        $this->fieldOne = $fieldOne;
    }

    /**
     * @return string
     */
    public function getFieldTwo(): string
    {
        return $this->fieldTwo;
    }

    /**
     * @param string $fieldTwo
     */
    public function setFieldTwo(string $fieldTwo): void
    {
        $this->fieldTwo = $fieldTwo;
    }

    /**
     * @return bool
     */
    public function isFieldThree(): bool
    {
        return $this->fieldThree;
    }

    /**
     * @param bool $fieldThree
     */
    public function setFieldThree(bool $fieldThree): void
    {
        $this->fieldThree = $fieldThree;
    }

    /**
     * @return bool
     */
    public function hasFieldFour(): bool
    {
        return $this->fieldFour;
    }

    /**
     * @param bool $fieldFour
     */
    public function setFieldFour(bool $fieldFour): void
    {
        $this->fieldFour = $fieldFour;
    }


}
