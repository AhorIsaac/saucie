<?php
class Food extends Connect
{

    // add food function
    public function addFood($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO food_table($implodeColumns) VALUES(:" . $implodePlaceholder . ") ";

        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            session_start();
            $_SESSION["add_food_success"] =
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: monospace; font-size: 14px; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h5 class="alert-heading"> Product Upload Successful! </h5>
                    <p> Saucie product was successfully added! </p>
                </div>';
            header("location: ../views/food-homepage.php");
            exit();
        }
    }

    // select breakfast meals 
    public function selectBreakfast($category)
    {
        $sql = "SELECT * FROM food_table WHERE `category` = '$category' LIMIT 4 ";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "invalid";
        }
    }

    // select lunch meals 
    public function  selectLunch($category)
    {
        $sql = "SELECT * FROM food_table WHERE `category` = '$category' LIMIT 4 ";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "invalid";
        }
    }

    // select dinner meals 
    public function selectDinner($category)
    {
        $sql = "SELECT * FROM food_table WHERE `category` = '$category' LIMIT 4";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }

    // select drinks 
    public function selectDrinks($category)
    {
        $sql = "SELECT * FROM food_table WHERE `category` = '$category' LIMIT 4";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return FALSE;
        }
    }


    // select all breakfast meals 
    public function selectAllBreakfastMeals()
    {
        $sql = "SELECT * FROM food_table WHERE `category` = 'Breakfast' ";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "invalid";
        }
    }


    // select all lunch meals 
    public function selectAllLunchMeals()
    {
        $sql = "SELECT * FROM food_table WHERE `category` = 'Lunch' ";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "invalid";
        }
    }

    // select all dinner meals 
    public function selectAllDinnerMeals()
    {
        $sql = "SELECT * FROM food_table WHERE `category` = 'Dinner' ";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "invalid";
        }
    }

    // select all drinks meals 
    public function selectAllDrinksMeals()
    {
        $sql = "SELECT * FROM food_table WHERE `category` = 'Drinks' ";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "invalid";
        }
    }

    // retrieve a single food details
    public function selectOneFoodInfo($id)
    {
        $sql = "SELECT * FROM food_table WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // update food information by admin
    public function updateFoodByAdmin($fields, $id)
    {
        $sql = "UPDATE food_table SET admin_id=:admin_id, name=:name, category=:category, description=:description, price_tag=:price_tag, quantity=:quantity, image=:image WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    // update food information by admin
    public function updateFoodByStaff($fields, $id)
    {
        $sql = "UPDATE food_table SET staff_id=:staff_id, name=:name, category=:category, description=:description, price_tag=:price_tag, quantity=:quantity, image=:image WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    // *** BREAKFAST CART / ORDER / READ / RETRIEVE ***

    // retrieve food from breakfast cart 
    public function breakfastInCart($food_id, $user_id)
    {
        $sql = "SELECT * FROM cart_breakfast WHERE food_id = $food_id AND user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    public function addBreakfastToCart($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO cart_breakfast($implodeColumns) VALUES(:" . $implodePlaceholder . ") ";

        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        } else {
            return "invalid";
        }
    }

    // update food information by admin
    public function updateBreakfastCart($quantity, $food_id, $user_id)
    {
        $sql = "UPDATE cart_breakfast SET quantity = '$quantity' WHERE food_id = '$food_id'  AND user_id = '$user_id' ";
        $stmt = $this->connection()->prepare($sql);

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    // return number of food from cart 
    public function rowCountBreakfastCart($user_id)
    {
        $sql = "SELECT * FROM cart_breakfast WHERE user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // *** BREAKFAST CART / ORDER / RETRIEVE 

    // retrieve cart details
    public function breakfastCartUserDetails($id)
    {
        $sql = "SELECT 
        customer_table.id as cusId, 
        customer_table.name as cusName, 
        customer_table.email as cusEmail, 
        customer_table.telephone as cusTelephone, 
        customer_table.address as cusAddress, 
        customer_table.profileimage as cusProfileimage,
        
        food_table.id as foodId, 
        food_table.name as foodName, 
        food_table.image as foodImage,
        food_table.price_tag as foodPrice,
        
        cart_breakfast.id as cartId, 
        cart_breakfast.quantity as cartQuantity 
        
        FROM customer_table JOIN food_table JOIN cart_breakfast ON
        customer_table.id = cart_breakfast.user_id AND 
        food_table.id = cart_breakfast.food_id 
        WHERE customer_table.id = $id";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }


    // delete single food item from breakfast cart
    public function deleteFromBreakfastCart($food_id, $user_id)
    {
        $sql = "DELETE FROM cart_breakfast WHERE user_id = $user_id AND food_id = $food_id";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    // delete single food item from breakfast cart
    public function deleteAllFromBreakfastCart($user_id)
    {
        $sql = "DELETE FROM cart_breakfast WHERE user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    // *** LUNCH CART / ORDER / READ / RETRIEVE ***

    // retrieve food from breakfast cart 
    public function lunchInCart($food_id, $user_id)
    {
        $sql = "SELECT * FROM cart_lunch WHERE food_id = $food_id AND user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }


    public function addLunchToCart($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO cart_lunch($implodeColumns) VALUES(:" . $implodePlaceholder . ") ";

        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        } else {
            return "invalid";
        }
    }

    // return number of food from lunch cart 
    public function rowCountLunchCart($user_id)
    {
        $sql = "SELECT * FROM cart_lunch WHERE user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // update food information
    public function updateLunchCart($quantity, $food_id, $user_id)
    {
        $sql = "UPDATE cart_lunch SET quantity = '$quantity' WHERE food_id = '$food_id'  AND user_id = '$user_id' ";
        $stmt = $this->connection()->prepare($sql);

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    // *** LUNCH CART / ORDER / RETRIEVE 

    // retrieve cart details
    public function lunchCartUserDetails($id)
    {
        $sql = "SELECT 
        customer_table.id as cusId, 
        customer_table.name as cusName, 
        customer_table.email as cusEmail, 
        customer_table.telephone as cusTelephone, 
        customer_table.address as cusAddress, 
        customer_table.profileimage as cusProfileimage,
        
        food_table.id as foodId, 
        food_table.name as foodName, 
        food_table.image as foodImage,
        food_table.price_tag as foodPrice,
        
        cart_lunch.id as cartId, 
        cart_lunch.quantity as cartQuantity 
        
        FROM customer_table JOIN food_table JOIN cart_lunch ON
        customer_table.id = cart_lunch.user_id AND 
        food_table.id = cart_lunch.food_id 
        WHERE customer_table.id = $id";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }


    // delete single food item from lunch cart
    public function deleteFromLunchCart($food_id, $user_id)
    {
        $sql = "DELETE FROM cart_lunch WHERE user_id = $user_id AND food_id = $food_id";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    // delete single food item from lunch cart
    public function deleteAllFromLunchCart($user_id)
    {
        $sql = "DELETE FROM cart_lunch WHERE user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    // *** DINNER CART / ORDER / READ / RETRIEVE ***

    // retrieve food from dinner cart 
    public function dinnerInCart($food_id, $user_id)
    {
        $sql = "SELECT * FROM cart_dinner WHERE food_id = $food_id AND user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addDinnerToCart($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO cart_dinner($implodeColumns) VALUES(:" . $implodePlaceholder . ") ";

        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        } else {
            return "invalid";
        }
    }

    // return
    public function rowCountDinnerCart($user_id)
    {
        $sql = "SELECT * FROM cart_dinner WHERE user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        return $stmt->rowCount();
    }


    // update food information
    public function updateDinnerCart($quantity, $food_id, $user_id)
    {
        $sql = "UPDATE cart_dinner SET quantity = '$quantity' WHERE food_id = '$food_id'  AND user_id = '$user_id' ";
        $stmt = $this->connection()->prepare($sql);

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    // *** DINNER CART / ORDER / RETRIEVE 

    // retrieve cart details
    public function dinnerCartUserDetails($id)
    {
        $sql = "SELECT 
        customer_table.id as cusId, 
        customer_table.name as cusName, 
        customer_table.email as cusEmail, 
        customer_table.telephone as cusTelephone, 
        customer_table.address as cusAddress, 
        customer_table.profileimage as cusProfileimage,
        
        food_table.id as foodId, 
        food_table.name as foodName, 
        food_table.image as foodImage,
        food_table.price_tag as foodPrice,
        
        cart_dinner.id as cartId, 
        cart_dinner.quantity as cartQuantity 
        
        FROM customer_table JOIN food_table JOIN cart_dinner ON
        customer_table.id = cart_dinner.user_id AND 
        food_table.id = cart_dinner.food_id 
        WHERE customer_table.id = $id";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }

    // delete single food item from lunch cart
    public function deleteFromDinnerCart($food_id, $user_id)
    {
        $sql = "DELETE FROM cart_dinner WHERE user_id = $user_id AND food_id = $food_id";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    // delete single food item from lunch cart
    public function deleteAllFromDinnerCart($user_id)
    {
        $sql = "DELETE FROM cart_dinner WHERE user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    // *** DRINKS CART / ORDER / READ / RETRIEVE ***

    // retrieve food from drinks cart 
    public function drinkInCart($food_id, $user_id)
    {
        $sql = "SELECT * FROM cart_drinks WHERE food_id = $food_id AND user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    public function addDrinkToCart($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO cart_drinks($implodeColumns) VALUES(:" . $implodePlaceholder . ") ";

        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        } else {
            return "invalid";
        }
    }


    // return number of food from drinks cart 
    public function rowCountDrinksCart($user_id)
    {
        $sql = "SELECT * FROM cart_drinks WHERE user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":user_id", $user_id);
        $stmt->execute();
        return $stmt->rowCount();
    }


    // update food information
    public function updateDrinksCart($quantity, $food_id, $user_id)
    {
        $sql = "UPDATE cart_drinks SET quantity = '$quantity' WHERE food_id = '$food_id' AND user_id = '$user_id' ";
        $stmt = $this->connection()->prepare($sql);

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    // *** DRINKS CART / ORDER / RETRIEVE 

    // retrieve cart details
    public function drinksCartUserDetails($id)
    {
        $sql = "SELECT 
        customer_table.id as cusId, 
        customer_table.name as cusName, 
        customer_table.email as cusEmail, 
        customer_table.telephone as cusTelephone, 
        customer_table.address as cusAddress, 
        customer_table.profileimage as cusProfileimage,
        
        food_table.id as foodId, 
        food_table.name as foodName, 
        food_table.image as foodImage,
        food_table.price_tag as foodPrice,
        
        cart_drinks.id as cartId, 
        cart_drinks.quantity as cartQuantity 
        
        FROM customer_table JOIN food_table JOIN cart_drinks ON
        customer_table.id = cart_drinks.user_id AND 
        food_table.id = cart_drinks.food_id 
        WHERE customer_table.id = $id";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return 0;
        }
    }


    // delete
    public function deleteFromDrinksCart($food_id, $user_id)
    {
        $sql = "DELETE FROM cart_drinks WHERE user_id = $user_id AND food_id = $food_id";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    // 
    public function deleteAllFromDrinksCart($user_id)
    {
        $sql = "DELETE FROM cart_drinks WHERE user_id = $user_id";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    // *** trying to process breakfast order

    public function moveToBreakfastOrderTable($ref, $user_id, $food_id, $quantity, $price, $total_price)
    {
        $sql = "INSERT INTO order_table_breakfast (ref, user_id, food_id, quantity, price, total_price) VALUES ($ref, $user_id, $food_id, $quantity, $price, $total_price) ";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    public function moveToLunchOrderTable($ref, $user_id, $food_id, $quantity, $price, $total_price)
    {
        $sql = "INSERT INTO order_table_lunch (ref, user_id, food_id, quantity, price, total_price) VALUES ($ref, $user_id, $food_id, $quantity, $price, $total_price) ";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    public function moveToDinnerOrderTable($ref, $user_id, $food_id, $quantity, $price, $total_price)
    {
        $sql = "INSERT INTO order_table_dinner (ref, user_id, food_id, quantity, price, total_price) VALUES ($ref, $user_id, $food_id, $quantity, $price, $total_price) ";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    public function moveToDrinksOrderTable($ref, $user_id, $food_id, $quantity, $price, $total_price)
    {
        $sql = "INSERT INTO order_table_drinks (ref, user_id, food_id, quantity, price, total_price) VALUES ($ref, $user_id, $food_id, $quantity, $price, $total_price) ";
        $stmt = $this->connection()->prepare($sql);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    // ** **

    // select breakfast meals 
    public function selectSaucieFood($category, $number)
    {
        $sql = "SELECT * FROM food_table WHERE `category` = '$category' AND `id` >= '$number' LIMIT 2 ";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "invalid";
        }
    }

    // ** **

    // select all breakfast meals 
    public function selectFourMeals($category, $number)
    {
        $sql = "SELECT * FROM food_table WHERE `category` = '$category' AND id >= '$number' LIMIT 3 ";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "invalid";
        }
    }
}
