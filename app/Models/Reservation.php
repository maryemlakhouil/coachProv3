<?php
namespace App\Models;

use PDO;

class Reservation
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function reserver(int $sportifId, int $coachId, int $seanceId): bool
    {
        // Vérifier que la séance est libre
        $check = $this->pdo->prepare("
            SELECT id
            FROM disponibilites
            WHERE id = ? AND coach_id = ? AND status = 'libre'
        ");
        $check->execute([$seanceId, $coachId]);

        if ($check->rowCount() === 0) {
            return false;
        }

        // Créer la réservation
        $insert = $this->pdo->prepare("
            INSERT INTO reservations (sportif_id, coach_id, availability_id, status)
            VALUES (?, ?, ?, 'en_attente')
        ");
        $success = $insert->execute([$sportifId, $coachId, $seanceId]);

        if ($success) {
            // Marquer la séance comme réservée
            $update = $this->pdo->prepare("
                UPDATE disponibilites SET status = 'reserve' WHERE id = ?
            ");
            $update->execute([$seanceId]);
        }

        return $success;
    }

    
    public function getBySportif(int $sportifId): array
    {
        $sql = "
            SELECT r.*, d.date, d.heure_debut, d.heure_fin,
                   u.nom, u.prenom
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

   
    public function getByCoach(int $coachId, ?string $status = null): array
    {
        $sql = "
            SELECT r.*, d.date, d.heure_debut, d.heure_fin,
                   u.nom, u.prenom
            FROM reservations r
            JOIN disponibilites d ON r.availability_id = d.id
            JOIN users u ON r.sportif_id = u.id
            WHERE r.coach_id = ?
        ";

        if ($status !== null) {
            $sql .= " AND r.status = ?";
        }

        $sql .= " ORDER BY d.date";

        $stmt = $this->pdo->prepare($sql);

        if ($status !== null) {
            $stmt->execute([$coachId, $status]);
        } else {
            $stmt->execute([$coachId]);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

   
    public function changerStatut(int $reservationId, int $coachId, string $status): bool
    {
        $sql = "
            UPDATE reservations
            SET status = ?
            WHERE id = ? AND coach_id = ?
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$status, $reservationId, $coachId]);
    }

    public function annuler(int $reservationId, int $sportifId): bool
    {
        // Récupérer la séance liée
        $stmt = $this->pdo->prepare("
            SELECT availability_id
            FROM reservations
            WHERE id = ? AND sportif_id = ?
        ");
        $stmt->execute([$reservationId, $sportifId]);
        $res = $stmt->fetch();

        if (!$res) {
            return false;
        }

        // Annuler la réservation
        $update = $this->pdo->prepare("
            UPDATE reservations
            SET status = 'annulee'
            WHERE id = ?
        ");
        $update->execute([$reservationId]);

        // Remettre la séance libre
        $this->pdo->prepare("
            UPDATE disponibilites
            SET status = 'libre'
            WHERE id = ?
        ")->execute([$res['availability_id']]);

        return true;
    }

  // Nombre de réservations confirmées pour un utilisateur
public function countReservedByUser(int $userId): int
{
    // Ici "acceptee" correspond à confirmée
    $stmt = $this->pdo->prepare(
        "SELECT COUNT(*) as total FROM reservations WHERE sportif_id = ? AND status = 'acceptee'"
    );
    $stmt->execute([$userId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'] ?? 0;
}

// Nombre de réservations en attente pour un utilisateur
public function countPendingByUser(int $userId): int
{
    // Ici "en_attente" correspond à pending
    $stmt = $this->pdo->prepare(
        "SELECT COUNT(*) as total FROM reservations WHERE sportif_id = ? AND status = 'en_attente'"
    );
    $stmt->execute([$userId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'] ?? 0;
}


public function getCoachs(): array
{
    $sql = "
        SELECT u.id, u.prenom, u.nom,
               c.experience, c.biographie
        FROM users u
        LEFT JOIN coach_profile c ON u.id = c.user_id
        WHERE u.role = 'coach'
    ";

    $stmt = $this->pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



}
?>
