<?php
error_reporting(2047);

/**
 * �ļ���message.php
 * ���ߣ�mqycn
 * ���ͣ�http://www.miaoqiyuan.cn
 * Դ�룺https://gitee.com/mqycn/WechatMessage
 * ˵��������ļ�����Ҫ���ƻظ������� �޸� message/WechatMessageApp.php
 */
require_once 'message/WechatMessageApp.php';

$wechatObj = new WechatMessageApp();
echo $wechatObj->auto();
?>