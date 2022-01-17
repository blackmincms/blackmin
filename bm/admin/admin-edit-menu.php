<?php	
/*
	CMS ,,Black Min''  Został stworzony przez di_Timonix'a
	
	ten plik służy do renderowania strony odpowiedzialnej za całe menu na stronie
	
	#Zawannsowane szukanie
	
	Black Min cms,
	
	#plik: 1.3.1
*/

	// ładowanie jądra black mina
	require_once "black-min.php";
	
?>


<!DOCTYPE html>
<html lang="pl" class="">
<head>

	<title>Edytuj Menu - Admin Panel <?php echo $black_min ?></title>
	
	<?php require_once "laduj-pliki-admin.php"; ?>

	<script>	
	// funkcjia do ładowania struktury menu głównego
	function load_menu_items() {
		$.ajax({
			type:"POST",
			url:"laduj/laduj-menu-items.php",
			data:{
			}
		})
		.done(function(info){
			$(".menu-load-items").text("");
			$(".menu-load-items").append(info);
		})
		.fail(function(){
			alert("Wystąpił błąd. Spróbuj ponownie później");
		});	
	}</script>
</head>
<body>

	<?php require_once "admin-menu.php"; ?>
	
	<?php require_once "admin-menu-left.php"; ?>
	
	<?php require_once "admin-menu-mobile.php"; ?>
	
	<main class="container-right">
		<section class="container tsr-p-10px">
			<section class="tsr fs-130 l-0">
				Edytuj Menu - Black Min 
			</section>
			<section class="tsr tsr-p-10px background-white tsr-mt-20">		

				<section class="tsr tsr-mt-20">
					<form accept-charset="UTF-8"  action="" method="post" id="add_post" autocomplete="off">	

						<section class="col-ms40 tsr-p-5px">
							<section class="tsr fs-70">
								Dodaj element do menu
							</section>
							<section class="tsr fs-70 tsr-border-solid-all tsr tsr-mt-20">
								<section class="tsr tsr-mt-20 fs-100">
									Własne linki
								</section>
								<section class="tsr tsr-mt-10 fs-100 tsr-p-10px add-text-alert">
									<section class="tsr fs-100">
										<section class="col-ms40 tsr-mt-10">
											Własny url
										</section>
										<section class="col-ms60">
											<input type="text" name="adres-url" class="input" placeholder="Dodaj url"/>
										</section>
									</section>
									<section class="tsr fs-100">									
										<section class="col-ms40 tsr-mt-10">
											Własny Tytuł
										</section>
										<section class="col-ms60">
											<input type="text" name="tytul-menu" class="input" placeholder="Dodaj Tytuł"/>
										</section>
									</section>	
									<section class="tsr tsr-mt-20">
										<button type="button" class="submit" value="Dodaj do menu" id="dodaj_do_menu"/>
											Dodaj do menu
										</button>
									</section>
								</section>
							</section>
						</section>
						<section class="col-ms60 tsr-p-5px">
							<section class="tsr fs-70">
								Struktura Menu Głównego
							</section>
							<section class="tsr fs-100 tsr-mt-20">
								<div class="menu-load-items">
									Ładowanie struktury menu
									<script>load_menu_items();</script>
								</div>
							</section>
						</section>					
					</form>	
				</section>
				
	<script type="text/javascript">

	// funkcjia która po kliknięciu dodaje nam nowy element do struktury głównego menu
	// pobiera dane wpisane od użtkownika i dodanie do menu
	$(document).ready(function() {
		tsr_sortiner("tsr-data",".tsr-psort-container",".tsr-sortiner",".tsr-sortitem",3,".tsr-sortbox2",false, 50);

		// skrypt dodający nowy element do menu
		$( this ).on( "click", "#dodaj_do_menu", function() {
			var id_menu = $('.sortiner-item').last().attr("data-id");
			var id_menu = ++id_menu;
			var url_adres =  $("input[name=adres-url]").val();
			var tytul_menu =  $("input[name=tytul-menu]").val();
			
			if (url_adres == "" || tytul_menu == "") {
				if (url_adres == "") {
					$("input[name=adres-url]").effect( "shake" );
				}	
				if (tytul_menu == "") {
					$("input[name=tytul-menu]").effect( "shake" );
				}
				
				$(this).closest(".add-text-alert").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
			}else {
				var done_add = 0;
				
				$.ajax({
					type:"POST",
					url:"insert/add-menu.php",
					data:{
						tytul:tytul_menu,
						url:url_adres,
						item_type:"link",
					}
				})
				.done(function(info){
					load_menu_items();
					$(".add-text-alert").append(info);
					$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
					$(".tsr-alert-success").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
					
					if (done_add == 1){
						$("input[name=adres-url]").val("");
						$("input[name=tytul-menu]").val("");	
					}
				})
				.fail(function(){
					alert("Wystąpił błąd. Spróbuj ponownie później");
				});	
			}
		});	

		// skrypt zmieniający nazwyę wyświetlaną i adres url menu
		$( this ).on( "click", ".edytuj_element_menu", function() {
			var url_adres_rename =  $(this).closest(".tsr-sort-item").find("input[name=adres-url-rename]").val();
			var id_menu  =  $(this).closest(".tsr-sortiner").attr("tsr-index");
			var tytul_menu_rename =  $(this).closest(".tsr-sort-item").find("input[name=tytul-menu-rename]").val();
			var item_type =  $(this).closest(".tsr-sort-item").find("input[name=item_type]").val();
			
			if (url_adres_rename == "" || tytul_menu_rename == "") {
				if (url_adres_rename == "") {
					$(this).closest(".tsr-sort-item").find("input[name=adres-url-rename]").effect( "shake" );
				}	
				if (tytul_menu_rename == "") {
					$(this).closest(".tsr-sort-item").find("input[name=tytul-menu-rename]").effect( "shake" );
				}
				
				$(this).closest(".tsr-sort-item").find(".add-text-alert-rename").append('<section class="tsr tsr-alert tsr-alert-error"> Nie wypełniłeś wszystkich informacji </section>');
				$(".tsr-alert-error").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
			}else {
				$(this).closest(".tsr-sortiner").attr("tsr-url", url_adres_rename);
				$(this).closest(".tsr-sortiner").attr("tsr-name", tytul_menu_rename);
				$(this).first().closest(".tsr-sortiner").first().find(".tsr-sort-handle").first().text(tytul_menu_rename);
					
				$.ajax({
					type:"POST",
					url:"insert/edit-menu-element.php",
					data:{
						url_adres_rename:url_adres_rename,
						id_menu:id_menu,
						tytul_menu_rename:tytul_menu_rename,
						item_type:item_type,
					}
				})
				.done(function(info){
					$(this).closest('.tsr-sort-item').append(info);
					$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
				})
				.fail(function(){
					alert("Wystąpił błąd. Spróbuj ponownie później");
				});	
			
			}
		});	

		// skrypt pokazujący i howający sekcie do zmieniania danych menu
		$( document ).on( "click", ".tsr-sort-item-button, .tsr-sort-item--hiden-button", function(oEvent) {
			$(this).parent().first().find('.tsr-sort-item').first().slideToggle();
			$(this).closest('.tsr-sort-item').slideToggle();
		});
		
		// skrypt do usuwanie elementów klasy
		$( this ).on( "click", ".sortiner-delete-buton", function(oEvent) {
			
			var d = $(this).closest(".tsr-sortiner");
			
			$.ajax({
				type:"POST",
				url:"insert/usun-element-menu.php",
				data:{
					id_menu : tsr_sortiner_index($(this).closest(".tsr-sortiner"), ".tsr-sortiner", "tsr-index", ".tsr-sortitem", "text"),
				}
			})
			.done(function(info){
				$('.tsr-sort-item').append(info);
				$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
				$(this).closest('.sortiner-item').fadeOut(500, function () { $(this).remove(); });
				
				// usuwanie elementu i zapisywanie menu
				$(d).delay(50).fadeIn(500).animate({opacity: "0"}, 500).delay(100).hide(500, function () { $(this).remove().delay(150, function() {setTimeout(function () {save_menu();}, 100);}); });
			})
			.fail(function(){
				alert("Wystąpił błąd. Spróbuj ponownie później");
			});		
		});
		
		$(document).on('click', '#zapisz_menu', function(evt1){
			evt1.preventDefault();
			
			var data_menu_structur = JSON.stringify(tsr_sortiner_index(".tsr-psort-container", ".tsr-sortiner", "tsr-index", ".tsr-sortitem"));
		
			$.ajax({
				type:"POST",
				url:"insert/edit-menu.php",
				data:{
					menu_structur: data_menu_structur
				}
			})
			.done(function(info){
				load_menu_items();
				$('#contajner_post_add').text("");
				$('form').append(info);
				$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
			})
			.fail(function(){
				alert("Wystąpił błąd. Spróbuj ponownie później");
			});
		
		});

		function save_menu(){
			var data_menu_structur = JSON.stringify(tsr_sortiner_index(".tsr-psort-container", ".tsr-sortiner", "tsr-index", ".tsr-sortitem"));
		
			$.ajax({
				type:"POST",
				url:"insert/edit-menu.php",
				data:{
					menu_structur: data_menu_structur
				}
			})
			.done(function(info){
				load_menu_items();
				$('#contajner_post_add').text("");
				$('form').append(info);
				$(".tsr-alert").delay(5000).fadeIn(5000).animate({opacity: "0"}, 1000).delay(1000).hide(500, function () { $(this).remove(); });
			})
			.fail(function(){
				alert("Wystąpił błąd. Spróbuj ponownie później");
			});
		
		}
		
	});
	</script>				
					
				</section>
			</section>
		</section>
	</main>

	<?php require_once "admin-stopka.php"; ?>

</body>
</html>