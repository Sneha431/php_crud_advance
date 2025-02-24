<?php 
require_once "Database.php";  // This imports the Database class from a file named "Database.php".

class User extends Database  // The "User" class extends the "Database" class, meaning it inherits the properties and methods from the Database class.
{
  protected $tablename = "user";  // This defines the table name for the User class. It's a protected property, so it's accessible within this class and derived classes.

  // insert data
  public function add($data)
  {
    // Check if the $data array is not empty.
    if(!empty($data))
    {
      // Initialize two arrays: one for fields (column names) and one for placeholders (for SQL parameters).
      $fields = $placeholder = [];

      // Loop through the $data array. $data is expected to be an associative array (e.g., ['name' => 'John', 'email' => 'john@example.com']).
      foreach($data as $field => $values)
      {
        $fields[] = $field;  // Add the field name to the $fields array.
        $placeholder[] = ":{$field}";  // Add the corresponding placeholder (e.g., :name, :email) to the $placeholder array.
      }
    }

    // Dynamically build the SQL query for the INSERT operation.
    // This will create a query like: "INSERT INTO user (name, email, phone) VALUES (:name, :email, :phone)"
    $sql = "INSERT INTO {$this->tablename}(".implode(',', $fields).") 
            VALUES (".implode(',', $placeholder).")";

    // Prepare the SQL statement to prevent SQL injection.
    //https://stackoverflow.com/questions/8263371/how-can-prepared-statements-protect-from-sql-injection-attacks
    $stmt = $this->conn->prepare($sql);

    try {
      // Start a database transaction to ensure the operation is atomic.
      // If you don’t use beginTransaction(), each query (e.g., INSERT, UPDATE, DELETE) 
      // is executed independently. This means that if an error occurs midway
      //  through a sequence of operations, there’s no easy way to undo any changes
      //   that have already been made. 
      // The database might end up in an inconsistent or corrupt state.
      $this->conn->beginTransaction();

      // Execute the SQL statement, passing the data to be bound to the placeholders in the query.
      $stmt->execute($data);

      // Get the last inserted ID (useful if the table has an auto-incrementing primary key).
      $lastInsertedId = $this->conn->lastInsertId();

      // Commit the transaction to make the changes permanent.
      $this->conn->commit();

      // Return the last inserted ID.
      return $lastInsertedId;
    }
    catch(PDOException $e) {
      // If there is an error, rollback the transaction to revert any changes.
      echo "Error: " . $e->getMessage();
      $this->conn->rollback();  // Rollback in case of error
    }
  }
//get all rows
  public function getRows($start=0,$limit=4){
    $sql="SELECT  * FROM {$this->tablename} ORDER BY DESC LIMIT {$start},{$limit}";
    $stmt=$this->conn->prepare($sql);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $results=$stmt->fetchAll(PDO::FETCH_ASSOC);

    }
    else{
      $results=[];
    }
    return $results;
  }
  //get single rows
  public function getRow($field,$value){
    $sql="SELECT * FROM {$this->tablename} WHERE {$field} = :{$field}";
    $stmt=$this->conn->prepare($sql);
    $stmt->bindParam(":{$field}", $value);
    $stmt->execute();
    if($stmt->rowCount()>0){
      $result=$stmt->fetch(PDO::FETCH_ASSOC);

    }
    else{
      $result=[];
    }
    return $result;
  }

  //total iono of rows inside the database
   public function getCount(){
    $sql="SELECT count(*) as pcount FROM {$this->tablename}";
    $stmt=$this->conn->prepare($sql);
    $stmt->execute();
   $result=$stmt->fetch(PDO::FETCH_ASSOC);
    return $result['pcount'];
  }

  //upload photo function

  public function upload_photo($file)
  {
    if(!empty($file)){
      $filetempPath=$file['tmp_name'];
       $filename=$file['name'];
        $filetype=$file['type'];
       $filename_ext=explode(".", $filename);
       $fileExtension=strtolower(end($filename_ext));
       $newfileName= md5(time().$filename).".".$fileExtension;
       $allowedExtension=["png","jpg","jpeg"];
       if(in_array($fileExtension,$allowedExtension))
       {
        $uploadFileDir=getcwd().'/uploads/';
        $desFilePath=$uploadFileDir.$newfileName;
        if(move_uploaded_file($filetempPath,$desFilePath)){
          return $newfileName;
        }
       }
    }
  }
}


?>