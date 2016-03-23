<?php
namespace Model;
class AdminUser extends Model
{
    public function __construct($pkVal = '')
    {
        parent::__construct('admin_user');
        if ($pkVal)
            $this->initArData($pkVal);
    }

}