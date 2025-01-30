Vtiger_Popup_Js("Reports_DashboardReportPopup_Js", {}, {
    registerEventForActionsButtons: function () {
        var b = this;
        var a = this.getPopupPageContainer();
        a.on("click", "button.cancelLink", function (c) {
            b.done();
        });
    }, getCompleteParams: function () {
        var a = this._super();
        a["pinchartview"] = true;
        return a;
    }, getPageRecords: function (c) {
        var b = this;
        var a = jQuery.Deferred();
        this._super(c).then(function (d) {
            b.popupSlimScroll();
            a.resolve(d);
        }, function (e, d) {
            a.reject(e, d);
        });
        return a.promise();
    }, popupSlimScroll: function () {
        var b = this.getPopupPageContainer();
        var a = b.find(".popupEntriesDiv popupEntries");
        app.helper.showBothAxisScroll(a, {
            setHeight: 400,
            live: false,
            alwaysShowScrollbar: 0,
            scrollbarPosition: "outside",
            "autoHideScrollbar": true
        });
        jQuery("#reportpopupPage .totalNumberOfRecords").hide();
    }, registerEventForListViewEntryClick: function () {
        return true;
    }, registerReportSelectButton: function (c) {
        var b = jQuery("#reportpopupPage");
        var a = this;
        var d = a.readSelectedIds();
        b.on("click", ".addReports", function (g) {
            var i = a.getSelectedRecordIds();
            var f = a.readSelectedIds();
            if (i) {
                var h = {
                    "mode": "MasspinChartToDashboard",
                    "action": "ChartActions",
                    "module": "Reports",
                    "recordIds": i,
                    "dashboardId": jQuery(".dashboardTab.active").data("tabid")
                };
                app.helper.showProgress();
                app.request.post({"data": h}).then(function (l, k) {
                    app.helper.hidePopup();
                    if (k["pinned"] == true) {
                        var j = app.vtranslate("JS_CHART_PINNED_TO_DASHBOARD", "Reports");
                        app.helper.showSuccessNotification({message: j});
                        window.location.reload();
                    }
                    app.helper.hideProgress();
                });
            }
        });
    }, registerEvents: function () {
        this._super();
        this.registerEventForActionsButtons();
        this.popupSlimScroll();
        this.registerReportSelectButton();
    }
});
