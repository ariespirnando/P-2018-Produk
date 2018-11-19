function _costume_alert(ti,ci){
	$.alert({
	  title: ti,
	  content: ci,
	  icon: 'fa fa-info-circle',
	  animation: 'scale',
	  closeAnimation: 'scale',
      type: 'blue',
      typeAnimated: true,
	  buttons: {
	      okay: {
	          text: 'OK',
	          btnClass: 'btn-blue'
	      }
	  }
	});
}
 
function _costume_delete(id,ti,lb,pl,res,url){
    $.confirm({
        title: ti,
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>'+lb+'</label>' +
        '<input type="text" placeholder="'+pl+'" class="name form-control" required />' +
        '</div>' +
        '</form>',
        type: 'blue',
        typeAnimated: true,
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var name = this.$content.find('.name').val(); 
                    $.ajax({
				         url: url,
				         type: 'post',
				         data: "id="+id+"&name="+name, 
				         success: function(response){
				            $.alert(res);
                            loadPagination(0);
				         }
				       }); 
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                // if the user submits the form by pressing enter in the field.
                e.preventDefault();
                jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });
}