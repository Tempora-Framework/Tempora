dataLang = [];
isDataLangLoaded = false;

(async () => {
	dataLang = await callApi("/langs/" + getCookie("LANG") + ".json");
	isDataLangLoaded = true;
})();

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
		console.error(error);
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
	return document.cookie
		.split("; ")
		.find(
			row => row.startsWith(name + "=")
		)
		?.split("=")[1];
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
	if (!isDataLangLoaded) {
		await new Promise(resolve => {
			const checkInterval = setInterval(() => {
				if (isDataLangLoaded) {
					clearInterval(checkInterval);
					resolve();
				}
			}, 10);
		});
	}

	let result = dataLang[key] || "Missing entry";

	if (options) {
		for (const [index, option] of Object.entries(options)) {
			result = result.replace(`$[${index}]`, option);
		}
	}

	return result;
}

/**
 * Display notification
 *
 * @param {string} message
 */
function setNotification(message) {
	let div = document.createElement("div");
	let p = document.createElement("p");

	div.className = "main_notification";
	div.id = "main_notification";
	p.textContent = message;
	div.append(p);

	document.body.appendChild(div);

	setCookie("NOTIFICATION", 60*60);
}

/**
 * Set cookie
 *
 * @param {string} name
 * @param {string} value
 * @param {number} time
 */
function setCookie(name, time, value = "") {
	let date = new Date();
	date.setTime(date.getTime() + time);
	let expires = "expires=" + date.toUTCString();
	document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

// Events

// Lang selection
langSelection = document.getElementById("lang_selection");
if (isElementExist(langSelection)) {
	langSelection.addEventListener("change", () => {
		setCookie("LANG", 60*60*24*30, langSelection.value);
		window.location.reload();
	})
}

// Notifications
notification = decodeURIComponent(getCookie("NOTIFICATION"));
if (notification) {
	if (notification !== "undefined") {
		setNotification(notification);
	}
}

setInterval(() => {
	DOMnotification = document.getElementById("main_notification");
	if (isElementExist(DOMnotification)) {
		setTimeout(
			() => {
				DOMnotification.remove();
			}, 5000
		)
	}
}, 1000);

DOMnotification = document.getElementById("main_notification");
if (isElementExist(DOMnotification)) {
	DOMnotification.addEventListener("click", () => {
		DOMnotification.remove();
	})
}
