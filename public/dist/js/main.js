$(function () {
    function setAjaxHeaders() {
        var headers = {};
        headers['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');

        // var authorization = getAuthorizationHeader();
        // if (null !== authorization) {
        //     headers['Authorization'] = authorization;
        // }

        $.ajaxSetup({
            headers: headers
        });
    }

    setAjaxHeaders();

    $('.delete_action').click(function () {
        var self = $(this);

        var data = {
            _method: self.data('method')
        };

        $.post(self.data('url'), data, function (obj) {
            console.log(obj);
        }, 'json');
    });
});
