let toolbarUserTitle = document.getElementById("toolbar_user_title");
let toolbarMs = document.getElementById("toolbar_ms");

if (isElementExist(toolbarUserTitle)) {
	let toolbarTimer = setInterval(() => {
		let toolbarMsValue = document.getElementById("toolbar_ms").textContent.replace(" s", "");

		if (toolbarMsValue <= 0) {
			toolbarUserTitle.style.color = "red";
			toolbarMs.style.color = "red";
			toolbarMs.textContent = "Timed out";
			window.clearInterval(toolbarTimer);
		} else {
			toolbarMsValue--;
			toolbarMs.textContent = toolbarMsValue + " s";
		}
	}, 1000);
}
