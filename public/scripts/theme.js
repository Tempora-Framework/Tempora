/**
 * Get local settings
 *
 * @returns
 */
function calculateSettingAsThemeString({localStorageTheme, systemSettingDark}) {
	if (localStorageTheme !== null) {
		return localStorageTheme;
	}

	if (systemSettingDark.matches) {
		return "dark";
	}

	return "light";
}

/**
 * Update theme button
 *
 * @returns
 */
async function updateButton({isDark}) {
	const text = isDark ? await translate("MAIN_THEME_LIGHT") : await translate("MAIN_THEME_DARK");

	let button = document.getElementById("theme_button");

	if (isElementExist(button)) {
		button.textContent = text;
	}
}

/**
 * Set theme
 *
 * @returns
 */
function updateThemeOnHtmlEl({theme}) {
	document.querySelector("html").setAttribute("data-theme", theme);
}

const button = document.getElementById("theme_button");
const localStorageTheme = localStorage.getItem("theme");
const systemSettingDark = window.matchMedia("(prefers-color-scheme: dark)");

let currentThemeSetting = calculateSettingAsThemeString({localStorageTheme, systemSettingDark});

updateButton({isDark: currentThemeSetting === "dark"});
updateThemeOnHtmlEl({theme: currentThemeSetting});

if (isElementExist(button)) {
	button.addEventListener("click", () => {
		const newTheme = currentThemeSetting === "dark" ? "light" : "dark";

		localStorage.setItem("theme", newTheme);
		updateButton({isDark: newTheme === "dark"});
		updateThemeOnHtmlEl({theme: newTheme});

		currentThemeSetting = newTheme;
	});
}
