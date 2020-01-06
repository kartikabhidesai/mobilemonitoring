var userDatatables = null;
var affiliateDatatables = null;

var User = function () {

    var handleUserDatatable = function () {
        userDatatables = getDataTable('#user_table', adminurl + 'user/manageUser/', {
            dataTable: {}
        });
    }

    var handleAffiliateDatatable = function () {
        affiliateDatatables = getDataTable('#affiliate_table', adminurl + 'affiliate/manageAffiliate/', {
            dataTable: {}
        });
    }

    var handleAffiliateStaus = function () {
        $('body').on('click', '.affiliateStatus', function () {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = adminurl + 'affiliate/userStatus';
            var data = {id: id, status: status};

            ajaxcall(url, data, function (output) {
                handleAjaxResponse(output);
                $('#affiliate_table').DataTable().ajax.reload(null, false).on('draw.dt', function () {});
                return false;
            });
        });

        $('body').on('click', '.monitoringStatus', function () {
            var id = $(this).attr('data-id');
            var status = $(this).attr('data-status');
            var url = adminurl + 'affiliate/monitoringStatus';
            var data = {id: id, status: status};

            ajaxcall(url, data, function (output) {
                handleAjaxResponse(output);
                $('#affiliate_table').DataTable().ajax.reload(null, false).on('draw.dt', function () {});
                return false;
            });

        });
    }

    var handleUserEdit = function () {

        var form = $('#userEdit');
        var rules = {
            user_limit: {
                required: true,
                number: true,
            }
        };
        var messages = {
            user_limit: {
                required: "Please enter user limits",
                number: "Please enter only number",
            }
        };

        handleFormValidate(form, rules, messages, function () {
            handleAjaxFormSubmit(form);
        });
    }

    return {
        init: function () {
            handleUserDatatable();
        },
        affiliate_init: function () {
            handleAffiliateDatatable();
            handleAffiliateStaus();
        },
        user_edit: function () {
            handleUserEdit();
        }
    }
}();