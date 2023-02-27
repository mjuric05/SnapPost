<!DOCTYPE html>
<html>
   <head>
      <title>SnapPost</title>
      <link rel="stylesheet" type="text/css" href="styles/styles.css">
      <link rel="stylesheet" type="text/css" href="styles/font-awesome.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <template class = "post-template">
         <article class='image-card' data-post-id=''>
            <img src="" alt=""/>
            <div class="content">
               <h2></h2>
               <p></p>
               <button class="likebutton">Like</button>
               <div class="comments-section">
                  <h3>Comments</h3>
                  <button class="add-comment-button">Add Comment</button>
                  <button class="bookmarkbutton">Bookmark</button>
               </div>
            </div>
         </article>
      </template>
      <template id='comment-template'>
         <article class='comment' data-comment-id=''>
            <ul class="comment-list">
               <button class = "remove-comment-button">Remove</button>
            </ul>
         </article>
      </template>
   </head>
   <body>
      <header>
         <h1>SnapPost</h1>
      </header>
      <nav>
         <ul>
            <li><button class="addImageCardButton">Add New Post!</button></li>
            <li><button class="changeProfileCredentials">Edit Your Profile</button></li>
            <li><button class="deleteImageCardButton">Delete a Post</button></li>
         </ul>
      </nav>
      <main>
         <div class="profile">
            <img id="profilePicture" src="images/profilePicture.jpg" alt="Profile Image">
            <h2 id="username">Username: Ivan1234</h2>
            <p id="memberSince">Member Since: January 1, 2022</p>
            <p id="gender">Gender: Male</p>
         </div>
         <div class="updateProfileDiv"></div>
         <div class="content-container">
            <h2>Welcome to SnapPost!</h2>
            <p>Here is what's new:</p>
            <div class="container"></div>
         </div>
      </main>
      <?php 
         require_once("php/posts.php");
         echo(generatePostsHtml());
         ?>
      <script src="scripts/script.js"></script>
      <footer>
         <p>Copyright © SnapPost 2023</p>
      </footer>
   </body>
</html>