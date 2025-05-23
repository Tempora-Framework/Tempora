const temporaErrorContainer = document.getElementById("tempora_error_container");
const TemoraError = document.getElementById("tempora_error");
const close = document.getElementById("close");
const showMoreButtons = document.querySelectorAll(".chronos_show_more");
const showMoreTitles = document.querySelectorAll(".file");

temporaErrorContainer.addEventListener("click", (event) => {
	if (event.target === temporaErrorContainer) {
		temporaErrorContainer.style.opacity = 0;
		setTimeout(() => {
			temporaErrorContainer.style.display = "none";
		}, 200);
	}
});

close.addEventListener("click", () => {
	temporaErrorContainer.style.opacity = 0;
	setTimeout(() => {
		temporaErrorContainer.style.display = "none";
	}, 200);
});

showMoreButtons.forEach((button) => {
	button.addEventListener("click", (event) => {
		if (event.target === button) {
			showMore(button);
		}
	});
});

showMoreTitles.forEach((title) => {
	title.addEventListener("click", (event) => {
		if (event.target === title) {
		title.firstChild.click();
		}
	});
});

function showMore(button) {
	let codeBlock = button.closest(".file_container");

	if (!codeBlock)
		return;

	codeBlock.querySelectorAll(".line").forEach(line => {
		line.classList.toggle("hidden");
	});

	let icon = button;
	const isDown = icon.classList.toggle("ri-arrow-down-s-line");
	icon.classList.toggle("ri-arrow-up-s-line", !isDown);
}
