const deletePostBtn = document.querySelector("#delete-post-btn");
const deleteProfileBtn = document.querySelector("#delete-profile-btn");
const newSortingBtn = document.querySelector("#new-sorting-btn");
const upvoteSortingBtn = document.querySelector("#upvote-sorting-btn");
const commentSortingBtn = document.querySelector("#comment-sorting-btn");
const editCommentBtns = document.querySelectorAll(".edit-comment-btn");
const dropBtns = document.querySelectorAll(".dropdown-btn");
const dropDowns = document.querySelectorAll(".dropdown-content");
const innerCard = document.querySelector(".flip-card-inner");
const editProfileBtn = document.querySelector(".edit-profile-btn");
const cancelBtn = document.querySelector("#cancel-btn");
// const sendEditBtns = document.querySelectorAll(".send-edit-btn");
const upvoteBtns = document.querySelectorAll(".upvote-btn");
if (deletePostBtn) {
  deletePostBtn.addEventListener("click", (e) => {
    e.preventDefault();
    const confirm = window.confirm("You are now deleting your post");
    if (confirm) {
      document.querySelector("#delete-form").submit();
    }
  });
}

if (deleteProfileBtn) {
  deleteProfileBtn.addEventListener("click", (e) => {
    e.preventDefault();
    const confirm = window.confirm("You are now deleting everything");
    if (confirm) {
      document.querySelector("#delete-profile-form").submit();
    }
  });
}
if (dropBtns.length > 0) {
  dropBtns.forEach((dropBtn) => {
    const data = dropBtn.dataset.commentId;
    dropBtn.addEventListener("focus", () => {
      document.querySelector(`#my-dropdown${data}`).classList.toggle("show");
    });
    dropBtn.addEventListener("blur", () => {
      setTimeout(() => {
        document.querySelector(`#my-dropdown${data}`).classList.toggle("show");
      }, 100);
    });
  });
}

if (editCommentBtns.length !== 0) {
  editCommentBtns.forEach((btn) => {
    btn.addEventListener("click", (event) => {
      const data = btn.dataset.commentId;
      document
        .querySelector(`#edit-comment-text${data}`)
        .classList.toggle("hidden");
      document
        .querySelector(`#comment-content${data}`)
        .classList.toggle("hidden");
      document
        .querySelector(`#send-edit-comment-btn${data}`)
        .classList.toggle("hidden");
      document.querySelector(`#dropbtn${data}`).classList.toggle("hidden");
    });
  });
}

if (upvoteBtns.length > 0) {
  upvoteBtns.forEach((upvoteBtn) => {
    const userId = upvoteBtn.dataset.userId;
    const postId = upvoteBtn.dataset.postId;
    if (userId && postId) {
      upvoteBtn.addEventListener("click", (e) => {
        e.preventDefault();
        const ajax = new XMLHttpRequest();
        ajax.open(
          "get",
          `http://localhost:8000/app/posts/upvote.php?userId=${userId}&postId=${postId}`,
          "SERVER-SCRIPT"
        );
        ajax.send();
        const count = upvoteBtn.querySelector(".upvote-counter").innerHTML;
        if (upvoteBtn.querySelector(".arrow-up").classList.contains("black")) {
          console.log("hello world");
          upvoteBtn.querySelector(".arrow-up").classList.toggle("black");
          upvoteBtn.querySelector(".arrow-up").classList.toggle("orange");
          upvoteBtn.querySelector(".upvote-counter").innerHTML =
            Number(count) + 1;
        } else {
          upvoteBtn.querySelector(".arrow-up").classList.toggle("black");
          upvoteBtn.querySelector(".arrow-up").classList.toggle("orange");
          upvoteBtn.querySelector(".upvote-counter").innerHTML =
            Number(count) - 1;
        }
        return false;
      });
    }
  });
}
if (editProfileBtn) {
  editProfileBtn.addEventListener("click", () => {
    innerCard.classList.add("flip");
  });
  cancelBtn.addEventListener("click", () => {
    innerCard.classList.remove("flip");
  });
}
