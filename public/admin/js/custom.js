$(document).ready(function() {

    $(document).on("click",".updateAdminStatus",function() {

        var status = $(this).children("i").attr("status");
        var admin_id = $(this).attr("admin_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },   
            type:'post',
            url:'/admin/updateAdminStatus',
            data:{status:status,admin_id:admin_id},
            success:function(resp) {
                if(resp['status']==0) {
                    $("#admin-"+admin_id).html("<i style='font-size:25px; color:#532e00 !important;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                }else if(resp['status']==1) {
                    $("#admin-"+admin_id).html("<i style='font-size:25px; color:#532e00 !important;' class='mdi mdi-bookmark-check' status='Active'></i>");
                }
            },error:function() {
                alert("Error");
            }
        })
    });

    $(document).on("click",".updateUserStatus",function() {

        var status = $(this).children("i").attr("status");
        var user_id = $(this).attr("user_id");

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },   
            type:'post',
            url:'/admin/updateUserStatus',
            data:{status:status,user_id:user_id},
            success:function(resp) {
                if(resp['status']==0) {
                    $("#user-"+user_id).html("<i style='font-size:25px; color:#532e00 !important;' class='mdi mdi-bookmark-outline' status='Inactive'></i>");
                }else if(resp['status']==1) {
                    $("#user-"+user_id).html("<i style='font-size:25px; color:#532e00 !important;' class='mdi mdi-bookmark-check' status='Active'></i>");
                }
            },error:function() {
                alert("Error");
            }
        })
    });

});
