<?php

class DevisModel extends AbstractModel
{



    public function findAllFormQuestions()
    {
        $rep = $this->pdo->query("SELECT formquestion.id, formquestion.title, formquestion.category
                                                FROM formquestion
                                                ");

        return  $rep->fetchAll();
    }


    public function createDevis($userId)
    {
        $query = $this->pdo->prepare("INSERT INTO devis
								(user_id, devisDate) 
								VALUES
								(:user_id, NOW())
								");

        $query->execute([
            "user_id" => $userId,
        ]);

        return $this->pdo->lastInsertId();
    }

    //enregistrement des devis pour les non authentifiés
    public function createDevisNonAuth()
    {
        $query = $this->pdo->query("INSERT INTO devis
								(devisDate) 
								VALUES
								(NOW())
								");

        return $this->pdo->lastInsertId();
    }


    public function findAllDevis($userId)
    {
        $query = $this->pdo->prepare("SELECT devisDate, id 
                                                FROM devis
                                                WHERE user_id = :user_id");
        $query->execute([
            "user_id" => $userId
        ]);

        return $query->fetchAll();
    }

    public function findDevisIDtoAddUserId($devisId, $userId)
    {
        $query = $this->pdo->prepare("UPDATE devis
                                                SET                                     
                                                user_id = :user_id
                                                WHERE 
                                                id = :id");
        $query->execute([
            "id" => $devisId,
            "user_id" => $userId,
        ]);
    }
    
}


