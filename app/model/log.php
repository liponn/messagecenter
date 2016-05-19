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
    public function getList($page='1',$type='1')
    {
        $tagModel = new \Model\Tags();
        if($type == 1)
        {
            $userNum = $this->where(array('status'=>1,'retry'=>0))->countNums();
            $pagination = $this->pageObj($page,$userNum);
            $results = $this->listTable('status=1', $pagination->start, $pagination->offset, "id desc")->resultArr();
        } elseif($type ==2)
        {
            $userNum = $this->where('status <> 1  AND retry < 3')->countNums();
            $pagination = $this->pageObj($page,$userNum);
            $results = $this->listTable('status != 1 AND retry < 3', $pagination->start, $pagination->offset, "id desc")->resultArr();
        }else
        {
            $userNum = $this->where('status =0')->countNums();
            $pagination = $this->pageObj($page,$userNum);
            $results = $this->listTable('status=0', $pagination->start, $pagination->offset, "id desc")->resultArr();
        }
        $tagInfo = $tagModel->get()->resultArr();
        foreach($results as &$log)
        {
            foreach($tagInfo as $tag){
                if($log['tag_id'] == $tag['id'])
                {
                    $log['tag_name'] = $tag['name'];
                }
            }
        }
        $page_num = $pagination->createLink();
        $data = array('num'=>$userNum,'info'=>$results,'page_num'=>$page_num);
        return $data;
    }
    //分页封装返回分页obj
    public function pageObj($page,$num)
    {
        $config = array(
            'total' => $num,
            'pagesize' => C('PAGE_SIZE'),
            'current_page' => $page,
        );
        return new \Lib\Pagination($config);
    }
}

