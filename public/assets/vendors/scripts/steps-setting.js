$(document).ready(function () {
	$(".tab-wizard").steps({
		headerTag: "h5",
		bodyTag: "section",
		transitionEffect: "fade",
		titleTemplate: '<span class="step">#index#</span> #title#',
		labels: {
			next: "Suivant",
			previous: "Précédant",
			finish: "Envoyer",
		},
		onStepChanging: function (event, currentIndex, newIndex) {
			// Ne pas autoriser le passage à l'étape suivante si les champs du step courant ne sont pas valides
			if (currentIndex < newIndex) {
				return validateStep(currentIndex);
			}

			// Permettre le retour aux étapes précédentes
			return true;
		},
		onFinished: function (event, currentIndex) {
			// Affichez le modal de succès ou soumettez le formulaire
			$('#success-modal').modal('show');
			$('#RegisterParticipant').submit(); // Vous pouvez soumettre le formulaire ici si nécessaire
		}
	});

	function validateStep(index) {
		let valid = true;
		let password = $('#password');
		let telephone = $('#telephone');
		let confirmPassword = $('#confirmPassword');

		// Vérifiez que tous les champs obligatoires de l'étape courante sont valides
		$('.tab-wizard section').eq(index).find('input[required]').each(function () {
			if (!$(this).val()) {
				valid = false;
				$(this).addClass('form-control-danger'); // Ajoutez une classe d'alerte
			} else {
				$(this).removeClass('form-control-danger'); // Enlevez la classe si valide
			}
		});
		if (telephone.val().length != 9 || !Number.isInteger(parseInt(telephone.val()))) {
			valid = false;
			telephone.addClass('form-control-danger');
		} else {
			telephone.removeClass('form-control-danger');
		}

		if (password.val() != confirmPassword.val() || password.val().length < 8) {
			valid = false;
			password.addClass('form-control-danger');
			confirmPassword.addClass('form-control-danger');
		} else {
			password.removeClass('form-control-danger');
			confirmPassword.removeClass('form-control-danger');
		}

		return valid; // Retourne vrai ou faux
	}
});

