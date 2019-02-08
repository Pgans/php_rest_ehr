<?php 
  class Tasks {
    // DB stuff
    private $conn;
    private $table = 'task';

    // Post Properties
    public $Id;
    public $Title;
    public $Status;
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Tasks
    public function read() {
      // Create query
      $query = 'SELECT * FROM task';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
    // Get Single Tasks
    public function read_single() {
        // Create query
        $query = 'SELECT * FROM ' . $this->table . ' p
                                  WHERE
                                    p.Id = ?
                                  LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->Id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->Title = $row['Title'];
        $this->Status = $row['Status'];   
    }
    // Create Tasks
    public function create() {
        // Create query
        $query = 'INSERT INTO ' . $this->table . ' SET Title = :Title, Status = :Status ';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->Title = htmlspecialchars(strip_tags($this->Title));
        $this->Status = htmlspecialchars(strip_tags($this->Status));
       
        // Bind data
        $stmt->bindParam(':Title', $this->Title);
        $stmt->bindParam(':Status', $this->Status);
        
        // Execute query
        if($stmt->execute()) {
          return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }

}
