<?php
namespace Model;
class SqsSubscribe extends Model
{
    public function __construct($pkVal = '')
    {
        parent::__construct('sqs_subscribe');
        if ($pkVal)
            $this->initArData($pkVal);
    }
}