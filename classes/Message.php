<?php

class Message extends Connect
{

    public function sendFeedback($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO feedback_table($implodeColumns) VALUES(:" . $implodePlaceholder . ") ";

        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    public function selectFeedbackMessages()
    {
        $sql = "SELECT 
        feedback_table.feedback_title AS title,
        feedback_table.feedback_message AS message,
        
        customer_table.name AS user_name,
        customer_table.profileimage AS user_image
        
        FROM feedback_table LEFT JOIN customer_table ON feedback_table.user_id = customer_table.id LIMIT 3 ";
        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function selectAllFeedbackMessages($subject)
    {
        $sql = "SELECT
        feedback_table.id AS id,
        feedback_table.feedback_title AS title,
        feedback_table.feedback_message AS message,
        feedback_table.feedback_seen AS seen,
        
        customer_table.name AS user_name,
        customer_table.profileimage AS user_image
        
        FROM feedback_table LEFT JOIN customer_table ON feedback_table.user_id = customer_table.id WHERE feedback_subject = '$subject'  ";
        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return null;
        }
    }

    public function markAsRead($id)
    {
        $sql = "UPDATE feedback_table SET feedback_seen = 1 WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function deleteFeedback($id)
    {
        $sql = "DELETE FROM feedback_table WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function unseenFeedbackNumber()
    {
        $sql = "SELECT * FROM feedback_table WHERE feedback_seen = 0";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function assignOrderMessage($id)
    {
        $sql = "SELECT * FROM assign_order_table WHERE `staff_id` = '$id' and `delivered` = 0";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function assignOrderDelivered($id)
    {
        $sql = "UPDATE assign_order_table  SET `delivered` = 1 WHERE `staff_id` = '$id' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }
}
