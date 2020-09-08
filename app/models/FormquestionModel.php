<?php

class FormquestionModel extends AbstractModel

{

    public function create($title, $category)
    {
        $query = $this->pdo->prepare("
                                INSERT INTO formquestion
								(title, category) 
								VALUES
								(:title, :category)
								");

        $query->execute([
            "title" => $title,
            "category" => $category,
        ]);

        return $this->pdo->lastInsertId();
    }




    public function addPriceAndQuestion($questionId, $priceIds)
    {

        $query = $this->pdo->prepare("
                                INSERT INTO formquestion_pricelist
								(pricelist_id, formquestion_id) 
								VALUES
								(:pricelist_id, :formquestion_id)
								");

        foreach ($priceIds as $priceId) {
            $query->execute([
                "pricelist_id" => $priceId,
                "formquestion_id" => $questionId,
            ]);
        }

    }


    public function find($id) {
        $query = $this->pdo->prepare("SELECT id, title, category
                                      FROM formquestion
                                      WHERE id= :id"); 

        $query->execute(["id" => $id]);
        return $query->fetch();                               

    }


    public function update($id, $title, $question)
    {
        $query =$this->pdo->prepare("UPDATE formquestion 
                                                SET 
                                                    title = :title,
                                                    question = :question
                                                WHERE id = :id");
        $query->execute([
            "title" => $title,
            "question" => $question, 
            "id" => $id
        ]);
    }


    public function removePrices($question_id, $pricesToRemove)
    {
        $query= $this->pdo->prepare("
                                    DELETE FROM formquestion_pricelist
                                    WHERE formquestion_id = :formquestion_id
                                    AND pricelist_id = :pricelist_id
                                    ");

        foreach ($pricesToRemove as $priceToRemove )
        {

            $query->execute([
                "formquestion_id" => $question_id,
                "pricelist_id" => $priceToRemove,
            ]);
        }
    }

    public function addPrices ($id, $priceIds) 
    {
        $query = $this->pdo->prepare("
                                     INSERT INTO formquestion_pricelist
                                     (formquestion_id, pricelist_id)
                                     VALUES
                                     (:formquestion_id, :pricelist_id)
                                     ON DUPLICATE KEY UPDATE 
                                     pricelist_id = :pricelist_id,
                                     formquestion_id = :formquestion_id
								     ");

        foreach ($priceIds as $priceId) {
            $query->execute([
                "formquestion_id" => $id, 
                "pricelist_id" => $priceId, 
            ]); 
        }

    }

    public function findAllByPrice () {

        $rep = $this->pdo->query("SELECT id, title, category, pricelist_id
                                  FROM formquestion_pricelist
                                  LEFT JOIN formquestion ON  formquestion_pricelist.formquestion_id = formquestion.id
                                  ORDER BY pricelist_id" ); 

                                  return $rep ->fetchAll(); 

    }

    public function delate($id)
    {
        $query = $this->pdo->prepare("DELETE FROM formquestion
                                      WHERE id = :id"); 
        $query->execute([
                             'id' => $id, 
                        ]);                               
    }

}


