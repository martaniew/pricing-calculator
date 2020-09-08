<?php

class PricelistModel extends AbstractModel
{
    public function create($title, $description, $price, $bym2, $dontFurniture)
    {
        $query = $this->pdo->prepare("
                                INSERT INTO pricelist
								(title, description,  price, bym2, dontFurniture) 
								VALUES
								(:title, :description, :price, :bym2, :dontFurniture)
								");

        $query->execute([
            "title" => $title,
            "description" => $description,
            "price" => $price,
            "bym2" => $bym2,
            "dontFurniture" => $dontFurniture,
        ]);

        return $this->pdo->lastInsertId() ;
    }

    public function displayAllToMakePriceList()
    {
        $query =$this->pdo->query("SELECT *
                                             FROM pricelist 
                                             ORDER BY title" );

        return $query->fetchAll();
    }
    public function findPrices($questionIds)
    {
        $query = $this->pdo->prepare("
                                SELECT price
                                FROM formquestion_pricelist
                                INNER JOIN pricelist
                                ON `pricelist_id` = pricelist.id 
                                AND FormQuestion_id = :FormQuestionId
                                INNER JOIN formquestion
                                ON `FormQuestion_id` = formquestion.id");

        foreach ($questionIds as $questionId)
        {
            $query->execute([
                "FormQuestionId" => $questionId
            ]);
        }

        return $query->fetchAll();

    }


    public function findCheckedPriceElements($questionId)
    {

        $query = $this->pdo->prepare("SELECT pricelist.id, (pricelist_id IS NOT NULL) AS isChecked, pricelist.title
                                                FROM pricelist
                                                LEFT JOIN formquestion_pricelist ON pricelist.id = formquestion_pricelist.pricelist_id
                                                AND FormQuestion_id = :id 
                                                ORDER BY title");

        $query->execute([
            "id" => $questionId,
        ]);

        return $query->fetchAll() ;
    }


    public function findScalarPriceIdsInQuestion($id) {

        $query = $this->pdo->prepare("SELECT    pricelist_id
                                                FROM formquestion_pricelist
                                                WHERE formQuestion_id = :formQuestion_id");

        $query->execute([
            "formQuestion_id" => $id
        ]);

        return $query->fetchAll(PDO::FETCH_COLUMN) ;

    }


    public function findAll() {
        $rep = $this->pdo->query("SELECT pricelist.id, pricelist.description, pricelist.category, pricelist.price, pricelist.dontFurniture, pricelist.bym2, pricelist.title
                                  FROM pricelist
                                  ORDER BY pricelist.title"); 

                                  return $rep->fetchAll(); 
    }


    public function find($id) {

        $query = $this->pdo->prepare("SELECT * 
                                      FROM pricelist
                                      WHERE id = :id"); 


        $query->execute([
            "id" => $id
        ]); 

        return $query->fetch(); 

    }

    public function update($id, $title, $description,  $bym2, $dontFurniture, $price) {

        $query = $this->pdo->prepare("UPDATE pricelist
                                      SET
                                      title = :title,
                                      description = :description,
                                      bym2 = :bym2, 
                                      dontFurniture = :dontFurniture, 
                                      price = :price
                                      WHERE id = :id"); 

        $query->execute([
            "title" => $title, 
            "description" => $description, 
            "bym2" => $bym2, 
            "dontFurniture" => $dontFurniture, 
            "price" => $price, 
            'id' => $id, 
        ]);                               

    }

    public function delate($id)
    {
        $query = $this->pdo->prepare("DELETE FROM pricelist
                                      WHERE id = :id"); 
        $query->execute([
                             'id' => $id, 
                        ]);                               
    }
}


