<?php

//初始化数据库连接
function dbInit()
{
    global $link;
    //连接数据库
    $link = mysqli_connect('localhost', 'root', '13471757928zxc', 'dati', 3306);
    //判断数据库连接是否成功，如果不成功则显示错误信息并终止脚本继续执行
    if (!$link) {
        die('连接数据库失败！' . mysqli_connect_error());
    }
    //设置字符集，选择数据库
    mysqli_query($link, 'set names utf8');

}


//sql请求
function query($sql)
{

    global $link;
    if ($result = mysqli_query($link, $sql)) {
        //执行成功
        return $result;
    } else {
        //失败输出
        echo 'SQL执行失败:<br>';
        echo '错误的SQL为:', $sql, '<br>';
        echo '错误的代码为:', mysqli_errno($link), '<br>';
        echo '错误的信息为:', mysqli_error($link), '<br>';
        die;
    }
}

//获取结果集
function fetchAll($sql)
{
    //var_dump($sql);
    //执行query()函数
    if ($result = query($sql)) {
        //执行成功
        //遍历结果集
        $rows = array();
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $rows[] = $row;
        }

        //释放结果集资源
        mysqli_free_result($result);
        return $rows;
    } else {
        //执行失败
        return false;
    }
}

//获取单结果集
function fetchRow($sql)
{
    //执行query()函数
    if ($result = query($sql)) {
        //从结果集取得一次数据即可
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row;
    } else {
        return false;
    }
}

//传入数据安全处理
function safeHandle($data)
{
    global $link;
    //转义字符串中的HTML标签
    $data = htmlspecialchars($data);
    //转义字符串中的特殊字符
    $data = mysqli_real_escape_string($link, $data);
    return $data;
}

/**
 * 判断是否是AJAX提交
 * @return bool
 */
function is_ajax()
{

    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
        return true;
    else {
        return false;
    }

}


/**
 * 返回Json数据
 * @param int $code
 * @param string $message
 * @param array $data
 * @return string
 */
function retJson($code, $message = '', $data = array())
{
    if (!is_numeric($code)) {
        return '';
    }

    $result = array(
        'code' => $code,
        'message' => $message,
        'data' => $data
    );

    echo json_encode($result);
    exit;
}


/**
 * 判断登录
 * @return bool
 */

function Login_or_not()
{
    session_start();
    $name = $_SESSION['userinfo'];
    if ($name) {
        return true;
    } else {
        return false;
    }
}

/**
 * 分钟转小时
 * @return bool
 */

function convertToHoursMins($time, $format = '%02d:%02d')
{
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}





