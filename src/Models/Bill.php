<?php

namespace App\Models;

class Bill
{
    public int $bill_id = -1;
    public int $user_id = -1;
    public string $bill_created_at = '';

    public static function all(): array
    {
        $bills = [];

        $query = PDO()->prepare('select * from bills');
        $query->execute();
        while ($row = $query->fetch()) {
            $bill = new Bill();
            $bill->fillFromDb($row);
            $bills[] = $bill;
        }

        return $bills;
    }

    public function save()
    {
        $result = false;

        if ($this->bill_id >= 0) {
            
        } else {
            $query = PDO()->prepare('insert into bills (user_id, bill_created_at) values (:user_id, :bill_created_at)');
            $result = $query->execute([
                'user_id' => $this->user_id,
                'bill_created_at' => $this->bill_created_at
            ]);
            if ($result) {
                $this->bill_id = PDO()->lastInsertId();
            }
        }

        return $result;
    }

    public function delete()
    {
        $query = PDO()->prepare('delete from bills where bill_id = :bill_id');
        return $query->execute(['bill_id' => $this->bill_id]);
    }

    public static function findById(int $bill_id)
    {
        $query = PDO()->prepare('select * from bills where bill_id = :bill_id');
        $query->execute(['bill_id' => $bill_id]);
        if ($row = $query->fetch()) {
            $bill = new Bill();
            $bill->fillFromDb($row);
            return $bill;
        }
        return null;
    }

    public static function findByUserId(int $user_id)
    {
        $bills = [];
        $query = PDO()->prepare('select * from bills where user_id = :user_id');
        $query->execute(['user_id' => $user_id]);
        while ($row = $query->fetch()) {
            $bill = new Bill();
            $bills[] = $bill->fillFromDb($row);
        }
        return $bills;
    }

    public static function findByUserIdAndDate(int $user_id, string $bill_created_at)
    {
        $query = PDO()->prepare('select * from bills where user_id = :user_id and bill_created_at = :bill_created_at');
        $query->execute([
            'user_id' => $user_id,
            'bill_created_at' => $bill_created_at
        ]);
        if ($row = $query->fetch()) {
            $bill = new Bill();
            $bill->fillFromDb($row);
            return $bill;
        }
        return null;
    }

    protected function fillFromDb(array $row)
    {
        $this->bill_id = $row['bill_id'];
        $this->user_id = $row['user_id'];
        $this->bill_created_at = $row['bill_created_at'];
        return $this;
    }

    public function fill(array $data)
    {
        $this->user_id = $data['user_id'] ?? 0;
        $this->bill_created_at = $data['bill_created_at'] ?? '';
        return $this;
    }
}
