<?
class M_User {
	function auth($login,$pass,$db){
        $sql = "select id, usergroup from users where login='$login' and pass = '$pass'";
        $res = $db->query($sql);
        $data = $res->fetch();
        if($data){
             $_SESSION['id_user'] = $data['id'];
             if($data['usergroup'] == 'admin'){
                $_SESSION['admin'] = true;
            }
        return true;
        } else {
            return false;
        }
    }

    function getUsername($db){
        $sql = "SELECT `login` FROM `users` WHERE `id`={$_SESSION['id_user']}";
        $res = $db->query($sql);
        $data = $res->fetch();
        return $data['login'];
    }
}