const applyStyles = iframe => {
	let styles = {
		fontColor : "#000000",
		backgroundColor : "rgba(128, 128, 128, 0.9)"

	}
	
	setTimeout(() => {
		iframe.contentWindow.postMessage(JSON.stringify(styles), "*");	
}, 100);
}
