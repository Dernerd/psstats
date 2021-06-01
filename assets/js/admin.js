jQuery(document).on('click', '#psstats-referral .notice-dismiss', function() {
    var data = { 'action': 'psstats_referral_dismiss_admin_notice' };
    jQuery.post(ajaxurl, data);
});
jQuery(document).on('click', '#psstats-referral .psstats-dismiss-forever', function() {
    var data = { 'action': 'psstats_referral_dismiss_admin_notice', forever: '1' };
    jQuery.post(ajaxurl, data);
});