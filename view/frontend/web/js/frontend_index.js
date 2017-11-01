
/*
 *
 * Copyright (c) 2017. @pablo
 *
 * Test Code
 */

define([
    'uiComponent',
    'jquery',
    'Magento_Ui/js/modal/modal',
    'Magento_Customer/js/customer-data'
], function (Component, $, modal, storage) {
    'use strict';

    var cacheKey = 'modal-overlay';
    var modal_one_view;

    var getData = function () {
        return storage.get(cacheKey)();
    };

    var saveData = function (data) {
        storage.set(cacheKey, data);
    };

    if ($.isEmptyObject(getData())) {
        var modal_overlay = {
            'modal_overlay': false
        };
      saveData(modal_overlay);
    }

    return Component.extend({

        initialize: function () {

            this._super();
            var options = {
                type: 'popup',
                responsive: true,
                innerScroll: false,
                title: false,
                buttons: false
            };

            var modal_overlay_element = $('#modal-overlay');
            var popup = modal(options, modal_overlay_element);
            modal_one_view = $('#Pablo_one_view').html();
            modal_overlay_element.css("display", "block");

            this.openModalOverlayModal();

        },

        openModalOverlayModal:function(){
            var modalContainer = $("#modal-overlay");

            // todo: check if must view all the times

            if(modal_one_view){
                 if(this.getModalOverlay()) {
                    return false;
                }
            }
            this.setModalOverlay(true);

            modalContainer.modal('openModal');
        },

        setModalOverlay: function (data) {
            var obj = getData();
            obj.modal_overlay = data;
            saveData(obj);
        },

        getModalOverlay: function () {
            return getData().modal_overlay;
        }

    });
});
