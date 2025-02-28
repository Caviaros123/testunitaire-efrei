<?php

namespace Prince\Testunit;


class Entreprise
{
    private string $nom;
    private array $employes = [];
    public function __construct(string $nom)
    {
        $this->nom = $nom;
    }
    public function ajouterEmploye(Employer $employe): void
    {
        $this->employes[] = $employe;
    }
    public function nombreEmployes(): int
    {
        return count($this->employes);
    }
    public function salaireTotal(): float
    {
        return array_reduce($this->employes, fn($total, $e) => $total + $e->getSalaire(), 0);
    }
    public function augmenterSalaires(float $pourcentage): void
    {
        foreach ($this->employes as $employe) {
            $employe->augmenterSalaire($pourcentage);
        }
    }
    public function getNom(): string
    {
        return $this->nom;
    }
    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }
    public function getEmployes(): array
    {
        return $this->employes;
    }
    public function setEmployes(array $employes): void
    {
        $this->employes = $employes;
    }
}
