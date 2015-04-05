<?php

function connect()
{
    // DB connection info
    $host = "eu-cdbr-azure-north-c.cloudapp.net";
    $user = "be787757308987";
    $pwd = "a435f8ab";
    $db = "apl";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        $sql = "SET @@auto_increment_increment=1";
        $stmt = $conn->query($sql);
        $stmt->execute();
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    
    return $conn;
}

function addUser($username, $password)
{
    $conn = connect();
    if ($password==""){
        $sql = "INSERT INTO User (Name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $username);
    }
    else {
        $sql = "INSERT INTO User (Name, Password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $password);
    }
    $stmt->execute();
}

function getCategoryId($category_name)
{
    $conn = connect();
    $sql = "SELECT id FROM category WHERE name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $category_name);
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    foreach($data as $row){
        $result = $row['id']."<br>";
    }
    return $result;
}

function getCategoryName($category_id)
{
    $conn = connect();
    $sql = "SELECT name FROM category WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $category_id);
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    foreach($data as $row){
        $result = $row['name']."<br>";
    }
    return $result;
}

function addPost($userid, $category_name, $heading, $description)
{
    $category = getCategoryId($category_name);
    $conn = connect();
    $sql = "INSERT INTO Post(Description, Category, User_ID, Heading) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $description);
    $stmt->bindValue(2, $category);
    $stmt->bindValue(3, $userid);
    $stmt->bindValue(4, $heading);
    $stmt->execute();
}

function addComment($userid, $postid, $content)
{
    $conn = connect();
    $sql = "INSERT INTO Comment(Content, User_ID, Post_ID) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $content);
    $stmt->bindValue(2, $userid);
    $stmt->bindValue(3, $postid);
    $stmt->execute();
}

/*getPost(post_id); - kogu info, mis postituses on*/
function getPost($post_id)
{
    $conn = connect();
    $sql = "SELECT * FROM post WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $post_id);
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    return $data;
}

/* GetAllPosts(category); - select TOP_20 from posts group by date;
   getAllPosts(category, searchstring); otsingu jaoks
   getAllPosts(searchstring); otsingu jaoks, otsib kõikjalt
   kui ainult searchstring, siis category pane 0, kui ainult category siis searchstring pane ""
   SELECT * FROM post join category on category.id=category where category.name="Matemaatiline analüüs"; (???)
*/
function getAllPosts($category_name, $searchstring) 
{
    $conn = connect();
    if ($category_name == "") {
        $sql = "SELECT * FROM post WHERE heading LIKE ? OR description LIKE ?";
        $stmt = $conn->prepare($sql);
        $search = "%". $searchstring ."%";  
        $stmt->bindValue(1, $search);
        $stmt->bindValue(2, $search);
    } elseif ($searchstring == "") {
        $sql = "SELECT * FROM post JOIN category ON category.id=category WHERE category.name = ? ORDER BY posted DESC LIMIT 20";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $category_name);
    } else {
        $sql = "SELECT * FROM post JOIN category ON category.id=category WHERE category.name = ? AND heading LIKE ? OR description LIKE ?";
        $stmt = $conn->prepare($sql);
        $search = "%". $searchstring ."%";
        $stmt->bindValue(1, $category_name);
        $stmt->bindValue(2, $search);
        $stmt->bindValue(3, $search);
    }
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    return $data;
}
/* tagastab listi, kust saab postituste pealkirju ja sisu sellise tsükli abil
foreach($data as $row){
    echo $row['Heading']. "     " . $row['Description']. "<br>";
}
kui on vaja ainult pealkirju või ainult sisu, siis muuta vastavalt kas 
echo $row['Heading']. "<br>"; või echo $row['Description']. "<br>";*/

function getAllComments($post_id)
{
    $conn = connect();
    $sql = "SELECT * FROM comment WHERE post_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $post_id);
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    return $data;
}

function getUserById($user_id)
{
    $conn = connect();
    $sql = "SELECT Name FROM user WHERE ID = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $user_id);
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    foreach ($data as $row){
        $result = $row['Name'];
    }
    return $result;
}

//userExists(username, password); tagastab user_id, kui userit pole tagastab 0
//fbUserHasLoggedOnBefore(username); tagastab user_id, kui pole varem sisse loginud tagastab 0
function userExists($username, $password)
{
    $conn = connect();
    if ($password=="")
    {
        $sql = "SELECT IFNULL( (SELECT id FROM user WHERE name= ?) , 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $username);
    } else {
        $sql = "SELECT IFNULL( (SELECT id FROM user WHERE name= ? and password = ?) , 0)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $password);
    }
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_NUM );
    foreach ($data as $row)
    {
        $result = $row[0];
    }
    return $result;
}
/*getAllCategories(searchInputString); tühja stringi korral kõik */

function getAllCategories($searchInputString)
{
    $conn = connect();
    if ($searchInputString==""){
        $sql = "SELECT name FROM category";
        $stmt = $conn->query($sql);
    } else {
        $sql = "SELECT * FROM category WHERE name LIKE ?";
        $search = "%".$searchInputString."%";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $search);
        $stmt->execute();
    }
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );

    return $data;
}

function getCategoriesInPopularityOrder()
{
    $conn = connect();
    $sql = "SELECT category.name, count(post.category) 'popular' from post right join category on post.category=category.id group by category.name order by popular desc";
    $stmt = $conn->query($sql);
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    return $data;
}
/* $data = getCategoriesInPopularityOrder();
foreach($data as $row){
    echo $row['name']."<br>";
}
*/
?>