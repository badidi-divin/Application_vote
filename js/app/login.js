  $(document).ready(function(e){

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
                          
            $('#cnx').click(function(e){
            
            e.preventDefault();

                var VNomUt = $('#NomUt').val();
                var VPwd = $('#Pwd').val();

            if(VNomUt =='' && VPwd==''){ 
            show_message('1','<strong>Erreur !</strong> Tout les champs sont vides, veuillez SVP les remplir.');
            }
            else if(VNomUt ==''){ 
            show_message('1','<strong>Erreur !</strong> Veuillez fournir le nom  d\'ulisateur. ');
            }
            else if(VPwd ==''){ 
            show_message('1','<strong>Erreur !</strong> Veuillez fournir le mot de passe. ');
            }
            else{
                 show_message('2','');
               $.get("login-traitement.php?User="+VNomUt+"&Pwd="+VPwd, {}, function(data){

                    if(data.message === "OK"){
                      
                      $('#UserInfos').empty().append(data.user);

                      swal("Bienvenue ! "+data.user, "", "success");

                       $('.swal-button').click(function(){
                              location.href='tableau_bord.php';
                        })
                     } 
                    else{
                      
                     swal("Connexion Impossible !!", "Veuillez fournir les identifiants correct SVP.", "error");
                       // $('#success').attr('color','red');
                       $('#NomUt').val('');
                        $('#Pwd').val('');
                        
                       } 
                         
               },'json')
              }
               /*  $.ajax({
                    url:"login-traitement.php?User="+VNomUt+"&Pwd="+VPwd,
                    type:"GET",
                    datatype: "json",
                    success:function(data){ 
                     
                      alert(data.error);                               
                    }
                 });*/ 
                
                });

             $('#reset').click(function(){
            
                var VNomUt = $('#NomUt').val('');
                var VPwd = $('#Pwd').val('');
                $('.alert-success').empty();
                $('#NomUt').focus();
                });
        
             
              $('.btn_log').click(function(){

                /*  alert('OOOKKK');
                  container = $('.dropdown__menu__login');
                  $('<div class="user_menu"></div>').prependTo(container);
                  container.addClass('is-visible');     */        

                 });

         }); 