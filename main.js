$(function(){
	
	var $utilizatori = $('#utilizatori');
	var $numeUtilizator = $('#numeUtilizator');
	console.log($.ajax({
		type: 'GET',
		url: 'http://localhost/Eveniment/src/API.php/utilizatorNume/"claudiu"',
		succes: function(utilizatori){
			console.log('succes',"a"+utilizator.parola);
			$.each(utilizatori,function(i,utilizator){
				$utilizatori.append('<li>Nume ' +utilizator.utilizator+ '</li>');
			});
		},
		error: function(){
			alert('eroare');
		}
	}));
	$('#adaug').on('click',function(){
		
		console.log($.ajax({
			url:'http://localhost/Eveniment/src/API.php/utilizator/3',
			type: 'DELETE',
			succes: function(utilizatorNow){
				console.log("adsa");
			},
			error: function(){
			alert('eroare');
		}
	}))});
});


