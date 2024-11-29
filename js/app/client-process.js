 $(document).ready(function(e){
       
	 /*MESSAGE DE MISE à JOUR STOCK*/
	    var id_msg = $('#id_msg').val();        
	    if(id_msg=="1"){
			swal("Mise à jour Stock Reussi !!", "Le Stock a bien été mis à jour", "success");
				 $('.swal-button').click(function(){
				 $('#id_msg').val("");
				 location.href='medicaments.php';
	        })
		}
	 /*MESSAGE DE MISE à JOUR STOCK*/
	            
	  function show_message(etat,msg){
			if(etat==="1"){
				$('.alert-mg-b').removeClass('is-no-visible');
				$('.alert-mg-b').addClass('is-visible');
				$('.message-mg-rt').append(msg);
			}else{
				$('.alert-mg-b').removeClass('is-visible');
				$('.alert-mg-b').addClass('is-no-visible');
			}
		}
			
	 
	    function viewdata(){
			$.ajax({
				url: 'traitement/afficher-produits.php',
				type:'GET',
				success: function(data){
					$('tbody').html(data)
				}
			})
		}
	 
	 function chargerCategories(){
		$.get('traitement/afficher-categories.php', function(rep){  
				$('#divcat').html('rep');
		});
	  }
	 
	  function clean(){
              $('#desi').val('');
              $('#frm_dose').val('');
              $('#dci').val('');
              $('#fab_prod').val('');
		      $('#prix_achat').val('500');
               $('#prix_achat').val('700');
               $('#qte_stock').val('5');
               /*$('#date_prod').val('');
               $('#date_expi').val('');*/
		       $('#categ').val('');
		       $('#cat_prod').val('');
	  }
	 
	  $('select').focusin(function(){
		 // chargerCategories();
	  });
       
	 	$('#btn-add-cli').click(function(e){
			
                e.preventDefault();
				
				var Vclient= $('#client').val();
                var Vn_cli= $('#n_cli').val();
			    var Vadrs_cli= $('#adrs_cli').val();
                
		        
				if((Vclient==="") || (Vn_cli==="") || (Vadrs_cli==="")){
				    show_message('1','<strong>Erreur !</strong> Certains champs marqué (*) doivent obligatoirement être remplis. ');
				   }else{	
						$.get("traitement/client-traitement.php?op=add&client="+Vclient+"&n_cli="+Vn_cli+"&adrs_cli="+Vadrs_cli, {}, function(data){
							 show_message('0','');
							  if(data.message === "OK"){

							 swal("Opération reussi !!", "Le client a bien été ajouté : "+data.prod_info, "success");
								  $('.swal-button').click(function(){ 
								  clean();
								  location.href="clients.php"
								   })
								  
								}   
							if(data.message === "error"){
								show_message('1','<strong>Erreur !!</strong> Référence produit déjà utilisé !!');
								$('#ref_prod').val('');
								$('#ref_prod').val(data.new_ref);
								}
							
					   },'json');
						
					}
                }); 

	    $('.btn-edit-prod').click(function(e){
			
                e.preventDefault();
				
				var Vref_prod2= $('#ref_prod2').val();
                var Vdesi2= $('#desi2').val();
                var Vdescrip2= $('#descrip2').val();
               // var Vdci2= $('#dci').val();
               // var Vfab_prod2= $('#fab_prod2').val();
                var Vprix_achat2= $('#prix_achat2').val();
                var Vprix_unit2= $('#prix_unit2').val();
                var Vqte_stock2= $('#qte_stock2').val();
                var Vdate_prod2= $('#date_prod2').val();
                //var Vdate_expi2= $('#date_expi2').val();
				var Vcateg2= $('#categ2').val();
		        
				if((Vdesi2==="") || (Vprix_achat2==="") || (Vprix_unit2==="") || (Vqte_stock2==="") || (Vdate_prod2==="")){
				    show_message('1','<strong>Erreur !</strong> Certains champs doivent obligatoirement être remplis. ');
				   }else{	
						$.get("traitement/produit-traitement.php?op=edit&ref_prod="+Vref_prod2+"&desi="+Vdesi2+"&descrip="+Vdescrip2+"&prix_achat="+Vprix_achat2+"&prix_unit="+Vprix_unit2+"&qte_stock="+Vqte_stock2+"&date_prod="+Vdate_prod2+"&categ="+Vcateg2, {}, function(data){
							 show_message('0','');
							  if(data.message === "OK"){
								  
									swal("Modicication Reussie !!", "L'Arcticle a bien été Modifié : "+data.prod_info, "success");
								  $('.swal-button').click(function(){ 
								  clean();
								  //location.href='medicaments.php';
								  /*viewdata();*/
								   })
								  
								}   
							if(data.message === "error"){
								show_message('1','<strong>Erreur !!</strong> Référence produit déjà utilisé !!');
								}
							
					   },'json');
						
					}
                }); 
	 
	    $('#btn-add-cat').click(function(e){
			
                e.preventDefault();
				
				var Vcat_prod= $('#cat_prod').val();
              		        
				if((Vcat_prod==="")){
				    show_message('1','<strong> Erreur !</strong> Veuillez fournir une catégorie svp. ');
				   }else{	
						$.get("traitement/produit-traitement.php?op=add_cat&cat_prod="+Vcat_prod, {}, function(data){
							 show_message('0','');
							  if(data.message === "OK"){
									swal("Opération Reussie !!", "La catégorie : "+data.prod_cat+" a bien été ajouté.", "success");
								  $('.swal-button').click(function(){
									  clean();
									  location.href='medicaments.php';
								  })
								}   
							if(data.message === "error"){
								show_message('1','<strong>Erreur !!</strong> Le nom de catégorie : '+Vcat_prod+' existe, creez en un autre !!');					
								}
							
					   },'json');
					   
					   chargerCategories();
						
					}
                }); 
	 
	
      $('.btn-supp').click(function(e){

               e.preventDefault();
			   
			   swal({
                    title: "Suppression du client ?",
                    text: "Etes-vous sûr? Cette opération est irreverssible. Vous ne pourrez plus récuperer les informations relatifs à client, Continuer l'opération ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                        if (willDelete) {
                            $.get($(this).attr('href'), {}, function(data){

                                  if(data.message === "OK"){
                                  swal("Suppression effectuée! CLIENT : "+data.client+" le client ci-haut a bien été supprimé, comme vous l'avez desiré !!", {
                                    icon: "success",
                                  });
                                    
                                    $('.swal-button').click(function(){ location.href='clients.php'; })

                                 }    
                            
                            },'json')
                        } else {
                          swal("Oups! Opération annulée.","");
                        }        
                      });  

            });

      $('#btn-supp-cat').click(function(e){

               e.preventDefault();
			   
               var Vcat_id = $('#cat_id').val();

               if((Vcat_id ===null)){
				    swal("Oups! Aucune catégorie selectionné.","Assurez-vous d'avoir selectionné une catégorie.","warning");
				   }else{	
			   swal({
                    title: "Suppression des "+Vcat_id+"(s)",
                    text: "Etes-vous sûr? en supprimant cette catégorie, tout les articles appartenant à la catégorie seront en même temps supprimés, continuer?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                        if (willDelete) {
                            $.get('traitement/produit-traitement.php?del_cat='+Vcat_id, {}, function(data){

                                  if(data.message === "OK"){
                                  swal("Suppression effectuée! CATEGORIE : "+data.nom_cat+" la catégorie ci-haut a bien été supprimée, comme vous l'avez desiré !!", {
                                    icon: "success",
                                  });
                                    
                                    $('.swal-button').click(function(){ location.href='medicaments.php'; })

                                 }    
                            
                            },'json')
                        } else {
                          swal("Oups! Opération annulée.","");
                        }        
                      });  
                    }

            });



 /*TRAITEMENT RECHERCHE PRODUITS*/

             $('#btn_search').click(function(e){

                e.preventDefault();

                var mon_crit= $('#crit').val();



               // $.get("produit-traitement.php?r_crt="+mon_crit,{}, function(data){                     
                            if(mon_crit == ''){

                              $('#erreur').empty().append('Fournir un critère de recherche.');
                              //$('.alert-success').empty().append("<div class='alert-message'> <strong><span id='success'>"+"Pseudo déjà utilisé."+" </span></strong></div>");
                            }else{
                              location.href='wenze-search.php?r_crt='+mon_crit+'#corp';
                            }
                            
                             
                      // },'json')
               
                }); 

         }); 