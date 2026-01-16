<?php
namespace App\Models;

use Core\Database;
use PDO;

class Coach{

    protected PDO $pdo;

    public function __construct(){

        $this->pdo = Database::getInstance();
    }

    /* 
       PROFIL COACH
    */

    public function getProfile(int $userId): array|null{

        $stmt = $this->pdo->prepare(
            "SELECT * FROM coach_profile WHERE user_id = ?"
        );
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createProfileIfNotExists(int $userId): void {

        $stmt = $this->pdo->prepare(
            "INSERT INTO coach_profile (user_id) VALUES (?)
             ON CONFLICT (user_id) DO NOTHING"
        );
        $stmt->execute([$userId]);
    }

    public function updateProfile(int $userId,string $biographie,int $experience,string $photo,string $certification): bool {

        $stmt = $this->pdo->prepare(
            "UPDATE coach_profile
             SET biographie = ?, experience = ?, photo = ?, certification = ?
             WHERE user_id = ?"
        );
        return $stmt->execute([$biographie,$experience,$photo,$certification,$userId]);
    }

    /* 
       DISPONIBILITÉS DE COACH 
    */

    public function AjoutDisponibilite(int $coachId,string $date,string $heureDebut,string $heureFin): bool {

        $stmt = $this->pdo->prepare(
            "INSERT INTO disponibilites
             (coach_id, date, heure_debut, heure_fin, status)
             VALUES (?, ?, ?, ?, 'libre')"
        );
        return $stmt->execute([ $coachId, $date, $heureDebut, $heureFin]);
    }

    public function getDisponibilites(int $coachId): array{

        $stmt = $this->pdo->prepare(
            "SELECT *
             FROM disponibilites
             WHERE coach_id = ?
             ORDER BY date, heure_debut"
        );
        $stmt->execute([$coachId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function SuprimeDisponibilite(int $dispoId, int $coachId): bool{

        $check = $this->pdo->prepare(
            "SELECT COUNT(*) FROM reservations WHERE availability_id = ?"
        );
        $check->execute([$dispoId]);

        if ($check->fetchColumn() > 0) {
            return false;
        }

        $stmt = $this->pdo->prepare(
            "DELETE FROM disponibilites WHERE id = ? AND coach_id = ?"
        );
        return $stmt->execute([$dispoId, $coachId]);
    }

    /* 
       RÉSERVATIONS
    */

    public function getReservations(int $coachId, string $status): array {

        $stmt = $this->pdo->prepare(
            "SELECT r.*, u.nom, u.prenom, d.date, d.heure_debut, d.heure_fin
             FROM reservations r
             JOIN users u ON r.sportif_id = u.id
             JOIN disponibilites d ON r.availability_id = d.id
             WHERE r.coach_id = ? AND r.status = ?
             ORDER BY d.date"
        );
        $stmt->execute([$coachId, $status]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function ModifierReservationStatus(int $reservationId,int $coachId,string $status): bool {

        $stmt = $this->pdo->prepare(
            "UPDATE reservations
             SET status = ?
             WHERE id = ? AND coach_id = ?"
        );
        return $stmt->execute([$status, $reservationId, $coachId]);
    }

    /*
       DASHBOARD
    */

    public function getDashboardStats(int $coachId): array{

        $pending = $this->pdo->prepare(
            "SELECT COUNT(*) FROM reservations
             WHERE coach_id = ? AND status = 'en_attente'"
        );
        $pending->execute([$coachId]);

        $today = $this->pdo->prepare(
            "SELECT COUNT(*)
             FROM reservations r
             JOIN disponibilites d ON r.availability_id = d.id
             WHERE r.coach_id = ?
             AND r.status = 'acceptee'
             AND d.date = CURRENT_DATE"
        );
        $today->execute([$coachId]);

        $next = $this->pdo->prepare(
            "SELECT u.nom, u.prenom, d.date, d.heure_debut, d.heure_fin
             FROM reservations r
             JOIN users u ON r.sportif_id = u.id
             JOIN disponibilites d ON r.availability_id = d.id
             WHERE r.coach_id = ?
             AND r.status = 'acceptee'
             AND d.date >= CURRENT_DATE
             ORDER BY d.date, d.heure_debut
             LIMIT 1"
        );
        $next->execute([$coachId]);

        return [
            'pending' => (int)$pending->fetchColumn(),
            'today'  => (int)$today->fetchColumn(),
            'next'   => $next->fetch(PDO::FETCH_ASSOC)
        ];
    }
}


