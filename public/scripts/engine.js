/**
 * Check if element already in DOM
 *
 * @param {*} element
 *
 * @returns
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

function getCookie(name) {
	let cookieValue = document.cookie
	.split("; ")
	.find(
		row => row.startsWith(name + "=")
	)
	?.split("=")[1];

	return cookieValue;
}

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
