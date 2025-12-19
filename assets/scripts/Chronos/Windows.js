class ChronosWindows {
	constructor(id, showed = null, index = null, x = null, y = null, h = null, w = null) {
		this.id = "chronos_windowed_" + id;
		this.showed = showed;
		this.index = index;
		this.x = x;
		this.y = y;
		this.h = h;
		this.w = w;
	}

	/**
	 * Display the windowed element
	 */
	display() {
		const element = document.querySelector(`.tempora_chronos_block_content[data-id='${this.id.replace("chronos_windowed_", "")}']`);
		let value = localStorage.getItem(this.id);

		if (!value) {
			this.showed = true;
			this.index = ChronosWindows.getSavedElements().length + 1;
			this.x = 10;
			this.y = 10;
			this.h = 300;
			this.w = 500;
			this.localDataSave();

			value = localStorage.getItem(this.id);
		}

		if (ChronosUtils.exist(element)) {
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
			Chronos.pinHoverListener(pin);

			container.style.top = y + "px";
			container.style.left = x + "px";
			container.style.height = h + "px";
			container.style.width = w + "px";

			container.style.zIndex = (1000 + index).toString();

			container.classList.add("windowed");

			// Handle focus on click
			container.addEventListener("click", () => {
				this.reorder(container);
			});

			element.style.removeProperty("left");
			element.style.removeProperty("right");

			// Handle resize and save position
			container.addEventListener("mouseup", () => {
				this.x = container.offsetLeft;
				this.y = container.offsetTop;
				this.h = container.offsetHeight - 2;
				this.w = container.offsetWidth - 2;
				this.localDataSave();
			});

			pin.classList.add("pinned");
			pin.classList.replace("ri-pushpin-line", "ri-pushpin-fill");

			// Handle pin click to unwindow the element
			pin.addEventListener("click", (event) => {
				event.stopPropagation();
				container.remove();
				element.style.removeProperty("display");

				this.showed = false;
				this.localDataSave();
			});

			this.showed = true;
			this.localDataSave();

			this.dragElement(container, pin.parentElement);

			document.body.prepend(container);
		}
	}

	/**
	 * Save windowed element state to localStorage
	 */
	localDataSave() {
		const currentValue = JSON.parse(localStorage.getItem(this.id));

		localStorage.setItem(
			this.id,
			JSON.stringify({
				showed: this.showed !== null ? this.showed : currentValue.showed,
				index: this.index !== null ? this.index : currentValue.index,
				x: this.x !== null ? this.x : currentValue.x,
				y: this.y !== null ? this.y : currentValue.y,
				h: this.h !== null ? this.h : currentValue.h,
				w: this.w !== null ? this.w : currentValue.w
			})
		);
	}

	/**
	 * Get all windowed saved elements from localStorage
	 *
	 * @return {Array}
	 */
	static getSavedElements() {
		return Object.keys(localStorage).filter((key) => key.startsWith("chronos_windowed_"));
	}

	/**
	 * Reorder windowed elements to bring the selected one to front
	 *
	 * @param {*} element
	 */
	reorder(element = null) {
		const windowedElements = ChronosWindows.getSavedElements();

		const sortByIndexElements = windowedElements.sort((a, b) => {
			const aIndex = JSON.parse(localStorage.getItem(a)).index;
			const bIndex = JSON.parse(localStorage.getItem(b)).index;

			return aIndex - bIndex;
		});

		let currentIndex = 1;
		sortByIndexElements.forEach((key) => {
			const id = key.replace("chronos_windowed_", "");
			const chronosWindows = new ChronosWindows(id);
			const dropElement = document.querySelector(`.tempora_chronos_block_content.windowed[data-id='${id}']`);

			if (ChronosUtils.exist(dropElement)) {
				let index;

				if (id === (element != null ? element.dataset.id : this.id)) {
					index = windowedElements.length;
				} else {
					index = currentIndex;

					currentIndex++;
				}

				chronosWindows.index = index;
				chronosWindows.localDataSave();

				dropElement.style.zIndex = (1000 + JSON.parse(localStorage.getItem(key)).index).toString();
			}
		});
	}

	/**
	 * Fix windowed element position if out of viewport
	 *
	 * @param {*} element
	 */
	fixPositions(element) {
		if (
			ChronosUtils.exist(element)
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

			this.x = element.offsetLeft;
			this.y = element.offsetTop;
			this.localDataSave();
		}
	}

	/**
	 * Make element draggable
	 *
	 * @param {*} element
	 * @param {*} handle
	 */
	dragElement(element, handle) {
		const chronosWindows = new ChronosWindows(element.dataset.id);
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

			chronosWindows.reorder(element);
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

			chronosWindows.fixPositions(element);
		}

		/**
		 * Mouse up event
		 */
		function closeDragElement() {
			document.onmouseup = null;
			document.onmousemove = null;
		}
	}
}
