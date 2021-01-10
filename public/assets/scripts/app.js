const deletePostBtn = document.querySelector("#delete-post-btn");

if (deletePostBtn) {
  deletePostBtn.addEventListener("click", (e) => {
    e.preventDefault();
    const confirm = window.confirm("You are now deleting your post.");
    if (confirm) {
      document.querySelector("#delete-form").submit();
    }
  });
}
