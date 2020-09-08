<?php

class UserModel extends AbstractModel

{

    public function create($pwdClear, $name, $forname, $numTel, $email)
    {
        $query = $this->pdo->prepare("
        INSERT INTO user
        (pwd, name,  forname,  numTel, email, signInDate)
        VALUES
        (:pwd, :name, :forname, :numTel, :email, NOW())
        ");


        try
        {

            $query->execute([
                "pwd" => password_hash($pwdClear, PASSWORD_DEFAULT),
                "name" => $name,
                "forname" => $forname,
                "numTel" => $numTel,
                "email" => $email,
            ]);

            return $this->pdo->lastInsertId() ;
        }
        catch (Exception $e)
        {
            if($e->getCode() == 23000)
            {
                throw new DomainException("Email déjà pris") ;
            }
            else
            {
                throw $e ;
            }
        }
    }




    public function findUserAndCheckPassword($email, $pwd)
    {



        $query = $this->pdo->prepare("SELECT *
                                               FROM user 
                                               WHERE email= :email");


        $query->execute(["email" => $email]);
        $user = $query->fetch();



        if(!$user)
        {
            throw new DomainException("there is no user with this e-mail") ;
        }
        else
        {
            if (!password_verify($pwd, $user["pwd"]))
            {
                throw new DomainException("mot de passe invalide");
            }

            return $user;
        }
    }


    public function findUser($email)
    {
        $query = $this->pdo->prepare("SELECT id
                                               FROM user 
                                               WHERE email= :email");


        $query->execute(["email" => $email]);
        return $userId = $query->fetch();

    }
}



