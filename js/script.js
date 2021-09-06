(function ($) {
	"use strict";

	setTimeout(function () {
		if (showWhatsfabAlert) {
			showPopUp();
		}
	}, 3000);

	function showPopUp() {
		var audioBell = new Audio(whatsfabDir + "/assets/bell.mp3");
		audioBell.play();

		$(".wf_welcome_alert_container").addClass("wf_opened");
		$(".wf_welcome_alert_container").removeAttr("style");
	}

	$(".wf_conversation-compose .wf_send").on("click", function () {
		openWA();
	});

	$(".wf_input-msg").keypress(function (event) {
		var keycode = event.keyCode ? event.keyCode : event.which;
		if (keycode == "13") {
			openWA();
		}
	});

	function openWA() {
		var whatsappLink =
			"https://wa.me/" +
			whatsappNumber +
			"?text=" +
			encodeURIComponent($(".wf_input-msg").val());
		var redirectWindow = window.open(whatsappLink, "_blank");
		redirectWindow.location;
	}

	$(".close_wf_welcome_alert").on("click", function () {
		$(".wf_welcome_alert_container").removeClass("wf_opened");
		$(".wf_welcome_alert_container").removeAttr("style");
	});

	$(".wf_whatsapp-button, .wf_actions.wf_close, .wf_welcome_alert").on(
		"click",
		function () {
			showWhatsfabAlert = false;

			$(".wf_animate_button").remove();

			if ($(".wf_whatsapp").hasClass("wf_opened")) {
				$(".wf_whatsapp").removeClass("wf_opened");
				$(".wf_whatsapp-button").removeClass("wf_invert");
			} else {
				$(".wf_whatsapp-button").addClass("wf_invert");
				$(".wf_whatsapp").addClass("wf_opened");
			}

			$(".wf_whatsapp").removeAttr("style");
		}
	);
})(jQuery);
