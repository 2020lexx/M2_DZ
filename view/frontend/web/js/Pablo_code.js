/*
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

require(['jquery',
         'leaflet',
         'mage/validation'
], function($){
    'use strict';

    var map_init;
    var remote_url_base;
    var map;

    var customer_marker;
    var server_marker;
    var customer_polyline;
    var customer_section;
    var mobile_layout = false;
    var markerArray = [];

    var init_result_data;
    var address_edit_mode = false;
    var address_edit_filled = false;
    var i;
    var marker_icons = {};
    for(i=1;i<8;i++){ marker_icons[i]= '<div class="marker-icon-image marker-icon-color-'+i+'" />'; }

    var out_zone_message = '<h3>Sorry .. right now you are so far away :-(<br><br>but stay tuned we\'re growing every day!! </h3>';
    var no_geocoding_message = '<h3>Sorry .. We didn\'t found you :-(<br><br>Is Your address data OK?</h3>';

    var Pablo_fail_zone = decodeURIComponent($('#Pablo_fail_zone').html());
    var Pablo_out_zone = decodeURIComponent($('#Pablo_out_zone').html());

     $(function() {
        // Execute if is enable
         if($('#map_init').length) {
             setTimeout(function () {
                 start_Pablo_code();
             }, 2000);
         }
    });

     function start_Pablo_code() {

         if($(window).width() < 700){
             mobile_layout = true;
             $('#Pablo_deliveryzones_data_result').css({'height':'0px','border':'none'});
         }

         $('#Pablo_main_modal').css('display', 'block');

         init_result_data = $('#Pablo_deliveryzones_data_result').html();

         // Map Init Procedure
         map_init = JSON.parse($('#map_init').html());

         remote_url_base = map_init['ProcUrl'];

         // Map
         // todo:array 1 element on lat
         map = L.map('delivery_map').setView(
             [
                 map_init['MapCenterLat'][0],
                 map_init['MapCenterLong']
             ],
             map_init['MapZoom']);

         L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
             attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
         }).addTo(map);
         L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
             attribution: '| Pablo_Developments - @pablo'
         }).addTo(map);

        /*  todo: google map option
        var googleLayer = new L.Google('ROADMAP');
         map.addLayer(googleLayer); */

         map_init['DrawData'].forEach(function(value,key){
              L.polygon(JSON.parse(value),{color:JSON.parse(map_init['AttrData'][key])['color'] })
                 .addTo(map).bindTooltip(map_init['NameData'][key],{permanent:true})
                 .openTooltip();
         });

         // put customers marker if exists
         if($('#customer_markers').length){

             var customer_markers = JSON.parse($('#customer_markers').html());
             var marker;

             customer_markers.forEach(function(value,key){

                 var icon = new L.DivIcon({ html: marker_icons[value['id']]});
                 marker = new L.marker(value['coords'],{ icon: icon }).addTo(map)
                 markerArray.push(marker);
             });

           }

         // check if this is an edit, if so set map
         if(($('input[name="city"]').length &&  $('input[name="city"]').attr('value')!='')){
             address_edit_filled = true;
             address_edit_mode = true;
             // check if form is valid
             fetch_remote_data($('.form-address-edit').serializeArray());

         }
     }
    //    var fnc_query_status_id;
   // var remote_url_base ='http://127.0.0.1/Pablo_Develop/B_Test/magento_dev/1/deliveryzones/index/procedure';

   // var default_map_data = JSON.parse($('#default_map_data').html());

    // submit data
    $('#Pablo_deliveryzones_submit' ).click(function(e) {
        // check if is valid
        if($('#Pablo_deliveryzones_input_form').validation('isValid')){
          fetch_remote_data($('#Pablo_deliveryzones_input_form').serializeArray());
        };
     });

    // view all addresses
    $('#Pablo_deliveryzones_address_view_all').click(function(e) {
        var group = L.featureGroup(markerArray);
        map.fitBounds(group.getBounds());
      });

    // center map on addresses
    $('.Pablo_deliveryzones_center_map').click(function(e) {

        map.setView(new L.LatLng(
                    JSON.parse($(this).attr('data-center-map'))[0],
                    JSON.parse($(this).attr('data-center-map'))[1]),
                     map_init['CustomerMapZoom']);
         });


    /* Common Functions */


    // ajax
    function fetch_remote_data(data){
        $.ajax({
            type:'POST',

// todo: verify php warings on response
// this is used to avoid PHP warnings on response. original : json
            dataType: 'html',
// todo: verify php warings on response
// this is used to avoid PHP warnings on response
            contentType: 'application/x-www-form-urlencoded;charset=ISO-8859-15',
            cache: false,
            url: remote_url_base,
            data: data,
            beforeSend: function(jqXHR) {
                jqXHR.overrideMimeType('text/html;charset=iso-8859-15');
                $('#Pablo_deliveryzones_data_result').html('<br>In Progress..');
            }
        })
            .done (function(data) {
                $('#Pablo_deliveryzones_data_result').html('');
                process_response(data);})
            .fail (function( jqXHR, textStatus,error ) {
                $('#Pablo_deliveryzones_data_results').html('<font color="AA0000">Errore SND-LNX: ' + error + '</font>').css('display','block');
              //  clearInterval(fnc_query_status_id);
                // $('#close_button').css('display','inline');
            });
    }

    // process response
    function process_response(string) {

        var data = $.parseJSON(responseToObject(string));

        // todo: management errors
        //$('#Pablo_deliveryzones_data_results').html('<font color="AA0000">Errore SND-LNX: ' + error + '</font>').css('display','block');
         // check mobile response
        if(mobile_layout) {
            $('#Pablo_deliveryzones_data_result').css('height','300px');
            $('.Pablo_deliveryzones #delivery_map').css('height','150px');
        }

        // Geocoding Error
        if(data['customerCoords']['status']=='no geocoding result'){
            customer_geocoding_error(data);
            return;
        }

        if(data['Zone']['status']=='off zone'){

            $('#Pablo_deliveryzones_data_result').html(Pablo_out_zone + out_zone_message);

        } else {
             // todo: make as usually
             // reset to initial html
            $('#Pablo_deliveryzones_data_result').html(init_result_data);

            Object.keys(data['Section']).forEach(function (value){
                $('#'+value).html(data['Section'][value]);
              })
            // view data
            $('#zone_name').html(data['Zone']['zone_name']);
            $('#Pablo_deliveryzones_data_result_div').css('visibility','visible');

            if (customer_marker !== undefined) { map.removeLayer(customer_marker); }
            if (server_marker !== undefined) { map.removeLayer(server_marker); }
            if (customer_polyline !== undefined) { map.removeLayer(customer_polyline); }
            if (customer_section !== undefined) { map.removeLayer(customer_section); }
            // draw section
             drawSection(
                 [
                     data['Zone']['zone_server_coords_lat'],
                     data['Zone']['zone_server_coords_long']
                 ],
                 data['Section']['distanceValue'],
                 data['Section']['section_name']);
        }
        // draw
        // center and zoom to customer
        customerMarker([
            data['customerCoords']['lat'],
            data['customerCoords']['long']
            ]);
        map.setView(
            [
                data['customerCoords']['lat'],
                data['customerCoords']['long']
            ],
            map_init['CustomerMapZoom']);

        // disable check button
        $("#Pablo_address_edit_submit").fadeOut().css('display','none');

        // after 5' draw path
        setTimeout(function(){
            // server marker
            serverMarker([
                data['Zone']['zone_server_coords_lat'],
                data['Zone']['zone_server_coords_long']
            ]);
            // draw path and zoom
            drawPath([
                [data['customerCoords']['lat'],data['customerCoords']['long']],
                [data['Zone']['zone_server_coords_lat'],data['Zone']['zone_server_coords_long']]
            ]);
            },5000);

        // if we're in address edit mode enable save button
        if(address_edit_mode){

            $("#Pablo_address_save_submit").css("display", "block");
        }

    }

    // no geocoding address
    function customer_geocoding_error(data){

        $('#Pablo_deliveryzones_data_result').html(Pablo_fail_zone + no_geocoding_message +
            '<p>' + data['customerAddress']['address'] + ' ' +  data['customerAddress']['address_number'] +
            '<br>' +  data['customerAddress']['pobox'] + ' - ' +  data['customerAddress']['city'] +
            ' (' +  data['customerAddress']['state'] + ')' +
            '<br>' +  data['customerAddress']['country'] +'</p>' );

        // if we're in address edit mode enable save button
        if(address_edit_mode){

            $("#Pablo_address_save_submit").css("display", "block");
        }
    }

    // off zone
    function customer_off_zone(data){



    }


    function customerMarker(coords){

        var icon = new L.DivIcon({ html: marker_icons[1]});

        customer_marker = L.marker(coords,{icon: icon}).addTo(map);
    }

    function serverMarker(coords){

        var icon = new L.DivIcon({ html: '<div class="marker-facility" />'});

        server_marker =  L.marker(coords,{ title:'These are Us', icon:icon}).addTo(map)

    }
    function drawPath(pathCoords){

        customer_polyline = L.polyline(pathCoords, {color: 'green'}).addTo(map);

        map.fitBounds(customer_polyline.getBounds());
    }

    function drawSection(centerCoords,radius,sectionName) {

        customer_section = L.circle(centerCoords, {radius: radius,fill:false,color:'green',dashArray:[10,5]})
            .bindTooltip(sectionName+' Facility',{permanent:true}).openTooltip()
            .addTo(map);
    }

// todo: verify php warings on response
// this is used to avoid PHP warnings on response
    function responseToObject(string) {

        return string.slice((string.search('L@@')+3),string.search('@@H'));
    }

   $("#Pablo_address_edit_submit").click(function(){

        address_edit_mode = true;
        $('html,body').animate({scrollTop: $("#Pablo_address_edit_submit").offset().top},'slow');
        fetch_remote_data($('.form-address-edit').serializeArray());

    });

    $("#Pablo_address_save_submit").click(function() {
        $('button[data-action="save-address"]').click();
    });
});


