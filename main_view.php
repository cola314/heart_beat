<!DOCTYPE html>
<html>
<head>
    <title>Heart Beat Web Service</title>
    <meta charset="utf-8">
    <style type="text/css">
       a:link { color: black; text-decoration: none;}
       a:visited { color: black; text-decoration: none;}
       a:hover { color: black; text-decoration: underline;}

       h1 {
          margin : 20px auto 0px auto;
       }

       .main {
           width : 50%;
           margin : 0px auto;
       }

       @media screen and (max-width: 1024px) {
           .main{
               width : 90%;
               margin : 0px auto;
            }
        }

       legend {
          margin-left : 20px;
       }

       fieldset {
          border-color: #000;
          border-style: solid;
       }


       input[type="checkbox"]
       {
         vertical-algin : middle;
       }

       input[type="text"]
       {
          padding-left:5%;
          width: 95%;
          height: 10vh;
          margin-bottom: 10px;
          font-size : 24px;
       }

       input[type="password"]
       {
          padding-left:5%;
          width: 95%;
          height: 10vh;
          margin-bottom: 10px;
          font-size : 24px;
       }

       li {
          list-style: none
       }

       #submit {
         width: 100%;
         height: 10vh;
         margin-top : 20px;
         margin-bottom: 10px;
         font-size : 20px;
       }
    </style>
</head>
<body>

<?php
    if(isset($_COOKIE["user_id"]) && isset($_COOKIE["user_password"]))
    {
        require_once("tools.php");
        require_once("MemberInfo.php");

        $user_id = $_COOKIE["user_id"];
        $user_password = $_COOKIE["user_password"];

        $member_handler = new MemberInfo();
        $member = $member_handler->getMember($user_id);

        if($member && $member["password"] == $user_password) {
            //echo "로그인 성공";
            setcookie("user_id", $_COOKIE["user_id"], time()+5*60*60);
            header("Location: main_service.php");
        }
    }
?>

    <div class="header">
        <center>
            <h1>Heart Beat</h1>
        </center>
    </div>
    <div class="main">
        <form action="login_check.php" method="post">
            <fieldset>
                <legend><h2>로그인</h2></legend>
                <input type="text" name="id" placeholder="아이디"/>
                <br/>
                <input type="password" name="password" placeholder="비밀번호"/>
                <br/>
                <input type="submit" id="submit" value="로그인"/>
                <br/>
                <li>
                  <input type="checkbox" name="keep_login"/>
                  <label for="checkbox">로그인 상태 유지</label>
                </li>
            </fieldset>
        </form>
    </div>
    <div>
        <center>
            <p><a href = "">아이디 찾기</a> | <a href="">비밀번호 찾기</a> | <a href="register_view.php">회원가입</a></p>
        </center>
    </div>
</body>
</html>
