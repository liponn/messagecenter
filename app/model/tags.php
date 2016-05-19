<?php
namespace Model;
class Tags extends Model
{
    const SEND_CH_QUICK = 1;
    const SEND_CH_NORMAL = 2;
    const SEND_CH_SLOW = 3;

    private static $settingCache;
    private  $tagSendSetting;

    public function __construct($pkVal = '')
    {
        parent::__construct('tags');
        if ($pkVal)
            $this->initArData($pkVal);

        $this->checkSendSettingCache();
    }

    private function checkSendSettingCache(){
        self::$settingCache =  __APP_CACHE_PATH__ . DIRECTORY_SEPARATOR . 'tagSettingCache';
        if( (!file_exists(self::$settingCache))  ||  (time() - 1 * 8 >= filemtime(self::$settingCache)))
        {
            //配置缓存不存在，或者上次修改时间离现在时间大于等于八个小时,则重建缓存
            $tags = $this->fields(['name','send_ch'])->get()->result();
            if($tags)
            {
                $tagsArr = [];
                foreach ($tags as $tag) {
                    $tagsArr[$tag->name] = $tag->send_ch;
                }
                $this->tagSendSetting = $tagsArr;
                $tagsChannelSetting = var_export($tagsArr,true);
                $phpTpl =<<<PHPTPL
<?php
return {$tagsChannelSetting};
PHPTPL;

                @file_put_contents(self::$settingCache,$phpTpl);
            }

        }

        if(!$this->tagSendSetting)
        {
            $this->tagSendSetting =  include_once(self::$settingCache);
        }


    }

    public function getSendCh($tagName){
        return isset($this->tagSendSetting[$tagName]) ? $this->tagSendSetting[$tagName] : null;
    }


    public  function getIdByName($tagName){
        $row = $this->fields('id')->where(['name' => $tagName])->get()->row();
        if($row)
        {
            return $row->id;
        }
        else
        {
            return false;
        }

    }
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
        $results = $this->listTable('', $pagination->start, $pagination->offset, "id desc")->resultArr();
        $page_num = $pagination->createLink();
        $data = array('num'=>$userNum,'info'=>$results,'page_num'=>$page_num);
        return $data;
    }

}