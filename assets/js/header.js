//NO ESTÁ FUNCIONANDO
// $(function() {
//     header = {
//         init:function(){
        //     var head = `<header>
        //     <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        //         <div class="container">
        //             <div class="navbar-header">
        //                 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        //                     <span class="sr-only">Toggle navigation</span>
        //                     <span class="icon-bar"></span>
        //                     <span class="icon-bar"></span>
        //                     <span class="icon-bar"></span>
        //                 </button>
        //                 <a class="logo"><img id="logo" src="<?= URL::to('assets/img/logo2.png'); ?>" /></a>
        //             </div>
        //             <!-- Collect the nav links for toggling -->
        //             <div class="collapse navbar-collapse navbar-ex1-collapse">
        //                 <ul class="nav navbar-nav navbar-right">
        //                     <li class="cam"><a >Bienvenid@ <b><?php echo($_SESSION['userName']) ?>  <span class="glyphicon glyphicon glyphicon-user"></span>  </b></a>
        //                     </li>
        //                     <li class="cam fz-18"><a href="<?= URL::base(); ?>/Service/fechasInconsistentes"><i class="glyphicon glyphicon-warning-sign"></i><span class="badge badge-mn"><?php print_r($this->Dao_service_model->cantFechasInconsistentes()->cant); ?></span></a></li>
        //                     <li class="cam"><a href="<?= URL::to('user/principalView'); ?>">Home</a>
        //                     </li>
        //                     <li class="cam"><a href="#services">Servicios</a>
        //                         <ul>
        //                             <li><a href="<?= URL::to('Service/assignService'); ?>">Agendar Actividad</a></li>
        //                             <li><a href="<?= URL::to('Service/listService'); ?>s">Ver Actividades</a></li>
        //                             <li><a href="https://accounts.google.com/ServiceLogin/signinchooser?passive=1209600&continue=https%3A%2F%2Faccounts.google.com%2FManageAccount&followup=https%3A%2F%2Faccounts.google.com%2FManageAccount&flowName=GlifWebSignIn&flowEntry=ServiceLogin" title="drive" target='_blank'>Drive</a></li>
        //                         </ul>
        //                     </li>
        //                     <li class="cam"><a href="#services">RF</a>
        //                         <ul>
        //                             <li class="cam"><a href="<?= URL::to('Service/RF'); ?>">Actualizar RF</a></li>
        //                             <li class="cam"><a href="<?= URL::to('SpecificService/viewRF'); ?>">Ver RF</a></li>
        //                         </ul>
        //                     </li>
        //                     <li class="cam"><a href="<?= URL::to('Grafics/getGrafics'); ?>">Gráficas</a>
        //                     </li>
        //                     <li class="cam"><a href="<?= URL::to('Modernizaciones/getModernizaciones'); ?>">Modernizaciones</a>
        //                     </li>
        //                     </li>
        //                     <li class="cam"><a href="<?= URL::to('welcome/index'); ?>">Salir  <span class="glyphicon glyphicon glyphicon-off"></span></a>
        //                     </li>
        //                 </ul>
        //             </div>
        //         </div>
        //     </nav>
        // </header>`;
//         header.addView(head);
//         },
//         addView: function(head){
//             console.log(head);
//             $("#headNavigation").html(head);
//         }
//     }
//     header.init();
// });