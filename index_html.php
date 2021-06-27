<?php if (!defined('APP')) require "./error/404.html"; ?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="content-type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>远程教育考试平台_在线考试</title>
    <link href="/assets/css/main.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/iconfont.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/css/test.css" rel="stylesheet" type="text/css"/>

    <style>
        .hasBeenAnswer {
            background: #5d9cec;
            color: #fff;
        }

    </style>
</head>

<body>
<div id="app" class="main">
    <!--nr start-->
    <div class="test_main">
        <div class="nr_left">
            <div class="test">
                <form action="" method="post">
                    <div class="test_title">
                        <p class="test_time">
                            <i>
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-icon_A"></use>
                                </svg>
                            </i>

                            <b class="alt-1">{{ examData.time.timeDay }}m{{ examData.time.time }}s</b>
                        </p>
                        <font><input type="button" name="test_jiaojuan" value="交卷"></font>
                    </div>

                    <div v-if="examData.single.count>0" class="test_content">
                        <div class="test_content_title">
                            <h2>单选题</h2>
                            <p>
                                <span>共</span><i class="content_lit">{{examData.single.count}}</i><span>题，</span><span>合计</span><i
                                        class="content_fs">{{examData.single.score_all}}</i><span>分</span>
                            </p>
                        </div>
                    </div>

                    <div v-for="(item,index) in examData.single.data" v-bind:key="item.id" class="test_content_nr">
                        <ul>

                            <li v-bind:id="'qu_0_'+index">
                                <div class="test_content_nr_tt">
                                    <i>{{index + 1}}</i><span>({{item.score}}分)</span><font>{{item.name}}</font>
                                </div>

                                <div class="test_content_nr_main">
                                    <ul>

                                        <li v-for="(o_item,o_index) in item.options" v-bind:key="o_item.id"
                                            class="option">

                                            <input @click="light()" type="radio" class="radioOrCheck" v-bind:name="'answer'+item.id"
                                                   v-bind:value="o_item.is_true"
                                                   v-bind:id="'0_answer_'+index+'_option_'+o_index"
                                            />


                                            <label @click="light()" v-bind:for="'0_answer_'+index+'_option_'+o_index">
                                                <span v-if="o_item.id == '0'">A.</span>
                                                <span v-if="o_item.id == '1'">B.</span>
                                                <span v-if="o_item.id == '2'">C.</span>
                                                <span v-if="o_item.id == '3'">D.</span>
                                                <p class="ue" style="display: inline;">{{o_item.text}}</p>
                                            </label>

                                        </li>

                                    </ul>
                                </div>
                            </li>


                        </ul>
                    </div>

                    <div v-if="examData.multiple.count>0" class="test_content">
                        <div class="test_content_title">
                            <h2>多选题</h2>
                            <p>
                                <span>共</span><i class="content_lit">{{examData.multiple.count}}</i><span>题，</span><span>合计</span><i
                                        class="content_fs">{{examData.multiple.score_all}}</i><span>分</span>
                            </p>
                        </div>
                    </div>






                    <div v-for="(item,index) in examData.multiple.data" v-bind:key="item.id" class="test_content_nr">


                        <ul>

                            <li v-bind:id="'qu_1_'+index">

                                <div class="test_content_nr_tt">
                                    <i>{{index + 1}}</i><span>({{item.score}}分)</span><font>{{item.name}}</font>
                                </div>

                                <div class="test_content_nr_main">
                                    <ul>
                                        <li v-for="(o_item,o_index) in item.options" v-bind:key="o_item.id" class="option"/>

                                            <input @click="light()" type="checkbox" class="radioOrCheck" v-bind:name="'answer'+item.id"
                                            v-bind:value="o_item.is_true" v-bind:id="'1_answer_'+index+'_option_'+(o_index)"
                                            />
                                        <label @click="light()" v-bind:for="'1_answer_'+index+'_option_'+(o_index)">
                                            <span v-if="o_item.id == '0'">A.</span>
                                            <span v-if="o_item.id == '1'">B.</span>
                                            <span v-if="o_item.id == '2'">C.</span>
                                            <span v-if="o_item.id == '3'">D.</span>
                                            <p class="ue" style="display: inline;">{{o_item.text}}</p>
                                        </label>

                                        </li>


                                    </ul>
                                </div>
                            </li>


                        </ul>
                    </div>

                </form>
            </div>

        </div>
        <div class="nr_right">
            <div class="nr_rt_main">
                <div class="rt_nr1">
                    <div class="rt_nr1_title">
                        <h1>
                            <i class="icon iconfont"></i>
                            答题卡
                        </h1>
                        <p class="test_time">
                            <i>
                                <svg class="icon" aria-hidden="true">
                                    <use xlink:href="#icon-icon_A"></use>
                                </svg>
                            </i>
                            <b class="alt-1">{{ examData.time.timeDay }}m{{ examData.time.time }}s</b>
                        </p>
                    </div>

                    <div class="rt_content">
                        <div class="rt_content_tt">
                            <h2>单选题</h2>
                            <p>
                                <span>共</span><i class="content_lit">60</i><span>题</span>
                            </p>
                        </div>
                        <div class="rt_content_nr answerSheet">
                            <ul>

                                <li><a href="#qu_0_0">1</a></li>


                            </ul>
                        </div>
                    </div>

                    <div class="rt_content">
                        <div class="rt_content_tt">
                            <h2>多选题</h2>
                            <p>
                                <span>共</span><i class="content_lit">30</i><span>题</span>
                            </p>
                        </div>
                        <div class="rt_content_nr answerSheet">
                            <ul>

                                <li><a href="#qu_1_0">1</a></li>


                            </ul>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <!--nr end-->
    <div class="foot"></div>
</div>

<script src="/assets/js/jquery-1.10.2.js"></script>
<!-- layer -->
<script src="/assets/js/layer/layer.js"></script>
<!-- //layer -->

<!-- Vue -->
<script src="/assets/js/vue/vue.js"></script>
<!-- //Vue -->
<script src="/assets/js/axios/axios.min.js"></script>
<!-- Meta tag Keywords -->

<script src="/assets/js/jquery.easy-pie-chart.js"></script>
<!--时间js-->
<script src="/assets/js/jquery.countdown.js"></script>
<script src="/assets/js/iconfont.js"></script>


<script type="text/javascript">
    //配置头部信息
    axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded;charset=UTF-8';
    axios.defaults.headers.post['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.get['Content-Type'] = 'application/x-www-form-urlencoded;charset=UTF-8';
    axios.defaults.headers.get['X-Requested-With'] = 'XMLHttpRequest';




    new Vue({

        el: "#app",
        data() {
            return {
                examData: {
                    "single": {
                        "data": [],
                        "score_all": 0,
                        "count": 0
                    },
                    "multiple": {
                        "data": [],
                        "score_all": 0,
                        "count": 0
                    },
                    "completion": {
                        "data": [],
                        "score_all": 0,
                        "count": 0
                    },
                    "big": {
                        "data": [],
                        "score_all": 0,
                        "count": 0
                    },
                    'time':{
                        'newTime': '2021-06-26 20:22:11',
                        'time':'99',
                        'timeDay':'99'
                    }

                },


            };
        },



        created(){
            //利用promise有序请求
            var fnArr = [this.login_or_not, this.getExamData,this.setTime];
            this.run(fnArr);

        },

        computed:{
//计算分数
            totalPrice(){
                let totalPrice=0;
                //遍历数组
                this.goodsList.forEach(element => {
                    if(element.check==1){
                        totalPrice+=element.subtotal*1;
                    }

                });
                return totalPrice.toFixed(2);//保留两位小数
            },

        },


        // mounted() {
        //     //利用promise有序请求
        //     var fnArr = [this.login_or_not, this.getExamData];
        //     this.run(fnArr);
        // },

        methods: {
            getExamData() {
                return new Promise((resolve, reject) => {
                    let that = this;

                    /*因为 axios 发送数据时不是以 formData 的形式发送的，而 php 接收的是以 formData 形式的数据。
    所以只好把数据在请求之前转换一下。*/
                    var params = new URLSearchParams();
                    // params.append('id', that.loginForm.username);
                    axios({
                        method: 'post',
                        url: '/index.php',
                        data: params,
                    }).then(function (res) {
                        resolve('getExamData');
                        console.log(res.data.data);
                        layer.msg(res.data.message);//消息提示
                        if (res.data.code == '200') {
                            //复制考试数据
                            that.examData = res.data.data;
                        }

                    });
                });
            },
            login_or_not() {
                return new Promise((resolve, reject) => {
                    let that = this;
                    /*因为 axios 发送数据时不是以 formData 的形式发送的，而 php 接收的是以 formData 形式的数据。
    所以只好把数据在请求之前转换一下。*/
                    var params = new URLSearchParams();
                    // params.append('id', that.loginForm.username);
                    axios({
                        method: 'post',
                        url: '/login_or_not.php',
                        data: params,
                    }).then(function (res) {
                        if (res.data.data === false) {
                            //复制考试数据
                            layer.msg('您尚未登录，请先登录！');//消息提示
                            setTimeout(function () {
                                window.location.href = "/login.php";
                                reject('login_or_not');
                            }, 2000)
                        } else {
                            resolve('login_or_not');
                        }

                    });
                });
            }
            ,

            run(arr, start = 0) {
                if (start > arr.length || start < 0) return; // 参数start不能超过    arr.length，不能为负数
                var next = function (i) {
                    if (i < arr.length) {
                        var fn = arr[i];
                        fn().then(res => {
                                console.log('此消息表示执行请求');
                                i++;
                                next(i)
                            }, res => {
                                console.log(res);
                            }
                        );
                    }
                }
                next(start);
            },
            light(){
                debugger;
                console.log('asd');
                var examId = $(this).closest('.test_content_nr_main').closest('li').attr('id'); // 得到题目ID
                var cardLi = $('a[href=#' + examId + ']'); // 根据题目ID找到对应答题卡
                // 设置已答题
                if (!cardLi.hasClass('hasBeenAnswer')) {
                cardLi.addClass('hasBeenAnswer');
                 }
            },
            setTime() {
                return new Promise((resolve, reject) => {
                    let that = this;
                this.timeOut = setInterval(() => {
                    setTimeout(() => {
                        //newtime是倒计时的结束时间，当前时间和newTime指定的时间相同时，倒计时为0，即倒计时结束


                        const timedate = new Date(that.examData.time.newTime);
                        // console.log(that.examData.time.newTime);
                        const now = new Date()
                        const date = timedate.getTime() - now.getTime()
                        // console.log(date)
                        const time = Math.ceil(date / 1000) % 60
                        const timeDay = Math.ceil(date / (1000 * 60)) - 1
                        that.examData.time.time = time > 0 ? time : 0
                        that.examData.time.timeDay = timeDay > 0 ? timeDay : 0
                        // console.log(that.examData.time.timeDay);
                        // console.log(that.examData);

                    }, 0)
                    resolve();
                }, 1000)
            })
            },


        }
    });
</script>





<script>
    window.jQuery(function ($) {
        "use strict";

        $('time').countDown({
            with_separators: false
        });
        $('.alt-1').countDown({
            css_class: 'countdown-alt-1'
        });
        $('.alt-2').countDown({
            css_class: 'countdown-alt-2'
        });

    });
</script>



</body>

</html>

