<?php
namespace Model;
class SqsLog extends Model
{
    public function __construct($pkVal = '')
    {
        parent::__construct('sqs_log');
        if ($pkVal)
            $this->initArData($pkVal);
    }
}