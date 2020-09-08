<?php

class DevisDetailsModel extends AbstractModel
{
    public function createDevisDetails($devisId, $quantitiesByQuestionIds, $cuisQuantitiesByQuestionIds, $pdvQuantitiesByQuestionIds)
    {
        $query = $this->pdo->prepare("
                                INSERT INTO devisdetails
								(devis_id, question_id, quantity, piece) 
								VALUES
								(:devis_id, :question_id, :quantity, :piece)
								");

        foreach ($quantitiesByQuestionIds as $questionId => $quantity) {

                $query->execute([
                    "question_id" => $questionId,
                    "devis_id" => $devisId,
                    "quantity" => $quantity,
                    "piece" => 'sdb',
                    ]);

        }

        foreach ($cuisQuantitiesByQuestionIds as $questionId => $quantity) {

            $query->execute([
                "question_id" => $questionId,
                "devis_id" => $devisId,
                "quantity" => $quantity,
                "piece" => 'cuisine',
            ]);

        }

        foreach ($pdvQuantitiesByQuestionIds as $questionId => $quantity) {

            $query->execute([
                "question_id" => $questionId,
                "devis_id" => $devisId,
                "quantity" => $quantity,
                "piece" => 'pdv',
            ]);

        }

    }


    public function findDevisDetails ($devisId)
    {

        $query = $this->pdo->prepare("
                                     SELECT pricelist.title, pricelist.description, pricelist.price, dontFurniture, quantity, (quantity * price) AS priceEach, devisdetails.piece 
                                     FROM pricelist 
                                     INNER JOIN formquestion_pricelist 
                                     ON pricelist.id = formquestion_pricelist.pricelist_id  
                                     INNER JOIN formquestion 
                                     ON formquestion_pricelist.formQuestion_id = formquestion.id 
                                     INNER JOIN devisdetails 
                                     ON devisdetails.question_id = formquestion.id 
                                     WHERE devisdetails.devis_id = :devis_id
                                     ORDER BY formquestion.category
                                     ");

        $query->execute([
            "devis_id" => $devisId,

        ]);

        return $query->fetchAll();

    }
}