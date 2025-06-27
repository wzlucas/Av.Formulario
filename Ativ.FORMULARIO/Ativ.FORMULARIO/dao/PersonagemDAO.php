<?php

require_once("model/Personagem.php");
require_once("util/Conexao.php");

class PersonagemDAO
{

    // Método que retorna todos os personagens cadastrados no banco
    public function listarPersonagens()
    {
        $con = Conexao::getCon();
        $sql = "SELECT * FROM personagens ORDER BY id DESC";
;
        $stm = $con->prepare($sql);
        $stm->execute();

        $registros = $stm->fetchAll();

        // Transforma os registros em objetos do tipo Personagem
        return $this->mapPersonagem($registros);
    }

    // Método para buscar um personagem específico pelo ID
    public function buscarPorId(int $id)
    {
        $con = Conexao::getCon();
        $sql = "SELECT * FROM personagens WHERE id = ?";

        $stm = $con->prepare($sql);
        $stm->execute([$id]);

        // Pega todos os dados retornados
        $registros = $stm->fetchAll();

        // Transforma os registros do banco em objetos Personagem
        $personagens = $this->mapPersonagem($registros);

        // Retorna apenas o primeiro (pois o ID é único)
        if (count($personagens) > 0) {
            return $personagens[0];
        }

        return null;
    }

    // Método auxiliar que transforma os dados vindos do banco em objetos Personagem
    private function mapPersonagem(array $registros)
    {
        $personagens = array();

        // Para cada registro (linha do banco), cria um objeto e preenche os dados
        foreach ($registros as $reg) {
            $personagem = new Personagem(
                $reg['nome'],
                $reg['genero'],
                $reg['filiacao'],
                $reg['recompensa'],
                $reg['origem'],
                $reg['akuma_no_mi'],
                $reg['imagem_url']
            );
            $personagem->setId($reg['id']); 

            array_push($personagens, $personagem); // Adiciona o objeto à lista
        }

        return $personagens;
    }
}
