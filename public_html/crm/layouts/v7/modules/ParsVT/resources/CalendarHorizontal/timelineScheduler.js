var TimeScheduler = {
    Options: {
        /* The function to call to fill up Sections.
         Sections are cached. To clear cache, use TimelineScheduler.FillSections(true);
         Callback accepts an array of sections in the format {
         id: num,
         name: string
         }
         */
        GetSections: function (callback) {
        },

        /* The function to call to fill up Items.
         Callback accepts an array of items in the format
         {
         id: num,
         name: string,
         sectionID: ID of Section,
         start: Moment of the start,
         end: Moment of the end,
         classes: string of classes to add,
         events: [
         {
         label: string to show in tooltip,
         at: Moment of event,
         classes: string of classes to add
         }
         ]
         }
         */
        GetSchedule: function (callback, start, end) {
        },

        /* The Moment to start the calendar at. RECOMMENDED: .startOf('day') */
        Start: moment.utc(),

        /* The Moment format to use when displaying Header information */
        HeaderFormat: 'YYYY-MM-DD',

        /* The Moment format to use when displaying Tooltip information */
        LowerFormat: 'YYYY-MM-DD HH:mm',

        /* An array of Periods to be selectable by the user in the form of {
         Name: unique string name to be used when selecting,
         Label: string to display on the Period Button,
         TimeframePeriod: number of minutes between intervals on the scheduler,
         TimeframeOverall: number of minutes between the Start of the period and the End of the period,
         TimeframeHeaderFormats: Array of formats to use for headers.
         }
         */
        Periods: [{
            Name: '2 days',
            Label: '2 days',
            TimeDuration: 30, //minutes
            StartPeroid: 0,
            TimeframePeriod: 120,
            TimeframeOverall: 2880,
            TimeframeHeaders: ['Do MMM', 'HH']
        }, {
            Name: '2 weeks',
            Label: '2 weeks',
            TimeframePeriod: 1440,
            TimeframeOverall: 20160,
            TimeframeHeaders: ['MMM', 'Do']
        }],

        /* The Name of the period to select */
        SelectedPeriod: '2 weeks',

        /* The Element to put the scheduler on */
        Element: $('<div></div>'),

        /* The minimum height of each section */
        MinRowHeight: 40,

        /* Whether to show the Current Time or not */
        ShowCurrentTime: true,

        /* Whether to show the Goto button */
        ShowGoto: true,

        /* Whether to show the Today button */
        ShowToday: true,

        /* Text to use when creating the scheduler */
        Text: {
            NextButton: 'Next',
            NextButtonTitle: 'Next period',
            PrevButton: 'Prev',
            PrevButtonTitle: 'Previous period',
            NextDayButton: 'Next Day',
            NextDayButtonTitle: 'Next Day',
            PrevDayButton: 'Prev Day',
            PrevDayButtonTitle: 'Previous Day',
            TodayButton: app.vtranslate('Today'),
            TodayButtonTitle: 'Go to today',
            GotoButton: app.vtranslate('Go to'),
            GotoButtonTitle: 'Go to specific date'
        },

        Events: {
            // function (item) { }
            ItemMouseEnter: null,

            // function (item) { }
            ItemMouseLeave: null,

            // function (item) { }
            ItemClicked: null,

            // function (item, sectionID, start, end) { }
            ItemDropped: null,

            // function (item, start, end) { }
            ItemResized: null,

            // function (item, start, end) { }
            // Called when any item move event is triggered (draggable.drag, resizable.resize)
            ItemMovement: null,
            // Called when any item move event starts (draggable.start, resizable.start)
            ItemMovementStart: null,
            // Called when any item move event ends (draggable.end, resizable.end)
            ItemMovementEnd: null,

            // function (eventData, itemData)
            ItemEventClick: null,

            // function (eventData, itemData)
            ItemEventMouseEnter: null,

            // function (eventData, itemData)
            ItemEventMouseLeave: null
        },

        // Should dragging be enabled?
        AllowDragging: false,

        // Should resizing be enabled?
        AllowResizing: false,

        // Disable items on moving?
        DisableOnMove: false,

        // A given max height for the calendar, if unspecified, will expand forever
        MaxHeight: null,

        //show popover
        showPopover: false
    },

    Wrapper: null,
    HeaderWrap: null,

    TableWrap: null,

    HeaderTable: null,

    ContentWrap: null,
    GridTable: null,
    SectionWrap: null,

    Table: null,
    Sections: {},

    CachedSectionResult: null,
    CachedScheduleResult: null,

    /* Initializes the Timeline Scheduler with the given opts. If omitted, defaults are used. */
    /* This should be used to recreate the scheduler with new defaults or refill items */
    Init: function (overrideCache) {
        TimeScheduler.Options.Element.find('.ui-draggable').draggable('destroy');
        TimeScheduler.Options.Element.empty();

        TimeScheduler.Wrapper = $('<div class="time-sch-wrapper"></div>').appendTo(TimeScheduler.Options.Element);
        TimeScheduler.HeaderWrap = $('<div class="time-sch-header-wrapper"></div>').appendTo(TimeScheduler.Wrapper);
        TimeScheduler.TableWrap = $('<div class="time-sch-table-wrapper"></div>').appendTo(TimeScheduler.Wrapper);
        TimeScheduler.SectionWrap = $('<div class="time-sch-section-wrapper"></div>').appendTo(TimeScheduler.TableWrap);

        TimeScheduler.CreateCalendar();
        TimeScheduler.FillSections(overrideCache);
    },

    GetSelectedPeriod: function () {
        var period;

        for (var i = 0; i < TimeScheduler.Options.Periods.length; i++) {
            if (TimeScheduler.Options.Periods[i].Name === TimeScheduler.Options.SelectedPeriod) {
                period = TimeScheduler.Options.Periods[i];
                break;
            }
        }

        if (!period) {
            period = TimeScheduler.Options.Periods[0];
            TimeScheduler.SelectPeriod(period.Name);
        }

        return period;
    },

    GetEndOfPeriod: function (start, period) {
        parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
        var m = moment(start).add('minutes', period.TimeframeOverall,1);
        parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment
        return m;
    },

    CreateCalendar: function () {
        var thead, tbody, tr, td, thisTime, header;
        var minuteDiff, splits, period, end ,timelineMonthNames;
        var prevDate = null,
            colspan = 0;

        period = TimeScheduler.GetSelectedPeriod();
        if (period.Name == '1 month') {
            period.TimeframeOverall = 60 * 24 * (TimeScheduler.Options.Start.daysInMonth());
        }
        var period_header_class = period.Name.replace(' ', '_');
        end = TimeScheduler.GetEndOfPeriod(TimeScheduler.Options.Start, period);

        minuteDiff = Math.abs(TimeScheduler.Options.Start.diff(end, 'minutes'));
        splits = (minuteDiff / period.TimeframePeriod);

        TimeScheduler.Table = $('<table class="time-sch-table"></table>');
        thead = $('<thead></thead>');
        tbody = $('<tbody></tbody>');

        for (var headerCount = 0; headerCount < period.TimeframeHeaders.length; headerCount++) {
            prevDate = null;
            colspan = 0;
            header = period.TimeframeHeaders[headerCount];

            tr = $('<tr class="time-sch-times"></tr>')
                .addClass('time-sch-times-header-' + headerCount + ' time-sch-times-header-' + headerCount + '_' + period_header_class)
                .appendTo(thead);

            if (period.Name == '1 days') {
                td = $('<td class="time-sch-section-header"></td>')
                    .append(thisTime)
                    .appendTo(tr);
            } else {
                td = $('<td class="time-sch-section-header"></td>')
                    .appendTo(tr);
            }

            for (var i = 0; i < splits; i++) {
                //change by Mahdi
                thisTime = moment.utc(TimeScheduler.Options.Start).local()
                    .add('minutes', (i * period.TimeframePeriod),1)
                    .format(header);
                if (prevDate !== thisTime) {
                    // If there is no prevDate, it's the Section Header
                    if (prevDate) {
                        td.attr('colspan', colspan);
                        colspan = 0;
                    }

                    prevDate = thisTime;
                    var entimelineMonthNames =['Jan', 'Feb', 'Mrt', 'Apr', 'Mei', 'Jun', 'Jul', 'Aug', 'Sep', 'Okt', 'Nov', 'Des'];
                    if (typeof parsvtCalendar !== 'undefined' && parsvtCalendar != 'gregorian') {
                        if (parsvt_calendar == 'jalali') {
                             timelineMonthNames = [
                                app.vtranslate('Farvardin'),
                                app.vtranslate('Ordibehesht'),
                                app.vtranslate('Khordad'),
                                app.vtranslate('Tir'),
                                app.vtranslate('Mordad'),
                                app.vtranslate('Shahrivar'),
                                app.vtranslate('Mehr'),
                                app.vtranslate('Aban'),
                                app.vtranslate('Azar'),
                                app.vtranslate('Dey'),
                                app.vtranslate('Bahman'),
                                app.vtranslate('Esfand')
                            ];
                        } else if (parsvt_calendar == 'islamic') {
                             timelineMonthNames = [
                                app.vtranslate('Muharram'),
                                app.vtranslate('Safar'),
                                app.vtranslate('Rabi al-awwal'),
                                app.vtranslate('Rabi al-thani'),
                                app.vtranslate('Jumada al-awwal'),
                                app.vtranslate('Jumada al-thani'),
                                app.vtranslate('Rajab'),
                                app.vtranslate('Shaaban'),
                                app.vtranslate('Ramadan'),
                                app.vtranslate('Shawwal'),
                                app.vtranslate('Dhu al-Qidah'),
                                app.vtranslate('Dhu al-Hijjah')
                            ];
                        }
                        if  (entimelineMonthNames.indexOf(thisTime) !== -1) {
                            if (TimeScheduler.arraySearch(entimelineMonthNames , thisTime)) {
                                thisTime = timelineMonthNames[TimeScheduler.arraySearch(entimelineMonthNames , thisTime)];
                            }
                        }
                    }
                    td = $('<td class="time-sch-date-header"></td>')
                        .append(thisTime)
                        .appendTo(tr);
                }

                colspan += 1;
            }

            td.attr('colspan', colspan);
        }

        TimeScheduler.Table.append(thead, tbody);
        TimeScheduler.TableWrap.append(TimeScheduler.Table);

        TimeScheduler.FillHeader();

        $(document).ready(function () {
            $(".time-sch-table").freezeHeader({'offset': '84px', 'background_color': '#F5F5F5'});
        });
    },
    arraySearch: function(arr,val) {
        for (var i=0; i<arr.length; i++)
            if (arr[i] === val)
                return i;
        return false;
    },

    CreateSections: function (sections) {
        var timeCount, tr, td, sectionContainer, headers;

        timeCount = 1;
        headers = $.makeArray(TimeScheduler.Table.find('thead tr'));

        for (var i = 0; i < headers.length; i++) {
            if (timeCount < $(headers[i]).find('.time-sch-date-header').length) {
                timeCount = $(headers[i]).find('.time-sch-date-header').length;
            }
        }

        for (var i = 0; i < sections.length; i++) {
            tr = $('<tr class="time-sch-section-row"></tr>')
                .css('height', TimeScheduler.Options.MinRowHeight);

            tr.addClass(i % 2 === 0 ? 'time-sch-section-even' : 'time-sch-section-odd');

            td = $('<td class="time-sch-section textOverflowEllipsis"></td>')
                .text(sections[i].name)
                .attr('title', sections[i].name)
                .data('section', sections[i])
                .appendTo(tr);

            for (time = 0; time < timeCount; time++) {
                td = $('<td class="time-sch-date"></td>').appendTo(tr);
            }

            sectionContainer = $('<div class="time-sch-section-container"></div>')
                .css('height', TimeScheduler.Options.MinRowHeight)
                .data('section', sections[i])
                .click(TimeScheduler.Cell_Clicked)
                .appendTo(TimeScheduler.SectionWrap);

            TimeScheduler.Sections[sections[i].id] = {
                row: tr,
                container: sectionContainer
            };

            TimeScheduler.Table.find('tbody').append(tr);
        }

        TimeScheduler.SectionWrap.css({
            top: TimeScheduler.Table.find('thead').height(),
            left: $('.time-sch-section').outerWidth()
        });

        if (TimeScheduler.Options.ShowCurrentTime) {
            TimeScheduler.ShowCurrentTime();
        }
    },

    ShowCurrentTimeHandle: null,
    ShowCurrentTime: function () {
        var currentTime, currentTimeElem, minuteDiff, currentDiff, end;

        // Stop any other timeouts happening
        if (TimeScheduler.ShowCurrentTimeHandle) {
            clearTimeout(TimeScheduler.ShowCurrentTimeHandle);
        }

        var parsvt_right = 0;
        if ((typeof parsvt_interface_language !== "undefined") && (parsvt_interface_language === 'fa' || parsvt_interface_language === 'ar')) {
            parsvt_right = TimeScheduler.GetSelectedPeriod().TimeframePeriod;
        }
        currentTime = moment();
        end = TimeScheduler.GetEndOfPeriod(TimeScheduler.Options.Start, TimeScheduler.GetSelectedPeriod());
        minuteDiff = Math.abs(TimeScheduler.Options.Start.diff(end, 'minutes'));
        currentDiff = Math.abs(TimeScheduler.Options.Start.diff(currentTime, 'minutes')) + parsvt_right;

        currentTimeElem = $('.time-sch-current-time');
        currentTimeElem.remove();

        if (currentTime >= TimeScheduler.Options.Start && currentTime <= end) {
            if ((typeof parsvt_interface_language !== "undefined") && (parsvt_interface_language === 'fa' || parsvt_interface_language === 'ar')) {
                currentTimeElem = $('<div class="time-sch-current-time"></div>')
                    .css('right', ((currentDiff / minuteDiff) * 100) + '%')
                    .attr('title', currentTime.format(TimeScheduler.Options.LowerFormat))
                    .appendTo(TimeScheduler.SectionWrap);
            } else {
                currentTimeElem = $('<div class="time-sch-current-time"></div>')
                    .css('left', ((currentDiff / minuteDiff) * 100) + '%')
                    .attr('title', currentTime.format(TimeScheduler.Options.LowerFormat))
                    .appendTo(TimeScheduler.SectionWrap);
            }
        }

        // Since we're only comparing minutes, we may as well only check once every 30 seconds
        TimeScheduler.ShowCurrentTimeHandle = setTimeout(TimeScheduler.ShowCurrentTime, 30000);
    },

    CreateItems: function (items) {
        var item, event, section, itemElem, eventElem, itemContent, itemName, itemIcon;
        var minuteDiff, splits, itemDiff, itemSelfDiff, eventDiff, calcTop, calcLeft, calcWidth, foundStart, foundEnd;
        var inSection = {}, foundPos, elem, prevElem, needsNewRow;
        var period, end;
        var title_font_size = $('#calendar_horizontal_title_font_size').val();
        var title_font_size_unit = $('#calendar_horizontal_title_font_size_unit').val();

        period = TimeScheduler.GetSelectedPeriod();
        end = TimeScheduler.GetEndOfPeriod(TimeScheduler.Options.Start, period);

        minuteDiff = Math.abs(TimeScheduler.Options.Start.diff(end, 'minutes'));

        for (var i = 0; i < items.length; i++) {
            item = items[i];

            section = TimeScheduler.Sections[item.sectionID];

            if (section) {
                if (!inSection[item.sectionID]) {
                    inSection[item.sectionID] = [];
                }
                var parsvt_start = {}, parsvt_end = {}, parsvt_start_item = {}, parsvt_end_item = {};
                parsvt_start = Object.assign({}, TimeScheduler.Options.Start);
                parsvt_end = Object.assign({}, end);
                parsvt_start_item = Object.assign({}, item.start);
                parsvt_end_item = Object.assign({}, item.end);
                if ((typeof parsvtlocale !== "undefined") && parsvtlocale != 'en') {
                    if (typeof parsvt_start_item._d === 'string' || (parsvt_start_item._d) instanceof String) {
                        parsvt_start_item._d = new Date(parsvt_start_item._d);
                    }
                    if (typeof parsvt_end._d === 'string' || (parsvt_end._d) instanceof String) {
                        parsvt_end._d = new Date(parsvt_end._d);
                    }
                    if (typeof parsvt_end_item._d === 'string' || (parsvt_end_item._d) instanceof String) {
                        parsvt_end_item._d = new Date(parsvt_end_item._d);
                    }
                    if (typeof parsvt_start._d === 'string' || (parsvt_start._d) instanceof String) {
                        parsvt_start._d = new Date(parsvt_start._d);
                    }
                }
                if (parsvt_start_item <= parsvt_end && parsvt_end_item >= parsvt_start) {
                    foundPos = null;
                    if ((typeof parsvtlocale !== "undefined") && parsvtlocale != 'en') {
                        foundStart = ((item.start > TimeScheduler.Options.Start) ? item.start : TimeScheduler.Options.Start);
                        foundEnd = ((item.end < end) ? item.end : end);
                    } else {
                        parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
                        foundStart = moment(Math.max(item.start, TimeScheduler.Options.Start));
                        foundEnd = moment(Math.min(item.end, end));
                        parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment
                    }


                    itemDiff = foundStart.diff(TimeScheduler.Options.Start, 'minutes');

                    itemSelfDiff = Math.abs(foundStart.diff(foundEnd, 'minutes'));

                    calcTop = 1;
                    var parsvt_right = 0;
                    if ((typeof parsvt_interface_language !== "undefined") && (parsvt_interface_language === 'fa' || parsvt_interface_language === 'ar')) {
                        parsvt_right = period.TimeframePeriod;
                    }
                    calcLeft = ((itemDiff + parsvt_right) / (minuteDiff)) * 100;
//                    calcLeft = ((itemDiff / minuteDiff) * 100) - (itemDiff/minuteDiff);
                    calcWidth = (itemSelfDiff / minuteDiff) * 100;
                    itemElem = $('<div class="time-sch-item" style="background-color: ' + item.color + '; color: ' + item.textColor + '"></div>');

                    if ((typeof parsvt_interface_language !== "undefined") && (parsvt_interface_language === 'fa' || parsvt_interface_language === 'ar')) {
                        itemElem.css({
                            top: calcTop,
                            right: calcLeft + '%',
                            width: calcWidth + '%'
                        });
                    } else {
                        itemElem.css({
                            top: calcTop,
                            left: calcLeft + '%',
                            width: calcWidth + '%'
                        });
                    }


                    itemIcon = $('<img alt="Icon" class="time-sch-item-icon" />');
                    itemContent = $('<div class="time-sch-item-content"></div>');

                    if (item.name) {
                        itemName = $('<div class="time-sch-item-name"></div>');
                        if (title_font_size != '') {
                            var font_size_unit = 'px';
                            if (title_font_size_unit == 'percent') {
                                font_size_unit = '%';
                            }
                            itemName.css({
                                'font-size': title_font_size + font_size_unit,
                            });
                        }
                        itemName.html(item.name);
                        itemContent.append(itemName);
                    }

                    if (item.icon) {
                        itemIcon.attr({
                            src: item.icon
                        });
                        itemElem.append(itemIcon);
                    }

                    itemElem.append(itemContent);

                    if (item.classes) {
                        itemElem.addClass(item.classes);
                    }

                    if (item.events) {
                        for (var ev = 0; ev < item.events.length; ev++) {
                            event = item.events[ev];

                            eventDiff = (event.at.diff(foundStart, 'minutes') / itemSelfDiff) * 100;

                            eventElem = $('<div class="time-sch-item-event"></div>')
                                .attr('title', event.at.format(TimeScheduler.Options.LowerFormat) + ' - ' + event.label)
                                .css('left', eventDiff + '%')
                                .data('event', event);

                            if (event.classes) {
                                eventElem.addClass(event.classes);
                            }

                            itemElem.append(eventElem);
                        }
                    }
                    if ((typeof parsvt_interface_language !== "undefined") && (parsvt_interface_language === 'fa' || parsvt_interface_language === 'ar')) {

                        if (item.start >= TimeScheduler.Options.Start) {
                            itemElem.append('<div class="time-sch-item-start" style="right: 1px;width: 1px;"></div>');
                        }
                        if (item.end <= end) {
                            itemElem.append('<div class="time-sch-item-end"  style="left: 1px;width: 1px;"></div>');
                        }
                    } else {

                        if (item.start >= TimeScheduler.Options.Start) {
                            itemElem.append('<div class="time-sch-item-start"></div>');
                        }
                        if (item.end <= end) {
                            itemElem.append('<div class="time-sch-item-end"></div>');
                        }
                    }

                    item.Element = itemElem;

                    // Place this in the current section array in its sorted position
                    for (var pos = 0; pos < inSection[item.sectionID].length; pos++) {
                        if (inSection[item.sectionID][pos].start > item.start) {
                            foundPos = pos;
                            break;
                        }
                    }

                    if (foundPos === null) {
                        foundPos = inSection[item.sectionID].length;
                    }

                    inSection[item.sectionID].splice(foundPos, 0, item);

                    itemElem.data('item', item);

                    TimeScheduler.SetupItemEvents(itemElem);

                    section.container.append(itemElem);
                }
            }
        }

        // Sort out layout issues so no elements overlap
        for (var prop in inSection) {
            section = TimeScheduler.Sections[prop];

            for (var i = 0; i < inSection[prop].length; i++) {
                elem = inSection[prop][i];

                // If we're passed the first item in the row
                for (var prev = 0; prev < i; prev++) {
                    prevElem = inSection[prop][prev];

                    var elemTop, elemBottom;
                    var prevElemTop, prevElemBottom;

                    prevElemTop = prevElem.Element.position().top;
                    prevElemBottom = prevElemTop + prevElem.Element.outerHeight();

                    elemTop = elem.Element.position().top;
                    elemBottom = elemTop + elem.Element.outerHeight();

                    // (elem.start must be between prevElem.start and prevElem.end OR
                    //  elem.end must be between prevElem.start and prevElem.end) AND
                    // (elem.top must be between prevElem.top and prevElem.bottom OR
                    //  elem.bottom must be between prevElem.top and prevElem.bottom)
                    needsNewRow = (
                        (prevElem.start <= elem.start && elem.start < prevElem.end) || (prevElem.start <= elem.end && elem.end <= prevElem.end)) && (
                        (prevElemTop <= elemTop && elemTop <= prevElemBottom) || (prevElemTop <= elemBottom && elemBottom <= prevElemBottom));

                    if (needsNewRow) {
                        elem.Element.css('top', prevElemBottom + 1);
                    }
                }

                elemBottom = elem.Element.position().top + elem.Element.outerHeight() + 1;

                if (elemBottom > section.container.height()) {
                    section.container.css('height', elemBottom);
                    section.row.css('height', elemBottom);
                }
            }
        }
    },

    registerPopoverEvent: function (event, element) {
        var vtCalendarInstance = Calendar_Calendar_Js.getInstance();
        var dateFormat = vtCalendarInstance.getUserPrefered('date_format');
        dateFormat = dateFormat.toUpperCase();
        var hourFormat = vtCalendarInstance.getUserPrefered('time_format');
        var timeFormat = 'HH:mm';
        if (hourFormat === '12') {
            timeFormat = 'hh:mm a';
        }

        var itemId = event.id;
        var itemIdArr = itemId.split('_');
        var generatePopoverContentHTML = function (eventObj) {
            var timeString = '';
            if (eventObj.activitytype === 'Task') {
                parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
                timeString = moment(eventObj.start._i, eventObj.start._f).format(timeFormat);
                parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment
            } else if (eventObj.module === "Events") {
                if (eventObj.start && typeof eventObj.start != 'undefined') {
                    timeString = eventObj.start.format(timeFormat);
                }
                if (eventObj.end && typeof eventObj.end != 'undefined') {
                    timeString += ' - ' + eventObj.end.format(timeFormat);
                }
            } else {
                timeString = eventObj.start.format(dateFormat);
            }
            var sourceModule = eventObj.module;
            if (!sourceModule) {
                sourceModule = 'Calendar';
            }
            var popOverHTML = '';
            popOverHTML += '<span>' + timeString + '</span>';

            if (sourceModule === 'Calendar' || sourceModule == 'Events') {
                popOverHTML += '' +
                    '<span class="pull-right cursorPointer" ' +
                    'onClick="CalendarHorizontal.deleteCalendarEvent(\'' + itemIdArr[1] + '\',\'' + sourceModule + '\');" title="' + app.vtranslate('JS_DELETE') + '">' +
                    '&nbsp;&nbsp;<i class="fa fa-trash"></i>' +
                    '</span> &nbsp;&nbsp;';

                if (sourceModule === 'Events') {
                    popOverHTML += '' +
                        '<span class="pull-right cursorPointer" ' +
                        'onClick="CalendarHorizontal.editCalendarEvent(' + itemIdArr[1] + ');" title="' + app.vtranslate('JS_EDIT') + '">' +
                        '&nbsp;&nbsp;<i class="fa fa-pencil"></i>' +
                        '</span>';
                } else if (sourceModule === 'Calendar') {
                    popOverHTML += '' +
                        '<span class="pull-right cursorPointer" ' +
                        'onClick="CalendarHorizontal.editCalendarEvent(' + itemIdArr[1] + ');" title="' + app.vtranslate('JS_EDIT') + '">' +
                        '&nbsp;&nbsp;<i class="fa fa-pencil"></i>' +
                        '</span>';
                }

                if (eventObj.status !== 'Held' && eventObj.status !== 'Completed') {
                    popOverHTML += '' +
                        '<span class="pull-right cursorPointer"' +
                        'onClick="CalendarHorizontal.markAsHeld(\'' + itemIdArr[1] + '\');" title="' + app.vtranslate('JS_MARK_AS_HELD') + '">' +
                        '<i class="fa fa-check"></i>' +
                        '</span>';
                } else if (eventObj.status === 'Held') {
                    popOverHTML += '' +
                        '<span class="pull-right cursorPointer" ' +
                        'onClick="CalendarHorizontal.holdFollowUp(\'' + itemIdArr[1] + '\');" title="' + app.vtranslate('JS_CREATE_FOLLOW_UP') + '">' +
                        '<i class="fa fa-flag"></i>' +
                        '</span>';
                }
            }
            return popOverHTML;
        };

        var content = $(element).find('.time-sch-item-name');
        var popoverHtml = '';
        var popoverTitle = '';
        if (content.find('.fc-horizontal-time').length) {
            popoverHtml += generatePopoverContentHTML(event);
            popoverTitle = event.title;
        } else {
            popoverHtml += $(element).find('.time-sch-item-name').html() + '<hr />' + generatePopoverContentHTML(event);
            popoverTitle = event.title;
        }
        var params = {
            //'title': $(element).find('.time-sch-item-name').html(),
            'title': popoverTitle,
            'content': popoverHtml,
            'trigger': 'hover',
            'closeable': true,
            'placement': 'top',
            'animation': 'fade'
        };

        element.webuiPopover(params);
    },

    SetupItemEvents: function (itemElem) {
        var itemData = itemElem.data('item');
        var periodSelected = TimeScheduler.GetSelectedPeriod();
        var widthSectionWrapper = TimeScheduler.SectionWrap.width();
        var grid_x = (widthSectionWrapper * periodSelected.TimeDuration) / periodSelected.TimeframeOverall;
        var grid_y = $('.time-sch-section-container').height();

        if (TimeScheduler.Options.showPopover) {
            TimeScheduler.registerPopoverEvent(itemData, itemElem);
        }

        if (TimeScheduler.Options.Events.ItemClicked) {
            itemElem.find('.time-sch-item-content').click(function (event) {
                event.preventDefault();
                var target = $(event.target);
                if (!target.is('a')) {
                    TimeScheduler.Options.Events.ItemClicked.call(this, itemElem.data('item'));
                } else {
                    window.open(target.attr('href'), '_blank');
                }
                event.stopPropagation();
            });
        }

        if (TimeScheduler.Options.Events.ItemMouseEnter) {
            itemElem.mouseenter(function (event) {
                TimeScheduler.Options.Events.ItemMouseEnter.call(this, $(this).data('item'));
            });
        }

        if (TimeScheduler.Options.Events.ItemMouseLeave) {
            itemElem.mouseleave(function (event) {
                TimeScheduler.Options.Events.ItemMouseLeave.call(this, $(this).data('item'));
            });
        }

        if (0 && TimeScheduler.Options.AllowDragging && (itemData.module == 'Events' || itemData.module == 'Calendar')) {

            itemElem.draggable({
                helper: 'clone',
                zIndex: 1,
                appendTo: '.time-sch-section-wrapper',
                distance: 5,
                snap: '.time-sch-section-container',
                snapMode: 'inner',
                snapTolerance: 10,
                grid: [grid_x, grid_y],
                drag: function (event, ui) {
                    var item, start, end;
                    var period, periodEnd, minuteDiff;

                    if (TimeScheduler.Options.Events.ItemMovement) {
                        period = TimeScheduler.GetSelectedPeriod();
                        periodEnd = TimeScheduler.GetEndOfPeriod(TimeScheduler.Options.Start, period);
                        minuteDiff = Math.abs(TimeScheduler.Options.Start.diff(periodEnd, 'minutes'));

                        item = $(event.target).data('item');
                        parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
                        start = moment(TimeScheduler.Options.Start).add('minutes', minuteDiff * (ui.helper.position().left / TimeScheduler.SectionWrap.width()),1);
                        end = moment(start).add('minutes', Math.abs(item.start.diff(item.end, 'minutes')),1);
                        parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment
                        // If the start is before the start of our calendar, add the offset
                        if (item.start < TimeScheduler.Options.Start) {
                            start.add('minutes', item.start.diff(TimeScheduler.Options.Start, 'minutes'),1);
                            end.add('minutes', item.start.diff(TimeScheduler.Options.Start, 'minutes'),1);
                        }

                        TimeScheduler.Options.Events.ItemMovement.call($('.ui-draggable-dragging'), item, start, end);
                    }
                },
                start: function (event, ui) {
                    $(this).hide();

                    // We only want content to show, not events or resizers
                    ui.helper.children().not('.time-sch-item-content').remove();
                    if (TimeScheduler.Options.Events.ItemMovementStart) {
                        TimeScheduler.Options.Events.ItemMovementStart.call(this);
                    }
                },
                stop: function (event, ui) {
                    if ($(this).length) {
                        $(this).show();
                    }

                    if (TimeScheduler.Options.Events.ItemMovementEnd) {
                        TimeScheduler.Options.Events.ItemMovementEnd.call(this);
                    }
                },
                cancel: '.time-sch-item-end, .time-sch-item-start, .time-sch-item-event'
            });

            $('.time-sch-section-container').droppable({
                greedy: true,
                hoverClass: 'time-sch-droppable-hover',
                tolerance: 'pointer',
                drop: function (event, ui) {
                    var item, sectionID, start, end;
                    var period, periodEnd, minuteDiff;

                    period = TimeScheduler.GetSelectedPeriod();
                    periodEnd = TimeScheduler.GetEndOfPeriod(TimeScheduler.Options.Start, period);
                    minuteDiff = Math.abs(TimeScheduler.Options.Start.diff(periodEnd, 'minutes'));

                    item = ui.draggable.data('item');
                    sectionID = $(this).data('section').id;

                    parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
                    start = moment(TimeScheduler.Options.Start).add('minutes', minuteDiff * (ui.helper.position().left / $(this).width()),1);
                    start = TimeScheduler.roundTimeWithDuration(start);
                    end = moment(start).add('minutes', Math.abs(item.start.diff(item.end, 'minutes')),1);
                    parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment

                    // If the start is before the start of our calendar, add the offset
                    if (item.start < TimeScheduler.Options.Start) {
                        start.add('minutes', item.start.diff(TimeScheduler.Options.Start, 'minutes'),1);
                        end.add('minutes', item.start.diff(TimeScheduler.Options.Start, 'minutes'),1);
                    }

                    // Append original to this section and reposition it while we wait
                    ui.draggable.appendTo($(this));
                    ui.draggable.css({
                        left: ui.helper.position().left - $(this).position().left,
                        top: ui.helper.position().top - $(this).position().top
                    });

                    if (TimeScheduler.Options.DisableOnMove) {
                        ui.draggable.draggable('disable').resizable('disable');
                    }
                    ui.draggable.show();

                    if (TimeScheduler.Options.Events.ItemDropped) {
                        // Time for a hack, JQueryUI throws an error if the draggable is removed in a drop
                        setTimeout(function () {
                            TimeScheduler.Options.Events.ItemDropped.call(this, item, sectionID, start, end);
                        }, 0);
                    }
                }
            });
        }

        if (0 && TimeScheduler.Options.AllowResizing && (itemData.module == 'Events' || itemData.module == 'Calendar')) {
            var foundHandles = null;

            if (itemElem.find('.time-sch-item-start').length && itemElem.find('.time-sch-item-end').length) {
                foundHandles = 'e, w';
            } else if (itemElem.find('.time-sch-item-start').length) {
                foundHandles = 'w';
            } else if (itemElem.find('.time-sch-item-end').length) {
                foundHandles = 'e';
            }

            if (foundHandles) {
                itemElem.resizable({
                    handles: foundHandles,
                    grid: [grid_x, null],
                    resize: function (event, ui) {
                        var item, start, end;
                        var period, periodEnd, minuteDiff;

                        if (TimeScheduler.Options.Events.ItemMovement) {
                            period = TimeScheduler.GetSelectedPeriod();
                            periodEnd = TimeScheduler.GetEndOfPeriod(TimeScheduler.Options.Start, period);
                            minuteDiff = Math.abs(TimeScheduler.Options.Start.diff(periodEnd, 'minutes'));

                            item = $(this).data('item');
                            parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
                            if (ui.position.left !== ui.originalPosition.left) {
                                // Left handle moved

                                start = moment(TimeScheduler.Options.Start).add('minutes', minuteDiff * (($(this).position().left) / TimeScheduler.SectionWrap.width()),1);
                                //start = TimeScheduler.roundTimeWithDuration(start);
                                end = item.end;
                            } else {
                                // Right handle moved

                                start = item.start;
                                end = moment(TimeScheduler.Options.Start).add('minutes', minuteDiff * (($(this).position().left + $(this).width()) / TimeScheduler.SectionWrap.width()),1);
                                //end = TimeScheduler.roundTimeWithDuration(end);
                            }
                            parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment

                            TimeScheduler.Options.Events.ItemMovement.call(this, item, start, end);
                        }
                    },
                    start: function (event, ui) {
                        // We don't want any events to show
                        $(this).find('.time-sch-item-event').hide();

                        if (TimeScheduler.Options.Events.ItemMovementStart) {
                            TimeScheduler.Options.Events.ItemMovementStart.call(this);
                        }
                    },
                    stop: function (event, ui) {
                        var item, start, end;
                        var period, periodEnd, minuteDiff, section;

                        period = TimeScheduler.GetSelectedPeriod();
                        periodEnd = TimeScheduler.GetEndOfPeriod(TimeScheduler.Options.Start, period);
                        minuteDiff = Math.abs(TimeScheduler.Options.Start.diff(periodEnd, 'minutes'));

                        item = $(this).data('item');

                        parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
                        if (ui.position.left !== ui.originalPosition.left) {
                            // Left handle moved

                            start = moment(TimeScheduler.Options.Start).add('minutes', minuteDiff * ($(this).position().left / TimeScheduler.SectionWrap.width()),1);
                            start = TimeScheduler.roundTimeWithDuration(start);
                            end = item.end;
                        } else {
                            // Right handle moved

                            start = item.start;
                            end = moment(TimeScheduler.Options.Start).add('minutes', minuteDiff * (($(this).position().left + $(this).width()) / TimeScheduler.SectionWrap.width()),1);
                            end = TimeScheduler.roundTimeWithDuration(end);
                        }
                        parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment

                        if (TimeScheduler.Options.DisableOnMove) {
                            $(this)
                                .resizable('disable')
                                .draggable('disable')
                                .find('.time-sch-item-event').show();
                        }

                        if (TimeScheduler.Options.Events.ItemMovementEnd) {
                            TimeScheduler.Options.Events.ItemMovementEnd.call(this);
                        }

                        if (TimeScheduler.Options.Events.ItemResized) {
                            TimeScheduler.Options.Events.ItemResized.call(this, item, start, end);
                        }
                    }
                });
            }
        }

        if (TimeScheduler.Options.Events.ItemEventClick) {
            itemElem.find('.time-sch-item-event').click(function (event) {
                event.preventDefault();

                var itemElem = $(this).closest('.time-sch-item');

                event.preventDefault();
                TimeScheduler.Options.Events.ItemEventClick.call(this, $(this).data('event'), itemElem.data('item'));
            });
        }
        if (TimeScheduler.Options.Events.ItemEventMouseEnter) {
            itemElem.find('.time-sch-item-event').mouseenter(function (event) {
                var itemElem = $(this).closest('.time-sch-item');

                event.preventDefault();
                TimeScheduler.Options.Events.ItemEventMouseEnter.call(this, $(this).data('event'), itemElem.data('item'));
            });
        }
        if (TimeScheduler.Options.Events.ItemEventMouseLeave) {
            itemElem.find('.time-sch-item-event').mouseleave(function (event) {
                var itemElem = $(this).closest('.time-sch-item');

                event.preventDefault();
                TimeScheduler.Options.Events.ItemEventMouseLeave.call(this, $(this).data('event'), itemElem.data('item'));
            });
        }
    },

    roundTimeWithDuration: function (timeObj) {
        var period = TimeScheduler.GetSelectedPeriod();
        var duration = period.TimeDuration;
        var TimeframePeriod = period.TimeframePeriod;
        var parts = TimeframePeriod / duration;
        var time_minutes = timeObj.format('mm');
        var current_time_minutes = time_minutes;
        if (time_minutes % duration != 0) {
            if (time_minutes >= duration) {
                for (var i = 1; i <= parts; i++) {
                    if (time_minutes < duration * i) {
                        time_minutes = TimeScheduler.roundCustom(time_minutes, duration * (i - 1), duration * i);
                        break;
                    }
                }
            } else {
                time_minutes = TimeScheduler.roundCustom(time_minutes, 0, duration);
            }

            timeObj = timeObj.add('minutes', time_minutes).subtract('minute', current_time_minutes, 1);
            return timeObj;
        } else {
            return timeObj;
        }


    },

    roundCustom: function (number, min, max) {
        var half = (min + max) / 2;
        if (number <= half) {
            number = min
        } else {
            number = max;
        }

        return number;
    },

    /* Call this with "true" as override, and sections will be reloaded. Otherwise, cached sections will be used */
    FillSections: function (override) {
        if (!TimeScheduler.CachedSectionResult || override) {
            TimeScheduler.Options.GetSections.call(this, TimeScheduler.FillSections_Callback);
        } else {
            TimeScheduler.FillSections_Callback(TimeScheduler.CachedSectionResult);
        }
    },

    FillSections_Callback: function (obj) {
        TimeScheduler.CachedSectionResult = obj;

        TimeScheduler.CreateSections(obj);
        TimeScheduler.FillSchedule();
    },

    FillSchedule: function () {
        var period, end;

        period = TimeScheduler.GetSelectedPeriod();
        end = TimeScheduler.GetEndOfPeriod(TimeScheduler.Options.Start, period);

        TimeScheduler.Options.GetSchedule.call(this, TimeScheduler.FillSchedule_Callback, TimeScheduler.Options.Start, end);
    },

    FillSchedule_Callback: function (obj) {
        TimeScheduler.CachedScheduleResult = obj;
        TimeScheduler.CreateItems(obj);
    },

    FillHeader: function () {
        var durationString, title, periodContainer, timeContainer, periodButton, timeButton;
        var selectedPeriod, end, period;

        periodContainer = $('<div class="time-sch-period-container"></div>');
        timeContainer = $('<div class="time-sch-time-container"></div>');
        title = $('<div class="time-sch-title"></div>');

        /*if($('.time-sch-period-container-top').length > 0){
            $('.time-sch-period-container-top').append(periodContainer);
            TimeScheduler.HeaderWrap.empty().append(timeContainer, title);
        }else{
            TimeScheduler.HeaderWrap.empty().append(periodContainer, timeContainer, title);
        }*/

        selectedPeriod = TimeScheduler.GetSelectedPeriod();
        end = TimeScheduler.GetEndOfPeriod(TimeScheduler.Options.Start, selectedPeriod);

        // Header needs a title
        title.text(TimeScheduler.Options.Start.format(TimeScheduler.Options.HeaderFormat) + ' - ' + end.format(TimeScheduler.Options.HeaderFormat));

        for (var i = 0; i < TimeScheduler.Options.Periods.length; i++) {
            period = TimeScheduler.Options.Periods[i];
            if (period.Label != 'Custom') {
                periodButton = $('<a class="time-sch-period-button time-sch-button" href="#"></a>')
                    .text(app.vtranslate(period.Label))
                    .addClass(period.Name === selectedPeriod.Name ? 'time-sch-selected-button' : '')
                    .data('period', period)
                    .click(TimeScheduler.Period_Clicked)
                    .appendTo(periodContainer);
            } else {
                //add custom period button
                if (period.Name === selectedPeriod.Name) {
                    periodButton = $('<a class="time-sch-period-button time-sch-button dateRange dateField" data-calendar-type="range" data-filtermode="range" value="" href="#"><i class="fa fa-calendar"></i></a><button type="button" class="time-sch-period-button time-sch-button rangeDisplay"><span class="selectedRange" data="' + period.DateRangeValue + '">' + period.DateRange + '</span></button>')
                        .addClass('time-sch-selected-button')
                        .data('period', period)
                        .appendTo(periodContainer);
                    TimeScheduler.registerCustomDateFilter(periodContainer);
                } else {
                    periodButton = $('<a class="time-sch-period-button time-sch-button dateRange dateField" data-calendar-type="range" data-filtermode="range" value="" href="#"><i class="fa fa-calendar"></i></a><button type="button" class="time-sch-period-button time-sch-button hide rangeDisplay"><span class="selectedRange"></span></button>')
                        .addClass('')
                        .data('period', period)
                        .appendTo(periodContainer);
                    TimeScheduler.registerCustomDateFilter(periodContainer);
                }
            }
        }

        if (TimeScheduler.Options.ShowGoto) {
            timeButton = $('<a class="time-sch-time-button time-sch-time-button-goto time-sch-button" href="#"></a>')
                .append(TimeScheduler.Options.Text.GotoButton)
                .addClass(selectedPeriod.Name == '1 days' ? '' : 'hide')
                .attr('title', TimeScheduler.Options.Text.GotoButtonTitle)
                .click(TimeScheduler.GotoTimeShift_Clicked)
                .appendTo(timeContainer);
        }

        if (TimeScheduler.Options.ShowToday) {
            timeButton = $('<a class="time-sch-time-button time-sch-time-button-today time-sch-button" href="#"></a>')
                .append(TimeScheduler.Options.Text.TodayButton)
                .addClass(selectedPeriod.Name == '1 days' ? '' : 'hide')
                .attr('title', TimeScheduler.Options.Text.TodayButtonTitle)
                .click(TimeScheduler.TimeShift_Clicked)
                .appendTo(timeContainer);
        }

        timeButton = $('<a class="time-sch-time-button time-sch-time-button-prev time-sch-button" href="#"></a>')
            .append(TimeScheduler.Options.Text.PrevButton)
            .addClass(selectedPeriod.Name == 'Custom' ? 'hide' : '')
            .attr('title', TimeScheduler.Options.Text.PrevButtonTitle)
            .click(TimeScheduler.TimeShift_Clicked)
            .appendTo(timeContainer);

        timeButton = $('<a class="time-sch-time-button time-sch-time-button-prev-day time-sch-button" href="#"></a>')
            .append(TimeScheduler.Options.Text.PrevDayButton)
            .addClass(selectedPeriod.Name == 'Custom' ? 'hide' : '')
            .attr('title', TimeScheduler.Options.Text.PrevDayButtonTitle)
            .click(TimeScheduler.TimeShift_Clicked)
            .appendTo(timeContainer);

        timeButton = $('<a class="time-sch-time-button time-sch-time-button-next-day time-sch-button" href="#"></a>')
            .append(TimeScheduler.Options.Text.NextDayButton)
            .addClass(selectedPeriod.Name == 'Custom' ? 'hide' : '')
            .attr('title', TimeScheduler.Options.Text.NextDayButtonTitle)
            .click(TimeScheduler.TimeShift_Clicked)
            .appendTo(timeContainer);

        timeButton = $('<a class="time-sch-time-button time-sch-time-button-next time-sch-button" href="#"></a>')
            .append(TimeScheduler.Options.Text.NextButton)
            .addClass(selectedPeriod.Name == 'Custom' ? 'hide' : '')
            .attr('title', TimeScheduler.Options.Text.NextButtonTitle)
            .click(TimeScheduler.TimeShift_Clicked)
            .appendTo(timeContainer);

        //TimeScheduler.HeaderWrap.append(periodContainer, timeContainer, title);
        if ($('.time-sch-period-container-top').length > 0) {
            $('.time-sch-period-container-top').empty().append(periodContainer);
            TimeScheduler.HeaderWrap.append(timeContainer, title);
        } else {
            TimeScheduler.HeaderWrap.append(periodContainer, timeContainer, title);
        }
        timeContainer.css('direction','ltr');
    },

    GotoTimeShift_Clicked: function (event) {
        event.preventDefault();
        var period;
        period = TimeScheduler.GetSelectedPeriod();
        var currentTimeStamp = new Date().getTime();
        var dt = $('<input type="text" id="go_to_date_' + currentTimeStamp + '" />')
            .css({
                position: 'absolute',
                left: 0,
                bottom: 0
            })
            .appendTo($(this))
            .datepicker({
                'autoclose': true,
                onClose: function () {
                    $(this).remove();
                },
                onSelect: function (date) {
                    var d = date;
                    //change by mahdi for select day
                    if ((typeof parsvt_interface_language !== "undefined") && (parsvt_interface_language === 'fa' || parsvt_interface_language === 'ar')) {
                        var month =d.getMonth()+1;
                        month = (month<10)?('0'+month):month;
                        var day = d.getDate();
                        day =(day<10)?('0'+day):day;
                        d =d.getFullYear()+'-'+month+'-'+day;
                    }

                    parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
                    TimeScheduler.Options.Start = moment(d).add('minutes', period.StartPeroid * 60,1);
                    TimeScheduler.Init();

                    parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment
                },
                defaultDate: TimeScheduler.Options.Start.format('YYYY-MM-DD')
            }).on('changeDate', function (e) {
                var d = e.date;
                //change by mahdi for select day
                if ((typeof parsvt_interface_language !== "undefined") && (parsvt_interface_language === 'fa' || parsvt_interface_language === 'ar')) {
                    var month =d.getMonth()+1;
                    month = (month<10)?('0'+month):month;
                    var day = d.getDate();
                    day =(day<10)?('0'+day):day;
                    d =d.getFullYear()+'-'+month+'-'+day;
                }

                parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
                TimeScheduler.Options.Start = moment(d).add('minutes', period.StartPeroid * 60,1);
                TimeScheduler.Init();

                parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment
            });
        dt.datepicker('show');
        dt.hide();
    },
    TimeShift_Clicked: function (event) {
        var period;

        event.preventDefault();
        period = TimeScheduler.GetSelectedPeriod();
        var current_start = TimeScheduler.Options.Start;
        if ($(this).is('.time-sch-time-button-today')) {
            TimeScheduler.Options.Start = moment().startOf('day', 1).add('minutes', period.StartPeroid * 60,1);
        } else if ($(this).is('.time-sch-time-button-prev-day')) {
            if (period.Name == '1 week') {
                //TimeScheduler.Options.Start = current_start.startOf('week');
                TimeScheduler.Options.Start.subtract('days', 1, 1).add('Milliseconds', 1,1);
            } else if (period.Name == '1 month') {
                //TimeScheduler.Options.Start = current_start.startOf('month');
                TimeScheduler.Options.Start.subtract('days', 1, 1).add('Milliseconds', 1,1);
            } else if (period.Name == '1 days') {
                TimeScheduler.Options.Start.subtract('days', 1, 1);
                TimeScheduler.Options.Start.startOf('day', 1).add('minutes', period.StartPeroid * 60,1);
            }
        } else if ($(this).is('.time-sch-time-button-next-day')) {
            if (period.Name == '1 week') {
                //TimeScheduler.Options.Start = current_start.startOf('week');
                TimeScheduler.Options.Start.add('days', 1,1).add('Milliseconds', 1,1);
            } else if (period.Name == '1 month') {
                //TimeScheduler.Options.Start = current_start.startOf('month');
                TimeScheduler.Options.Start.add('days', 1,1).add('Milliseconds', 1,1);
            } else if (period.Name == '1 days') {
                TimeScheduler.Options.Start.add('days', 1,1);
                TimeScheduler.Options.Start.startOf('day', 1).add('minutes', period.StartPeroid * 60,1);
            }
        } else if ($(this).is('.time-sch-time-button-prev')) {
            if (period.Name == '1 week') {
                if ((typeof parsvtlocale !== "undefined") && parsvtlocale != 'en') {
                    current_start.add('days', 1, 1).add('Milliseconds', 1,1);
                }
                TimeScheduler.Options.Start = current_start.startOf('week', 1).add('Milliseconds', 1,1);
                TimeScheduler.Options.Start.subtract('weeks', 1, 1);
                if ((typeof parsvtlocale !== "undefined") && parsvtlocale != 'en') {
                    TimeScheduler.Options.Start.subtract('days', 1, 1).add('Milliseconds', 1,1);
                }
            } else if (period.Name == '1 month') {
                TimeScheduler.Options.Start = current_start.startOf('month', 1).add('Milliseconds', 1,1);
                TimeScheduler.Options.Start.subtract('months', 1, 1).add('Milliseconds', 1,1);
            } else if (period.Name == '1 days') {
                TimeScheduler.Options.Start.subtract('days', 1, 1);
                TimeScheduler.Options.Start.startOf('day', 1).add('minutes', period.StartPeroid * 60,1,1);
            }
        } else if ($(this).is('.time-sch-time-button-next')) {

            if (period.Name == '1 week') {
                if ((typeof parsvtlocale !== "undefined") && parsvtlocale != 'en') {
                    current_start.add('days', 1, 1).add('Milliseconds', 1,1);
                }
                TimeScheduler.Options.Start = current_start.startOf('week', 1).add('Milliseconds', 1,1);
                TimeScheduler.Options.Start.add('weeks', 1 ,1);
                if ((typeof parsvtlocale !== "undefined") && parsvtlocale != 'en') {
                    TimeScheduler.Options.Start.subtract('days', 1, 1).add('Milliseconds', 1,1);
                }
            } else if (period.Name == '1 month') {
                TimeScheduler.Options.Start = current_start.startOf('month', 1).add('Milliseconds', 1,1);
                TimeScheduler.Options.Start.add('months', 1,1).add('Milliseconds', 1,1);
            } else if (period.Name == '1 days') {
                TimeScheduler.Options.Start.add('days', 1,1);
                TimeScheduler.Options.Start.startOf('day', 1).add('minutes', period.StartPeroid * 60,1);
            }
        }

        TimeScheduler.Init();
    },

    Cell_Clicked: function (e) {
        var $this = $(this); // or use $(e.target) in some cases;
        var periodSelected = TimeScheduler.GetSelectedPeriod();
        var grid_x = periodSelected.TimeframeOverall / periodSelected.TimeframePeriod;
        var offset = $this.offset();
        var width = $this.width();
        var posX = offset.left;
        var x = e.pageX - posX;
        x = x / width * 100;
        x = x < 0 ? 0 : x;
        x = x > 100 ? 100 : x;
        var cell_number = (x * grid_x) / 100;
        //Edit BY Mahdi FOR ADD Event click calendar
        if ((typeof parsvt_interface_language !== "undefined") && (parsvt_interface_language === 'fa' || parsvt_interface_language === 'ar')) {
            cell_number = grid_x - 1 - cell_number;
        }

        TimeScheduler.Options.Events.Cell_Clicked.call(this, periodSelected, cell_number, $this.data('section'));
    },

    /* Selects the period with the given name */
    SelectPeriod: function (name) {
        TimeScheduler.Options.SelectedPeriod = name;
        var period = TimeScheduler.GetSelectedPeriod();

        if (name == '1 week') {
            TimeScheduler.Options.Start = moment().startOf('week', 1).add('Milliseconds', 1,1);
            if ((typeof parsvtlocale !== "undefined") && parsvtlocale != 'en') {
                TimeScheduler.Options.Start.subtract('days', 1, 1).add('Milliseconds', 1,1);
            }
        } else if (name == '1 month') {
            TimeScheduler.Options.Start = moment().startOf('month', 1).add('Milliseconds', 1,1);
        } else if (name == '1 days') {
            TimeScheduler.Options.Start = moment().startOf('day', 1).add('minutes', period.StartPeroid * 60,1);
        } else if (name == 'Custom') {//NOT WORK!!!
            var periodContainer = $('.time-sch-period-container');
            var date_range = periodContainer.find('.selectedRange').data('date-range');
            var date_range_arr = date_range.split(',');
            var date_start = date_range_arr[0];
            var date_end = date_range_arr[1];
            var dateFormat = $('#CalendarViewContent #date_format').val();
            //Edit BY Mahdi FOR ADD Event click calendar
            if ((typeof parsvt_calendar !== "undefined") && (parsvt_calendar === 'jalali' || parsvt_calendar === 'islamic')) {
                date_start = vtfarsitools.getDateInstance(date_start, dateFormat);
                date_end = vtfarsitools.getDateInstance(date_end, dateFormat);
                var date_start_moment = moment(date_start, dateFormat.toUpperCase()).add('months', 1,1).add('Milliseconds', 1,1);
                var date_end_moment = moment(date_end, dateFormat.toUpperCase()).add('months', 1,1).add('Milliseconds', 1,1);
            }else{
                var date_start_moment = moment(date_start, dateFormat.toUpperCase());
                var date_end_moment = moment(date_end, dateFormat.toUpperCase());
            }

            if (date_start_moment == date_end_moment) {
                date_end_moment.add('minutes', 24 * 60, 1);
            }
            var diff_minutes = date_end_moment.diff(date_start_moment, 'minutes');

            for (var i = 0; i < TimeScheduler.Options.Periods.length; i++) {
                if (TimeScheduler.Options.Periods[i].Name === 'Custom') {
                    TimeScheduler.Options.Periods[i].TimeframeOverall = diff_minutes;
                    TimeScheduler.Options.Periods[i].DateRange = '(' + date_range + ')';
                    TimeScheduler.Options.Periods[i].DateRangeValue = date_range;
                    break;
                }
            }

            TimeScheduler.Options.Start = date_start_moment;
        }
        TimeScheduler.Init();
    },

    Period_Clicked: function (event) {
        event.preventDefault();
        TimeScheduler.SelectPeriod($(this).data('period').Name);
    },

    registerCustomDateFilter: function (periodContainer) {
        vtUtils.applyFieldElementsView(periodContainer);

        periodContainer.on("click", "a.dateRange", function (e) {
            var currentTarget = jQuery(e.currentTarget);
            if (!currentTarget.hasClass('rangeDisplay')) {
                jQuery('a', periodContainer).removeClass('time-sch-selected-button');
                currentTarget.addClass('time-sch-selected-button');
            }
        });

        periodContainer.on('datepicker-change', 'a[data-calendar-type="range"]', function (e) {
            var element = jQuery(e.currentTarget);

            var date_range = element.val();
            var date_range_arr = date_range.split(',');
            var date_start = date_range_arr[0];
            var date_end = date_range_arr[1];
            var dateFormat = $('#CalendarViewContent #date_format').val();
            parsvt_calendar_scheduler = 1;//by Mahdi for set Month in moment
            if ((typeof parsvt_calendar !== "undefined") && (parsvt_calendar === 'jalali' || parsvt_calendar === 'islamic')) {
                date_start = vtfarsitools.getDateInstance(date_start, dateFormat);
                date_end = vtfarsitools.getDateInstance(date_end, dateFormat);
                var date_start_moment = moment(date_start, dateFormat.toUpperCase()).add('months', 1,1).add('Milliseconds', 1,1);
                var date_end_moment = moment(date_end, dateFormat.toUpperCase()).add('months', 1,1).add('Milliseconds', 1,1);
            }else {
                var date_start_moment = moment(date_start, dateFormat.toUpperCase());
                var date_end_moment = moment(date_end, dateFormat.toUpperCase()).add('minutes', 24 * 60, 1);
            }
            parsvt_calendar_scheduler = 0;//by Mahdi for set Month in moment
            var diff_days = date_end_moment.diff(date_start_moment, 'days');
            if (diff_days > 31) {
                app.helper.showErrorNotification({
                    title: app.vtranslate('Limited 31 days'),
                    message: app.vtranslate('Date range should be in a month to show activities better')
                });
                return;
            } else {
                jQuery('a', periodContainer).removeClass('time-sch-selected-button');
                element.addClass('time-sch-selected-button');
                periodContainer.find('.selectedRange').html("(" + element.val() + ")").closest('button').removeClass('hide');
                periodContainer.find('.selectedRange').data('date-range', element.val());
                $("a.dateRange", periodContainer).trigger('click');
                TimeScheduler.SelectPeriod('Custom');
            }
        });
    }
};