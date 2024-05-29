jQuery(document).ready(function($) {
    // Function to fetch and display agent details in the agent info modal
    function fetchAgentDetails(postId, callback) {
        $.ajax({
            url: agent_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'view_agent_details',
                post_id: postId,
                security: agent_ajax_object.nonce
            },
            success: function(response) {
                if (response.success) {
                    callback(response.data);
                } else {
                    alert('Failed to fetch agent details.');
                }
            }
        });
    }

    // Function to update the report buttons visibility based on category
    function updateReportButtonsVisibility(category) {
        if (category === 'Sub Admin') {
            $('.admin-button-box').attr('style', 'display: block !important');
            $('.subadmin-button-box').attr('style', 'display: none !important');
            $('.superadmin-button-box').attr('style', 'display: none !important');
        } else if (category === 'Super') {
            $('.superadmin-button-box').attr('style', 'display: none !important');
            $('.admin-button-box').attr('style', 'display: block !important');
            $('.subadmin-button-box').attr('style', 'display: block !important');
        }  else if (category === 'Master Agent') {
            $('.superadmin-button-box').attr('style', 'display: block !important');
            $('.admin-button-box').attr('style', 'display: block !important');
            $('.subadmin-button-box').attr('style', 'display: block !important');
        }else {
            $('.admin-button-box').attr('style', 'display: none !important');
            $('.subadmin-button-box').attr('style', 'display: none !important');
            $('.superadmin-button-box').attr('style', 'display: none !important');
        }
    }

    // Event handler for viewing agent details
    $('.view-agent').on('click', function() {
        var postId = $(this).data('id');
        fetchAgentDetails(postId, function(agent) {
            $('.detail-name').text(agent.name);
            $('.detail-type').text(agent.category);
            $('.detail-number').text(agent.number);
            $('.detail-id').text(agent.id);
            $('.detail-wa').attr('href', agent.whatsapp_link);
            $('.detail-rating').empty();
            for (var i = 0; i < 5; i++) {
                if (i < agent.rating) {
                    $('.detail-rating').append('<i class="fa-solid fa-star"></i>');
                } else {
                    $('.detail-rating').append('<i class="fa-regular fa-star"></i>');
                }
            }
            $('.detail-admin-id').text(agent.admin_id); // Added
            $('.detail-admin-whatsapp').attr('href', 'https://wa.me/' + agent.admin_whatsapp); // Added
            
            $('.detail-subadmin-id').text(agent.subadmin_id); // Added
            $('.detail-subadmin-whatsapp').attr('href', 'https://wa.me/' + agent.subadmin_whatsapp); // Added
            $('.detail-superadmin-id').text(agent.superadmin_id); // Added
            $('.detail-superadmin-whatsapp').attr('href', 'https://wa.me/' + agent.superadmin_whatsapp); // Added

            // Update report buttons visibility based on category
            updateReportButtonsVisibility(agent.category);

            $('#agentInfo').modal('show');
        });
    });

    // Event handler for reporting agent
    $('.report-agent').on('click', function() {
        var postId = $(this).data('id');
        fetchAgentDetails(postId, function(agent) {
            $('.detail-name').text(agent.name);
            $('.detail-type').text(agent.category);
            $('.detail-number').text(agent.number);
            $('.detail-id').text(agent.id);
            $('.detail-admin-id').text(agent.admin_id); // Added
            $('.detail-admin-whatsapp').attr('href', 'https://wa.me/' + agent.admin_whatsapp); // Added
            $('.detail-subadmin-id').text(agent.subadmin_id); // Added
            $('.detail-subadmin-whatsapp').attr('href', 'https://wa.me/' + agent.subadmin_whatsapp); // Added
            $('.detail-superadmin-id').text(agent.superadmin_id); // Added
            $('.detail-superadmin-whatsapp').attr('href', 'https://wa.me/' + agent.superadmin_whatsapp); // Added

            // Update report buttons visibility based on category
            updateReportButtonsVisibility(agent.category);

            $('#AgentReport').modal('show');
        });
    });

    // Event handler for report to buttons
    $('#ReportTo').on('click', 'a', function(e) {
        e.preventDefault();
        var postId = $('#AgentReport').data('id');
        var reportType = $(this).text().toLowerCase().replace(' ', '_');

        var whatsappNumber;
        if ($(this).hasClass('detail-admin-whatsapp')) {
            whatsappNumber = $('.detail-admin-whatsapp').attr('href').split('/').pop();
        } else if ($(this).hasClass('detail-subadmin-whatsapp')) {
            whatsappNumber = $('.detail-subadmin-whatsapp').attr('href').split('/').pop();
        } else if ($(this).hasClass('detail-superadmin-whatsapp')) {
            whatsappNumber = $('.detail-superadmin-whatsapp').attr('href').split('/').pop();
        }

        var whatsappLink = 'https://wa.me/' + whatsappNumber;
        window.open(whatsappLink, '_blank');

        $.ajax({
            url: agent_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'report_agent',
                post_id: postId,
                report_type: reportType,
                security: agent_ajax_object.nonce
            },
            success: function(response) {
                if (response.success) {
                    alert(response.data.message);
                } else {
                    alert('Failed to report agent.');
                }
                $('#AgentReport').modal('hide');
            }
        });
    });
});
