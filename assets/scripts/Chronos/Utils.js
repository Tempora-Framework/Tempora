class ChronosUtils {
	/**
	 * Check if element already in DOM
	 *
	 * @param {*} element
	 *
	 * @return {boolean}
	 */
	static exist(element) {
		return element != "undefined" && element != null;
	}

	/**
	 * Show / Hide chronos panel
	 *
	 * @param {*} state
	 */
	static display(state = null) {
		const chronos = document.querySelector(".tempora_chronos");
		if (ChronosUtils.exist(chronos)) {
			if (state === null) {
				state = localStorage.getItem("chronos") === "true" ? true : false;
			}

			chronos.classList.toggle("hidden", !state);
			localStorage.setItem("chronos", state);
		}
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
	static modifyColor(hexColor, type = 'lighten', amount = 20) {
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
}
