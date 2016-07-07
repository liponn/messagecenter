<?php
namespace Lib;

class UserData
{
    private $group;

    public function __construct()
    {
        if(!$this->group)
        {
            $userHost = C('SERVER_PASSPORT');
            $host = parse_url($userHost, PHP_URL_HOST);
            if (!$host) {
                die('未配置 SERVER_PASSPORT');
            }
            $this->group = $host;
        }
    }

    static public function get($name){
        static $self;
        if(!$self)
            $self = new self();
        $sessionTool = new Session();
        $sessionTool->setGroup($self->group);
        $data = $sessionTool->get('userData.'.$name);
        $sessionTool->setGroup('');
        return $data;
    }

    public function __get($name)
    {
        $sessionTool = new Session();
        $sessionTool->setGroup($this->group);
        $data = $sessionTool->get('userData.'.$name);
        $sessionTool->setGroup('');
        return $data;
    }
}