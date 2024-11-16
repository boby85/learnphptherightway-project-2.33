<?php

namespace App\Models;

use App\Model;

class Transaction extends Model
{
    public function index(): array
    {
        $query = 'SELECT * FROM transactions';
        $fetchStmt = $this->db->prepare($query);
        $fetchStmt->execute();

        return $fetchStmt->fetchAll();
    }

    public function create (array $data)
    {
        $query = 'INSERT INTO transactions (t_date, t_check, t_description, t_amount)
                  VALUES (:date, :check, :description, :amount)';
        $stmt = $this->db->prepare($query);

        foreach ($data as $line) {
            $stmt->execute(
                [
                    'date' => date("Y-m-d H:m:i", strtotime($line[0])),
                    'check' => (int) $line[1],
                    'description' => $line[2],
                    'amount' => (float) $line[3]
                ]
            );
        }
    }
}