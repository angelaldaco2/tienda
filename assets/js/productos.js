$(document).ready(function(e) {

    $('.detalles').click(function(){
		console.log($(this).val());
		$.ajax({
			type:"POST",
			url:"Controlador/detallesProducto.php", 
			data:{ID:$(this).val()},		
			success: function(data){
				datos = JSON.parse(data);
				console.log(datos);
				$('#idp').text( datos.ID_Producto );
				$('#descp').text( datos.DescripcionProducto );
				$('#precp').text( datos.Precio );
				$('#tallap').text( datos.Talla );
				$('#marcap').text( datos.NombreMarca );
				$('#estp').text( datos.Estilo );
				$('#catp').text( datos.NombreCategoria );
				$('#colp').text( datos.NombreColor );
				$('#sub1p').text( datos.NombreSubCategoria );
				$('#sub2p').text( datos.Subcategoria2 );
				$('#sub3p').text( datos.Subcategoria3 );
				$('#exisp').text( datos.ExistenciaTienda );

			}
		});
	});

	    $('.editars').click(function(){
		console.log($(this).val());
		$.ajax({
			type:"POST",
			url:"Controlador/detallesProducto.php", 
			data:{ID:$(this).val()},		
			success: function(data){
				datos = JSON.parse(data);
				$('#pid').text( datos.ID_Producto );
				$('#pdesc').text( datos.DescripcionProducto );
				$('#pprec').val( datos.Precio );
				$('#ptalla').text( datos.Talla );
				$('#pmarca').text( datos.NombreMarca );
				$('#pest').text( datos.Estilo );
				$('#pcat').text( datos.NombreCategoria );
				$('#pcol').text( datos.NombreColor );
				$('#psub1').val( datos.Subcategoria1 );
				$('#psub1').text( datos.NombreSubCategoria );
				$('#psub2').val( datos.Subcategoria2 );
				$('#psub2').text( datos.Subcategoria2 );
				$('#psub3').val( datos.Subcategoria3 );
				$('#psub3').text( datos.Subcategoria3 );
				$('#pexis').val( datos.ExistenciaTienda );

			}
		});
	});

    modificarProducto=function(){
		$.ajax({
			type: "POST",
			url: 'Controlador/modificarProducto_proc.php',
			data: {
				ID_Producto:$('#pid').text(),
				precio:$('#pprec').val(),
				subcat1:$('.psub1').val(),
				subcat2:$('.psub2').val(),
				subcat3:$('.psub3').val(),
				exist:$('#pexis').val()
			},
			success: function(data){
				console.log('hola')
				if(data != false){
					alert(data);
				}else{
				}
			}
		});
	}


	addProducto=function(){
    	console.log('holi')
		$.ajax({
			type: "POST",
			url: 'Controlador/addProducto_proc.php',
			data: {
				precio:$('#apprec').val(),
				color:$('#apcol').val(),
				marca:$('#apmarca').val(),
				estilo:$('#apest').val(),
				categoria:$('#apcat').val(),
				subcat1:$('#apsub1').val(),
				subcat2:$('#apsub2').val(),
				subcat3:$('#apsub3').val(),
				talla:$('#aptalla').val(),
				cantidad:$('#apexis').val()
			},
			success: function(data){
				if(data != false){
					alert(data);
				}else{
				}
				cantidad:$('#apexis').val('0');

			}
		});
	}

	Borrar=function(){
		$('#apprec').val(""),
		$('#apcol').val(""),
		$('#apmarca').val(""),
		$('#apest').val(""),
		$('#apcat').val(""),
		$('#apsub1').val(""),
		$('#apsub2').val(""),
		$('#apsub3').val(""),
		$('#aptalla').val(""),
		$('#apexis').val("0")
		}


	$('.bye').hide();
	buscar=function(){
		if($('#buscaTabla').val() != ""){
			$.ajax({
				type: "POST",
				url: 'Controlador/detallesProducto2.php?opc=buscar',
				data: {match:$('#buscaTabla').val()},
				success: function(data){
					$('.orig').hide();
					$('.search').show();
					$('.bye').show();
					$('.search').html(data);
					$('.editars').unbind('click');
					$('.editars').bind('click',function(){
						$.ajax({
							type:"POST",
							url:"Controlador/detallesProducto.php", 
							data:{ID:$(this).val()},		
							success: function(data){
								datos = JSON.parse(data);
								$('#pid').text( datos.ID_Producto );
								$('#pdesc').text( datos.DescripcionProducto );
								$('#pprec').val( datos.Precio );
								$('#ptalla').text( datos.Talla );
								$('#pmarca').text( datos.NombreMarca );
								$('#pest').text( datos.Estilo );
								$('#pcat').text( datos.NombreCategoria );
								$('#pcol').text( datos.NombreColor );
								$('#psub1').val( datos.Subcategoria1 );
								$('#psub1').text( datos.NombreSubCategoria );
								$('#psub2').val( datos.Subcategoria2 );
								$('#psub2').text( datos.Subcategoria2 );
								$('#psub3').val( datos.Subcategoria3 );
								$('#psub3').text( datos.Subcategoria3 );
								$('#pexis').val( datos.ExistenciaTienda );
							}
						});
					});
					$('.detalles').unbind('click');
					$('.detalles').bind('click',function(){
						$.ajax({
							type:"POST",
							url:"Controlador/detallesProducto.php", 
							data:{ID:$(this).val()},		
							success: function(data){
								datos = JSON.parse(data);
								console.log(datos);
								$('#idp').text( datos.ID_Producto );
								$('#descp').text( datos.DescripcionProducto );
								$('#precp').text( datos.Precio );
								$('#tallap').text( datos.Talla );
								$('#marcap').text( datos.NombreMarca );
								$('#estp').text( datos.Estilo );
								$('#catp').text( datos.NombreCategoria );
								$('#colp').text( datos.NombreColor );
								$('#sub1p').text( datos.NombreSubCategoria );
								$('#sub2p').text( datos.Subcategoria2 );
								$('#sub3p').text( datos.Subcategoria3 );
								$('#exisp').text( datos.ExistenciaTienda );

							}
						});
					});
				}
			});
		}else{
			$('.orig').show();
			$('.search').hide();
			$('.bye').hide();
			$('.search').html('');
		}
	};
});