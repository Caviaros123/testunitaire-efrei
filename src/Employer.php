<?php

namespace Prince\Testunit;

class Employer
{
    private string $nom;
    private float $salaire;
    private string $poste;
    private int $anneesExperience;
    public function __construct(string $nom, float $salaire, string $poste, int $anneesExperience)
    {
        $this->nom = $nom;
        $this->salaire = $salaire;
        $this->poste = $poste;
        $this->anneesExperience = $anneesExperience;
    }
    public function getNom(): string
    {
        return $this->nom;
    }
    public function getSalaire(): float
    {
        return $this->salaire;
    }
    public function getPoste(): string
    {
        return $this->poste;
    }
    public function getAnneesExperience(): int
    {
        return $this->anneesExperience;
    }
    public function augmenterSalaire(float $pourcentage): void
    {
        if ($pourcentage > 0) {
            $this->salaire += $this->salaire * ($pourcentage / 100);
        }
    }
    public function promotion(string $nouveauPoste, float $augmentation): void
    {
        $this->poste = $nouveauPoste;
        $this->augmenterSalaire($augmentation);
    }
}
