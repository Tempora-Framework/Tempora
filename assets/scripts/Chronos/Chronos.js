class Chronos {
	/**
	 * Apply colors to chronos elements
	 */
	static applyColor() {
		const chronosDropElements = document.querySelectorAll(".tempora_chronos_block_content");

		chronosDropElements.forEach((dropElement) => {
			const color = dropElement.dataset.color;
			const header = dropElement.querySelector('.tempora_chronos_drop_element_header');

			if (ChronosUtils.exist(header)) {
				header.style.backgroundColor = color;
			}
		});
	}

	static pinHoverListener(pin) {
		const color = pin.parentElement.parentElement.dataset.color;
		pin.addEventListener('mouseenter', () => {
			pin.style.backgroundColor = ChronosUtils.modifyColor(color, 'lighten');
		});
		pin.addEventListener('mouseleave', () => {
			pin.style.backgroundColor = color;
		});
	}
}
