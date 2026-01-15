<?php
namespace App\Models;

use Core\Model;
use PDO;

class Utilisateur extends Model {

    protected ?int $id = null;
    protected string $nom = '';
    protected string $prenom = '';
    protected string $email = '';
    protected string $password = '';
    protected string $role = '';

    public function __construct(?int $id = null){
        parent::__construct();

        if ($id !== null) {
            $this->id = $id;
            $this->load();
        }
    }

    protected function load(): bool {
        
        if ($this->id === null) return false;

        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$data) return false;

        $this->nom      = $data['nom'];
        $this->prenom   = $data['prenom'];
        $this->email    = $data['email'];
        $this->password = $data['password'];
        $this->role     = $data['role'];

        return true;
    }

    // GETTERS
    public function getId(): ?int { return $this->id; }
    public function getNom(): string { return $this->nom; }
    public function getPrenom(): string { return $this->prenom; }
    public function getEmail(): string { return $this->email; }
    public function getRole(): string { return $this->role; }

    // INSCRIPTION
    
    public function register(string $nom, string $prenom, string $email, string $password, string $role): bool {
        if (!in_array($role, ['coach', 'sportif'])) return false;
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) return false;

        $check = $this->db->prepare("SELECT id FROM users WHERE email = ?");
        $check->execute([$email]);
        if ($check->rowCount() > 0) return false;

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (nom, prenom, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([$nom, $prenom, $email, $hashedPassword, $role]);
    }

    // CONNEXION 

    public function login(string $email, string $password): array|false {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) return false;
        if (!password_verify($password, $user['password'])) return false;

        return $user;
    }
}
