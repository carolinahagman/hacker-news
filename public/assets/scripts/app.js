const deletePostBtn = document.querySelector("#delete-post-btn");
const deleteProfileBtn = document.querySelector("#delete-profile-btn");

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
