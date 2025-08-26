chronos = document.querySelector(".tempora_chronos");
chronosMain = document.getElementById("tempora_chronos_title");
chronosClose = document.getElementById("chronos_close");
chronosUserTitle = document.getElementById("chronos_user_title");
chronosMs = document.getElementById("chronos_ms");
chronosElements = document.querySelectorAll(".tempora_chronos_drop_container");

if (isElementExist(chronosUserTitle)) {
	let chronosTimer = setInterval(() => {
		let chronosMsValue = document.getElementById("chronos_ms").textContent.replace(" s", "");

		if (chronosMsValue <= 0) {
			chronosUserTitle.style.color = "red";
			chronosMs.style.color = "red";
			chronosMs.textContent = "Timed out";
			window.clearInterval(chronosTimer);
		} else {
			chronosMsValue--;
			chronosMs.textContent = chronosMsValue + " s";
		}
	}, 1000);
}

if (isElementExist(chronosMain)) {
	chronosClose.addEventListener("click", () => {
		chronos.classList.add("hidden");
	});
}

if (isElementExist(chronosMain)) {
	chronosMain.addEventListener("click", () => {
		chronos.classList.remove("hidden");
	});
}
