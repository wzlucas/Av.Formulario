<?php

require_once("model/Personagem.php");
require_once("util/Conexao.php");

class PersonagemDAO
{
    public function inserirPersonagem(Personagem $personagem)
    {
        $sql = "INSERT INTO personagens (nome, genero, filiacao, recompensa, origem, akuma_no_mi, imagem_url)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $con = Conexao::getCon();

        $stm = $con->prepare($sql);

        $stm->execute([
            $personagem->getNome(),
            $personagem->getGenero(),
            $personagem->getFiliacao(),
            $personagem->getRecompensa(),
            $personagem->getOrigem(),
            $personagem->getAkumaNoMi(),
            $personagem->getImagemUrl()
        ]);
    }

    public function listarPersonagens()
    {
        $sql = "SELECT * FROM personagens ORDER BY id DESC";

        $con = Conexao::getCon();
        $stm = $con->prepare($sql);
        $stm->execute();

        $registros = $stm->fetchAll();
        return $this->mapPersonagem($registros);
    }

    public function buscarPorId(int $id)
    {
        $con = Conexao::getCon();
        $sql = "SELECT * FROM personagens WHERE id = ?";

        $stm = $con->prepare($sql);
        $stm->execute([$id]);

        $registros = $stm->fetchAll();
        $personagens = $this->mapPersonagem($registros);

        if (count($personagens) > 0) {
            return $personagens[0];
        }

        return null;
    }

    private function mapPersonagem(array $registros)
    {
        $personagens = array();

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

            array_push($personagens, $personagem);
        }

        return $personagens;
    }
}
