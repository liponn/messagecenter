<?php
namespace Model;
class Subscribe extends Model
{
    public function __construct($pkVal = '')
    {
        parent::__construct('subscribe');
        if ($pkVal)
            $this->initArData($pkVal);
    }
}