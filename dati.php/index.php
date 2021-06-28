<?php
//声明文件解析的编码格式
header('content-type: text/html; charset=utf-8');
require './common.php';


/*ajax*/
if (is_ajax()) {

//判断登录
    if (!Login_or_not()){
        exit(retJson(500, '非法访问！',''));
    }


    dbInit();
//接收测试id
    $exam_id = isset($_POST['exam_id']) ? trim($_POST['exam_id']) : '1';
    $exam_id = safeHandle($exam_id);//安全处理
    $sql = "select q.id,q.name,q.type,q.exam_id,q.score,e.exam_time,GROUP_CONCAT(o.text SEPARATOR '----') as text ,GROUP_CONCAT(o.is_true SEPARATOR '----') as `is_true` from questions as q join `options` as o
on q.id=o.question_id join `exam` as e on q.exam_id=e.id where e.id = '$exam_id' and e.is_deleted = '0' and e.is_show = '1' GROUP BY q.id ";
    $row = fetchAll($sql); //拿到数据

    if (empty($row)) exit(retJson(500, '该试卷未发布！'));

    $result_data['single']['data']=[];//对应type1单选题
    $result_data['multiple']['data']=[];//对应type2
    $result_data['completion']['data']=[];//对应type3
    $result_data['big']['data']=[];//对应type4

    $result_data['single']['score_all']=0;
    $result_data['multiple']['score_all']=0;
    $result_data['completion']['score_all']=0;
    $result_data['big']['score_all']='0';


    $result_data['time']['newTime']=date("Y-m-d H:i:s", strtotime("+".$row[0]['exam_time']." minutes"));
    $result_data['time']['time']=0;
    $result_data['time']['timeDay']=$row[0]['exam_time'];


//重定义数据结构
    foreach ($row as &$value) {
        $answer['text']=explode('----',$value['text']);
        $answer['is_true']=explode('----',$value['is_true']);
        foreach ($answer['text'] as $an_item => $an_value){
            $value['options'][$an_item]['text']=$an_value;
            $value['options'][$an_item]['id']=$an_item;
            $value['options'][$an_item]['is_true']=$answer['is_true'][$an_item];
            $value['options'][$an_item]['is_checked']=false;
            $value['is_light']=false;
        }
        unset($value['text']);
        unset($value['is_true']);
        //划分题型
            switch ($value['type']){
                case 1:
                    $result_data['single']['data'][]=$value;
                    $result_data['single']['score_all']+=$value['score'];
                    break;
                case 2:
                    $result_data['multiple']['data'][]=$value;
                    $result_data['multiple']['score_all']+=$value['score'];
                    break;
                case 3:
                    $result_data['completion']['data'][]=$value;
                    $result_data['completion']['score_all']+=$value['score'];
                    break;
                case 4:
                    $result_data['big']['data'][]=$value;
                    $result_data['big']['score_all']+=$value['score'];
                    break;
            }
    }
    $result_data['single']['count']=count($result_data['single']['data']);
    $result_data['multiple']['count']=count($result_data['multiple']['data']);
    $result_data['completion']['count']=count($result_data['completion']['data']);
    $result_data['big']['count']=count($result_data['big']['data']);


    exit(retJson(200, '获取数据成功！',$result_data));
}
/*//aja*/

define('APP', '181603011008');
//加载视图页面，显示数据
require './index_html.php';
