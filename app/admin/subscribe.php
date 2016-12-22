<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");

/**
 * @pageroute
 */
function lst()
{
    $framework = getFrameworkInstance();
    $SubscribeModel = new \Model\Subscribe();
    $page = I('get.p/d', 1);
    $data = $SubscribeModel->getList($page);
    $userNum = $data['num'];
    $results = $data['info'];
    $page_num = $data['page_num'];
    $framework->smarty->assign('total', $userNum);
    $framework->smarty->assign('lists', $results);
    $framework->smarty->assign("pagination_link",$page_num );
    $framework->smarty->display('subscribe/list.html');
}

/**
 * @pageroute
 */
function add()
{
    $framework = getFrameworkInstance();
    if(IS_POST) {
        $SubscribeModel = new \Model\Subscribe();
        $tagModel  = new \Model\Tags();
        $info = I('post.');
        $SubscribeModel->tag_id = $info['tag_id'];
        $SubscribeModel->url =  htmlspecialchars_decode(trim($info['url']));
        $SubscribeModel->remark = $info['remark'];
        $SubscribeModel->order = $info['order'];
        $SubscribeModel->status = $info['status'];
        $SubscribeModel->create_time = date('Y-m-d H:i:s', time());
        $status = $SubscribeModel->save();
        if($status)
            $status = $tagModel->getEditCountById($info['tag_id'],1);
        urlJump($status,U('admin.php', ['c' => 'subscribe', 'a' => 'lst']),'add');
    }else
    {
        $tagModel = new \Model\Tags();
        $result = $tagModel->get()->resultArr();
        $framework->smarty->assign('list',$result);
        $framework->smarty->display('subscribe/add.html');
    }
}

/**
 * @pageroute
 */
function edit()
{
    $framework = getFrameworkInstance();
    $SubscribeModel = new \Model\Subscribe();
    if(IS_POST)
    {
        $info = I('post.');
        $data = array(
            'tag_id' => $info['tag_id'],
            'url' => htmlspecialchars_decode(trim($info['url'])),
            'remark' => $info['remark'],
            'order' => $info['order'],
            'status' => $info['status'],
            'update_time' => date('Y-m-d H:i:s', time()),
        );
        $where = array('id'=>$info['id']);
        $status = $SubscribeModel->update($data,$where);
        urlJump($status,U('admin.php', ['c' => 'subscribe', 'a' => 'lst']),'edit');
    }else
    {
        $id = I('get.id');
        $tagModel = new \Model\Tags();
        $result = $tagModel->get()->resultArr();
        $framework->smarty->assign('taglist',$result);
        $result = $SubscribeModel->where(array('id'=>$id))->get()->rowArr();
        $framework->smarty->assign('list',$result);
        $framework->smarty->display('subscribe/edit.html');
    }
}

/**
 * @pageroute
 */
function del()
{
    $id = I('get.id');
    $tag_id = I('get.tag_id');
    $where = array('id'=>$id);
    $tagModel = new \Model\Tags();
    $tag = $tagModel->getEditCountById($tag_id,2);
    $SubscribeModel = new \Model\Subscribe();
    $status = $SubscribeModel->delete($where);
    urlJump($status,U('admin.php', ['c' => 'subscribe', 'a' => 'lst']),'del');
}