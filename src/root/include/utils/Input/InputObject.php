<?php

const INPUT_TYPE_REGULAR = 0;
const INPUT_TYPE_EMAIL = 1;
const INPUT_TYPE_CHECKBOX = 2;
const INPUT_TYPE_PASSWORD_ONE = 3; //If only password one is used this will be treated as a login
const INPUT_TYPE_PASSWORD_TWO = 4;
const INPUT_TYPE_DATE = 5;



class InputObject
{
    function __construct($valueName, $inputType) {
        $this->valueName=$valueName;
        $this->inputType=$inputType;
    }
    
    private $valueName;
    private $errorMsg = "";
    private $inputType = inputType::CHECKBOX;

    /**
     * @return mixed
     */
    public function getValueName()
    {
        return $this->valueName;
    }

    /**
     * @param mixed $valueName
     */
    public function setValueName($valueName)
    {
        $this->valueName = $valueName;
    }

    /**
     * @return string
     */
    public function getErrorMsg(): string
    {
        return $this->errorMsg;
    }

    /**
     * @param string $errorMsg
     */
    public function setErrorMsg(string $errorMsg)
    {
        $this->errorMsg = $errorMsg;
    }

    /**
     * @return int
     */
    public function getInputType(): int
    {
        return $this->inputType;
    }

    /**
     * @param int $inputType
     */
    public function setInputType(int $inputType)
    {
        $this->inputType = $inputType;
    }



}
