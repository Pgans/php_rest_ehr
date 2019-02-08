<?php 
  class Cid_hn {
    // DB stuff
    private $conn;
    private $table = 'cid_hn';

    // Post Properties
    public $CID;
    public $HN0;
    public $HN;
    public $XN;
    public $auto_cid;
    public $hn_ssp;
    
    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get Cid_hn
    public function read() {
      // Create query
      $query = 'SELECT * FROM cid_hn LIMIT 20';
      
      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

    // Get Single Post
    public function read_single() {
          // Create query
          $query = 'SELECT *
                                    FROM cid_hn a
                                    WHERE
                                      a.auto_cid = ?
                                    LIMIT 0,1';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Bind ID
          $stmt->bindParam(1, $this->auto_cid);

          // Execute query
          $stmt->execute();

          $row = $stmt->fetch(PDO::FETCH_ASSOC);

          // Set properties
          $this->CID = $row['CID'];
          $this->HN0 = $row['HN0'];
          $this->HN = $row['HN'];
          $this->XN = $row['XN'];
          $this->auto_cid = $row['auto_cid'];
          $this->hn_ssp = $row['hn_ssp'];
    }
     // Create Cid_HN
     public function create() {
        // Create query
        $query = 'INSERT INTO cid_hn SET 
        CID = :CID, 
        HN0 = :HN0, 
        HN = :HN, 
        XN = :XN, 
        auto_cid = :auto_cid,
        hn_ssp = :hn_ssp';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Clean data
        $this->CID = htmlspecialchars(strip_tags($this->CID));
        $this->HN0 = htmlspecialchars(strip_tags($this->HN0));
        $this->HN = htmlspecialchars(strip_tags($this->HN));
        $this->XN = htmlspecialchars(strip_tags($this->XN));
        $this->auto_cid = htmlspecialchars(strip_tags($this->auto_cid));
        $this->hn_ssp = htmlspecialchars(strip_tags($this->hn_ssp));

        // Bind data
        $stmt->bindParam(':CID', $this->CID);
        $stmt->bindParam(':HN0', $this->HN0);
        $stmt->bindParam(':HN', $this->HN);
        $stmt->bindParam(':XN', $this->XN);
        $stmt->bindParam(':auto_cid', $this->auto_cid);
        $stmt->bindParam(':hn_ssp', $this->hn_ssp);

        // Execute query
        if($stmt->execute()) {
          return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  }


  // Update Post
  public function update() {
    // Create query
    $query = 'UPDATE ' . $this->table . '
                          SET CID = :CID, HN0 = :HN0, HN = :HN, XN = :XN, auto_cid = :auto_cid, hn_ssp = :hn_ssp
                          WHERE auto_cid = :auto_cid';

    // Prepare statement
    $stmt = $this->conn->prepare($query);

    // Clean data
    $this->CID = htmlspecialchars(strip_tags($this->CID));
    $this->HN0 = htmlspecialchars(strip_tags($this->HN0));
    $this->HN = htmlspecialchars(strip_tags($this->HN));
    $this->XN = htmlspecialchars(strip_tags($this->XN));
    $this->auto_cid = htmlspecialchars(strip_tags($this->auto_cid));
    $this->hn_ssp = htmlspecialchars(strip_tags($this->hn_ssp));

    // Bind data
    $stmt->bindParam(':CID', $this->CID);
    $stmt->bindParam(':HN0', $this->HN0);
    $stmt->bindParam(':HN', $this->HN);
    $stmt->bindParam(':XN', $this->XN);
    $stmt->bindParam(':auto_cid', $this->auto_cid);
    $stmt->bindParam(':hn_ssp', $this->hn_ssp);


    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: %s.\n", $stmt->error);

    return false;
  } 

}