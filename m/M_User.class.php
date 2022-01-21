<?
class M_User {
	function auth($login, $pass){
        $sql = "select id, usergroup from users where login='$login' and pass='$pass'";
        $data = MPDO::getRow($sql);
        if($data){
             $_SESSION['id_user'] = $data['id'];
             M_Cart::addFromCookie($data['id']);
             if($data['usergroup'] == 'admin'){
                $_SESSION['admin'] = true;
            }
        return true;
        } else {
            return false;
        }
    }

    public static function pass ($name, $password) {
        return strrev(md5($name)) . md5($password);

    }

    public static function getUsername($userId){
        $sql = "SELECT `login` FROM `users` WHERE `id`='$userId'";
        $data = MPDO::getRow($sql);
        return $data['login'];
    }

    function regUser ($name, $login, $pass) {
        $sql = "SELECT * FROM users WHERE login = '$login'";
        $user = MPDO::getRow($sql);
        if (!$user) {
            $sql = "INSERT INTO users VALUES (null, '$login', '$pass', 'user')";
            MPDO::insert($sql);
            return true;
        } else {
            return false;
        }
    }
}