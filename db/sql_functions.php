<?php
// priit lisas
function formatDate($str){
    $space = explode(" ", $str);
    $minus = explode("-", $space[0]);
    $colon = explode(":", $space[1]);
    return $minus[2].'.'.$minus[1].'.'.$minus[0].' '.$colon[0].':'.$colon[1].'';
}

    
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
        $sql2 = "set time_zone = '+03:00'";
        $stmt2 = $conn->query($sql2);
        $stmt2->execute();
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    
    return $conn;
}
function addUser($username, $password, $Profilepicture)
{
    $conn = connect();
    if ($password=="" and $Profilepicture==""){
        $sql = "INSERT INTO User (Name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $username);
    }
    else if ($Profilepicture==""){
        $sql = "INSERT INTO User (Name, Password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $password);
    } else if ($password=="") {
        $sql = "INSERT INTO User (Name, Profilepicture) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $Profilepicture);
    } else{
        $sql = "INSERT INTO User (Name, Password, Profilepicture) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(1, $username);
        $stmt->bindValue(2, $password);
        $stmt->bindValue(3, $Profilepicture);
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
        $result = $row['id'];
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
        $result = $row['name'];
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
    $sql2 = "SELECT id FROM post WHERE user_id = ? ORDER BY posted DESC LIMIT 1;";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindValue(1, $userid);
    $stmt2->execute();
    $data = $stmt2->fetchAll( PDO::FETCH_ASSOC );
    foreach($data as $row){
        $result = $row['id'];
    }
    return $result;
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
        $sql = "SELECT * FROM post JOIN category ON category.id=category WHERE category.name = ? AND (heading LIKE ? OR description LIKE ?)";
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
    $sql = "SELECT Name, Password, Joined, Profilepicture FROM user WHERE ID = ? ";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $user_id);
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    // foreach ($data as $row){
        // $result = $row['Name'];
    // }
    return $data;
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

//tagastab tabeli post+comment, uuemad on eespool

function getUserPostsandComments($username){
    $conn = connect();
    $sql = "SELECT post.id, Description, Null as Content, Category, User_ID, Posted, Heading, Null as Post_ID, Downvote, Upvote  FROM post INNER JOIN user ON User_ID=user.ID WHERE user.name= ?
            UNION
            SELECT comment.id, Null as Description, Content, Null as Category, User_ID, Posted, Null as Heading, Post_ID, Upvote, Downvote FROM comment INNER JOIN user ON User_ID=user.ID WHERE user.name= ? ORDER BY posted DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, $username);
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    return $data;
}

function nuberofCommentsandPostsbyUser($username){
    $conn = connect();
    $sql = "SELECT count(*) as 'summa' from(SELECT post.id, Description, Category, User_ID, Posted, Heading, Downvote, Upvote FROM post INNER JOIN user ON User_ID=user.ID WHERE user.name=?
            UNION
            SELECT comment.id, Content, Null as Category, User_ID, Posted, Post_ID, Upvote, Downvote FROM comment INNER JOIN user ON User_ID=user.ID WHERE user.name=? ORDER BY posted ASC) as tem";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $username);
    $stmt->bindValue(2, $username);
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    return $data;
}


//kontrollib, kas pärast mingit kellaaega on postitusi lisatud, time on string 'aaaa-kk-pp tt:mm:ss', kellaaja või kellaaja sekundid võib lisamata jätta, kui vaja pole
//tagastab null, kui pole lisatud pärast seda kellaaega
function postsAddedAfterTime($time){
    $conn = connect();
    $sql = "SELECT * FROM post WHERE Posted>?";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(1, $time);
    $stmt->execute();
    $data = $stmt->fetchAll( PDO::FETCH_ASSOC );
    return $data;
}
?>