const themeButton = document.getElementById("theme_button");
const html = document.documentElement;
const themeList = ["light", "dark", "system"];
const themeIcon = ["ri-sun-line", "ri-moon-line", "ri-progress-4-line"];
const currentTheme = localStorage.getItem("theme") || "light";

html.setAttribute("data-theme", currentTheme);
updateThemeButton(themeList.indexOf(currentTheme));

themeButton.addEventListener("click", () => {
	const themeIndex = (themeList.indexOf(html.getAttribute("data-theme")) + 1) % themeList.length;
	const nextTheme = themeList[themeIndex];

	html.setAttribute("data-theme", nextTheme);
	localStorage.setItem("theme", nextTheme);

	updateThemeButton(themeIndex)
});

async function updateThemeButton(themeIndex) {
	themeButton.className = themeIcon[themeIndex];
	themeButton.title = await translate("MAIN_THEME_" + themeList[(themeIndex + 1) % themeList.length].toUpperCase());
}
