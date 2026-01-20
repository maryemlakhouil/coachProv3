<?php

require_once __DIR__ . '/../core/Security.php';
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/Seance.php';
require_once __DIR__ . '/../config/database.php';

class ReservationController
{
    private Reservation $reservation;
    private Seance $seance;

    public function __construct()
    {
        Security::checkRole('sportif');
        $pdo = Database::getConnection();
        $this->reservation = new Reservation($pdo);
        $this->seance = new Seance($pdo);
    }

    public function seances(): void
    {
        $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->reservation->reserver(
                $_SESSION['user_id'],
                (int)$_POST['coach_id'],
                (int)$_POST['seance_id']
            )) {
                $message = "Séance réservée avec succès";
            } else {
                $message = "Impossible de réserver";
            }
        }

        $seances = $this->seance->getSeancesDisponibles();
        require __DIR__ . '/../views/sportif/seances.php';
    }

    public function mesReservations(): void
    {
        $reservations = $this->reservation->getBySportif($_SESSION['user_id']);
        require __DIR__ . '/../views/sportif/mes_reservations.php';
    }
}
