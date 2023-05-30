<?php

namespace App\Models;

use MF\Model\Model;

class Produto extends Model
{
  private $ID_Prod;
  private $marca;
  private $modelo;
  private $volume;
  private $preco;
  private $vendas;
  private $qtd_avaliacoes;
  private $avaliacao;
  private $fk_catg;

  public function __get($atributo) {
    return $this->$atributo;
  }

  public function __set($atributo, $valor) {
    $this->$atributo = $valor;
  }

  //recuperar
  public function getAll() {
    $query = "
    
    SELECT ID_Prod, marca, modelo, volume, FORMAT(preco, 2, 'pt_BR') AS valor, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) AS valor_numerico, fk_catg, img_prod 
    FROM produto 
    WHERE ID_Prod NOT IN ('16', '17', '19') 
    ORDER BY RAND() 
    LIMIT 8
    ";

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getAllProducts() {
    $query = "
    
    SELECT ID_Prod, marca, modelo, volume, FORMAT(preco, 2, 'pt_BR') AS valor, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) AS valor_numerico, fk_catg, img_prod 
    FROM produto 
    WHERE ID_Prod NOT IN ('16', '17', '19') 
    ORDER BY RAND() 
    ";

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getThreeProducts() {
    $query = "
    
    select ID_Prod, marca, modelo, volume, FORMAT(preco, 2, 'pt_BR') as valor, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) as valor_numerico, fk_catg, img_prod, Descrição, Descrição_curta
    from produto 
      WHERE ID_Prod IN ('16', '17', '19');
    ";

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }


  public function getProductId($id) {
    $query = "
    select ID_Prod, marca, modelo, volume, FORMAT(preco, 2, 'pt_BR') as valor, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) as valor_numerico, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) as valor_desc, fk_catg, img_prod, Descrição, Descrição_curta
    from produto 
      WHERE ID_Prod = :id;
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getProductBrand($id, $marca) {
    $query = "
    SELECT ID_Prod, marca, modelo, volume, FORMAT(preco, 2, 'pt_BR') AS valor, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) AS valor_numerico, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) AS valor_desc, fk_catg, img_prod, Descrição, Descrição_curta 
    FROM produto 
    WHERE marca = :marca AND ID_Prod != :id AND ID_Prod NOT IN ('16', '17', '19') 
    ORDER BY RAND() 
    LIMIT 8    
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':marca', $marca);
    $stmt->bindValue(':id', $id);

    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getAllProduct() {
    $query = "
    SELECT ID_Prod, marca, modelo, volume, FORMAT(preco, 2, 'pt_BR') AS valor, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) AS valor_numerico, fk_catg, img_prod 
    FROM produto 
    WHERE modelo LIKE :modelo
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':modelo', '%'.$this->__get('modelo').'%');
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getProductByCategory($produtoCategoria) {
    $query = "
    SELECT p.ID_Prod, p.marca, p.modelo, p.volume, FORMAT(p.preco, 2, 'pt_BR') AS valor, CAST(REPLACE(p.preco, ',', '.') AS DECIMAL(10,2)) AS valor_numerico, p.fk_catg, p.img_prod 
    FROM categoria c 
    JOIN produto p ON c.ID_Catg = p.fk_catg 
    WHERE c.nome_cat = :categoria;
    ";

    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':categoria', $produtoCategoria);

    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}