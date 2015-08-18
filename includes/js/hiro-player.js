var init_hiro_player = function(videoUrl, videoPoster, currentObj) {

	currentObj.append('<div id="hiro_player" class="hiro"></div>');

	hiro.ready(function() {
      	var hiro_player = hiro({
			externalID: "mothernist-default",
			subExternalID: "${PUBLISHERID}",
			IAS_percentage: 100,
			width: "100%",
			height: 400,
			player: "hiro_player",
			customControls: {
				stop: false,
				play: true,
				scrubber: true,
				time: true,
				mute: true,
				volume: true,
				fullscreen: true,
				timeColor: "#ffffff",
				borderRadius: "0px",
				sliderGradient: "none",
				backgroundColor: "#242424",
				backgroundGradient: "none",
				sliderBorder: "none",
				volumeSliderColor: "#ffffff",
				bufferColor: "#f6bbbe",
				buttonColor: "#d8454d",
				tooltipColor: "#000000",
				volumeSliderGradient: "none",
				tooltipTextColor: "#ffffff",
				progressGradient: "none",
				progressColor: "#ac353b",
				volumeBorder: "none",
				bufferGradient: "none",
				timeSeparator: " ",
				durationColor: "#ffffff",
				callType: "default",
				sliderColor: "#ffffff",
				disabledWidgetColor: "#555555",
				buttonOverColor: "#d8454d",
				timeBgColor: "rgb(0, 0, 0, 0)",
				volumeColor: "#d7464b",
				buttonOffColor: "rgba(255,255,255,1)",
				timeBorder: "none",
				height: 30,
				opacity: 1.0
			},
			contentLogoDef: {
				url: "http://hiro.viewster.com/iframes/scripts/flow/flowplayer.content-3.2.0.swf",
				bottom: 40,
				left: 5,
				width: 125,
				height: 30,
				padding: 0,
				border: "0px none #FFFFFF",
				backgroundColor: "transparent",
				backgroundGradient: "none",
				html: "<img src=\'http://www.mothernist.com/wp-content/uploads/2014/12/new_mothernist_logo1.png\' />"
			},
			companionDivsSet: [{
				"id": "companion-video",
				"width": 300,
				"height": 250
			}],
			noPrerollUserInitiate: false,
			userInitiate: false,
			splashImg: videoPoster,
			playImg: "http://www.mothernist.com/wp-content/plugins/wonderplugin-gallery/engine/skins/gallery/playvideo_64.png",
			playList: [{
				url: videoUrl,
				customProperties: {
					videoTitle: "",
					videoExternalId: "",
					videoDescription: "",
					videoKeyWords: "",
					videoTags: "",
					videoDurationSecs: "60"
				}
			}]
		})

		hiro_player.on("start", function( event ) {
			jQuery.event.trigger({
		      type: "hiro_started",
		      message: "hiro player started",
		      time: new Date()
		    });
		});
		
	})
}