<?php
require_once('config.php');

class User
{
    public $name, $email, $mobile, $role, $created_by;
    private $password;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function setpassword($password)
    {
        if (!empty($password)) $this->password = md5($password);
    }

    public function create()
    {
        if ($this->validateCreate()) {
            try {
                $connect = pdo_connect();
                $statement = $connect->prepare("INSERT INTO `users`(`name`, `email`, `password`, `mobile`, `role`) VALUES (:name,:email,:password,:mobile,:role)");
                $statement->bindValue('name', $this->name);
                $statement->bindValue('email', $this->email);
                $statement->bindValue('password', $this->password);
                $statement->bindValue('mobile', $this->mobile);
                $statement->bindValue('role', $this->role);
                $statement->execute();
                $connect = null;
                return true;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        } else {
            return false;
        }
    }

    private function validateCreate()
    {
        if (empty($this->password)) {
            return false;
        } else {
            return true;
        }
    }

    public static function destroy($id)
    {
        try {
            $connect = pdo_connect();
            $statement = $connect->prepare("DELETE FROM `users` WHERE id = :id");
            $statement->bindValue('id', $id);
            $statement->execute();
            $connect = null;
            return true;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function find($id)
    {
        try {
            $connect = pdo_connect();
            $statement = $connect->prepare("SELECT * FROM `users` WHERE id = :id");
            $statement->bindValue('id', $id);
            $statement->execute();
            $connect = null;
            if ($user = $statement->fetchObject()) {
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public static function all()
    {
        try {
            $users = [];
            $connect = pdo_connect();
            $statement = $connect->prepare("SELECT * FROM `users` ");
            $statement->execute();
            $connect = null;
            while ($user = $statement->fetchObject()) {
                $users[] = $user;
            }
            return $users;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function update($id)
    {
        if ($this->validateUpdate()) {
            try {
                $users = [];
                $connect = pdo_connect();
                $statement = $connect->prepare("UPDATE `users` SET `name`=:name,`email`=:email,`mobile`=:mobile,`role`=:role WHERE id = :id");
                $statement->bindValue('id', $id);
                $statement->bindValue('name', $this->name);
                $statement->bindValue('email', $this->email);
                $statement->bindValue('mobile', $this->mobile);
                $statement->bindValue('role', $this->role);
                $statement->execute();
                $connect = null;
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        } else {
            echo "err";
        }
    }

    public function validateUpdate()
    {
        if (empty($this->name)) {
            return false;
        } else {
            return true;
        }
    }
}
