

<!DOCTYPE html>

<html lang="en">

<head>

    <title> Inscrivez - vous :: Money Maker</title>

    <meta charset="utf-8">

<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">

<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="theme-color" content="#039be5">

<meta charset="utf-8">


<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- <link rel="apple-touch-icon" sizes="57x57" href="/assets/img/favicon/apple-icon-57x57.png">

<link rel="apple-touch-icon" sizes="60x60" href="/assets/img/favicon/apple-icon-60x60.png">

<link rel="apple-touch-icon" sizes="72x72" href="/assets/img/favicon/apple-icon-72x72.png">

<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/favicon/apple-icon-76x76.png">

<link rel="apple-touch-icon" sizes="114x114" href="/assets/img/favicon/apple-icon-114x114.png">

<link rel="apple-touch-icon" sizes="120x120" href="/assets/img/favicon/apple-icon-120x120.png">

<link rel="apple-touch-icon" sizes="144x144" href="/assets/img/favicon/apple-icon-144x144.png">

<link rel="apple-touch-icon" sizes="152x152" href="/assets/img/favicon/apple-icon-152x152.png">

<link rel="apple-touch-icon" sizes="180x180" href="/assets/img/favicon/apple-icon-180x180.png">

<link rel="icon" type="image/png" sizes="192x192" href="/assets/img/favicon/android-icon-192x192.png">

<link rel="icon" type="image/png" sizes="32x32" href="/assets/img/favicon/favicon-32x32.png">

<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon/favicon-96x96.png">

<link rel="icon" type="image/png" sizes="16x16" href="/assets/img/favicon/favicon-16x16.png"> -->

<link rel="icon" type="image/jpg" sizes="192x192" href="{{ URL::asset('complement/assets/img/logo.jpg') }}">

<link rel="manifest" href="/assets/img/favicon/manifest.json"> 

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/socicon@3.0.5/css/socicon.min.css">

<meta name="msapplication-TileColor" content="#039be5">

<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">

<meta name="description" content="Money Maker- Mobile Money to Credit Card Service. Online Payments Made Simple & Accessible for Everyone.">

<meta name="keywords" content="noupia,cameroon,credit card,mobile money,mtn,orange money,africa,online">

<link rel="stylesheet" href="/assets/css/font-awesome-4.7.0/css/font-awesome.min.css">

<link rel="stylesheet" href="/assets/css/font-awesome-4.7.0/css/font-awesome.css">

<link rel="stylesheet" href="css\app.css">

<noscript>

    <meta http-equiv="Refresh" content="0; url='https://google.com/search?q=enable+javascript'" />

</noscript>



<script src="/assets/js/lib/jquery-3.4.1.min.js"></script>

<script src="public\js\newapp.js"></script> 

<!--<script type="text/javascript" src="https://app.noupia.com/assets/js/global2.js" ></script>-->

<!-- <link rel="icon" href="https://app.noupia.com/assets/img/favicon/favicon.ico" > -->

<link rel="stylesheet" type="text/css" href="https://app.noupia.com/assets/components/global/global3.css" />

<link rel="stylesheet" type="text/css" href="https://app.noupia.com/assets/components/global/flexbox.css" />

<link rel="stylesheet" type="text/css" href="https://app.noupia.com/assets/css/app.css" />

<script>

    setInterval(function () {

        

        const online = navigator.onLine

        const isVerifPage = window.location.href.indexOf('verify') > -1

        if (isVerifPage) {

            

            $.ajax({

                type : 'GET',

                url : '/verify',

                data : {

                    check_reload_required : true,

                },

                success : function (data) {

                    data = JSON.parse(data)

                

                    if(data.reload_required == 'yes'){

                        window.location = '?reload=true'

                        return false

                    }

                }

            })

        }



    }, 3000)



    window.PLAYER_ID = 'EMPTY'

</script>

<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>

    <script>

        $(function () { 

            window.OneSignal = window.OneSignal || [];

            OneSignal.push(function() {

                OneSignal.init({

                    appId: "c54e1140-83bd-4827-925d-c4483624cca2",

                    notifyButton: {

                        enable: true,

                    },

                })

                OneSignal.showNativePrompt()  

            }) 

            window.OneSignal.isPushNotificationsEnabled(function(isEnabled) {

                  if (isEnabled) {

                      OneSignal.getUserId( function(userId) {

                          //console.log('player_id is : ' + userId); 

                          window.PLAYER_ID = userId

                      })

                  }

            })

        })

      

    </script>





  

</head>

<body class="bg-white">

   



<!-- App Header -->

<div class="appHeader text-light" style="background:  #f2f2fc; box-shadow: 0 19px 38px rgba(0,0,0,0.30), 0 15px 12px rgba(0,0,0,0.22); height: 10vh;">

    <div class="left">

                    <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">

                <i class="material-icons">apps</i>

            </a>

         

    </div>

    <div class="pageTitle">

        <img src="{{ URL::asset('complement/assets/img/logo.png') }}" width="120rem">

    </div>

    </div>

<!-- * App Header -->



        

            @yield('content')

        





<!-- App Sidebar -->

<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-body p-0">

                

                <!-- profile box -->

                <div class="profileBox pt-2 pb-2">

                    <div class="image-wrapper">

                        <i class="material-icons">apps</i>

                    </div>

                    <div class="in">

                        <strong> Money Maker</strong>

                        <div class="text-muted">Money MakerHQ </div>

                    </div>

                    <a href="#" class="btn btn-link btn-icon sidebar-close" data-dismiss="modal">

                        <i class="material-icons">close</i>

                    </a>

                </div>

                <br>

                <!-- * profile box -->



                



                <!-- others -->



                <ul class="listview flush transparent no-line image-listview">

                    

                    <li>

                        <a href="/faqs" class="item">

                            <div class="icon-box" style="background:  #efaa1e; border-color: #efaa1e;">

                                <i class="material-icons">help</i>

                            </div>

                            <div class="in">

                                Questions

                            </div>

                        </a>

                    </li>



                    <li>

                        <a href="/assistance" class="item">

                            <div class="icon-box" style="background:  #efaa1e; border-color: #efaa1e;">

                                <i class="material-icons">support_agent</i>

                            </div>

                            <div class="in">

                                Assistance

                            </div>

                        </a>

                    </li>

                                        <li>

                        <a href="/language" class="item">

                            <div class="icon-box" style="background:  #efaa1e; border-color: #efaa1e;">

                                <i class="material-icons">language</i>

                            </div>

                            <div class="in">

                                Langue                            </div>

                        </a>

                    </li>

                    





                    

                    <li>

                        <a href="/terms" class="item">

                            <div class="icon-box" style="background:  #efaa1e; border-color: #efaa1e;">

                                <i class="material-icons">info</i>

                            </div>

                            <div class="in">

                                Termes                            </div>

                        </a>

                    </li>



                                        <li>

                        <a href="/signin" class="item">

                            <div class="icon-box" style="background:  #efaa1e; border-color: #efaa1e;">

                                <i class="material-icons">account_circle</i>

                            </div>

                            <div class="in">

                                Connexion                            </div>

                        </a>

                    </li>

                                    </ul>

                <!-- * others -->



                <!-- send money -->

                <div class="listview-title mt-1">Copyright &copy; <a target="_blank" title="PERFITCOM" href="https://www.perfitcom.com">PERFITCOM</a> 2021 </div>

                <!--

                    <ul class="listview image-listview flush transparent no-line">

                        <li>

                            <a href="#" class="item">

                                <img src="assets/img/sample/avatar/avatar2.jpg" alt="image" class="image">

                                <div class="in">

                                    <div>Artem Sazonov</div>

                                </div>

                            </a>

                        </li>

                        <li>

                            <a href="#" class="item">

                                <img src="assets/img/sample/avatar/avatar4.jpg" alt="image" class="image">

                                <div class="in">

                                    <div>Sophie Asveld</div>

                                </div>

                            </a>

                        </li>

                        <li>

                            <a href="#" class="item">

                                <img src="assets/img/sample/avatar/avatar3.jpg" alt="image" class="image">

                                <div class="in">

                                    <div>Kobus van de Vegte</div>

                                </div>

                            </a>

                        </li>

                    </ul>

                    -->

                <!-- * send money -->



            </div>

        </div>

    </div>

</div>

<!-- * App Sidebar -->



<!-- ///////////// Js Files ////////////////////  -->



<!-- Bootstrap-->

<script src="/assets/js/lib/popper.min.js"></script>

<script src="/assets/js/lib/bootstrap.min.js"></script>

<!-- Ionicons -->

<!--<script src="assets/ionicons/ionicons.js"></script> -->

<!-- Owl Carousel -->

<script src="/assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>

<!-- Base Js File -->

<script src="/assets/js/base.js"></script>





<!-- Feedback Action Sheet -->

<div class="modal fade action-sheet" id="feedbackActionSheet" tabindex="-1" role="dialog">

    <div class="modal-dialog" role="document">

        <div class="modal-content">

            <div class="modal-header">

                <h5 class="modal-title">

                    Comment améliorer Noupia?                </h5>

            </div>

            <div class="modal-body">

                <div class="action-sheet-content">

                    <form method="POST" action="/feedback">

                        <input type="hidden" name="sendFeedback" value="true">

                        <div class="form-group basic">

                            <div class="input-wrapper">

                                <label class="label" for="account3"></label>

                                <select class="form-control custom-select" id="account3">

                                    <option disabled selected value="0" selected> </option>

                                </select>

                            </div>

                        </div>

                        <div class="form-group basic">

                            <label class="label"> Dites-nous quelque chose</label>

                            <div class="input-group mb-3">

                                <div class="input-group-prepend">

                                    <span class="input-group-text" id="input145555"> </span>

                                </div>

                                <textarea name="message" class="form-control form-control-lg" placeholder=""

                                    minlength="10" required></textarea>

                            </div>

                        </div>

                        <div class="form-group basic">

                            <button type="submit" class="btn btn-primary btn-block btn-lg" -data-dismiss="modal">

                                Envoyer</button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- * Feedback Action Sheet -->

</body>



</html>

















