<?php
namespace Model;
class Log extends Model
{
    public function __construct($pkVal = '')
    {
        parent::__construct('log');
        if ($pkVal)
            $this->initArData($pkVal);
    }
}