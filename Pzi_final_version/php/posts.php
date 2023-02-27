<?php
require_once("DatabaseAccess.php");

function getPostsFromDb(){
    // execute query and get posts data from the Posts table in the database
	 return getDbAccess()->executeQuery("SELECT * FROM Posts;");
}

function loadComments($postID){
    return getDbAccess()->executeQuery("SELECT * FROM Comments WHERE PostID = $postID");
}

// generate html code for posts using data from the database
function generatePostsHtml(){
    $html = "";

    $posts = getPostsFromDb();

    foreach($posts as $post){
        // get values of the columns in the table in order 
        $id = $post[0];
        $username = $post[1];
        $imageUrl = $post[2];
        $description = $post[3];
        $liked = $post[4];
        $likes = $post[5];
        $bookmarked = $post[6];
        $bookmarks = $post[7];
            
        if($bookmarked == 1) {
            $bm='Bookmarked'; 
        }
        else {
            $bm='Bookmark'; 
        } 

        $comments = loadComments($id);
        
        // html template filled with data
        $html .= "<article class='image-card' data-post-id='$id'>
                    <img src='$imageUrl' alt='$username'>
                    <div class='content'>
                        <h2>$username</h2>
                        <p>$description</p>";
                    
        if($liked == 1) {
        
            $html .= "<button class='likebutton clicked'>$likes</button>";
        }

        else {
            $html .= "<button class='likebutton'>$likes</button>";
        }
        
        if($bookmarked	== 1) {
            $html .= " <button class='bookmarkbutton pressed'>$bm</button>";
        }

        else {
            $html .= " <button class='bookmarkbutton'>$bm</button>";
        }
        
        $html .= "      <div class='comments-section'>
                            <h3>Comments</h3>
                            <button class='add-comment-button'>Add Comment</button>
                            <ul class='comment-list'>";

        foreach($comments as $comment) {
            $commentID = $comment[0];
            $commentUsername = $comment[1];
            $commentDescription = $comment[2];
            $commentPostID = $comment[3];

            $html .= "<article class='comment' data-comment-id='$commentID'>
                        <li>
                            $commentDescription
                            <button class = 'remove-comment-button'> Remove </button>
                        </li>
            </article>";
        }
        $html .= "          </ul>
                        </div>
                    </div>
                  </article>";

        if($liked == 1) {

        }

        
    }

    return $html;
}

function togglePostLike($id, $liked, $likes){
    getDbAccess()->executeQuery("UPDATE Posts SET Liked='$liked', Likes='$likes' WHERE ID='$id';");
}

function togglePostBookmark($id, $bookmarked, $bookmarks){
    getDbAccess()->executeQuery("UPDATE Posts SET Bookmarked='$bookmarked', Bookmarks='$bookmarks' WHERE ID='$id';");

}

function addPost($imageUrl, $description){
    getDbAccess()->executeInsertQuery("INSERT INTO Posts VALUES ('0', '@Grogu', '$imageUrl', '$description', '0', '0', '0', '0');");
}

function addComment($description, $postID){
    getDbAccess()->executeInsertQuery("INSERT INTO Comments VALUES ('0', '@Grogu', '$description', '$postID');");
}

function removeComment($commentID){
    getDbAccess()->executeQuery("DELETE FROM Comments WHERE ID='$commentID';");
}