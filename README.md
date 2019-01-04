# WechatMessage

#### 项目介绍
微信消息处理类

#### 使用说明

**1、申请测试帐号**

打开测试接口页面，[https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login](https://mp.weixin.qq.com/debug/cgi-bin/sandbox?t=sandbox/login)

![输入图片说明](https://images.gitee.com/uploads/images/2019/0104/161704_fbff2508_82383.png "1.png")

点击 登录 按钮，使用微信扫码登陆。

**2、填写 测试脚本的URL **

将下载的脚本安装到服务器后，比如：http://您的域名/安装路径/

在 接口配置信息中，填写 测试地址为： http://您的域名/安装路径/demo/message.php 访问

如果不想自己配置，可以使用 在线测试地址：http://wechatmessage.demo.miaoqiyuan.cn/demo/message.php

![输入图片说明](https://images.gitee.com/uploads/images/2019/0104/162114_2c759830_82383.png "2.png")


**3、关注 测试号二维码 **

![输入图片说明](https://images.gitee.com/uploads/images/2019/0104/162348_24e78c53_82383.png "3.png")

关注 测试号二维码，进入 公众号 聊天窗口，输入内容即可测试。

![输入图片说明](https://images.gitee.com/uploads/images/2019/0104/162928_a77ffa95_82383.jpeg "4.jpg")

#### 修改说明

参考 demo/message/WechatMessageApp.php，直接重写对应的方法就可以了。

以上边的截图为例

收到 订阅(onSubscribeEvent)，返回 你好，非常感谢您的订阅。

收到 文本信息，增加 [自动回复] 和 内容原样输出。

```
class WechatMessageApp extends WechatMessageCommon {
	protected function onSubscribeEvent() {
		$msg = "你好，非常感谢您的订阅。\n\n";
		return $this->textMessage($msg);
	}
	protected function onTextMessage($content) {
		return $this->textMessage("[自动回复]${content}");
	}
}
```

如果 没有 重写 消息事件，会回复 不支持的消息，方便调试，当然也可以通过重写 onOtherMessage 的方法引导用户操作

![输入图片说明](https://images.gitee.com/uploads/images/2019/0104/163515_563a4dfb_82383.jpeg "5.jpg")

```
class WechatMessageApp extends WechatMessageCommon {
	protected function onOtherMessage($event_type, $argument = array()) {
		return $this->textMessage("不支持的消息，请回复\n1:XXX\n2:XXX");
	}
}
```

**4、消息类型和对应的方法 **

| 消息事件 | 需要重写的方法 | 
| :-: | - |
| 用户订阅 | onSubscribeEvent() |
| 文字消息 | onTextMessage($content) |
| 图片消息 | onImageMessage($image, $media_id) |
| 语音消息 | onVoiceMessage($media_id, $format, $to_text) |
| 视频消息 | onVideoMessage($media_id, $media_thumb_id) |
| 分享消息 | onLinkMessage($title, $desc, $url) |
| 文件上传 | onFileMessage($file_name, $desc, $file_key, $file_md5, $file_size) |
| 位置信息 | onLocationMessage($address, $lat, $lng, $scale) |
| 进入客服界面(小程序) | onUserEnterTempsessionEvent() |

| 回复类型 | 回复的方法 | 
| :-: | - |
| 文字消息 | textMessage($content) |
| 图片消息 | imageMessage($media_id) |
| 语音消息 | voiceMessage($media_id) |
| 视频消息 | videoMessage($media_id, $title = '', $desc = '') |
| 分享消息 | linkMessage($articles = array()) |


订阅号只支持 回复文本信息

服务号、小程序 可以支持所有消息类型（测试中，暂时没有提交到gitee）

分享信息的 $articles 创建的方法：

```
$articles = array(
    $message->linkMessageArticleItem($title, $url, $image, $desc),
    $message->linkMessageArticleItem($title, $url, $image, $desc),
    $message->linkMessageArticleItem($title, $url, $image, $desc)
);
```
