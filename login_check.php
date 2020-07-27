<?php
    require_once("tools.php");
    require_once("MemberInfo.php");

    $user_id = requestValue("id");
    $user_password = requestValue("password");
    $login_keep = requestValue("keep_login");

    $member_handler = new MemberInfo();
    $member = $member_handler->getMember($user_id);

    if($member && $member["password"] == $user_password) {
        //echo "로그인 성공";

        setcookie("user_id", $_REQUEST["id"], time()+5*60*60);

        if($login_keep)
        {
            setcookie("user_password", $_REQUEST["password"], time()+60*60);
        }
        else {
            setcookie("user_password", "");
        }

        header("Location: main_service.php");
    }
    else {
        errorBack("아이디 또는 비밀번호가 옳지 않습니다.");
    }
?>
