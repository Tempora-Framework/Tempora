chronos = document.querySelector(".tempora_chronos");
chronosMain = document.getElementById("tempora_chronos_title");
chronosClose = document.getElementById("chronos_close");
chronosUserTitle = document.getElementById("chronos_user_title");
chronosMs = document.getElementById("chronos_ms");
chronosElements = document.querySelectorAll(".tempora_chronos_drop_container");
chronosPins = document.querySelectorAll(".tempora_chronos .pin");
chronosDropElements = document.querySelectorAll(".tempora_chronos_block_content");

windowWidth = window.innerWidth;
windowHeight = window.innerHeight;

window.addEventListener('resize', () => {
	windowWidth = window.innerWidth;
});

applyChronosColors();

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

/**
 * Apply colors to chronos elements
 */
function applyChronosColors() {
	chronosDropElements.forEach((dropElement) => {
		const color = dropElement.dataset.color;
		const header = dropElement.querySelector('.tempora_chronos_drop_element_header');

		dropElement.style.background = `radial-gradient(ellipse at right center, ${color}e0 0%, #191a1be0 65%)`
		if (isElementExist(header)) {
			header.style.backgroundColor = color;
		}
	});
}

displayChronos(JSON.parse(localStorage.getItem("chronos") || true));

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
		displayChronos(false);
		localStorage.setItem("chronos", false);
	});
}

if (isElementExist(chronosMain)) {
	chronosMain.addEventListener("click", () => {
		displayChronos(true);
		localStorage.setItem("chronos", true);
	});
}

if (isElementExist(chronosPins)) {
	chronosPins.forEach((pin) => {
		// Handle pin click to toggle windowed mode
		pin.addEventListener("click", (event) => {
			event.stopPropagation();

			chronosDisplayWindowedElement(pin.parentElement.parentElement.dataset.id);

			windowFocus(document.querySelector(`.tempora_chronos_block_content.windowed[data-id='${pin.parentElement.parentElement.dataset.id}']`));
		});

		pinHoverListener(pin);
	});

	// Load saved windowed elements on page load
	chronosGetWindowedSavedElements().forEach((key) => {
		const id = key.replace("chronos_windowed_", "");
		const element = document.querySelector(`.tempora_chronos_block_content[data-id='${id}']`);

		if (isElementExist(element)) {
			const value = JSON.parse(localStorage.getItem(key));
			if (value.showed) {
				chronosDisplayWindowedElement(id);
			}
		}
	});
}

/**
 * Handle pin hover effect
 *
 * @param {*} pin
 */
function pinHoverListener(pin) {
	const color = pin.parentElement.parentElement.dataset.color;
	pin.addEventListener('mouseenter', () => {
		pin.style.backgroundColor = modifyColor(color, 'lighten');
	});
	pin.addEventListener('mouseleave', () => {
		pin.style.backgroundColor = color;
	});
}

/**
 * Display element in windowed mode
 *
 * @param {*} id
 */
function chronosDisplayWindowedElement(id) {
	const element = document.querySelector(`.tempora_chronos_block_content[data-id='${id}']`);
	let value = localStorage.getItem("chronos_windowed_" + id);

	if (!value) {
		chronosLocalStorageSave(id, {
			showed: true,
			index: chronosGetWindowedSavedElements().length + 1,
			x: 10,
			y: 10,
			h: 300,
			w: 500
		});
		value = localStorage.getItem("chronos_windowed_" + id);
	}

	if (isElementExist(element)) {
		// check if showed exists in value
		const x = JSON.parse(value).x;
		const y = JSON.parse(value).y;
		const h = JSON.parse(value).h;
		const w = JSON.parse(value).w;
		const index = JSON.parse(value).index;

		const container = element.cloneNode(true);
		element.style.display = "none";
		const pin = container.querySelector(".pin");
		pin.style.backgroundColor = container.dataset.color;
		pinHoverListener(pin);

		container.style.top = y + "px";
		container.style.left = x + "px";
		container.style.height = h + "px";
		container.style.width = w + "px";

		container.style.zIndex = (1000 + index).toString();

		container.classList.add("windowed");

		// Handle focus on click
		container.addEventListener("click", () => {
			windowFocus(container);
		});

		element.style.removeProperty("left");
		element.style.removeProperty("right");

		// Handle resize and save position
		container.addEventListener("mouseup", () => {
			chronosLocalStorageSave(id, {
				showed: true,
				index: JSON.parse(localStorage.getItem("chronos_windowed_" + id)).index,
				x: container.offsetLeft,
				y: container.offsetTop,
				h: container.offsetHeight,
				w: container.offsetWidth
			});
		});

		pin.classList.add("pinned");
		pin.classList.replace("ri-pushpin-line", "ri-pushpin-fill");

		// Handle pin click to unwindow the element
		pin.addEventListener("click", (event) => {
			event.stopPropagation();
			container.remove();
			element.style.removeProperty("display");

			const currentValue = localStorage.getItem("chronos_windowed_" + id);
			// Save state as unwindowed
			localStorage.setItem("chronos_windowed_" + id, JSON.stringify({
				showed: false,
				index: JSON.parse(currentValue).index,
				x: JSON.parse(currentValue).x,
				y: JSON.parse(currentValue).y,
				h: JSON.parse(currentValue).h,
				w: JSON.parse(currentValue).w
			}));
		});

		dragElement(container, pin.parentElement);

		document.body.prepend(container);
	}
}

/**
 * Make element draggable
 *
 * @param {*} element
 * @param {*} handle
 */
function dragElement(element, handle) {
	let pos1 = 0;
	let pos2 = 0;
	let pos3 = 0;
	let pos4 = 0;

	handle.onmousedown = dragMouseDown;

	/**
	 * Mouse down event
	 *
	 * @param {*} e
	 */
	function dragMouseDown(e) {
		e.preventDefault();
		pos3 = e.clientX;
		pos4 = e.clientY;

		document.onmouseup = closeDragElement;
		document.onmousemove = elementDrag;

		windowFocus(element);
	}

	/**
	 * Mouse move event
	 *
	 * @param {*} e
	 */
	function elementDrag(e) {
		e.preventDefault();

		pos1 = pos3 - e.clientX;
		pos2 = pos4 - e.clientY;
		pos3 = e.clientX;
		pos4 = e.clientY;

		element.style.top = (element.offsetTop - pos2) + "px";
		element.style.left = (element.offsetLeft - pos1) + "px";

		windowFixedPosition(element);
	}

	/**
	 * Mouse up event
	 */
	function closeDragElement() {
		document.onmouseup = null;
		document.onmousemove = null;
	}
}

/**
 * Fix windowed element position if out of viewport
 *
 * @param {*} element
 */
function windowFixedPosition(element) {
	if (isElementExist(element)
		&& element.classList.contains("windowed")
	) {
		const rect = element.getBoundingClientRect();

		if (rect.right > windowWidth) {
			element.style.left = 'auto';
			element.style.right = '0';
		}

		if (rect.left < 0) {
			element.style.left = '0';
			element.style.right = 'auto';
		}

		if (windowHeight < rect.bottom) {
			element.style.top = (windowHeight - rect.height) + "px";
		}

		if (rect.top < 0) {
			element.style.top = '0';
		}

		chronosLocalStorageSave(element.dataset.id, {
			showed: true,
			index: JSON.parse(localStorage.getItem("chronos_windowed_" + element.dataset.id)).index,
			x: element.offsetLeft,
			y: element.offsetTop,
			h: element.offsetHeight,
			w: element.offsetWidth
		});
	}
}

/**
 * Focus windowed element
 *
 * @param {*} element
 */
function windowFocus(element) {
	const windowedElements = chronosGetWindowedSavedElements();

	const sortByIndexElements = windowedElements.sort((a, b) => {
		const aIndex = JSON.parse(localStorage.getItem(a)).index;
		const bIndex = JSON.parse(localStorage.getItem(b)).index;

		return aIndex - bIndex;
	});

	let currentIndex = 1;
	sortByIndexElements.forEach((key) => {
		const id = key.replace("chronos_windowed_", "");
		const dropElement = document.querySelector(`.tempora_chronos_block_content.windowed[data-id='${id}']`);

		if (isElementExist(dropElement)) {
			let index;

			if (id === element.dataset.id) {
				index = windowedElements.length;
			} else {
				index = currentIndex;

				currentIndex++;
			}

			chronosLocalStorageSave(id, {
				showed: true,
				index: index,
				x: JSON.parse(localStorage.getItem(key)).x,
				y: JSON.parse(localStorage.getItem(key)).y,
				h: JSON.parse(localStorage.getItem(key)).h,
				w: JSON.parse(localStorage.getItem(key)).w
			});

			dropElement.style.zIndex = (1000 + JSON.parse(localStorage.getItem(key)).index).toString();
		}
	});
}

/**
 * Save windowed element state to localStorage
 *
 * @param {*} id
 * @param {*} value
 */
function chronosLocalStorageSave(id, value) {
	localStorage.setItem("chronos_windowed_" + id, JSON.stringify(
		{
			showed: value.showed,
			index: value.index,
			x: value.x,
			y: value.y,
			h: value.h,
			w: value.w
		}
	));
}

/**
 * Get all windowed saved elements from localStorage
 *
 * @return {Array}
 */
function chronosGetWindowedSavedElements() {
	return Object.keys(localStorage).filter((key) => key.startsWith("chronos_windowed_"));
}

/**
 * Show / Hide chronos panel
 *
 * @param {*} state
 */
function displayChronos(state) {
	if (state) {
		chronos.classList.remove("hidden");
	} else {
		chronos.classList.add("hidden");
	}
}

/**
 * Check if element already in DOM
 *
 * @param {*} element
 *
 * @return {boolean}
 */
function isElementExist(element) {
	return element != "undefined" && element != null;
}

/**
 * Lighten or darken a hex color
 *
 * @param {string} hexColor
 * @param {string} type
 * @param {number} amount
 *
 * @return {string}
 */
function modifyColor(hexColor, type = 'lighten', amount = 20) {
	let usePound = false;

	if (hexColor[0] === "#") {
		hexColor = hexColor.slice(1);
		usePound = true;
	}

	if (hexColor.length === 8) {
		hexColor = hexColor.slice(0, 6);
	}

	const num = parseInt(hexColor, 16);

	let r = (num >> 16) + (type === 'lighten' ? amount : -amount);
	if (r > 255) r = 255;
	else if (r < 0) r = 0;

	let g = ((num >> 8) & 0x00FF) + (type === 'lighten' ? amount : -amount);
	if (g > 255) g = 255;
	else if (g < 0) g = 0;

	let b = (num & 0x0000FF) + (type === 'lighten' ? amount : -amount);
	if (b > 255) b = 255;
	else if (b < 0) b = 0;

	return (usePound ? "#" : "") + (r.toString(16).padStart(2, '0')) + (g.toString(16).padStart(2, '0')) + (b.toString(16).padStart(2, '0'));
}
