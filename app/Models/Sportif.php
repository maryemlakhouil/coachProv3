<?php
namespace App\Models;

use Core\Database;
use PDO;

class Sportif {

    protected PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function getCoachs(): array {
        $sql = "
            SELECT u.id, u.nom, u.prenom, c.photo, c.biographie, c.experience
            FROM users u
            JOIN coach_profile c ON u.id = c.user_id
            WHERE u.role = 'coach'
        ";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDisponibilites(int $coachId): array {
        $sql = "
            SELECT * FROM disponibilites
            WHERE coach_id = ? AND status='libre' AND date >= CURRENT_DATE
            ORDER BY date
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$coachId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function reserverSeance(int $sportifId,int $coachId,int $availabilityId): bool {
        $check = $this->pdo->prepare(
            "SELECT id FROM disponibilites WHERE id = ? AND status='libre'"
        );
        $check->execute([$availabilityId]);
        if ($check->rowCount() === 0) return false;

        $stmt = $this->pdo->prepare(
            "INSERT INTO reservations (sportif_id, coach_id, availability_id)
             VALUES (?, ?, ?)"
        );
        $stmt->execute([$sportifId, $coachId, $availabilityId]);

        $update = $this->pdo->prepare(
            "UPDATE disponibilites SET status='reserve' WHERE id=?"
        );
        $update->execute([$availabilityId]);

        return true;
    }

    public function getReservations(int $sportifId): array {
        $sql = "
            SELECT r.id, r.status, d.date, d.heure_debut, d.heure_fin, u.nom, u.prenom
            FROM reservations r
            JOIN disponibilites d ON r.availability_id = d.id
            JOIN users u ON r.coach_id = u.id
            WHERE r.sportif_id = ?
            ORDER BY d.date
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$sportifId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function annulerReservation(int $reservationId, int $sportifId): bool {
        $stmt = $this->pdo->prepare(
            "SELECT availability_id FROM reservations WHERE id=? AND sportif_id=?"
        );
        $stmt->execute([$reservationId, $sportifId]);
        $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$reservation) return false;

        $delete = $this->pdo->prepare("DELETE FROM reservations WHERE id=?");
        $delete->execute([$reservationId]);

        $update = $this->pdo->prepare("UPDATE disponibilites SET status='libre' WHERE id=?");
        $update->execute([$reservation['availability_id']]);

        return true;
    }

    public function getDashboardStats(int $sportifId): array {
        $reserved = $this->pdo->prepare(
            "SELECT COUNT(*) FROM reservations WHERE sportif_id=? AND status='acceptee'"
        );
        $reserved->execute([$sportifId]);

        $pending = $this->pdo->prepare(
            "SELECT COUNT(*) FROM reservations WHERE sportif_id=? AND status='en_attente'"
        );
        $pending->execute([$sportifId]);

        return [
            'reserved' => (int)$reserved->fetchColumn(),
            'pending' => (int)$pending->fetchColumn()
        ];
    }
}
