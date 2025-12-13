<?php
class Task {
    private $conn;
    private $table_name = "tasks";
    public $id;
    public $user_id;
    public $title;
    public $description;
    public $status;
    public $priority;
    public $due_date;
    public function __construct($db) {
        $this->conn = $db;
    }
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET user_id = :user_id,
                      title = :title,
                      description = :description,
                      status = :status,
                      priority = :priority,
                      due_date = :due_date";
        $stmt = $this->conn->prepare($query);
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->priority = htmlspecialchars(strip_tags($this->priority));
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":priority", $this->priority);
        $stmt->bindParam(":due_date", $this->due_date);
        return $stmt->execute();
    }
    public function getUserTasks($user_id, $status = null) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id";
        if ($status) {
            $query .= " AND status = :status";
        }
        $query .= " ORDER BY 
                    CASE priority 
                        WHEN 'high' THEN 1 
                        WHEN 'medium' THEN 2 
                        WHEN 'low' THEN 3 
                    END,
                    due_date ASC,
                    created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        if ($status) {
            $stmt->bindParam(":status", $status);
        }
        $stmt->execute();
        return $stmt;
    }
    public function getTask($id, $user_id) {
        $query = "SELECT * FROM " . $this->table_name . " 
                  WHERE id = :id AND user_id = :user_id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET title = :title,
                      description = :description,
                      status = :status,
                      priority = :priority,
                      due_date = :due_date,
                      completed_at = :completed_at
                  WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->status = htmlspecialchars(strip_tags($this->status));
        $this->priority = htmlspecialchars(strip_tags($this->priority));
        $completed_at = ($this->status === 'completed') ? date('Y-m-d H:i:s') : null;
        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":priority", $this->priority);
        $stmt->bindParam(":due_date", $this->due_date);
        $stmt->bindParam(":completed_at", $completed_at);
        $stmt->bindParam(":id", $this->id);
        $stmt->bindParam(":user_id", $this->user_id);
        return $stmt->execute();
    }
    public function delete($id, $user_id) {
        $query = "DELETE FROM " . $this->table_name . " 
                  WHERE id = :id AND user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":user_id", $user_id);
        return $stmt->execute();
    }
    public function getStats($user_id) {
        $query = "SELECT 
                    COUNT(*) as total,
                    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
                    SUM(CASE WHEN status = 'in_progress' THEN 1 ELSE 0 END) as in_progress,
                    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed,
                    SUM(CASE WHEN priority = 'high' THEN 1 ELSE 0 END) as `high_priority`
                  FROM " . $this->table_name . " 
                  WHERE user_id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch();
    }
}
?>
