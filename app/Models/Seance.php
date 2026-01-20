<?php

namespace App\Models;

use PDO;

class Seance
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /* ==========================
       1. Ajouter une séance
    ========================== */
    public function ajouterSeance(
        int $coachId,
        string $date,
        string $heureDebut,
        string $heureFin
    ): bool {
        $sql = "
            INSERT INTO disponibilites
            (coach_id, date, heure_debut, heure_fin, status)
            VALUES (?, ?, ?, ?, 'libre')
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$coachId, $date, $heureDebut, $heureFin]);
    }

    /* ==========================
       2. Modifier une séance
    ========================== */
    public function modifierSeance(
        int $seanceId,
        int $coachId,
        string $date,
        string $heureDebut,
        string $heureFin
    ): bool {
        $sql = "
            UPDATE disponibilites
            SET date = ?, heure_debut = ?, heure_fin = ?
            WHERE id = ? AND coach_id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $date,
            $heureDebut,
            $heureFin,
            $seanceId,
            $coachId
        ]);
    }

    /* ==========================
       3. Supprimer une séance
    ========================== */
    public function supprimerSeance(int $seanceId, int $coachId): bool
    {
        $sql = "
            DELETE FROM disponibilites
            WHERE id = ? AND coach_id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$seanceId, $coachId]);
    }

    /* ==========================
       4. Séances d’un coach
    ========================== */
   
    public function getSeanceParCoach(int $coachId){
        $sql = "
            SELECT *
            FROM disponibilites
            WHERE coach_id = ?
            ORDER BY date, heure_debut
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$coachId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSeancesDisponibles(){
        $sql = "
            SELECT d.*, u.nom, u.prenom
            FROM disponibilites d
            JOIN users u ON d.coach_id = u.id
            WHERE d.status = 'libre'    
            AND d.date >= CURDATE()
            ORDER BY d.date, d.heure_debut
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
