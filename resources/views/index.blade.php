<!DOCTYPE html>
<html lang="en-US">
   <head>
      <meta charset="UTF-8">
      <title>V-MIS</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="css/components.css">
      <link rel="stylesheet" href="css/responsee.css">
      <link rel="stylesheet" href="css/icons.css">
      <link rel="stylesheet" href="owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="owl-carousel/owl.theme.css">
      <!-- CUSTOM STYLE -->
      <link rel="stylesheet" href="css/template-style.css">
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
      <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
      <script type="text/javascript" src="js/jquery-ui.min.js"></script>
      <script type="text/javascript" src="js/template-scripts.js"></script>
      <!-- MAP STYLE -->
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/css/ol.css" type="text/css">
      <style>
        .map {
          height: 700px;
          width: 90%;
          display: block;
          margin-left: auto;
          margin-right: auto;
        }
        .ol-popup {
          position: absolute;
          background-color: white;
          box-shadow: 0 1px 4px rgba(0,0,0,0.2);
          padding: 15px;
          border-radius: 10px;
          border: 1px solid #cccccc;
          bottom: 12px;
          left: -50px;
          min-width: 280px;
          }
          .ol-popup:after, .ol-popup:before {
          top: 100%;
          border: solid transparent;
          content: " ";
          height: 0;
          width: 0;
          position: absolute;
          pointer-events: none;
          }
          .ol-popup:after {
          border-top-color: white;
          border-width: 10px;
          left: 48px;
          margin-left: -10px;
          }
          .ol-popup:before {
          border-top-color: #cccccc;
          border-width: 11px;
          left: 48px;
          margin-left: -11px;
          }
          .ol-popup-closer {
          text-decoration: none;
          position: absolute;
          top: 2px;
          right: 8px;
          }
          .ol-popup-closer:after {
          content: "x";
          }
      </style>
   </head>
   <body class="size-1140">
  	  <!-- PREMIUM FEATURES BUTTON -->
  	  <a target="_blank" class="hide-s" href="../template/onepage-premium-template/" style="position:fixed;top:130px;right:-14px;z-index:10;"><img src="img/premium-features.png" alt=""></a>
      <!-- TOP NAV WITH LOGO -->
      <header>
         <div id="topbar" class="hide-s hide-m">

         </div>
         <nav>
            <div class="line">
               <div class="s-12 l-2">
                  <p class="logo">V-MIS</p>
               </div>
               <div class="top-nav s-12 l-10">
                  <ul class="right">
                     <li class="active-item"><a href="#carousel">Home</a></li>
                    {{-- <!--<li><a href="#features">Process</a></li>
                     <li><a href="#services">Services</a></li> -->--}}
                     <li><a href="#contact">Contact</a></li>
                     <li>
                        @if(Auth::check())
                           <a href="{{url('/dashboard')}}">Dashboard</a>
                        @else
                          <a href="{{url('login')}}">Login</a>
                        @endif
                     </li>
                  </ul>
               </div>
            </div>
         </nav>
      </header>
      <section>
        <!-- Map Block -->
        <div id="carousel">
         <div id="map" class="map"></div>
         <div id="popup" class="ol-popup">
           <a href="#" id="popup-closer" class="ol-popup-closer"></a>
           <div id="popup-content"></div>
         </div>
       
         
         <!-- <div>
           <label for="selector">Map Layers:</label>
           <select id="selector" onchange="changeLayer(value)">
             <option disabled selected value> -- select an option -- </option>
             <option value="Gewogs">Gewogs</option>
             <option value="CAs">Commercial Aggregators</option>
             <option value="Dzongkhags">Dzongkhags</option>
           </select>
         </div> -->

         <div align='center'>
           <label><input type='checkbox' onclick='handleClickGewog(this);'>Gewog</label><br>
           <label><input type='checkbox' onclick='handleClickDzongkhag(this);'>Dzongkhag</label>
         </div>
         <script src="https://cdn.jsdelivr.net/gh/openlayers/openlayers.github.io@master/en/v6.3.1/build/ol.js"></script>
         <script type="text/javascript">
          var map = new ol.Map({
              target: 'map',
              layers: [
                  new ol.layer.Tile({
                  source: new ol.source.OSM()
                })
              ],
              view: new ol.View({
                  center: ol.proj.fromLonLat([90.46,27.60]),
                  zoom: 8.80
              }),
              controls: [], //These options disable map scroll
              interactions: []
          });

          var gewog_layer;
          var dzongkhag_layer;

          function show_dzongkhag_layer() {
            if(typeof dzongkhag_layer == 'undefined') {
              //alert('dzongkhag_layer not defined');
              var dzongkhag_name = ['Thimphu', 'Bumthang', 'Trashiyangtse', 'Samtse'];
              var long = [89.64191, 90.7525, 91.498, 89.09951];
              var lat = [27.46609, 27.54918, 27.6116, 26.89903];
              var pointerFeatures = [];

              dzongkhag_name.forEach(createFeatures);
              function createFeatures(value, index, array) {
                feature = new ol.Feature({
                  geometry: new ol.geom.Point(ol.proj.fromLonLat([long[index],lat[index]])),
                  type: 'Dzongkhag',
                  name: dzongkhag_name[index]
                });
                console.log(feature.get('gewog_name'));
                pointerFeatures.push(feature);
              }
              // create the marker stylesheet
              var iconStyle = new ol.style.Style({
                image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                  anchor: [0.5, 46],
                  anchorXUnits: 'fraction',
                  anchorYUnits: 'pixels',
                  //opacity: 0.75,
                  src: '../../images/dzongkhag.png'
                }))
              });
              dzongkhag_layer = new ol.layer.Vector({
                name: 'Dzongkhag',
                source: new ol.source.Vector({
                  features: pointerFeatures,
                }),
                style: iconStyle
              });
            }
            //Now add the layer
            map.addLayer(dzongkhag_layer);
          }

          function show_gewog_layer() {
            if(typeof gewog_layer == 'undefined') {
              var pointerFeatures = [];

              const create_gewog_layer = async () => {
                const response = await fetch('gewog_map');
                const json = await response.json();
                console.log(json);
                console.log('after json');
                json.gewogs.forEach(function(value, index, array){
                  var lat = array[index].latitude;
                  var long = array[index].longitude;
                  feature = new ol.Feature({
                    geometry: new ol.geom.Point(ol.proj.fromLonLat([long, lat])),
                    type: 'Gewog',
                    name: array[index].gewog
                  });
                  console.log('feature: ' + feature.getGeometry().getCoordinates());
                  console.log("gewog: " + array[index].gewog);
                  console.log("lat: " + lat);
                  console.log("long: " + long);
                  pointerFeatures.push(feature);
                })
                //console.log(pointerFeatures);
                
                var iconStyle = new ol.style.Style({
                  image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
                    anchor: [0.5, 46],
                    anchorXUnits: 'fraction',
                    anchorYUnits: 'pixels',
                    //opacity: 0.75,
                    src: '../../images/extension.png'
                  }))
                });
                gewog_layer = new ol.layer.Vector({
                  name: 'Gewog',
                  source: new ol.source.Vector({
                    features: pointerFeatures,
                  }),
                  style: iconStyle
                });
                console.log('adding layer');
                map.addLayer(gewog_layer);
              }

              create_gewog_layer();

            //   var gewog_name = ['Chokhor', 'Ura', 'Tang', 'Chhume'];
            //   var long = [90.71112766300, 90.91560670800, 90.87104712900, 90.69937767200];
            //   var lat = [27.60460129980, 27.48790712980, 27.57078822880, 27.49359672880];
              

            //   gewog_name.forEach(createFeatures);
            //   function createFeatures(value, index, array) {
            //     feature = new ol.Feature({
            //       geometry: new ol.geom.Point(ol.proj.fromLonLat([long[index],lat[index]])),
            //       type: 'Gewog',
            //       name: gewog_name[index]
            //     });
            //     //console.log(feature.get('gewog_name'));
            //     pointerFeatures.push(feature);
            //   }
            //   // create the marker stylesheet
            //   var iconStyle = new ol.style.Style({
            //     image: new ol.style.Icon(/** @type {olx.style.IconOptions} */ ({
            //       anchor: [0.5, 46],
            //       anchorXUnits: 'fraction',
            //       anchorYUnits: 'pixels',
            //       //opacity: 0.75,
            //       src: '../../images/extension.png'
            //     }))
            //   });
            //   gewog_layer = new ol.layer.Vector({
            //     name: 'Gewog',
            //     source: new ol.source.Vector({
            //       features: pointerFeatures,
            //     }),
            //     style: iconStyle
            //   });
            // }
            // //Now add the layer
            // console.log('adding layer');
            // map.addLayer(gewog_layer);
          }
          else {
            map.addLayer(gewog_layer);
          }
       }

        //trypopup
        var container = document.getElementById('popup');
        var content = document.getElementById('popup-content');
        var closer = document.getElementById('popup-closer');

        var overlay = new ol.Overlay({
          element: container
        });
        map.addOverlay(overlay);
        map.on('click', function(event) {
          map.forEachFeatureAtPixel(event.pixel, function(feature,layer) {
            var coordinate = event.coordinate;
          //  var content = document.getElementById('popup');
          //  content.innerHTML = '<p>Position:'+coordinate+'</p><code>' +feature.get('ID') + '</code>';
          //content = '<p>Position:'+coordinate+'</p><code>' +feature.get('ID') + '</code>';
          content.innerHTML= feature.get('type')+': '+feature.get('name');
          overlay.setPosition(coordinate);
              // console.log("ID: " + feature.get('ID'));
              // alert("You clicked on " + feature.get('ID'));

            });
        });
        closer.onclick = function() {
          overlay.setPosition(undefined);
          closer.blur();
          return false;
        };

        //end trypopup

        function changeLayer(value){
          if (value == 'Gewogs') {
            show_gewog_layer();
          }
          else if (value == 'CAs') {
            show_ca_layer();
          }
          else if (value == 'Dzongkhags') {
            show_dzongkhag_layer();
          }
        }

        function handleClickGewog(status) {
          if(status.checked) {
            show_gewog_layer();
          }
          else {
            remove_layer('Gewog');
          }
        }

        function handleClickDzongkhag(status) {
          if(status.checked) {
            show_dzongkhag_layer();
          }
          else {
            remove_layer('Dzongkhag');
          }
        }

        function remove_layer(layer_name) {
           map.getLayers().getArray()
             .filter(layer => layer.get('name') === layer_name)
             .forEach(layer => map.removeLayer(layer));
        }
        </script>
      
        

         <!-- FIRST BLOCK -->
         <!-- <div id="first-block">
            <div class="line">
               <h1>What is C-SMS?</h1>
               <p>C-SMS is the Crop-Surplus Management System that will help to mange the surplus and market value to some place that
                   have no crop production</p>
               <div class="s-12 m-4 l-2 center"><a class="white-btn" href="#features">Click the Process</a></div>
            </div>
         </div> -->
         <!-- FEATURES -->
         <!-- <div id="features">
            <div class="line">
               <div class="margin">
                  <div class="s-12 m-6 l-3 margin-bottom">
                     <img src="{{asset('images/login.jpg')}}">
                     <h2>Login to System</h2>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                  </div>
                  <div class="s-12 m-6 l-3 margin-bottom">
                  <img src="{{asset('images/surplus.jpg')}}">
                    <h2>Manage the Surplus</h2>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat adipiscing.</p>
                  </div>
                  <div class="s-12 m-6 l-3 margin-bottom">
                  <img src="{{asset('images/interaction.jpg')}}">
                     <h2>Market Interaction</h2>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna erat volutpat.</p>
                  </div>
                  <div class="s-12 m-6 l-3 margin-bottom">
                  <img src="{{asset('images/demand.jpg')}}">
                     <h2>Market Demand</h2>
                     <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat nonummy.</p>
                  </div>
               </div>
            </div>
         </div> -->
         <!-- SERVICES -->
         <!-- <div id="services">
            <div class="line">
               <h2 class="section-title">What System do</h2>
               <div class="margin">
                  <div class="s-12 m-6 l-4 margin-bottom">
                  <img src="{{asset('images/management.jpg')}}">
                     <div class="service-text">
                        <h3>Surplus Management</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                     </div>
                  </div>
                  <div class="s-12 m-6 l-4 margin-bottom">
                  <img src="{{asset('images/graph_icon.png')}}">
                     <div class="service-text">
                        <h3>We look to the Market Demand</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                     </div>
                  </div>
                  <div class="s-12 m-12 l-4 margin-bottom">
                  <img src="{{asset('images/production.png')}}">
                     <div class="service-text">
                        <h3>Market for Crop Production</h3>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.</p>
                     </div>
                  </div>
               </div>
            </div>
         </div> -->

         <!-- CONTACT -->
         <div id="contact">
            <div class="line">
               <h2 class="section-title">Contact Us</h2>
               <div class="margin">
                  <div class="s-12 m-12 l-4 margin-bottom right-align">
                     <h3>Ministry Of Agriculture and Forests</h3>
                     <h>Department of Agriculture</h4>
                     <h5>Vegetable Management Information System</h5>
                     <address>
                        <p><strong>Adress:</strong> Tashichho Dzong</p>
                        <p><strong>Post Box:</strong> 123</p>
                        <p><strong>Contact:</strong> +975-1745664/02-343457</p>
                        <p><strong>E-mail:</strong> info@tenzi.gmail</p>
                     </address>
                  </div>
               </div>
            </div>
         </div>
      </section>

      <!-- FOOTER -->
      <footer>
         <div class="line">
            <div class="s-12 l-6">
               <p>Copyright 2020, Department of Agriculture</p>
               <p>Ministry of Agriculture and Forests</p>
            </div>
            <div class="s-12 l-6">
               <a class="right" href="http://www.moaf.gov.bt/" title="Responsee - lightweight responsive framework"><strong>Ministry of Agriculture and Forests</strong></a>
            </div>
         </div>
      </footer>

      <script type="text/javascript" src="js/responsee.js"></script>
      <script type="text/javascript" src="owl-carousel/owl.carousel.js"></script>
      <script type="text/javascript">
         jQuery(document).ready(function($) {
            var theme_slider = $("#owl-demo");
            var owl = $('#owl-demo');
            owl.owlCarousel({
              nav: false,
              dots: true,
              items: 1,
              loop: true,
              autoplay: true,
              autoplayTimeout: 6000
            });
            var owl = $('#owl-demo2');
            owl.owlCarousel({
              nav: true,
              dots: false,
              items: 1,
              loop: true,
              navText: ["&#xf007","&#xf006"],
              autoplay: true,
              autoplayTimeout: 4000
            });

            // Custom Navigation Events
            $(".next-arrow").click(function() {
                theme_slider.trigger('next.owl');
            })
            $(".prev-arrow").click(function() {
                theme_slider.trigger('prev.owl');
            })
        });
      </script>
   </body>
</html>
