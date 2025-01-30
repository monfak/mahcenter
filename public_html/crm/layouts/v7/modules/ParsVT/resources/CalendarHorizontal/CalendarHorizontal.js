jQuery.Class('Settings_CalendarHorizontal_Js', {
}, {
    ckEditorInstance: false,

    /**
     * Function to get ckEditorInstance
     */
    getckEditorInstance: function () {
        if (this.ckEditorInstance == false) {
            this.ckEditorInstance = new Vtiger_CkEditor_Js();
        }
        return this.ckEditorInstance;
    },

    registerLoadCKEditorEvents: function () {
        var textAreaElementEvents = jQuery('#events_custom_title');
        var textAreaElementCalendar = jQuery('#calendar_custom_title');
        var ckEditorInstance = this.getckEditorInstance();
        ckEditorInstance.loadCkEditor(textAreaElementEvents);
        ckEditorInstance.loadCkEditor(textAreaElementCalendar);
        this.registerFillCustomTitleEvent();
    },

    registerFillCustomTitleEvent: function () {
        $('[name=events_fields]').on('change', function (e) {
            var textarea = CKEDITOR.instances.events_custom_title;
            var value = jQuery(e.currentTarget).val();
            if (textarea != 'undefined') {
                textarea.insertHtml(value);
            } else if (jQuery('textarea[name="events_custom_title"]')) {
                var textArea = jQuery('textarea[name="events_custom_title"]');
                textArea.insertAtCaret(value);
            }
        });
        $('[name=calendar_fields]').on('change', function (e) {
            var textarea = CKEDITOR.instances.calendar_custom_title;
            var value = jQuery(e.currentTarget).val();
            if (textarea != 'undefined') {
                textarea.insertHtml(value);
            } else if (jQuery('textarea[name="calendar_custom_title"]')) {
                var textArea = jQuery('textarea[name="calendar_custom_title"]');
                textArea.insertAtCaret(value);
            }
        });
    },

    registerEvents : function() {
        if($('#calendar-horizontal-settings-edit-container').length) {
            this.registerLoadCKEditorEvents();
        }
    }
});
jQuery(document).ready(function(){
    var instance = new Settings_CalendarHorizontal_Js();
    instance.registerEvents();
    Vtiger_Index_Js.getInstance().registerEvents();
});
//http://stackoverflow.com/questions/946534/insert-text-into-textarea-with-jquery
jQuery.fn.extend({
    insertAtCaret: function(myValue) {
        return this.each(function(i) {
            if (document.selection) {
                //For browsers like Internet Explorer
                this.focus();
                var sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
            } else if (this.selectionStart || this.selectionStart == '0') {
                //For browsers like Firefox and Webkit based
                var startPos = this.selectionStart;
                var endPos = this.selectionEnd;
                var scrollTop = this.scrollTop;
                this.value = this.value.substring(0, startPos)+myValue+this.value.substring(endPos,this.value.length);
                this.focus();
                this.selectionStart = startPos + myValue.length;
                this.selectionEnd = startPos + myValue.length;
                this.scrollTop = scrollTop;
            } else {
                this.value += myValue;
                this.focus();
            }
        });
    }
});