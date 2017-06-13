/*$(function(){
	
	var $evenimente = $('#evenimente');
	console.log($.ajax({
		type: 'GET',
		url: 'http://localhost:8080/Eveniment/src/API.php/evenimentNume/"Film"',
		succes: function(evenimente){
			console.log("a"+eveniment.categorie);
			$.each(evenimente,function(i,utilizator){
				$evenimente.append('<li>Nume: ' +eveniment.nume_eveniment+ '</li>');
			});
		}
	}));
});*/
$(function CallURL()  {
	console.log("fun");
    $.ajax({
        url: 'http://localhost:8080/Eveniment/src/API.php/evenimentNume/"Film"',
        type: "GET",
        dataType: "jsonp",
        async: false,
        success: function(msg)  {
            JsonpCallback(msg);
        },
        error: function()  {
            ErrorFunction();
        }
    });
});

$(function JsonpCallback(json)  {
    document.getElementById('evenimente').innerHTML = json.result;
});
