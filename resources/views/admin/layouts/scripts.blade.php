<!-- jQuery 2.2.3 -->
<script src="/dashboard/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="/dashboard/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/dashboard/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/dashboard/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
{{--<script src="/dashboard/dist/js/demo.js"></script>--}}
{{--<script src="/dashboard/dist/js/dashboard.js"></script>--}}
<script src="/dashboard/plugins/izitoast/js/iziToast.min.js" type="text/javascript"></script>
<!--<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>-->
<!--<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>-->
<script src="/vendor/tinymce/js/tinymce/tinymce.min.js"></script>
<script>
    var editor_config = {
        path_absolute : "/",
        selector: "textarea.tinymce",
        height: 400,
        directionality : "rtl",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        style_formats : [
            {title : 'Line height 5px', selector : 'p,div,h1,h2,h3,h4,h5,h6', styles: {lineHeight: '5px'}},
            {title : 'Line height 10px', selector : 'p,div,h1,h2,h3,h4,h5,h6', styles: {lineHeight: '10px'}},
            {title : 'Line height 15px', selector : 'p,div,h1,h2,h3,h4,h5,h6', styles: {lineHeight: '15px'}},
            {title : 'Line height 20px', selector : 'p,div,h1,h2,h3,h4,h5,h6', styles: {lineHeight: '20px'}},
            {title : 'Line height 25px', selector : 'p,div,h1,h2,h3,h4,h5,h6', styles: {lineHeight: '25px'}},
            {title : 'Line height 30px', selector : 'p,div,h1,h2,h3,h4,h5,h6', styles: {lineHeight: '30px'}}
         ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | lineheightselect",
        relative_urls: false,
        file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
        },
        language : 'fa_IR',
        content_style: "@import url('{{ url('css/tinymce.css') }}');",
    };

    tinymce.init(editor_config);
</script>
<script>
    $(document).ready(function(){
        $('.pagination').addClass("pagination-sm no-margin pull-right");
        $('.close-callout').click(function () {
            $(this).parentsUntil('.pad').remove();
        });
    });
</script>
<script>
    $(document).ready(function () {
        $('.close-callout').click(function () {
            $(this).parentsUntil('.pad').remove();
        });
    });
</script>

<script src="{{ asset('dashboard/dist/js/persian-date-0.1.8.min.js') }}"></script>
<script src="{{ asset('dashboard/dist/js/persian-datepicker-0.4.5.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/yajra/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/plugins/yajra/js/datatables.bootstrap.js') }}"></script>
<script src="{{ asset('dashboard/plugins/yajra/js/simple_numbers_no_ellipses.js') }}"></script>
<script type="text/javascript">
    $.fn.DataTable.ext.pager.simple_numbers_no_ellipses = function(page, pages){
        var numbers = [];

        var buttons = $.fn.DataTable.ext.pager.numbers_length;
        var half = Math.floor( buttons / 2 );

        var _range = function ( len, start ){
            var end;

            if ( typeof start === "undefined" ){
                start = 0;
                end = len;

            } else {
                end = start;
                start = len;
            }

            var out = [];
            for ( var i = start ; i < end; i++ ){ out.push(i); }

            return out;
        };


        if ( pages <= buttons ) {
            numbers = _range( 0, pages );

        } else if ( page <= half ) {
            numbers = _range( 0, buttons);

        } else if ( page >= pages - 1 - half ) {
            numbers = _range( pages - buttons, pages );

        } else {
            numbers = _range( page - half, page + half + 1);
        }

        numbers.DT_el = 'span';

        return [ 'previous', numbers, 'next' ];
    };
</script>
<script type="text/javascript">
      $(document).ready(function() {
            $('.table-datatable').removeAttr('width').DataTable({
                processing: true,

                    columnDefs: [
                        { width: 50, targets: 0 }
                    ],


                order: [[ 0, "asc" ]],
                language: {
                    "url": "{{ asset('dashboard/plugins/yajra/i18n/Persian.json') }}"
                },

                pagingType: "simple_numbers_no_ellipses",
                lengthMenu: [
                    [10,25, 50, 100, -1],
                    [10,25, 50, 100, "همه"]
                ],
            });
        });

</script>
