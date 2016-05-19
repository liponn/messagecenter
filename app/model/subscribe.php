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
    //获取订阅数据列表
    public function getList($page='1'){
        //总数目
        $userNum = $this->countNums();
        //分页配置
        $config = array(
            'total' => $userNum,
            'pagesize' => C('PAGE_SIZE'),
            'current_page' => $page,
        );
        $pagination = new \Lib\Pagination($config);
        //dump($pagination);die;
        $results = $this->listTable('', $pagination->start, $pagination->offset, "id desc,order desc")->resultArr();
        $page_num = $pagination->createLink();
        $data = array('num'=>$userNum,'info'=>$results,'page_num'=>$page_num);
        return $data;
    }

    /**
     * @param $data 添加的数据
     * @return bool 状态
     */
    public function addSave($data)
    {
        if(empty($data)) return false;
        $this->tag_id = $data['tag_id'];
        $this->url = $data['url'];
        $this->remark = $data['remark'];
        $this->order = $data['order'];
        $this->status = $data['status'];
        $this->create_time = $data['create_time'];
        return $this->save();

    }
}