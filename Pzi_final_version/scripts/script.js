let likeButtons = document.querySelectorAll(".likebutton");
let addCardButtons = document.querySelectorAll(".addImageCardButton");
let deleteCardButtons = document.querySelectorAll(".deleteImageCardButton");
let editProfileButtons = document.querySelectorAll(".changeProfileCredentials");
let bookmarkbuttons = document.querySelectorAll(".bookmarkbutton");
let removeCommentButtons = document.querySelectorAll(".remove-comment-button");

for (let i = 0; i < likeButtons.length; i++) {
    likeButtons[i].addEventListener("click", handleLikeClick);
}

for (let i = 0; i < addCardButtons.length; i++) {
    addCardButtons[i].addEventListener("click", createImageCard);
}

for (let i = 0; i < deleteCardButtons.length; i++) {
    deleteCardButtons[i].addEventListener("click", deleteImageCard);
}

for (let i = 0; i < editProfileButtons.length; i++) {
    editProfileButtons[i].addEventListener("click", updateProfile);
}

for (let i = 0; i < bookmarkbuttons.length; i++) {
    bookmarkbuttons[i].addEventListener("click", handleBookmarkClick);
}

for (let i = 0; i < removeCommentButtons.length; i++) {
    removeCommentButtons[i].addEventListener("click", handleRemoveCommentClick);
}

async function handleLikeClick(event) {

    let button = event.target;

    if (button.classList.contains("clicked")) {
        button.classList.remove("clicked");
    } else {
        button.classList.add("clicked");
    }

    let isCurrentlyLiked;
    if (button.classList.contains("clicked")) {
        isCurrentlyLiked = 1;
    } else {
        isCurrentlyLiked = 0;
    }
    
    const likeElement = event.currentTarget.closest('.likebutton');
    const postID = likeElement.closest('.image-card').getAttribute('data-post-id');

    if (isCurrentlyLiked == 0) {
        likeElement.classList.remove('clicked');
        likeElement.textContent = parseInt(likeElement.textContent) - 1;
    } else {
        likeElement.classList.add('clicked');
        likeElement.textContent = parseInt(likeElement.textContent) + 1;
    }

    try {
        const serverResponse = await fetch(

            `API.php?action=togglePostLike&id=${postID}&liked=${isCurrentlyLiked}&likes=${parseInt(likeElement.textContent)}`
        );
        const responseData = await serverResponse.json();

        if (!responseData.success) {
            throw new Error(`Error commenting: ${responseData.reason}`);
        }

    } catch (error) {
        throw new Error(error.message || error);
    }
}

async function handleBookmarkClick(event) {

    let button = event.target;

    if (button.classList.contains("pressed")) {
        button.classList.remove("pressed");
    } else {
        button.classList.add("pressed");
    }

    let isCurrentlyBookmarked;
    if (button.classList.contains("pressed")) {
        isCurrentlyBookmarked = 1;
    } else {
        isCurrentlyBookmarked = 0;
    }

    let bookmarkEl = event.currentTarget.closest('.bookmarkbutton');
    const postID = bookmarkEl.closest('.image-card').getAttribute('data-post-id');

    if (!isCurrentlyBookmarked) {
        bookmarkEl.classList.remove('pressed');
        bookmarkEl.textContent = "Bookmark";
    } else {
        bookmarkEl.classList.add('pressed');
        bookmarkEl.textContent = "Bookmarked";
    }

    try {
        const serverResponse = await fetch(
            `API.php?action=togglePostBookmark&id=${postID}&bookmarked=${isCurrentlyBookmarked}&bookmarks=${isCurrentlyBookmarked}`
        );
        const responseData = await serverResponse.json();

        if (!responseData.success) {
            throw new Error(`Error bookmarking post: ${responseData.reason}`);
        }


    } catch (error) {
        throw new Error(error.message || error);
    }
}

async function handleAddCommentClick(event) {
    const commentText = prompt("Enter a comment:");

    const commentListItem = document.createElement("li");
    commentListItem.classList.add("comment");
    commentListItem.textContent = commentText;

    const removeButton = document.createElement("button");
    removeButton.classList.add("remove-comment-button");
    removeButton.textContent = "Remove";
    removeButton.addEventListener("click", handleRemoveCommentClick);

    commentListItem.appendChild(removeButton);

    const commentList = event.target.parentElement.querySelector(".comment-list");
    commentList.appendChild(commentListItem);

    const commentBtn = event.currentTarget;
    const postID = commentBtn.closest('.image-card').getAttribute('data-post-id');

    if (!commentText) {
        return;
    }

    try {
        const serverResponse = await fetch(
            `API.php?action=addComment&description=${commentText}&postID=${postID}`
        );
        const responseData = await serverResponse.json();

        if (!responseData.success) {
            throw new Error(`Error commenting: ${responseData.reason}`);
        }

        location.reload();

    } catch (error) {
        throw new Error(error.message || error);
    }

}

async function handleRemoveCommentClick(event) {
    const comment = event.currentTarget.closest('.comment')
    const commentID = comment.getAttribute('data-comment-id')
    try {
        const serverResponse = await fetch(
            `API.php?action=removeComment&commentID=${commentID}`
        );
        const responseData = await serverResponse.json();

        if (!responseData.success) {
            throw new Error(`Error removing comment: ${responseData.reason}`);
        }

        comment.remove();
    } catch (error) {
        throw new Error(error.message || error);
    }
}

const addCommentButtons = document.querySelectorAll(".add-comment-button");
addCommentButtons.forEach(button => {
    button.addEventListener("click", handleAddCommentClick);
});

async function createImageCard() {

    let title = prompt("Enter a title:");
    let image = prompt("Enter an image URL:", "images/image1.png");
    let description = prompt("Enter a description:");

    try {
        const serverResponse = await fetch(`API.php?action=addPost&imageUrl=${image}&description=${description}`);
        const responseData = await serverResponse.json();

        if (!responseData.success) {

            throw new Error(`Error while adding post: ${responseData.reason}`);
        }

        let newCard = document.createElement("div");
        newCard.classList.add("image-card");
        newCard.innerHTML = `
      <img src="${image}" alt="${title}">
      <div class="content">
        <h2>${title}</h2>
        <p>${description}</p>
        <button class="likebutton">Like</button>
        <button class="bookmarkbutton">Bookmark</button>
        <div class="comments-section">
          <h3>Comments</h3>
          <button class="add-comment-button">Add Comment</button>
          <ul class="comment-list">
          </ul>
        </div>
      </div>
    `;

        let container = document.querySelector(".container");
        container.appendChild(newCard);

        const newCommentButton = newCard.querySelector(".add-comment-button");
        newCommentButton.addEventListener("click", handleAddCommentClick);

        const newLikeButton = newCard.querySelector(".likebutton");
        newLikeButton.addEventListener("click", handleLikeClick);

        const newBookmarkButton = newCard.querySelector(".bookmarkbutton");
        newBookmarkButton.addEventListener("click", handleBookmarkClick);

    } catch (error) {
        throw new Error(error.message || error);
    }
}

function deleteImageCard() {
    const titleToDelete = prompt("Enter the title of the image card you want to delete:");
    const imageCards = document.querySelectorAll(".image-card");
    let deleted = false;
    imageCards.forEach((card) => {
        const title = card.querySelector(".content h2").textContent;
        if (title === titleToDelete) {
            card.remove();
            deleted = true;
        }
    });
    if (!deleted) {
        alert(`No image card with the title "${titleToDelete}" was found.`);
    }
}

function updateProfile() {
    const newUsername = prompt("Enter new username:");
    if (newUsername !== null) {
        document.getElementById("username").textContent = "Username: " + newUsername;
    }

    const newMemberSince = prompt("Enter new member since date (e.g. January 1, 2022):");
    if (newMemberSince !== null) {
        document.getElementById("memberSince").textContent = "Member Since: " + newMemberSince;
    }

    const newGender = prompt("Enter new gender:");
    if (newGender !== null) {
        document.getElementById("gender").textContent = "Gender: " + newGender;
    }

    const newProfilePicture = prompt("Enter the URL of the new profile picture:", "images/profilePicture.jpg");
    if (newProfilePicture !== null) {
        document.getElementById("profilePicture").setAttribute("src", newProfilePicture);
    }
}