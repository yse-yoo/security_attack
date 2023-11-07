<?php
require_once("Model.php");
class User extends Model
{
    public static function authUser()
    {
        if (!empty($_SESSION['auth_user'])) {
            return $_SESSION['auth_user'];
        }
    }

    public static function userIcon($id)
    {
        $iconFile = "{$id}.png";
        $iconFilePath = BASE_DIR . "/images/user_icon/{$iconFile}";
        if (file_exists($iconFilePath)) {
            return $iconFile;
        } else {
            return "me.png";
        }
    }

    /**
     * ユーザ認証（Authorize)
     * @param string $email
     * @param string $password
     * @return array $user
     */
    public function auth($email, $password)
    {
        if ($user = $this->findByEmail($email)) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }
    }

    /**
     * Emailでユーザ検索
     * @param string $email
     * @return array $user
     */
    public function findByEmail($email)
    {
        // Emailでユーザ検索するSQL
        $sql = 'SELECT * FROM users WHERE email = "' . $email . '";';

        $stmt = $this->pdo->query($sql);
        $this->value = $stmt->fetch(PDO::FETCH_ASSOC);
        return $this->value;
    }

    public function insert($data)
    {
        //パスワードをHash化
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        //usersにデータを挿入するSQL
        $sql = "INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)";
        $stmt = $this->pdo->prepare($sql);
        //MySQLに実行
        return $stmt->execute($data);
    }

}