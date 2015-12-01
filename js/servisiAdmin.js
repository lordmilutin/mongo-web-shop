$("document").ready(function() {
	var strana = 0;
	var limit = 9;
	var maxStrana;
	var pretraga = "";
	var kategorije = "";
	var cookie;
	var loc = window.location.pathname;
	var dir = loc.substring(0, loc.lastIndexOf('/'));

	//uzmi inicjalne podatke
	uradiAjax();
	uzmiKategorije();
	uzmiCookie();

	//binduj search event
	$("#pretraga").bind("change paste keyup", function() {
		var v = $("#pretraga").val();
		if (v.length == 0) 
		{
			strana = 0;
			limit = 9;
			pretraga = "";

			uradiAjax();
		}
		else if (v.length > 2) 
		{
			strana = 0;
			limit = 9;
			pretraga = v;

			uradiAjax();
		}
	});

	//binduj kategorije event
	$("#kategorije").bind("change", function() {
		if ($("#kategorije option:selected" ).val() == "sve")
			kategorije = "";
		else
			kategorije = $("#kategorije option:selected" ).val();

		$(".sadrzaj").slideUp(0, function(){
			strana = 0;
			uradiAjax();			
		});
	});

	function uzmiCookie() {
		cookie = document.cookie.split(",");
		//console.log(cookie);

		if (cookie.length == 1) 
		{
			$(".sadrzajKorpe").html("<p>Vaša korpa je trenutno prazna!</p>");
			$(".brUKorpi").html("0 proizvoda");
		}
		else if (cookie.length == 2)
		{
			uzmiKorpuSadrzaj(cookie);
			$(".brUKorpi").html("1 proizvod");
		}
		else if (cookie.length > 2) 
		{
			uzmiKorpuSadrzaj(cookie);
			$(".brUKorpi").html(cookie.length-1 + " proizvoda");
		}
	}

	function uzmiKorpuSadrzaj(cookie) {
		var korpa = $(".sadrzajKorpe");
		korpa.html("Učitavam...");

		var strIDs = "";
		for (var i = 1; i < cookie.length; i++) 
		{
			strIDs += cookie[i];
			if (i != cookie.length-1)
				strIDs += ",";
		}

		$.ajax({
			url: dir + "/api/GetHranaPoId/id="+strIDs,
			type: "GET",
			success:function(result) {
				res = JSON.parse(result);
				//console.log(res);
				korpa.html("");

				var cena = 0;
				for (var i = 0; i < res.length; i++) 
				{
					korpa.append('<div class="media" data-cena="'+res[i].cena+'">'+
					  '<span class="media-left">'+
					    '<img src="img/placeholder.jpg" alt="Hrana!" width=64 height=64>'+
					  '</span>'+
					  '<div class="media-body">'+
					    '<h4 class="media-heading">'+res[i].naziv+'</h4>'+
					    '<p class="nomarg">' +res[i].kategorija+'</p><p class="text-success">'+res[i].cena+' RSD</p>'+
					    '<i class="fa fa-times ukloniIzKorpe" data-id="'+res[i]._id.$id+'"></i>'+
					  '</div>'+
					'</div><hr>');
					cena +=res[i].cena;
				}

				korpa.append('<h4 class="text-success cenaUk">Ukupno: '+cena+' RSD</h4>');

				//binduj klik na "X" u korpi
				$(".ukloniIzKorpe").bind("click", function() {
					cookie = document.cookie.split(",");

					var toRem = $(this).parent().parent();
					cena = cena - parseInt(toRem.attr("data-cena"));

					var idRem = $(this).attr("data-id");
					var ind = cookie.indexOf(idRem);
					if (ind > -1) 
						cookie.splice(ind, 1);

					console.log(idRem + " " +cookie );

					toRem.slideUp(300, function() {
						toRem.next().remove();
						toRem.remove();
						document.cookie = cookie.toString();

						if (cookie.length == 1) 
						{
							$(".sadrzajKorpe").html("<p>Vaša korpa je trenutno prazna!</p>");
							$(".brUKorpi").html("0 proizvoda");
						}
						else if (cookie.length == 2)
						{
							$(".brUKorpi").html("1 proizvod");
							$(".cenaUk").html('Ukupno: '+cena+' RSD');
						}
						else if (cookie.length > 2) 
						{
							$(".brUKorpi").html(cookie.length-1 + " proizvoda");
							$(".cenaUk").html('Ukupno: '+cena+' RSD');
						}
					});
				})
			},
			error:function(error) {
				console.log(error);
			}
		});		
	}

	function uzmiKategorije() 
	{
		$.ajax({
			url: dir + "/api/GetKategorije/",
			type: "GET",
			success:function(result) {
				res = JSON.parse(result);
				//console.log(res);

				for (var i = 0; i < res.length; i++)
				{
					$("#kategorije").append("<option value='"+res[i]+"'>"+res[i]+"</option>");
				}
			},
			error:function(error) {
				console.log(error);
			}
		});		
	}

	function uradiAjax()
	{
		$.ajax({
			url: dir + "/api/getHrana/strana="+strana+"&limit="+limit+"&pretraga="+pretraga+"&kat="+kategorije,
			type: "GET",
			success:function(result) {

				ubaciRezultate(result);
				ubaciPaginaciju(result);
			},
			error:function(error) {
				console.log(error);
			}
		});
	}


	function ubaciRezultate(result)
	{
		res = JSON.parse(result);
		var sadrzaj = $(".sadrzaj");
		sadrzaj.html("");
		//sadrzaj.append(html);

		if (res.length < 2) 
		{
			var html = 
			'<div class="bs-component">'+
			'<div class="alert alert-danger">'+
			'<strong>Nema rezultata. Promenite kriterijume pretrage.</strong>'+
			'</div>'+
			'</div>';
			sadrzaj.append(html);
		}
		else 
		{
			for (i=0; i < res.length-1; i++)
			{
				//ubaci rezultate
				var html =
				'<tr">'+
	                '<td><img src="img/'+ res[i].slika +'" alt="Hrana!" class="img-thumbnail" width=64 height=64></td>'+
	                '<td>'+res[i].naziv+'</td>'+
	                '<td>Kategorija: '+res[i].kategorija+'</td>'+
	                '<td>'+res[i].sastojci.join(", ")+'</td>'+
	                '<td>'+res[i].cena+' RSD</td>'+
	                '<td><a class="btn btn-primary delete" href="#" data-id="'+res[i]._id.$id+'">Obrisi</a></td>'+
	            '</tr>';

				sadrzaj.append(html);
				if ((i+1) % 3 == 0)
					$(".sadrzaj").append("<div class='clearfix'></div>");
			}

			$(".dodaj").click(function(e) {var k = $(this); dodajKlik(e, k)});
			$(".delete").click(function(e){
				e.preventDefault();
				var id = $(this).attr("data-id");
				$.ajax({
					url: dir + "/api/DeleteItem/id="+id,
					type: "GET",
					success:function(result) {
						alert("Uspešno obrisano!");
						uradiAjax();
						uzmiKategorije();
						uzmiCookie();
					},
					error:function(error) {
						console.log(error);
					}
				});
			})
		}

		sadrzaj.slideDown(0);
	}

	function dodajKlik(e, kliknuto) {
		e.preventDefault();
		cookie = document.cookie.split(",");
		if (cookie.indexOf(kliknuto.attr("data-id")) !== -1)
			return;

		cookie.push(kliknuto.attr("data-id"));
		document.cookie = cookie.toString();
		//console.log(cookie);

		uzmiCookie();
	}

	function ubaciPaginaciju(result) 
	{
		$(".pagination").html("");
		res = JSON.parse(result);
		maxStrana = Math.ceil( res[res.length-1] / limit );

		for (var i=0; i< maxStrana;i++)
		{
			var li = document.createElement("li"); 
			if (i==strana)
				li.className ="active";

			li.innerHTML = "<a href='#'>"+ (i+1) +"</a>";
			$(".pagination").append(li);
		}

		$(".pagination li a").click(function(e) {
			e.preventDefault();

			if ($(this).parent().hasClass("active"))
				return;

			strana = $(this).html()-1;
			$(".sadrzaj").slideUp(0, function() {
				$(".sadrzaj").html("");
				$(".pagination").html("");
				uradiAjax();
			})
		});
	}


	$("#addBtn").click(function(e){
		var data = $("#addItem").serializeArray();
		$.ajax({
			url: dir + "/api/AddItem/",
			data: data,
			method: "POST",
			success: function(e){
				console.log(e);
				$('#myModal').modal('hide');
				alert("Artikal uspešno dodat u bazu!");
				uradiAjax();
			},
			error: function(e){
				$('#myModal').modal('hide');
				alert("Artikal nije dodat! Greska: "+ e);
				console.log("Error" + e);
			}
		});
	});
});