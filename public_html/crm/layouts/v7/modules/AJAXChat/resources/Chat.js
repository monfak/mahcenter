jQuery.Class("PARSVTIGERCHAT", {

	__init: function(e)	{

	var url ='index.php?module=AJAXChat&view=Index';
	app.request.get({url:url}).then(function (err, data) {
        $(document.body).append(data);

        var headerLinksBig = jQuery('#menubar_quickCreate').closest('li');
                var headerIcon = '<li>' +
                    '<div class="headerLinksAJAXChat" style="margin-top: 10px;" class="">' +
                    '<a href="#" class="ChatIcon" id="header_mail_notification" class="dropdown-toggle" >' +
                    '<span class="fa fa-comments fa-stack" aria-hidden="true"></span>' +
                    '</a>' +
                    '</li>';
                headerLinksBig.before(headerIcon);

                $('.headerLinksAJAXChat .ChatIcon').toggle(function() {
                    $('#AJAXChatBlock').animate({'right':'0px'});
                }, function() {
                    $('#AJAXChatBlock').animate({'right':'-603px'});
                });
	});
	}
});


jQuery(function() {
	var params = {
		'action' : 'Status',
		'module' : 'AJAXChat'
	}
	AppConnector.request(params).then(
		function(data){
			if(data.result.status === 'show') {
           var StartParsChatInstance = new PARSVTIGERCHAT;
           StartParsChatInstance.__init();
		   }
    	}
	);
});