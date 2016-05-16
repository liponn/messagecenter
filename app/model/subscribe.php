<?php
namespace Model;
class Subscribe extends Model
{
    const STATUS_SUCCESS = 1;
    const STATUS_FAIL = 0;
    public function __construct($pkVal = '')
    {
        parent::__construct('subscribe');
        if ($pkVal)
            $this->initArData($pkVal);
    }


    public function getByTagId($tagId){
        $result = $this->fields(['id','url'])->where(['tag_id' => $tagId])->get()->result();
        return $result;
    }
}