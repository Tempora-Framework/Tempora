/**
 * Check if element already in DOM
 *
 * @param {*} element
 *
 * @return {boolean}
 */
function isElementExist(element) {
	return (typeof(element) != "undefined" && element != null) ? true : false;
}

/**
 * API POST request
 *
 * @param {string} path
 * @param {*} settings
 *
 * @returns
 */
async function callApi(path = "/api", type = "get", settings = null) {
	return await fetch(path, {
		method: type,
		headers: {
			"Accept": "application/json",
			"Content-Type": "application/json"
		},
		...(settings !== null && {
				body: JSON.stringify(settings)
			})
	}).then((response) => {
		return response.json();
	}).catch((error) => {
		console.log(error);
	})
}

/**
 * Return cookie value
 *
 * @param {string} name
 *
 * @return {string}
 */
function getCookie(name) {
	let cookieValue = document.cookie
		.split("; ")
		.find(
			row => row.startsWith(name + "=")
		)
		?.split("=")[1];

	return cookieValue;
}

/**
 * Lang function
 *
 * @param {string} key
 * @param {array} options
 *
 * @return {string}
 */
async function translate(key, options = null) {
	let datas = await callApi("/langs/" + getCookie("LANG") + ".json");

	let result = datas[key] || "Missing entry";

	if (options) {
		for (const [index, option] of Object.entries(options)) {
			result = result.replace(`$[${index}]`, option);
		}
	}

	return result;
}

langSelection = document.getElementById("lang_selection");
if (isElementExist(langSelection)) {
	langSelection.addEventListener("change", () => {
		let date = new Date();
		date.setTime(date.getTime() + (60*60*24*30));
		let expires = "expires=" + date.toUTCString();
		document.cookie = "LANG=" + langSelection.value + ";" + expires + ";path=/";

		window.location.reload();
	})
}
