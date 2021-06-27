<?php if (!defined('APP')) require "./error/404.html"; ?>
<!DOCTYPE HTML>
<html lang="zxx">


<head>
    <title>用户登陆</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8"/>
    <meta name="keywords" content=""/>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- Jquery -->
    <script src="/assets/js/jquery-1.10.2.js"></script>
    <!-- //Jquery -->

    <!-- layer -->
    <script src="/assets/js/layer/layer.js"></script>
    <!-- //layer -->

    <!-- Vue -->
    <script src="/assets/js/vue/vue.js"></script>
    <!-- //Vue -->
    <script src="/assets/js/axios/axios.min.js"></script>
    <!-- Meta tag Keywords -->
    <!-- css files -->
    <link rel="stylesheet" href="/assets/css/style.css" type="text/css" media="all"/>
    <!-- Style-CSS -->

    <!-- Font-Awesome-Icons-CSS -->
    <!-- //css files -->
    <!-- web-fonts -->

    <!-- //web-fonts -->
</head>

<body>
<!-- bg effect -->
<div id="bg">
    <canvas></canvas>
    <canvas></canvas>
    <canvas></canvas>
</div>
<!-- //bg effect -->
<!-- title -->
<h1>Effect Login Form</h1>
<!-- //title -->
<!-- content -->
<div class="sub-main-w3">
    <div id="app" class="form">
        <h2>Login Now
            <i class="fa fa-long-arrow-down"></i>
        </h2>
        <div class="form-style-agile">
            <label>
                <i class="fa fa-user"></i>
                用户名
            </label>
            <input v-model="loginForm.username" placeholder="Username" name="Name" type="text" required="">
        </div>
        <div class="form-style-agile">
            <label>
                <i class="fa fa-unlock-alt"></i>
                密码
            </label>
            <input v-model="loginForm.password" placeholder="Password" name="Password" type="password" required="">
        </div>
        <!-- checkbox -->
        <div class="wthree-text">
            <ul>
                <li>
                    <label class="anim">
                        <input v-model="remember" @change="changeChecked(remember)" type="checkbox" class="checkbox" required="">
                        <span>保存密码</span>
                    </label>
                </li>
                <li>
                    <a href="javascript:(window.history.go(-1))">返回</a>&nbsp;&nbsp;<span style="color: #fff">|</span>&nbsp;&nbsp;<a href="javascript:(window.location.href='/register.php')">注册</a>
                </li>
            </ul>
        </div>
        <!-- //checkbox -->
        <input type="submit" @click='login()' value="登 录">
    </div>
</div>
<!-- //content -->

<!-- copyright -->
<div class="footer">
    <p></p>
</div>
<!-- //copyright -->


<!-- effect js -->
<script src="/assets/js/canva_moving_effect.js"></script>
<!-- //effect js -->

</body>

<script type="text/javascript">
    //模拟ajax请求头
    axios.defaults.headers.post['X-Requested-With'] = 'XMLHttpRequest';
    axios.defaults.headers.get['X-Requested-With'] = 'XMLHttpRequest';



    new Vue({
        el: "#app",
        data() {
            return {
                loginForm: {
                    username: '',
                    password: '',

                },
                remember: false,
            };
        },
        mounted () {
            // 页面加载获取cookie
            this.getCookie();
            console.log(this.loginForm);
        },
        methods: {
            login() {
                let that = this;

                /*因为 axios 发送数据时不是以 formData 的形式发送的，而 php 接收的是以 formData 形式的数据。
所以只好把数据在请求之前转换一下。*/
                var params = new URLSearchParams();
                params.append('username',that.loginForm.username);
                params.append('password', that.loginForm.password);

                /*账号密码判断*/
                if (this.loginForm.username === '' || this.loginForm.password === '') {
                    layer.msg('账号密码不能为空')
                    return false;
                }
                /*// 账号密码判断*/
                console.log(that.loginForm);
                axios({
                    method: 'post',
                    url: '/login.php',
                    data:params,
                }).then(function (res) {
                    layer.msg(res.data.message);//消息提示
                    console.log(res.data);
                    if (that.remember==true){//设置cookie
                        that.setCookie(that.loginForm.username, that.loginForm.password, 7);
                    }else {
                        that.clearCookie();
                    }
                    if (res.data.code=='200'){//跳转
                        setTimeout(function () {
                            window.location.href="/index.php";
                        },2000)

                    }

                });
            },
            changeChecked(is_checked){//清楚cookie
                if (!is_checked){
                    this.clearCookie();
                }
            },
            // 设置cookie
            setCookie (cname, cpwd, exdays) {
                var d = new Date()
                d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000))
                var expires = 'expires=' + d.toGMTString()
                document.cookie = 'username' + '=' + cname + ';' + expires
                document.cookie = 'password' + '=' + cpwd + ';' + expires
            },
            // 获取cookie
            getCookie () {
                if (document.cookie.length > 0) {
                    var arr = document.cookie.split(';') // 这里显示的格式需要切割一下自己可输出看下
                    for (var i = 0; i < arr.length; i++) {
                        var arr2 = arr[i].split('=') // 再次切割
                        // 判断查找相对应的值 将cookie中的值填入页面
                        //debugger
                        if (arr2[0].trim() === 'username') {
                            this.loginForm.username = arr2[1];
                            this.remember=true;
                        } else if (arr2[0].trim() === 'password') {
                            this.loginForm.password = arr2[1]
                        }
                    }
                }
            },
            // 清除cookie
            clearCookie () {
                this.setCookie('', '', -1)
            }

        }
    });
</script>

</html>

