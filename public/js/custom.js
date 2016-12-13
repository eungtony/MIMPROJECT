$(document).ready(() => {
	$('#apropos').click(() => {
		$('#parameters-panel').removeClass('active');
		$('#help-panel').removeClass('active');
		$('#taches-panel').removeClass('active');
		$('#apropos-panel').addClass('active');		
		$('#parameters-content').hide();
		$('#help-content').hide();
		$('#taches-content').hide();
		$('#apropos-content').show();
	});
	$('#parameters').click(() => {
		$('#help-panel').removeClass('active');
		$('#taches-panel').removeClass('active');
		$('#apropos-panel').removeClass('active');
		$('#parameters-panel').addClass('active');
		$('#taches-content').hide();
		$('#apropos-content').hide();
		$('#help-content').hide();
		$('#parameters-content').show();
	});
	$('#taches').click(() => {
		$('#apropos-panel').removeClass('active');
		$('#parameters-panel').removeClass('active');
		$('#help-panel').removeClass('active');
		$('#taches-panel').addClass('active');
		$('#apropos-content').hide();		
		$('#parameters-content').hide();
		$('#help-content').hide();
		$('#taches-content').show();
	});
	$('#help').click(() => {
		$('#taches-panel').removeClass('active');
		$('#apropos-panel').removeClass('active');
		$('#parameters-panel').removeClass('active');
		$('#help-panel').addClass('active');
		$('#taches-content').hide();
		$('#apropos-content').hide();		
		$('#parameters-content').hide();
		$('#help-content').show();
	});
});