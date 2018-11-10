function _costume_alert(ti,ci){
	$.alert({
	  title: ti,
	  content: ci,
	  icon: 'fa fa-info-circle',
	  animation: 'scale',
	  closeAnimation: 'scale',
	  buttons: {
	      okay: {
	          text: 'OK',
	          btnClass: 'btn-blue'
	      }
	  }
	});
}