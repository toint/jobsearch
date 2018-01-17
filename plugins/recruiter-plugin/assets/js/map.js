"use strict";

jQuery(document).ready(function($) {
    $('#map-viet-nam').vectorMap({
		map: 'vietnam',
		regionsSelectable: true,
		regionsSelectableOne: true,
		
		
		regionStyle: {
			initial: {
				fill: "white"
			},
			selected: {
				fill: "red"
		  }
		},
		onRegionClick: function (e, code) {
			var map = $('#map-viet-nam').vectorMap('get', 'mapObject');
			$('#placeCode').val(code);
			$('#placeName').val(map.getRegionName(code));
			$('#vector-map-modal').dialog('close');
		},
		onRegionTipShow: function (e, el, code) {
			
		}
	});

	var left,top;
	$('#map-viet-nam').vectorMap('get', 'mapObject').container.mousemove(function(e){
		left = e.pageX - 40;
		top = e.pageY - 60;
	});

	$('#vector-map-modal').dialog({
		autoOpen: false,
		width: 350,
		height: 500,
		buttons: [{
			text: 'Close',
			click: function() {
				$(this).dialog('close');
			}
		}]
	});

	$('#btnPlace').click(function() {
		$('#vector-map-modal').dialog('open');
	});
	
});