$(document).ready(function(){
	setTimeout(function() {
		//$('.alert').fadeOut('slow');
		$('.alert').slideUp("hide");
	}, 8000);
	$('.tool_tip').tooltip('hide');
	
	
	//---------------------------------------------------------------------------------------------------
	var nowTemp = new Date();
	var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
 
	var checkin = $('#dpd1').datepicker({
		onRender: function(date) {
			return date.valueOf() > now.valueOf() ? 'disabled' : '';
		}
	}).on('changeDate', function(ev) {
		/*if (ev.date.valueOf() > checkout.date.valueOf()) {
			var newDate = new Date(ev.date)
			newDate.setDate(newDate.getDate() + 1);
			checkout.setValue(newDate);
		}
		*/
	   
	   
	   //var newDate = new Date(ev.date)
	   //newDate.setDate(newDate.getDate() + 1);
		
		var checkout = $('#dpd2').datepicker({
			onRender: function(date) {
				//console.log(date);
				if (date.valueOf() > now.valueOf()) {
					return 'disabled';
				} else if (date.valueOf() < checkin.date.valueOf()) {
					return 'disabled';
				}
				return '';
			}
		}).on('changeDate', function(ev) {
			checkout.hide();
		}).data('datepicker');
		
		
		
		
		
		
		
		
		
		
		checkin.hide();
		$('#dpd2')[0].focus();
	}).data('datepicker');
	
//--------------------------------------------------------------------------------------------------------------
		
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
});
function modal(id, url, mensagem)
{
	$("#modal-confirmacao > .modal-body").text(mensagem);
	$("#button-confirmar").attr("href", root+url+id);
	$('#modal-confirmacao').modal('show');
}

