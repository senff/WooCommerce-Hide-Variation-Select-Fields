/**
* @preserve WooCommerce Hide Variation Select Fields 0.1 | @senff | GPL2 Licensed
*/


(function($) {
	$(document).ready(function($) {

		// Give all variation rows an attribute
		var variationSelect = 1;
		$('table.variations tr').each(function(){
			$(this).attr('variation-select',variationSelect);
			variationSelect++;
		});

		// Set defaults
		$('table.variations tr').each(function(){	
			$(this).find("option:selected").attr('default-selection','');
		});

		analyzeFields();

		$('table.variations tr select').change(function () {
			analyzeFields();
		 });

	});

	// Hide all fields, starting with (b), regardless of any settings or defaults
	function hideFields(b) {
		$('table.variations tr').each(function(){
			var variationSelectCount = $(this).attr('variation-select');
			if (variationSelectCount >= b) {
				$(this).addClass('variation-hide');
				$(this).find('select').prop('disabled', true);

				// $(this).find("option:first").prop("selected", true);
			} else {
				$(this).removeClass('variation-hide');
				$(this).find('select').prop('disabled', false);
			}
		});
	}

	// Go through all fields and when it sees any fields with "No Selection", makes all the rest hidden.
	// (Fired at initialization and every time any field changes.)
	function analyzeFields() {
		$('table.variations tr').each(function(){
			var optionSelected = $(this).find("option:selected");
			var valueSelected  = optionSelected.val();
			var textSelected   = optionSelected.text();
			let varCounter = parseInt($(this).attr('variation-select'));
			nextOne = varCounter+1;
			if(valueSelected == '') {
				// This select box has no selection anymore. Make all following ones hidden.
				hideFields(nextOne);
				stopIteration = true;
	        	return false;
		     } else {
		     	// Make next select box visible
		     	$('table.variations tr[variation-select='+nextOne+']').removeClass('variation-hide');
		     	$('table.variations tr[variation-select='+nextOne+']').find('select').prop('disabled', false);
		     }
		});

	}

}(jQuery));


