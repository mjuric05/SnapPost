<?php
require_once("php/posts.php");

// function that we call from our JS code that processes the request and calls actions that execute queries
function processRequest(){
  $action = getRequestParameter("action");

    // action that was called
    switch ($action) {
      case 'togglePostLike':
        processTogglePostLike();
        break;
      case 'togglePostBookmark':
        processTogglePostBookmark();
        break;
      case 'addPost':
        processAddPost();
        break;
      case 'addComment':
        processAddComment();
        break;
      case 'removeComment':
        processRemoveComment();
        break;
      default:
      echo(json_encode(array(
         "success" => false,
         "reason" => "Unknown action: $action"
      )));
      break;
    }
}

// getRequestParameter("action") -> "deleteCard"
function getRequestParameter($key) {
   // $_REQUEST[$key] -> a map of keys and values from the request
   return isset($_REQUEST[$key]) ? $_REQUEST[$key] : "";
}

//API.php?action=togglePostLike&id=1&liked=1&likes=1
function processTogglePostLike(){
  $success = false;
  $reason = "";

  $id = getRequestParameter("id");
  $liked = getRequestParameter("liked");
  $likes = getRequestParameter("likes");

  if (is_numeric($id) && is_numeric($liked) && is_numeric($likes)) {
    togglePostLike($id, $liked, $likes);
    $success = true;
  } 
  else {
    $success = false;
    $reason = "Needs id:number; like:number; likes:number";
  }

  echo(json_encode(array(
  "success" => $success,
  "reason" => $reason
  )));
}

//API.php?action=togglePostBookmark&id=1&bookmarked=1&bookmarks=1
function processTogglePostBookmark(){
  $success = false;
  $reason = "";

  $id = getRequestParameter("id");
  $bookmarked = getRequestParameter("bookmarked");
  $bookmarks = getRequestParameter("bookmarks");

  if (is_numeric($id) && is_numeric($bookmarked)&& is_numeric($bookmarks)) {
    togglePostBookmark($id, $bookmarked, $bookmarks);
    $success = true;
  } 
  else {
    $success = false;
    $reason = "Needs id:number; bookmark:number; bookmarks:number";
  }

  echo(json_encode(array(
  "success" => $success,
  "reason" => $reason
  )));
}

//API.php?action=addPost&imageUrl=asdfjgk&description=fsefef
function processAddPost(){
  $success =false;
  $reason = "";
  $id = 0;

  $imageUrl = getRequestParameter('imageUrl');
  $description = getRequestParameter('description');

  if($imageUrl != "" && $description != ""){
    $id = addPost($imageUrl, $description);
    $success = true;
  }
  else{
    $success = false;
    $reason = "Needs description and imageUrl";
  }

  echo(json_encode(array(
    "success" => $success,
    "reason" => $reason,
    "id" => $id
    )));
}

//API.php?action=addComment&description=fsefef&postID=1
function processAddComment(){
  $success =false;
  $reason = "";
  $id = 0;

  $description = getRequestParameter('description');
  $postID = getRequestParameter('postID');

  if($description != "" && $postID != ""){
    $id = addComment($description, $postID);
    $success = true;
  }
  else{
    $success = false;
    $reason = "Needs description";
  }

  echo(json_encode(array(
    "success" => $success,
    "reason" => $reason,
    "id" => $id
    )));
}

function processRemoveComment(){
  $success =false;
  $reason = "";
  $id = 0;

  $commentID = getRequestParameter('commentID');

  if(is_numeric($commentID)){
    $id = removeComment($commentID);
    $success = true;
  }
  else{
    $success = false;
    $reason = "Requires: commentID (numeric)";
  }

  echo(json_encode(array(
    "success" => $success,
    "reason" => $reason,
    "id" => $id
    )));
}


processRequest();