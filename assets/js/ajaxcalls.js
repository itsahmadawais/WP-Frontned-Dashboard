function ca_save_post_ajax(user_id , post_id) {
    jQuery.ajax({
        url: ca_ajax_url.ajax_url,
        type: 'POST',
        data: {
            action: 'ca_save_post_ajax_action',
            pid: post_id,
            uid: user_id
        },
        success: function (response) {
           if(response)
               location.reload(true);
        }
    });
}
function ca_unsave_post_ajax(user_id , post_id) {
    jQuery.ajax({
        url: ca_ajax_url.ajax_url,
        type: 'POST',
        data: {
            action: 'ca_unsave_post_ajax_action',
            pid: post_id,
            uid: user_id
        },
        success: function (response) {
            if(response)
               location.reload(true);
        }
    });
}
