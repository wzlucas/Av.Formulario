<?php

class Personagem {
    private $id;
    private $nome;
    private $genero;
    private $filiacao;
    private $recompensa;
    private $origem;
    private $akumaNoMi;
    private $imagemUrl;

    public function __construct($nome, $genero, $filiacao, $recompensa, $origem, $akumaNoMi, $imagemUrl = null) {
        $this->nome = $nome;
        $this->genero = $genero;
        $this->filiacao = $filiacao;
        $this->recompensa = $recompensa;
        $this->origem = $origem;
        $this->akumaNoMi = $akumaNoMi;
        $this->imagemUrl = $imagemUrl;
    }

 
    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     */
    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of nome
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome($nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of genero
     */
    public function getGenero()
    {
        return $this->genero;
    }

    /**
     * Set the value of genero
     */
    public function setGenero($genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    /**
     * Get the value of filiacao
     */
    public function getFiliacao()
    {
        return $this->filiacao;
    }

    /**
     * Set the value of filiacao
     */
    public function setFiliacao($filiacao): self
    {
        $this->filiacao = $filiacao;

        return $this;
    }

    /**
     * Get the value of recompensa
     */
    public function getRecompensa()
    {
        return $this->recompensa;
    }

    /**
     * Set the value of recompensa
     */
    public function setRecompensa($recompensa): self
    {
        $this->recompensa = $recompensa;

        return $this;
    }

    /**
     * Get the value of origem
     */
    public function getOrigem()
    {
        return $this->origem;
    }

    /**
     * Set the value of origem
     */
    public function setOrigem($origem): self
    {
        $this->origem = $origem;

        return $this;
    }

    /**
     * Get the value of akumaNoMi
     */
    public function getAkumaNoMi()
    {
        return $this->akumaNoMi;
    }

    /**
     * Set the value of akumaNoMi
     */
    public function setAkumaNoMi($akumaNoMi): self
    {
        $this->akumaNoMi = $akumaNoMi;

        return $this;
    }

    /**
     * Get the value of imagemUrl
     */
    public function getImagemUrl()
    {
        return $this->imagemUrl;
    }

    /**
     * Set the value of imagemUrl
     */
    public function setImagemUrl($imagemUrl): self
    {
        $this->imagemUrl = $imagemUrl;

        return $this;
    }
}
