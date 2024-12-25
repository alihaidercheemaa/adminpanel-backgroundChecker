const Dashboard = function () {
    let start = "";
    let end = "";
    let picker;
    const dashboardreport = (start, end, label) => {
        let title = '';
        let range = '';
        let rangejson = '';
        if (label == 'Today') {
            title = 'Today:';
            range = start.format('MMM DD, YYYY');
            rangejson = start.format('YYYY-MM-DD');
        } else if (label == 'Yesterday') {
            title = 'Yesterday:';
            range = start.format('MMM DD, YYYY');
            rangejson = start.format('YYYY-MM-DD');
        } else {
            range = start.format('MMM DD, YYYY') + ' - ' + end.format('MMM DD, YYYY');
            rangejson = start.format('YYYY-MM-DD') + ' | ' + end.format('YYYY-MM-DD');
        }

        let selectrange = rangejson.split("|");
        if (selectrange.length != 2) {
            selectrange[1] = selectrange[0];
        }

        const data = {
            start_date: selectrange[0],
            end_date: selectrange[1],
            requestType: 'dashboardReport'
        };
        $.post('datafiles/report', data, function (response) {
            let result = JSON.parse(response);
            if (result["status"] !== null && result["status"] == 1) {
                if (isObject(result["payload"])) {
                    if (isObject(result["payload"]["appoinntments"])) {
                        if (result["payload"]["appoinntments"]["total_appointments"] !== null) {
                            $("#total_appointments").empty().text(result["payload"]["appoinntments"]["total_appointments"]);
                        }
                    }

                    if (isObject(result["payload"]["contacts"])) {
                        if (result["payload"]["contacts"]["total_contacts"] !== null) {
                            $("#total_contacts").empty().text(result["payload"]["contacts"]["total_contacts"]);
                        }
                    }
                    if (isObject(result["payload"]["subscribers"])) {
                        if (result["payload"]["subscribers"]["total_subscribers"] !== null) {
                            $("#total_subscribers").empty().text(result["payload"]["subscribers"]["total_subscribers"]);
                        }
                    }
                    if (isObject(result["payload"]["blogs"])) {
                        if (result["payload"]["blogs"]["total_blogs"] !== null) {
                            $("#total_blogs").empty().text(result["payload"]["blogs"]["total_blogs"]);
                        }
                    }
                    if (isObject(result["payload"]["packages"])) {
                        if (result["payload"]["packages"]["total_packages"] !== null) {
                            $("#total_packages").empty().text(result["payload"]["packages"]["total_packages"]);
                        }
                    }
                    if (isObject(result["payload"]["credibility"])) {
                        if (result["payload"]["credibility"]["total_credibility"] !== null) {
                            $("#total_credibility").empty().text(result["payload"]["credibility"]["total_credibility"]);
                        }
                    }

                }
            }
            initCounter();
        });
        picker.find('span.date_range').html(range);
        picker.find('span.date_title').html(title);
    };
    $(document).ready(function () {
        picker = $('#datepicker');
        start = moment().startOf('month');
        end = moment();
        picker.daterangepicker({
            start_date: start,
            end_date: end,
            opens: 'left',
            minDate: moment().subtract(12, 'months'),
            maxDate: moment(),
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Last 3 Months': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Year': [moment().startOf('year'), moment().endOf('year')]
            },
        }, dashboardreport);

    });
    return {
        init: function () {
            dashboardreport(start, end, '');
        }
    };
}();
jQuery(document).ready(function () {
    Dashboard.init();
});
