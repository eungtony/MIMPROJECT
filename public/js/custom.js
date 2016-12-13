$(document).ready(() => {
	$('#apropos').click(() => {
		$('#taches-panel').removeClass('active');
		$('#apropos-panel').addClass('active');
		$('#taches-content').hide();
		$('#apropos-content').show();
	});
	$('#parameters').click(() => {
		console.log('Affichage des paramètres !');
	});
	$('#taches').click(() => {
		$('#apropos-panel').removeClass('active');
		$('#taches-panel').addClass('active');
		$('#apropos-content').hide();
		$('#taches-content').show();
	});
	$('#help').click(() => {
		console.log('Affichage de l\'aide !');
	});
});