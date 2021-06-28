<?php
require 'common.php';

/*将考试计入数据库*/

if (is_ajax()) {

//判断登录
    if (!Login_or_not()) {
        exit(retJson(500, '非法访问！', ''));
    }

    $score = isset($_POST['score']) ? trim($_POST['score']) :"";
    $exam_id = isset($_POST['exam_id']) ? trim($_POST['exam_id']): "";
    dbInit();
    if (!empty($exam_id)) { //建立连接
        $score=safeHandle($score);//安全处理
        $exam_id=safeHandle($exam_id);
        session_start();
        //用户id
        $user_id=$_SESSION["userinfo"]["id"];
        $sql = "INSERT INTO record_exam (`user_id`,`exam_id`,`score`) VALUES ($user_id,$exam_id,$score)";


        if(json_encode(query($sql)));
           exit(retJson(200,'考试结束',''));
        } else {
            # 插入失败，返回false
           exit(retJson(500,'系统错误，请联系管理员',''));
        }



    }
