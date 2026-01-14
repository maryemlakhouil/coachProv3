<?php
namespace App\Models;

use Core\Model;
use PDO;

class Coach extends Model
{
    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM coaches");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
