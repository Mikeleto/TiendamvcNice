<?php

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = Mysqldb::getInstance()->getDatabase();
    }

    public function verifyProduct($product_id, $user_id)
    {
        $sql = 'SELECT * FROM carts WHERE product_id=:product_id AND user_id=:user_id AND state=0';
        $query = $this->db->prepare($sql);
        $params = [
            ':product_id' => $product_id,
            ':user_id' => $user_id,
        ];
        $query->execute($params);

        return $query->rowCount();
    }

    public function addProduct($product_id, $user_id)
    {
        $sql = 'SELECT * FROM products WHERE id=:id';
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $product_id]);
        $product = $query->fetch(PDO::FETCH_OBJ);
        $sql4 = 'SELECT * FROM users WHERE id=:id';
        $query2 = $this->db->prepare($sql4);
        $query2->execute([':id' => $user_id]);
        $use = $query2->fetch(PDO::FETCH_OBJ);
        $price = $product->price;
        $send =  $product->send;
        $discount =  $product->discount;
        $total = $price + $send - $discount;

        $sql2 = 'INSERT INTO carts(state,name,email, user_id, product_id,product_name, quantity, discount,price, send, date,total)
                 VALUES (:state,:name,:email ,:user_id, :product_id,:product_name, :quantity, :discount,:price, :send, :date, :total)';
        $query2 = $this->db->prepare($sql2);
        $params2 = [
            ':state' => 0,
            ':name' => $use->first_name,
            ':email' => $use->email,
            ':user_id' => $user_id,
            ':product_id' => $product_id,
            ':product_name' => $product->name,
            ':quantity' => 1,
            ':discount' => $discount,
            ':price' =>  $price,
            ':send' => $send,
            ':date' => date('Y-m-d H:i:s'),
            ':total' => $total,
        ];
        $query2->execute($params2);
        return $query2->rowCount();


    }

    public function getCart($user_id)
    {
        $sql = 'SELECT c.user_id as user, c.product_id as product, c.quantity as quantity, 
                c.send as send, c.discount as discount, p.price as price, p.image as image,
                p.description as description, p.name as name
                FROM carts as c, products as p
                WHERE c.user_id=:user_id AND state=0 AND c.product_id=p.id';

        $query = $this->db->prepare($sql);
        $query->execute([':user_id' => $user_id]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function update($user, $product, $quantity)
    {
        $sql = 'UPDATE carts SET quantity=:quantity WHERE user_id=:user_id AND product_id=:product_id';
        $query = $this->db->prepare($sql);
        $params = [
            ':user_id' => $user,
            ':product_id' => $product,
            ':quantity' => $quantity,
        ];

        return $query->execute($params);
    }

    public function delete($product, $user)
    {
        $sql = 'DELETE FROM carts WHERE user_id=:user_id AND product_id=:product_id';
        $query = $this->db->prepare($sql);
        $params = [
            ':user_id' => $user,
            ':product_id' => $product,
        ];
        return $query->execute($params);
    }

    public function closeCart($id, $state)
    {
        $response = false;
        $sql = 'UPDATE carts SET state=:state WHERE user_id=:user_id AND state=0';
        $query = $this->db->prepare($sql);
        $params = [
            ':user_id' => $id,
            ':state' => $state,
        ];
        return $query->execute($params);



    }


    public function getAddresses($id){
        $sql = 'SELECT * FROM adresses WHERE id = :id';
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateAddresses($data){
        $response = false;
        $data = (array) $data;
        $sql = 'UPDATE adresses SET 
                     id = :id,
            first_name = :first_name,
            last_name_1 = :last_name_1,
            last_name_2 = :last_name_2,
            email = :email,
            address = :address,
            city = :city,
            state = :state,
            zipcode = :zipcode,
            country = :country
WHERE id = :id
            ';

        $params = [
            ':id' => $_POST['id'] ?? '',
            ':first_name' => $_POST['first_name'] ?? '',
            ':last_name_1' => $_POST['last_name_1'] ??  '',
            ':last_name_2' =>  $_POST['last_name_2'] ?? '',
            ':email' =>  $_POST['email'] ?? '',
            ':address' => $_POST['address'] ?? '',
            ':city' => $_POST['city'] ?? '',
            ':state' => $_POST['state'] ??  '',
            ':zipcode' => $_POST['postcode'] ??  '',
            ':country' => $_POST['country'] ?? '',

        ];
        $query = $this->db->prepare($sql);
        $response = $query->execute($params);
        return $response;

    }
    public function payments($id)
    {
        $sql = 'SELECT * FROM payment';
        $query = $this->db->prepare($sql);
        $query->execute([':id' => $id]);

        return $query->fetch(PDO::FETCH_OBJ);
    }


    public function getPayments()
    {
        $sql = 'SELECT * FROM payment WHERE deleted = 0';
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_OBJ);
    }

}