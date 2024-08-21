// Switchery
		var elems = Array.prototype.slice.call(document.querySelectorAll('.switch-btn'));
		$('.switch-btn').each(function() {
			new Switchery($(this)[0], $(this).data());
		});

		// Bootstrap Touchspin
		$("input[name='demo_vertical2']").TouchSpin({
			verticalbuttons: true,
			// verticalupclass: 'fa fa-plus',
			// verticaldownclass: 'fa fa-minus'
		});
		// $("input[name='prix']").TouchSpin();
		// $("input[name='prix']").TouchSpin({
		// 	min: 0,
		// 	max: 100000000,
		// 	step: 1,
		// 	decimals: 2,
		// 	boostat: 1,
		// 	maxboostedstep: 10,
		// 	// postfix: '%'
		// });

		// $("input[name='']").TouchSpin();
		// $("input[name='']").TouchSpin({
		// 	min: 0,
		// 	max: 12,
		// 	step: 0.1,
		// 	decimals: 2,
		// 	boostat: 5,
		// 	maxboostedstep: 10,
		// 	// postfix: '%'
		// });
		
		// $("input[name='']").TouchSpin({
		// 	min: 0,
		// 	max: 12,
		// 	stepinterval: 1,
		// 	maxboostedstep: 12,
		// 	prefix: 'mois'
		// });

		$("input[name='quantite']").TouchSpin({
			min: -1000000000,
			max: 1000000000,
			stepinterval: 1,
			maxboostedstep: 10000000,
		});

		$("input[name='duree']").TouchSpin({
			min: 0,
			max: 12,
			stepinterval: 1,
			postfix: 'mois'
		});
		// $("input[name='duree']").TouchSpin({
		// 	min: 0,
		// 	max: 12,
		// 	stepinterval: 1,
		// 	postfix: 'mois'
		// });
		$("input[name='valeur']").TouchSpin({
			min: -1000000000,
			max: 1000000000,
			stepinterval: 1,
			postfix: 'Fcfa'
		});
		$("input[name='prix']").TouchSpin({
			min: 0,
			max: 1000000000,
			// stepinterval: 1,
			postfix: 'Fcfa'
		});

		$("input[name='demo3_22']").TouchSpin({
			initval: 40
		});
		$("input[name='demo5']").TouchSpin({
			prefix: "pre",
			postfix: "post"
		});