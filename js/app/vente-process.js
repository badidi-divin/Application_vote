 $(document).ready(function(e){
       
	 /*MESSAGE DE MISE à JOUR STOCK*/
	    var id_msg = $('#id_msg').val();
	 if (id_msg!=""){
	    if(id_msg==="1"){
			swal("Mise à jour Ordonnance, Reussie", "La quantité à acheter du produit, a bien été mise à jour.", "success");
				 $('.swal-button').click(function(){
				 $('#id_msg').val("");
				 location.href='ventes.php';
	        })
		}else {
			var click_text = $.trim($('#id_msg').val()).split('|');
			var id_msg2 = $.trim(click_text[0]);
			var stock = $.trim(click_text[1]);
			if(id_msg2==="0"){
			  swal("Stock insuffisant pour la vente !!", "Il reste seulement : "+stock+" unité(s) de ce produit en stock. Veuillez donc entrer une quantité inferieure ou égal à "+stock+" unité(s)", "error");
			  $('.swal-button').click(function(){
				 $('#id_msg').val("");
				 location.href='ventes.php';
			   });
			}
		}
	 }

     function hide_champs(){
                $('#txt_ref').addClass('is-no-visible');
			    $('#txt_prix').addClass('is-no-visible');
			    $('#txt_qte').addClass('is-no-visible');

			    $('#txt_client').addClass('is-no-visible');
			    $('#txt_adrs').addClass('is-no-visible');
			    $('#txt_devise').addClass('is-no-visible');
			    $('#txt_taux').addClass('is-no-visible');
		        
	  }
      hide_champs();
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
                $('#txt_ref').val('');
			    $('#txt_prix').val('');
			    $('#txt_qte').val('');
		        $('#qte_vend').val('1');
			    $('#search').val('');
		        //$('#mont_verse').val('50');
			    $('#reduc').val('0');
			    //$('#total_fac').val('0');
	  }

		 
	  $('select').focusin(function(){
		  chargerCategories();
	  });

	 /*$('#btn-valid_cli').click(function(e){
       
      }*/

	 $('#btn-add-to-list').click(function(e){
			
                e.preventDefault();
				
  
				var Vtxt_ref= $('#txt_ref').val();
			    var Vtxt_prix="";
			    var Vsearch= $('#search').val();
			    var Vqte_vend= $('#qte_vend').val();    
			    

                var Vtxt_client= $('#txt_client').val();
			    var Vtxt_adrs= $('#txt_adrs').val();
			    var Vtxt_devise= $('#txt_devise').val();
			    var Vtxt_taux= $('#txt_taux').val();

                var click_text1 = $('#txt_qte').val().split(' ');	       
		        var Vtxt_qte= $.trim(click_text1[0]);
		        var Vunite_vend= $.trim(click_text1[1]);

              
			    var test_qte = Vtxt_qte - Vqte_vend;

			         if(Vtxt_devise == "CDF"){
			         	var Vtxt_prix= $('#txt_prix').val() * Vtxt_taux;
			         }else{
			         	var Vtxt_prix= $('#txt_prix').val();		         	
			         }

			         //swal("Opération impossible !!", "CONVERTI : "+Vtxt_prix+" "+Vtxt_devise, "error");


				if((Vtxt_ref==="" || Vtxt_prix==="" || Vtxt_qte==="" || Vsearch=="" || Vtxt_qte=="" || Vqte_vend=="" || Vqte_vend == 0)){
				    swal("Opération impossible !!", "Veuillez renseigner un Article existant avec une quantité  à acheter valide SVP (différent de 0).", "error");
					$('#search').val('');
					$('#qte_vend').val('1');
				   }else if(Vtxt_qte==0){
					     swal("Le Stock d' "+Vsearch+" epuisé !!", "Veillez SVP le réaprovisionner !", "error");
					   
				   }else if(test_qte < 0){
					   swal("Stock insuffisant pour la vente !!", "Il reste seulement : "+Vtxt_qte+" "+Vsearch+" en stock. Veuillez entrer une quantité inferieure ou égal à "+Vtxt_qte, "error");
					    $('.swal-button').click(function(){
								 // location.href='ventes.php';
						});
				   }else{	
						$.get("traitement/vente-traitement.php?op=add_panier&nom_prod="+Vsearch+"&prix_prod="+Vtxt_prix+"&ref_prod="+Vtxt_ref+"&txt_qte="+Vtxt_qte+"&qte_vend="+Vqte_vend+"&txt_client="+Vtxt_client+"&txt_adrs="+Vtxt_adrs+"&txt_devise="+Vtxt_devise+"&unite_vend="+Vunite_vend, {}, function(data){
							  if(data.message === "OK"){
									swal("Opération Reussie !!", "L'article : "+Vsearch+" a bien été ajouté à la liste.", "success");
								  $('.swal-button').click(function(e){
									  clean();
									   location.href='ventes.php?client='+Vtxt_client+'&adrs_cli='+Vtxt_adrs+'&taux_change='+Vtxt_taux+'&devise='+Vtxt_devise;
								  })
								}   
							if(data.message === "error"){
								 swal("Redondance detectée !!", "L'article : "+Vsearch+" existe déjà dans cette Liste !! un article ne peut être repeté 2 fois.", "error");					
								}
							
					   },'json');
					   
					  // chargerCategories();
						
					}
                });
	    
	    $('#btn-add-vente').click(function(e){
			
                e.preventDefault();
		
			    var Vmont_vers = $('#mont_verse').val();
			    var Vreduc = $('#reduc').val();
			    var Vtotal_fac =$('#total_fac').val();
			     var Vtxt_devise= $('#txt_devise').val();
			        var Vreport_type=$('#report_type').val();
			        
                     var Vtotal_reduc= ($('#total_fac').val() * Vreduc)/100;
                     var Vmoney_symbol="";

                   if(Vtxt_devise==='dollar'){
                      Vmoney_symbol="$";
                   }else{
                      Vmoney_symbol="CDF";
                   }

				   if(Vtotal_reduc > Vtotal_fac){
					   swal("Reduction trop élévée !!", "Vous ne pouvez pas accorder une réduction ("+Vreduc+" Fc) qui depasse le coût total("+Vtotal_fac+"Fc) de votre ordonnance.", "error");
				   }else if(Vmont_vers < Vtotal_fac){
					   swal("Paiement insuffisant !!", "le montant versé ("+Vmont_vers+" Fc) est inferieur à la somme totale de l'ordonnance ("+Vtotal_fac+" Fc)", "error");
				   }
			        else{	
						if(Vreduc!=""){ 
                           
							Vtotal_fac=$('#total_fac').val() - Vtotal_reduc;

					}
						$.get("traitement/vente-traitement.php?op=add_vente&mont_vers="+Vmont_vers+"&reduc="+Vreduc+"&total_fac="+Vtotal_fac+"&report_type="+Vreport_type, {}, function(data){
							  if(data.message === "OK"){
									swal("La vente a reussie !!", "REF Opération : "+data.Ref_cmd+" | Montant total : "+data.Total_achat+" "+Vmoney_symbol, "success");
								  $('.swal-button').click(function(){
									  //clean();
									if ((Vreport_type=='FACT')) {
									  location.href='./etats/facture_finale.php?ref='+data.Ref_cmd;
									}
									else if ((Vreport_type=='BON')){
                                      location.href='./etats/bon_livraison.php?ref='+data.Ref_cmd;
									}
									 else if ((Vreport_type=='PROFORMA')){
                                    location.href='./etats/facture_pro_format.php?ref='+data.Ref_cmd;
									}
									  //location.href='ventes.php';
									
								  })
								}   
							if(data.message === "error"){
								 swal("Redondance detectée !!", "La référence vente : "+data.Ref_cmd+" a déjà été attribuée.", "error");
								
								}
							
					   },'json');
					}
                });
	 
	   $('#btn-clean-panier').click(function(e){

               e.preventDefault();
                
                var Vtxt_client= $('#txt_client').val();
			    var Vtxt_adrs= $('#txt_adrs').val();
			    var Vtxt_devise= $('#txt_devise').val();
			    var Vtxt_taux= $('#txt_taux').val();

              swal({
                    title: "Annulation de la vente ?",
                    text: "Etes-vous sûr de vouloir annuler cette vente? toute l'ordonnance et son contenu (Medicaments) actuel seront perdus.",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                        if (willDelete) {
                            $.get($(this).attr('href'), {}, function(data){

                                  if(data.message === "OK"){
                                  swal("Annulation reussi !!", {
                                    icon: "success",
                                  });
                                    
                                    $('.swal-button').click(function(){
                                      // viewdata(); 
                                    	location.href='ventes.php';})
                                   }    
                            
                            },'json')
                        } else {
                          swal("Oups! Opération annulée.","");
                        }        
                      });
        });
	 
       $('.btn-supp').click(function(e){

               e.preventDefault();


                var Vtxt_client= $('#txt_client').val();
			    var Vtxt_adrs= $('#txt_adrs').val();
			    var Vtxt_devise= $('#txt_devise').val();
			    var Vtxt_taux= $('#txt_taux').val();
			

			   swal({
                    title: "Mise à jour Liste ?",
                    text: "Etes-vous sûr de vouloir retirer cet article de liste ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                        if (willDelete) {
                            $.get($(this).attr('href'), {}, function(data){

                                  if(data.message === "OK"){
                                  swal("Suppression effectuée! ARTICLE : "+data.nom_prod+" a bien été retiré de la liste.", {
                                    icon: "success",
                                  });
                                    
                                    $('.swal-button').click(function(){ //viewdata(); 
                                    	//location.href='refresh.php?client1='+Vtxt_client;
                                    	
                                    	  location.href='ventes.php?client='+Vtxt_client+'&adrs_cli='+Vtxt_adrs+'&taux_change='+Vtxt_taux+'&devise='+txt_devise;
                                        
                                    	//
                                    })

                                   }    
                            
                            },'json')
                        } else {
                          swal("Oups! Opération annulée.","");
                        }        
                      });  

                    /*$.get($(this).attr('href'), {}, function(data){

                          if(data.message === "OK"){

                                ///('#corp').empty().append(data.table_panier);
                                if(confirm('Retirer cet article de votre panier?')){
                                    location.href='panier.php?id=1#corp';}
                           }
                          else {
                          
                           }           
                    },'json') */ 

            });


 $('#btn-supp-vente').click(function(e){

               e.preventDefault();
			   
			   swal({
                    title: "Supprimer la vente ?",
                    text: "Etes-vous sûr? Cette opération est irreverssible. Tous les produits lié à la  référence de cette vente serons supprimés de la liste ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                        if (willDelete) {
                            $.get($(this).attr('href'), {}, function(data){

                                  if(data.message === "OK"){
                                  swal("Suppression effectuée!", "La vente REF : "+data.ref_cmd+" a bien été supprimé, comme vous l'avez desiré !!", {
                                    icon: "success",
                                  });
                                    
                                    $('.swal-button').click(function(){ location.href='liste-ventes.php'; })

                                  }    
                            
                            },'json')
                        } else {
                          swal("Oups! Opération annulée.","");
                        }        
                      });  

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


  $('#btn_retour').click(function(e){

               e.preventDefault();
			   
			   swal({
                    title: "Quitter la vente ?",
                    text: "Etes-vous sûr de vouloir continuer ?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                  })
                  .then((willDelete) => {
                        if (willDelete) {
                     
                     location.href='ventes.php';
                                 
                                   }    
                            else {
                          swal("Oups! Opération annulée.","");}
                           
                         });   
                   
                   });         

                   


