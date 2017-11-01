<?php
/**
 * Created by sapphire.php@gmail.com
 * User: yongze
 * Date: 2017/10/31
 * Time: 下午6:54
 */
require __DIR__.'/../vendor/autoload.php';
$client = new \Yongze\swoole\WebSocketClient('127.0.0.1', 9505);

$message =<<<eof
博客
学院
下载
更多

qq_34251396
composer之创建自己的包
原创 2014年11月05日 21:45:05 标签：composer /php 13279
BY JENNER · 2014年11月4日· 阅读次数：19

composer的出现，使得PHPer可以像java一样更加方便的管理代码。在composer没有出现之前，人们大多使用pear、pecl管理依赖，但是局限性很多，也很少有人用（接触的大多phper基本不适用pear管理依赖）。composer不仅仅能够解决依赖的问题，也可以在一定程度上解决造轮子的问题。

废话不多说，这篇主要记录如何创建自己的package。

大概步骤如下：

在github上创建一个项目（项目名称可以随意）
编写composer.json
copy代码文件并修改命名空间
在https://packagist.org/上递交自己的包
设置github的hook
编写composer.json

先看一个示例：


1

2

3

4

5

6

7

8

9

10

11

12

13

14

15

16

17

18

19

20

21

22

{

    "name": "jenner/message_queue",

    "description": "php message queue wrapper",

    "license": "MIT",

    "keywords": ["message queue"],

    "version": "1.0.0",

    "authors": [

        {

            "name": "Jenner",

            "email": "hypxm@qq.com"

        }

    ],

    "require": {

        "php": ">=5.3.0"

    },

 

    "autoload": {

        "psr-0": {

            "Jenner\\Zebra\\MessageQueue": "src/"

        }

    }

}
需要注意的几个字段说明如下：

name:包名称，递交时packagist会检测报名字是否合法。必须是一个/分隔的字符串。当别人引入你的包时，vendor下会自动创建这个目录。例如org/package包，则会在vender下创建org/package目录。

autoload:包的加载方式，具体加载方式可以参考composer中文网说明。这里使用的是psr-0标准加载方式。composer会在src目录下根据命名空间执行自动加载。

 

copy代码修改命名空间

composer.json文件修改后，我们需要把要打包的源文件复制过来。这里我把所有的文件放在了src目录下，后面可能会有和src同级的tests等目录，而这些目录是不会被加载的。src目录下需遵循psr-0标准。命名空间和目录定义要一直。例如Namespcae/SubNamespace命名空间，则src下必须有Namespace/SubNamespace目录。

代码编写标准可以参考psr-0、psr-1标准

 

递交自己的包

pacagist开放递交，你可以任意递交自己的包，当然，要符合一定规则。

packagist右上角有一个submit package的按钮，点击会跳转到递交页面，如下图：

QQ截图20141104224005

然后在文本框中输入你在github上创建的项目的git地址。packagist会自动检测是否合法。如果合法点击递交即可递交自己的包了。

你可能需要在github上面发布几个release，这样packagist才会认定你的包是稳定的，否则只能required开发包。

设置github的hook

版本控制工具大多支持hook，用于代码递交时触发一个事件，将代码同步到其他环境中。在github上设置hook后，我们每次pull，都会自动同步到packagist上，这样就不需要我们手动强制同步了。具体操作可以参见packgist的说明，操作很简单，耐心看下应该问题不大。

 

最后，如果别人使用了这个包。他的vendor目录下就会产生jenner/message_queue目录，其下的内容就是你github上的代码了，结构是完全一致的。

 

 

原创文章，转载请注明： 转载自始终不够

本文链接地址: composer之创建自己的包

版权声明：本文为博主原创文章，未经博主允许不得转载。
  
发表你的评论
 发表评论
 zhaishuaigan
zhaishuaigan2016-07-16 21:564楼
为什么没有开发测试过程，怎么在不提交packagist的情况下测试自己写的包是否正常， 找了很多地方， 都没有这个部分的说明
回复
zhaishuaigan
zhaishuaigan2016-07-16 21:563楼
为什么没有开发测试过程，怎么在不提交packagist的情况下测试自己写的包是否正常， 找了很多地方， 都没有这个部分的说明
回复
zhaishuaigan
zhaishuaigan2016-07-16 21:552楼
为什么没有开发测试过程，怎么在 不提交packagist的情况下 测试自己写的包是否正常， 找了很多地方， 都没有这个部分的说明
回复
查看 5 条热评
相关文章推荐
Composer构建现代PHP帝国(二)——编写自己的Composer包

或许自己开发过很多组件，多个类库，接口等。会不会因为切换框架而头疼，是不是还得修改你的代码，可能还得在某一框架里面重新包含这些文件进来。现在有两个工具可以帮助你解决这一问题,它们分别是Composer...
github_36670459github_366704592016-12-28 17:231362
5. Laravel5学习笔记：在packagist上发布自己的composer包

学习laravel5已经有一段的时间了，深深被composer管理php包的功能感动，想想自己也来动手写个包，发布到packagist上。包功能介绍此包实现功能：laravel5使用百度UEditor...
hel12hehel12he2015-06-27 11:062426
 
月薪3万的前端程序员都避开了哪些坑？

程序员薪水有高有低，同样工作5年的程序员，有的人月薪30K、50K，有的人可能只有5K、8K。是什么因素导致了这种差异？
用 composer 造轮子

composer 是 PHP 的依赖管理工具，本篇文章就来说明如何构建一个包，并提交到 Packagist ，这样别人就可以方便地通过 composer 使用你的包了。 开发 composer 包有以...
WebbenWebben2017-09-06 17:56128
Laravel Composer Package 开发简明教程

在Laravel的文档中有Package Development，对于入门开发人员来说还是比较抽象，因为开发一个包需要了解 Service Providers,Service Providers 和...
xionggang1024xionggang10242017-08-01 22:11184
Composer构建现代PHP帝国(一)——Composer快速入门

关于学完快速入门后,是否对Composer有一定的了解啦，或许你还没我那么喜爱它吧，因为它还有很多强大的功能在上面我们还没有应用到它，下一篇文章将介绍如何编写符合Composer自动加载的组件／类库，...
github_36670459github_366704592016-12-27 20:36343
Laravel 及 composer 安装及使用

安装composerphp -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" php -r "if (hash...
WebbenWebben2017-07-12 15:58174
使用satis 搭建私有Composer

satis composer 私有仓库
goodzywgoodzyw2017-02-10 16:58580
229 用 composer 管理私有包

最近在搭建api脚手架，需要在项目中使用私有的包，只想在公司中重用，但不是真的想开源，不能放在 github 或者 packagist上面。 需要引入的包的 git 地址为 testRepo ...
fancivezfancivez2017-01-05 15:40908
composer 创建一个github 项目，然后可以通过composer下载

1.在github申请账户，申请完成就可以创建项目了 2.创建一个composer.json文件：内容如下:{ "name": "zqy234/terrytest", "descriptio...
terry_waterterry_water2016-01-07 16:252855
正确的 Composer 扩展包安装方法

问题说明我们经常要往现有的项目中添加扩展包，有时候因为文档的错误引导，如下图来自 这个文档 的：composer update 这个命令在我们现在的逻辑中，可能会对项目造成巨大伤害。因为 compos...
xianglingchuanxianglingchuan2016-07-17 10:1017716
composer之创建自己的包

composer的出现，使得PHPer可以像java一样更加方便的管理代码。在composer没有出现之前，人们大多使用pear、pecl管理依赖，但是局限性很多，也很少有人用（接触的大多phper基...
dbg8685dbg86852017-04-09 20:4647
如何创建一个composer包

如何创建一个composer包 composer已经成了php程序员的标配, 但是composer需要搭配版本控制器使用，现在最好用的版本控制器当然是git了. 所以你需要有一个github账号才...
wolfqongwolfqong2016-08-04 13:33309
CakePhp创建项目，composer及常用包的安装

创建项目安装composer 这里安装全局的composer，首先下载Composer-Setup.exe，不知道去哪里下载的小伙伴请猛戳下面链接 这里是链接http://opcqde8up.bkt....
yangmmhyangmmh2017-07-01 10:28160

composer安装包，简单使用手册

2016-12-07 16:47657KB
下载

Composer安装包

2017-08-07 09:32734KB
下载
使用composer发布自己的PHP依赖包

欢迎使用Markdown编辑器写博客本Markdown编辑器使用StackEdit修改而来，用它写博客，将会带来全新的体验哦： Markdown和扩展Markdown简洁的语法 代码块高亮 图片链接和...
bo19881224bo198812242016-10-14 09:141492

Composer安装包

2015-12-14 11:03660KB
下载

composer.phar 安装包

2017-03-20 14:011.75MB
下载
PHP包管理工具-Composer的用法

简介：Composer是PHP中的一个依赖管理工具. 它可以让你声明自己项目所依赖的库，然后它将会在项目中为你安装这些库。
xftimesxftimes2014-06-12 11:311257

Control4 Composer 编程指南包1

2013-08-04 16:353.42MB
下载
 
始终不够

＋关注
原创
33
 
粉丝
143
 
喜欢
0
 
码云
0
他的最新文章更多文章
PHP异步编程简述
递归与循环
wordpress全栈优化
flume日志收集系统搭建

博主专栏
 2
PHP专题
2943
在线课程

【福利】神经网络的原理及结构设计
【福利】神经网络的原理及结构设计
讲师：
互联网职业选择那点事
互联网职业选择那点事
讲师：

热门文章

写给4年前开始编程序的自己
35214
基于Redis的MessageQueue队列封装
18775
基于PHP的crontab定时任务管理
14897
基于PCNTL的PHP并发编程
14304
composer之创建自己的包
13274

0
 
 
 
 
127.0.0.1
eof;

if (!$client->connect())
{
    echo "connect failed \n";
    return false;
}
if (!$client->send($message))
{
    echo $message. " send failed \n";
    return false;
}
echo "send succ \n";
