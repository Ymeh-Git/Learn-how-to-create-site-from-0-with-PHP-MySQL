<?php 

class Post {
    private $conn;
    private $table = 'posts';

    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    public function __construct($pdo){
        $this->conn= $pdo; 
    }

    public function read(){
        $query = "SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM
            ".$this->table." p
            LEFT JOIN
                categories c ON p.category_id = c.id
                ORDER BY p.created_at DESC";

        // prepared stmt
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function read_single(){
        $query = "SELECT
            c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM
            ".$this->table." p
            LEFT JOIN
                categories c ON p.category_id = c.id
                WHERE p.id = ? LIMIT 1";

        // prepared stmt
        $stmt = $this->conn->prepare($query);
        // bind values
        $stmt-> bindValue(1, $this->id);
        // execute
        $stmt->execute();
        // fetch array
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->title = $row['title'];
        $this->body = $row['body'];
        $this->author = $row['author'];
        $this->category_id = $row['category_id'];
        $this->category_name = $row['category_name'];
    }

    public function create(){
        $query = "INSERT INTO ".$this->table. " SET title = :title, body = :body, author = :author, category_id= :category_id;";
        // prepared stmt
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->title        = htmlspecialchars(strip_tags($this->title));
        $this->body         = htmlspecialchars(strip_tags($this->body));
        $this->author       = htmlspecialchars(strip_tags($this->author));
        $this->category_id  = htmlspecialchars(strip_tags($this->category_id));

        // bind param
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':body', $this->body);
        $stmt->bindValue(':author', $this->author);
        $stmt->bindValue(':category_id', $this->category_id);

        // execute
        if($stmt->execute()){
            return true;
        }

        // print error if something goes wrong
        printf('Error %s. \n', $stmt->error);
        return false;
    }

    // update post function
    public function update(){
        $query = "UPDATE ".$this->table. " 
        SET title = :title, 
            body = :body, 
            author = :author, 
            category_id= :category_id
        WHERE id = :id";
        // prepared stmt
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->title        = htmlspecialchars(strip_tags($this->title));
        $this->body         = htmlspecialchars(strip_tags($this->body));
        $this->author       = htmlspecialchars(strip_tags($this->author));
        $this->category_id  = htmlspecialchars(strip_tags($this->category_id));
        $this->id           = htmlspecialchars(strip_tags($this->id));

        // bind param
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':body', $this->body);
        $stmt->bindValue(':author', $this->author);
        $stmt->bindValue(':category_id', $this->category_id);
        $stmt->bindValue(':id', $this->id);

        // execute
        if($stmt->execute()){
            return true;
        }

        // print error if something goes wrong
        printf('Error %s. \n', $stmt->error);
        return false;
    }

    // delete function
    public function delete(){
        $query = "DELETE FROM ".$this->table." WHERE id = :id";

        // prepared stmt
        $stmt = $this->conn->prepare($query);

        // clean data
        $this->id           = htmlspecialchars(strip_tags($this->id));

        // bind values
        $stmt->bindValue(':id', $this->id);

        // execute
        if($stmt->execute()){
            return true;
        }

        printf("Error %s. \n", $stmt->error);
        return false;
    }
}

?>