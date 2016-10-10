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

        swal({
            title: "确定删除？",
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "取消",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "确定",
            closeOnConfirm: false
        }, function () {
            var data = {
                _method: self.data('method')
            };

            $.post(self.data('url'), data, function (obj) {
                if (obj.status) {
                    swal({
                        title: "删除成功!",
                        type: "success",
                        confirmButtonText: "确定"
                    }, function () {
                        window.location.reload(true);
                    });
                } else {
                    swal("删除失败!", obj.msg, "error");
                }
            }, 'json');
        });
    });

    $('#check-all').click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $('#menu-setting-btn').click(function () {
        var self = $(this);
        var roleIds = [];
        $('.role-id:checked').each(function (index, element) {
            roleIds.push($(element).data('id'));
        });

        var data = {
            "role_ids[]": roleIds
        };
        console.log(roleIds, self.data('url'), data);
        $.post(self.data('url'), data, function (obj) {
            // if (obj.status) {
            //     swal({
            //         title: "删除成功!",
            //         type: "success",
            //         confirmButtonText: "确定"
            //     }, function () {
            //         window.location.reload(true);
            //     });
            // } else {
            //     swal("删除失败!", obj.msg, "error");
            // }
        }, 'json');
    });
});
