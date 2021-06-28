<?php
//声明文件解析的编码格式
header('content-type: text/html; charset=utf-8');
require './common.php';


/*ajax登录*/
if (is_ajax()) {

    $username = isset($_POST['username']) ? trim($_POST['username']) :"";
    $password = isset($_POST['password']) ? trim($_POST['password']): "";
    dbInit();
    if (!empty($username) && !empty($password)) { //建立连接

        $username=safeHandle($username);//安全处理
        $password=safeHandle($password);
        $sql = "SELECT `id`,`name`,`pwd` FROM users WHERE `name` = '$username'";
        $row = fetchRow($sql); //拿到单条数据
        $salt='dati';
        $password = md5(md5($password).md5($salt));//加盐md5
        if ($password == $row['pwd']) {//判断密码是否正确
            session_start(); //开启session
            $_SESSION['userinfo'] = array(//创建session 保存账号信息
                'id' => $row['id'],
                'name' => $row['name'],
            );
            $date = date('Y-m-d H:m:s');//写入登录表
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
            $info = sprintf("当前访问用户：%s,IP地址：%s,时间：%s /n", $username, $ip, $date);

            exit(retJson(200,'账号'.$row['name'].'登录成功,欢迎您的到来！'));
        }

    }

    exit(retJson(500, '账号或密码错误！'));

}


/*//ajax登录*/

define('APP', '181603011008');
//加载视图页面，显示数据
require './login_html.php';
