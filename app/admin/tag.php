<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");

/**
 * @pageroute
 */
function lst()
{
    $framework = getFrameworkInstance();
    $SubscribeModel = new \Model\Tags();
    $SubscribeModel->checkSendSettingCache(true);
    $page = I('get.p/d', 1);
    $data = $SubscribeModel->getList($page);
    $userNum = $data['num'];
    $results = $data['info'];
    $page_num = $data['page_num'];
    $framework->smarty->assign('total', $userNum);
    $framework->smarty->assign('lists', $results);
    $framework->smarty->assign("pagination_link",$page_num );
    $framework->smarty->display('tag/list.html');
}

/**
 * @pageroute
 */
function add()
{
    $framework = getFrameworkInstance();
    if(IS_POST) {
        $info = I('post.');
        $data = array(
            'title' => $info['title'],
            'name' => $info['name'],
            'send_ch' => $info['send_ch'],
            'remark' => $info['remark'],
            'create_time' => date('Y-m-d H:i:s', time()),
        );
        $SubscribeModel = new \Model\Tags();
        $status = $SubscribeModel->add($data);
        $SubscribeModel->checkSendSettingCache(true);
        urlJump($status,U('admin.php', ['c' => 'tag', 'a' => 'lst']),'add');
    }else
    {
        $framework->smarty->display('tag/add.html');
    }
}

/**
 * @pageroute
 */
function edit()
{
    $framework = getFrameworkInstance();
    $SubscribeModel = new \Model\Tags();
    if(IS_POST)
    {
        $info = I('post.');
        $data = array(
            'title' => $info['title'],
            'name' => $info['name'],
            'send_ch' => $info['send_ch'],
            'remark' => $info['remark'],
            'update_time' => date('Y-m-d H:i:s', time()),
        );
        $where = array('id'=>$info['id']);
        $SubscribeModel->checkSendSettingCache(true);
        $status = $SubscribeModel->update($data,$where);
        urlJump($status,U('admin.php', ['c' => 'tag', 'a' => 'lst']),'edit');
    }else
    {
        $id = I('get.id');
        $result = $SubscribeModel->where(array('id'=>$id))->get()->rowArr();
        $framework->smarty->assign('list',$result);
        $framework->smarty->display('tag/edit.html');
    }
}

/**
 * @pageroute
 */
function del()
{
    $id = I('get.id');
    $where = array('id'=>$id);
    $SubscribeModel = new \Model\Tags();
    $status = $SubscribeModel->delete($where);
    urlJump($status,U('admin.php', ['c' => 'tag', 'a' => 'lst']),'del');
}
