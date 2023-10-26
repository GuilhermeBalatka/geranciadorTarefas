<?php

namespace App\Entity;

use App\Repository\AnexoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Tarefas;

/**
 * @ORM\Entity(repositoryClass=AnexoRepository::class)
 */
class Anexo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $arquivo;

    /**
     * @ORM\ManyToOne(targetEntity=Tarefas::class)
     * @ORM\JoinColumn(name="tarefa_id", referencedColumnName="id")
     */
    private $tarefa;
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    public function getArquivo(): ?string
    {
        return $this->arquivo;
    }

    public function setArquivo(?string $arquivo): self
    {
        $this->arquivo = $arquivo;

        return $this;
    }

    public function getTarefa(): ?Tarefas
    {
        return $this->tarefa;
    }

    public function setTarefa(?Tarefas $tarefa): self
    {
        $this->tarefa = $tarefa;

        return $this;
    }

    
    public function getFilePath(): ?string
    {
        return $this->arquivo; 
    }
}
