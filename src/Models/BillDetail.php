<?php

namespace App\Models;

class BillDetail
{
    public int $bill_id = -1;
    public int $product_id = -1;
    public int $product_amount = -1;

    public static function all(): array
    {
        $billdetails = [];

        $query = PDO()->prepare('select * from billsdetail');
        $query->execute();
        while ($row = $query->fetch()) {
            $billdetail = new BillDetail();
            $billdetail->fillFromDb($row);
            $billdetails[] = $billdetail;
        }

        return $billdetails;
    }

    public function save()
    {
        $result = false;

        $query = PDO()->prepare('insert into billsdetail (bill_id, product_id, product_amount) values (:bill_id, :product_id, :product_amount)');
        $result = $query->execute([
            'bill_id' => $this->bill_id,
            'product_id' => $this->product_id,
            'product_amount' => $this->product_amount
        ]);

        return $result;
    }

    public function deleteByBillId()
    {
        $query = PDO()->prepare('delete from billsdetail where bill_id = :bill_id');
        return $query->execute(['bill_id' => $this->bill_id]);
    }

    public function deleteByBillIdAndProductId()
    {
        $query = PDO()->prepare('delete from billsdetail where bill_id = :bill_id and product_id = :product_id');
        return $query->execute([
            'bill_id' => $this->bill_id,
            'product_id' => $this->product_id
        ]);
    }

    public static function findByBillId(int $bill_id)
    {
        $billdetails = [];
        $query = PDO()->prepare('select * from billsdetail where bill_id = :bill_id');
        $query->execute(['bill_id' => $bill_id]);
        while ($row = $query->fetch()) {
            $billdetail = new BillDetail();
            $billdetails[] = $billdetail->fillFromDb($row);
        }
        return $billdetails;
    }

    protected function fillFromDb(array $row)
    {
        $this->bill_id = $row['bill_id'];
        $this->product_id = $row['product_id'];
        $this->product_amount = $row['product_amount'];
        return $this;
    }

    public function fill(int $bill_id, array $data)
    {
        $this->bill_id = $bill_id ?? 0;
        $this->product_id = $data['product_id'] ?? 0;
        $this->product_amount = $data['product_amount'] ?? '';
        return $this;
    }
}
