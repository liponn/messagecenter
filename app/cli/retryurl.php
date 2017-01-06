<?php defined("__FRAMEWORKNAME__") or die("No permission to access!");
/**
 * 重试失败URL
 * @pageroute
 */
function run()
{
    $logModel = new \Model\Log();
    $logInfos = $logModel->where(array('status' => 0 , 'err_code' => 35))->get()->result();
    if ($logInfos) {
        foreach ($logInfos as $logInfo) {
            $curl = new \Lib\Curl\Curl();
            if (false !== stripos($logInfo->url, 'https')) {
                $curl->setOpt(CURLOPT_SSL_VERIFYPEER, false);
                $curl->setOpt(CURLOPT_SSL_VERIFYHOST, false);
            }
            $curl->setOpt(CURLOPT_TIMEOUT, 3);
            $curl->post($logInfo->url, json_decode($logInfo->send_data, true));
            if (!$curl->errorCode || $curl->errorCode == 28) {
                $logSaveModel = new \Model\Log($logInfo->id);
                $logSaveModel->err_code = $curl->httpStatusCode;
                $logSaveModel->status = \Model\Subscribe::STATUS_SUCCESS;
                if ($logSaveModel->save())
                    logs(array('logId' => $logInfo->id, 'url' => $logInfo->url, 'error' => '200', 'msg' => '发送成功'), 'retry');
            }
            logs(array('logId' => $logInfo->id, 'url' => $logInfo->url, 'error' => '100', 'msg' => '发送失败'), 'retry');
        }
    }
}
