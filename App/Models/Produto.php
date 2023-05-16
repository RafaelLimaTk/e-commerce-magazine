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
    
    select ID_Prod, marca, modelo, volume, FORMAT(preco, 2, 'pt_BR') as valor, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) as valor_numerico, fk_catg, img_prod from produto LIMIT 8;
    ";

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }

  public function getThreeProducts() {
    $query = "
    
    select ID_Prod, marca, modelo, volume, FORMAT(preco, 2, 'pt_BR') as valor, CAST(REPLACE(preco, ',', '.') AS DECIMAL(10,2)) as valor_numerico, fk_catg, img_prod, Descrição
    from produto 
      WHERE ID_Prod IN ('16', '17', '19');
    ";

    $stmt = $this->db->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
  }
}