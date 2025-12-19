chronosMain = document.getElementById("tempora_chronos_title");
chronosClose = document.getElementById("chronos_close");
chronosElements = document.querySelectorAll(".tempora_chronos_drop_container");
chronosPins = document.querySelectorAll(".tempora_chronos .pin");

windowWidth = window.innerWidth;
windowHeight = window.innerHeight;

window.addEventListener('resize', () => {
	windowWidth = window.innerWidth;
});

Chronos.applyColor();

// Handle chronos dropdown positioning
chronosElements.forEach((element) => {
	element.addEventListener('mouseenter', () => {
		const dropElement = element.querySelector('.tempora_chronos_block_content');

		if (
			dropElement
			&& (!dropElement.classList.contains('windowed'))
		) {
			dropElement.style.left = '';
			dropElement.style.right = '';

			const rect = dropElement.getBoundingClientRect();

			if (rect.right > windowWidth) {
				dropElement.style.left = 'auto';
				dropElement.style.right = '0';
			}

			if (rect.left < 0) {
				dropElement.style.left = '0';
				dropElement.style.right = 'auto';
			}
		}
	});
});

// Handle chronos open / close
if (
	ChronosUtils.exist(chronosClose)
	&& ChronosUtils.exist(chronosMain)
) {
	chronosClose.addEventListener("click", () => {
		ChronosUtils.display(false);
	});

	chronosMain.addEventListener("click", () => {
		ChronosUtils.display(true);
	});
}

ChronosUtils.display();

if (ChronosUtils.exist(chronosPins)) {
	chronosPins.forEach((pin) => {
		// Handle pin click to toggle windowed mode
		pin.addEventListener("click", (event) => {
			event.stopPropagation();

			const chronosWindows = new ChronosWindows(pin.parentElement.parentElement.dataset.id);
			chronosWindows.display();
			chronosWindows.reorder();
		});

		Chronos.pinHoverListener(pin);
	});

	// Load saved windowed elements on page load
	ChronosWindows.getSavedElements().forEach((key) => {
		const id = key.replace("chronos_windowed_", "");
		const element = document.querySelector(`.tempora_chronos_block_content[data-id='${id}']`);

		if (ChronosUtils.exist(element)) {
			const value = JSON.parse(localStorage.getItem(key));
			if (value.showed) {
				(new ChronosWindows(id)).display();
			}
		}
	});
}
