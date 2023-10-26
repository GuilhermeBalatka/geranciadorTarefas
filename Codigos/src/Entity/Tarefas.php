<?php

namespace App\Entity;

use App\Repository\TarefasRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TarefasRepository::class)
 */
class Tarefas
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $descricao;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $prazo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $prioridade;

    /**
     * @ORM\Column(type="boolean", nullable=true) // Adicione a propriedade "concluida"
     */
    private $concluida; // Adicione a propriedade "concluida"

    /**
     * @ORM\OneToMany(targetEntity=Anexo::class, mappedBy="tarefa", orphanRemoval=true)
     */
    private $anexos;

    public function __construct()
    {
        $this->anexos = new ArrayCollection();
    }

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

    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getPrazo(): ?\DateTimeInterface
    {
        return $this->prazo;
    }

    public function setPrazo(?\DateTimeInterface $prazo): self
    {
        $this->prazo = $prazo;

        return $this;
    }

    public function getPrioridade(): ?string
    {
        return $this->prioridade;
    }

    public function setPrioridade(?string $prioridade): self
    {
        $this->prioridade = $prioridade;

        return $this;
    }

    public function isConcluida(): ?bool // Método para verificar se a tarefa está concluída
    {
        return $this->concluida;
    }

    public function setConcluida(?bool $concluida): self // Método para definir se a tarefa está concluída
    {
        $this->concluida = $concluida;

        return $this;
    }

    /**
     * @return Collection|Anexo[]
     */
    public function getAnexos(): Collection
    {
        return $this->anexos;
    }

    public function addAnexo(Anexo $anexo): self
    {
        if (!$this->anexos->contains($anexo)) {
            $this->anexos[] = $anexo;
            $anexo->setTarefa($this);
        }

        return $this;
    }

    public function removeAnexo(Anexo $anexo): self
    {
        if ($this->anexos->removeElement($anexo)) {
            if ($anexo->getTarefa() === $this) {
                $anexo->setTarefa(null);
            }
        }

        return $this;
    }
}
