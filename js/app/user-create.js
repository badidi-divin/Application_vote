  $(document).ready(function(e){
            
        
            
            $('#btn_conf').click(function(e){

              e.preventDefault();

                var Vnom_post= $('#nom_post').val();
                var Vprnom= $('#prnom').val();
                var Vmail= $('#mail').val();
                var Vtel= $('#tel').val();
                var Vadrs1= $('#adrs1').val();
                var Vadrs2= $('#adrs2').val();
                var Vvil= $('#vil').val();
                var Vpseudo= $('#pseudo').val();
                var Vpwd1= $('#pwd1').val();
                var Vpwd2= $('#pwd2').val();
            
                if ((!Vnom_post =='') && (!Vprnom=='') && !Vmail=='' && !Vtel=='' && !Vadrs1=='' && !Vvil=='' && !Vpseudo=='' && !Vpwd1=='' && !Vpwd2=='') {

                  if (Vpwd1==Vpwd2) {

                     $.get("user-traitement.php?nom_post="+Vnom_post+"&prnom="+Vprnom+"&mail="+Vmail+"&tel="+Vtel+"&adrs1="+Vadrs1
                        +"&adrs2="+Vadrs2+"&vil="+Vvil+"&pseudo="+Vpseudo+"&pwd1="+Vpwd1,{}, function(data){

                           if(data.message === "pseudo"){
                            $('.alert-success').empty().append("<div class='alert-message'> <strong><span id='success'>"+"Pseudo déjà utilisé."+" </span></strong></div>");
                           }
                            if(data.message === "tel"){
                                  $('.alert-success').empty().append("<div class='alert-message'> <strong><span id='success' >"+"Numéro de téléphone déjà attribué."+" </span></strong></div>");
                            }
                            if(data.message === "mail"){

                                $('.alert-success').empty().append("<div class='alert-message'> <strong><span id='success' >"+"L'adresse email déjà utilisé."+ "</span></strong></div>");
                            }
                              if(data.message === "OK"){
                              
                                $('#UserInfos').empty().append(data.user);
                                
                                swal(" Merci! "+data.nom, "Nous vous remerçions d'avoir choisi CTS pour effectuer vos achats, vous êtes desormais client et pouvez desormais profiter de la totalité des produits et offres. BON SHOPPING", "success");
                                
                                 $('.swal-button').click(function(){
                                        location.href='wenze.php?id=1&idscat=1';
                                  })
                               }
                             
                       },'json')

                   }
                   else{
                      $('.alert-success').empty().append("<div class='alert-message'> <strong><span id='success' >"+"Les deux mot de passe ne correspndent pas !!!"+" </span></strong></div>");
                      $('#pwd2').val('');
                      $('#pwd2').attr('border','red');
                   }
                 }
                 else{
                      $('.alert-success').empty().append("<div class='alert-message'> <strong><span id='success' >"+"Veuillez Remplir tout les champs important (*)"+" </span></strong></div>");
                     }

                });

      

             $('#btn_reset').click(function(e){

                e.preventDefault();

                var NomPost= $('#nom_post').val('');
                var Prnom= $('#prnom').val('');
                var mail= $('#mail').val('');
                var tel= $('#tel').val('');
                var adrs1= $('#adrs1').val('');
                var adrs2= $('#adrs2').val('');
                var vil= $('#vil').val('');
                var pseudo= $('#pseudo').val('');
                var pwd1= $('#pwd1').val('');
                var pwd2= $('#pwd2').val('');

                
                $('.alert-success').empty();
                $('#nom_post').focus();
                }); 

         }); 