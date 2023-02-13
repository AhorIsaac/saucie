<?php

class Order extends Connect {
    
    // select all pending breakfast order using user_id 
    public function selectAllPendingBreakfastOrderForOneCustomer($user_id) 
    {
        $sql = "SELECT
        order_table_breakfast.quantity AS order_quantity,
        order_table_breakfast.price AS order_price,
        order_table_breakfast.total_price AS order_total_price,
        order_table_breakfast.ref AS order_reference_number,
        order_table_breakfast.order_time AS order_reference_time,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image
        
        FROM order_table_breakfast JOIN food_table ON order_table_breakfast.food_id = food_table.id  WHERE `user_id` = '$user_id' AND `delivered` = 0 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }
    }
    
    
    // select all pending lunch order using user_id 
    public function selectAllPendingLunchOrderForOneCustomer($user_id) 
    {
        $sql = "SELECT
        order_table_lunch.quantity AS order_quantity,
        order_table_lunch.price AS order_price,
        order_table_lunch.total_price AS order_total_price,
        order_table_lunch.ref AS order_reference_number,
        order_table_lunch.order_time AS order_reference_time,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image
        
        FROM order_table_lunch JOIN food_table ON order_table_lunch.food_id = food_table.id  WHERE `user_id` = '$user_id' AND `delivered` = 0 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }
    }
    
    // select all pending dinner order using user_id 
    public function selectAllPendingDinnerOrderForOneCustomer($user_id) 
    {
        $sql = "SELECT
        order_table_dinner.quantity AS order_quantity,
        order_table_dinner.price AS order_price,
        order_table_dinner.total_price AS order_total_price,
        order_table_dinner.ref AS order_reference_number,
        order_table_dinner.order_time AS order_reference_time,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image
        
        FROM order_table_dinner JOIN food_table ON order_table_dinner.food_id = food_table.id  WHERE `user_id` = '$user_id' AND `delivered` = 0 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }
    }
    
    // select all pending drinks order using user_id 
    public function selectAllPendingDrinksOrderForOneCustomer($user_id) 
    {
        $sql = "SELECT
        order_table_drinks.quantity AS order_quantity,
        order_table_drinks.price AS order_price,
        order_table_drinks.total_price AS order_total_price,
        order_table_drinks.ref AS order_reference_number,
        order_table_drinks.order_time AS order_reference_time,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image
        
        FROM order_table_drinks JOIN food_table ON order_table_drinks.food_id = food_table.id  WHERE `user_id` = '$user_id' AND `delivered` = 0 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }
    }

    
    public function pendingBreakfastNumber($user_id) 
    {
        $sql = "SELECT * FROM order_table_breakfast WHERE user_id = $user_id AND delivered = 0 ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }    
    
    public function pendingLunchNumber($user_id) 
    {
        $sql = "SELECT * FROM order_table_lunch WHERE user_id = $user_id AND delivered = 0 ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }    
    
    public function pendingDinnerNumber($user_id) 
    {
        $sql = "SELECT * FROM order_table_dinner WHERE user_id = $user_id AND delivered = 0 ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }    
    
    public function pendingDrinksNumber($user_id) 
    {
        $sql = "SELECT * FROM order_table_drinks WHERE user_id = $user_id AND delivered = 0 ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return 1;
        } else {
            return 0;
        }
    }    
    
    
    // select all delivered breakfast order using user_id 
    public function selectAllDeliveredBreakfastOrderForOneCustomer($user_id) 
    {
        $sql = "SELECT
        order_table_breakfast.quantity AS order_quantity,
        order_table_breakfast.price AS order_price,
        order_table_breakfast.total_price AS order_total_price,
        order_table_breakfast.ref AS order_reference_number,
        order_table_breakfast.order_time AS order_reference_time,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image
        
        FROM order_table_breakfast JOIN food_table ON order_table_breakfast.food_id = food_table.id  WHERE `user_id` = '$user_id' AND `delivered` = 1 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }
    }
    
    
    // select all deivered lunch order using user_id 
    public function selectAllDeliveredLunchOrderForOneCustomer($user_id) 
    {
        $sql = "SELECT
        order_table_lunch.quantity AS order_quantity,
        order_table_lunch.price AS order_price,
        order_table_lunch.total_price AS order_total_price,
        order_table_lunch.ref AS order_reference_number,
        order_table_lunch.order_time AS order_reference_time,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image
        
        FROM order_table_lunch JOIN food_table ON order_table_lunch.food_id = food_table.id  WHERE `user_id` = '$user_id' AND `delivered` = 1 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }
    }
    
    
    // select all delivered dinner order using user_id 
    public function selectAllDeliveredDinnerOrderForOneCustomer($user_id) 
    {
        $sql = "SELECT
        order_table_dinner.quantity AS order_quantity,
        order_table_dinner.price AS order_price,
        order_table_dinner.total_price AS order_total_price,
        order_table_dinner.ref AS order_reference_number,
        order_table_dinner.order_time AS order_reference_time,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image
        
        FROM order_table_dinner JOIN food_table ON order_table_dinner.food_id = food_table.id  WHERE `user_id` = '$user_id' AND `delivered` = 1 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }
    }

    
    // select all delivered drinks order using user_id 
    public function selectAllDeliveredDrinksOrderForOneCustomer($user_id) 
    {
        $sql = "SELECT
        order_table_drinks.quantity AS order_quantity,
        order_table_drinks.price AS order_price,
        order_table_drinks.total_price AS order_total_price,
        order_table_drinks.ref AS order_reference_number,
        order_table_drinks.order_time AS order_reference_time,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image
        
        FROM order_table_drinks JOIN food_table ON order_table_drinks.food_id = food_table.id  WHERE `user_id` = '$user_id' AND `delivered` = 1 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }
    }
    
    public function assignOrder($staff_id, $ref_no, $admin_id) 
    {
        $sql = "INSERT INTO assign_order_table(`staff_id`, `ref_no`, `admin_id`) VALUES('$staff_id', '$ref_no', '$admin_id') ";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();
        
        if($stmtExec) {
            return TRUE;
        }
    }
    
    public function validRefNoBreakfast($ref) 
    {
        $sql1 = "SELECT * FROM order_table_breakfast WHERE ref = '$ref' ";
        $stmt1 = $this->connection()->prepare( $sql1 );
        $stmt1->bindValue(":ref", $ref);
        $stmtExec1 = $stmt1->execute();
        
        if ($stmtExec1) {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }
    
    public function validRefNoLunch($ref) 
    {
        $sql2 = "SELECT * FROM order_table_lunch WHERE ref = '$ref' ";
        $stmt2 = $this->connection()->prepare( $sql2 );
        $stmt2->bindValue(":ref", $ref);
        $stmtExec2 = $stmt2->execute();
        
        if ($stmtExec2) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function validRefNoDinner($ref) 
    {
        $sql3 = "SELECT * FROM order_table_dinner WHERE ref = '$ref' ";
        $stmt3 = $this->connection()->prepare( $sql3 );
        $stmt3->bindValue(":ref", $ref);
        $stmtExec3 = $stmt3->execute();
        
        if ($stmtExec3) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function validRefNoDrinks($ref) 
    {
        $sql4 = "SELECT * FROM order_table_drinks WHERE ref = '$ref' ";
        $stmt4 = $this->connection()->prepare( $sql4 );
        $stmt4->bindValue(":ref", $ref);
        $stmtExec4 = $stmt4->execute();
        
        if ($stmtExec4) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function selectReferenceNumbers($staff_id) 
    {
        $sql = "SELECT ref_no FROM assign_order_table WHERE staff_id = '$staff_id' ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }
    }        
    
    
    public function deleteAssignOrder($id) 
    {
        $sql = "DELETE FROM assign_order_table WHERE staff_id = '$id' ";
        $stmt = $this->connection()->prepare($sql);
        
        $stmtExec = $stmt->execute(); 
        
        if ($stmtExec) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function updateOrderAddress($table, $address, $ref) 
    {
        $sql = "UPDATE $table SET `delivery_address` = '$address' WHERE `ref` = '$ref' ";
        $stmt = $this->connection()->prepare($sql);
        
        $stmtExec = $stmt->execute(); 
        
        if ($stmtExec) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function selectAllDeliveredOrderReferenceNumbersForAParticularTable($tablename)
    {
        $sql = "SELECT DISTINCT ref FROM $tablename WHERE delivered = 1";
        $stmt = $this->connection()->prepare($sql);
        
        $stmt->execute();
        
        if($stmt->rowCount() > 0)
        {
            while ($row = $stmt->fetch())
            {
                $data[] = $row;    
            }
            return $data;
        }
        else {
            return null;
        }        
    }
    
    public function selectAllPendingOrderReferenceNumbersForAParticularTable($tablename)
    {
        $sql = "SELECT DISTINCT ref FROM $tablename WHERE delivered = 0";
        $stmt = $this->connection()->prepare($sql);
        
        $stmt->execute();
        
        if($stmt->rowCount() > 0)
        {
            while ($row = $stmt->fetch())
            {
                $data[] = $row;    
            }
            return $data;
        }
        else {
            return null;
        }
    }
    
    // *** &&&& ***

    // SELECT PARTICULAR ORDER BASED ON REFERENCE NUMBER

    public function selectParticularOrderBasedOnReferenceNumber($reference_number, $order_table)
    {
         $sql = "SELECT
        $order_table.id AS order_id,
        $order_table.quantity AS order_quantity,
        $order_table.price AS order_price,
        $order_table.total_price AS order_total_price,
        $order_table.ref AS order_reference_number,
        $order_table.order_time AS order_reference_time,
        $order_table.delivery_address AS address,
        
        customer_table.name AS order_username,
        customer_table.email AS order_email,
        customer_table.telephone AS order_telephone,
        customer_table.profileimage AS order_user_image,
        customer_table.address AS customer_address,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image
        
        FROM $order_table JOIN food_table JOIN customer_table ON $order_table.food_id = food_table.id AND $order_table.user_id = customer_table.id  WHERE `ref` = '$reference_number' AND `delivered` = 0 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }       
    }
    
    // DELIVER ORDER, SPECIFY THE STAFF THAT DELIVERED THE ORDER 

    public function deliverOrder($order_ref_no, $order_table_name, $staff_id)
    {
        $sql = "UPDATE $order_table_name SET `delivered` = 1, `staff_id` = '$staff_id' WHERE ref = '$order_ref_no' ";
        $stmt = $this->connection()->prepare($sql);
        
        $stmtExec = $stmt->execute();
        
        if ($stmtExec) 
        {
            return TRUE;
        }
        else 
        {
            return FALSE;
        }
    }
    
    // GET ALL PENDING ORDERS 
    public function pendingOrderNumber($table)
    {
        $sql = "SELECT DISTINCT `ref` FROM $table WHERE `delivered` = 0 ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }    
    
    
    public function selectParticularDeliveredOrderBasedOnReferenceNumber($reference_number, $order_table)
    {
        $sql = "SELECT
        $order_table.id AS order_id,
        $order_table.quantity AS order_quantity,
        $order_table.price AS order_price,
        $order_table.total_price AS order_total_price,
        $order_table.ref AS order_reference_number,
        $order_table.order_time AS order_reference_time,
        $order_table.delivery_address AS address,
        
        customer_table.name AS order_username,
        customer_table.email AS order_email,
        customer_table.telephone AS order_telephone,
        customer_table.profileimage AS order_user_image,
        customer_table.address AS customer_address,
        
        food_table.name AS order_food_name,
        food_table.image as order_food_image,
        
        staff_table.name AS order_staff_name,
        staff_table.profileimage AS order_staff_image
        
        
        FROM $order_table JOIN food_table JOIN customer_table JOIN staff_table ON $order_table.food_id = food_table.id AND $order_table.user_id = customer_table.id AND $order_table.staff_id = staff_table.id  WHERE `ref` = '$reference_number' AND `delivered` = 1 ";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return null;
        }    
        
    }
    
}
