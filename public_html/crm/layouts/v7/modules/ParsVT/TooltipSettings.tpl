{literal}
    <style>
        .image {
            width: 25px;
            height: 25px;
            overflow: hidden;
            cursor: pointer;
            color: #fff;
        }
        .image img {
            visibility: hidden;
        }
    </style>
{/literal}
<div style="padding:20px;">
    <form method="post" action="">

        <div style="clear:both;"></div>
        <table style="width:100%;" cellpadding="10" id="field_list">
            <tr>
                <td  colspan="4" style="padding: 10px">
                    <input type="hidden" id="tooltip_selected_module"  value="{$SELECTED_MODULE}">
                    <input type="hidden" id="tooltip_source_module"  value="{$SOURCE_MODULE}">
                    <p style="text-align:justify" class="alert alert-info">
                        {vtranslate('TOOLTIP_HELP', $QUALIFIED_MODULE_NAME)}
                    </p>
                </td>
            </tr>
            {if $SELECTED_MODULE}
                <tr>
                    <td style="padding: 10px; vertical-align:top;"><strong>{vtranslate('Icon', $QUALIFIED_MODULE_NAME)}</strong></td>
                    <td style="padding: 10px; vertical-align:top;"><strong>{vtranslate('LBL_SOURCE_FIELD', 'Settings:PickListDependency')}</strong></td>
                    <td style="padding: 10px; vertical-align:top;"><strong>{vtranslate('Description', $QUALIFIED_MODULE_NAME)}</strong></td>
                    <td style="padding: 10px; vertical-align:top">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center" style="width: 25px;padding: 10px; vertical-align:top">
                        <div id="image_{$SELECTED_FIELD.fieldid}" class="image" onclick="openKCFinderImageType(this,{$SELECTED_FIELD.fieldid})" style="float:left;">
                            {if $SELECTED_FIELD.icon eq ''}
                                <img class="img" src="layouts/v7/modules/ParsVT/resources/Tooltip/info_icon.png" style="visibility: visible;max-width: 95%;">
                            {else}
                                <img class="img" src="{$SELECTED_FIELD.icon}" style="visibility: visible;max-width: 95%;">
                            {/if}
                        </div>

                        <input type="hidden" style="display: block; margin-left:0px;" value="{$SELECTED_FIELD.icon}"  class="field_icon" id="field_icon_{$SELECTED_FIELD.fieldid}" name="field_icon_{$SELECTED_FIELD.fieldid}"/>

                    </td>
                    <td  style="padding: 10px; vertical-align:top">
                        <select id="list_fields" name="list_fields" class="select2" style="width: 200px;">
                            <option value="">{vtranslate('LBL_SELECT_FIELD', 'Settings:PickListDependency')}</option>
                            {foreach from=$FIELD_LIST item=FIELD}
                                <option value="{$FIELD.fieldid}" {if $FIELD.fieldid eq $SELECTED_FIELD.fieldid}selected{/if} style="{if $FIELD.helpinfo neq ''}font-weight:bold{/if}">
                                    {vtranslate($FIELD.fieldlabel, $SELECTED_MODULE_NAME)}
                                </option>
                            {/foreach}
                        </select>
                        <br/><br/>
                        <select id="preview_type" class="select2" name="preview_type_{$SELECTED_FIELD.fieldid}" style="width: 150px">
                            <option value="2"{if $SELECTED_FIELD.preview_type eq "2"} selected{/if}>{vtranslate('Tooltip', $QUALIFIED_MODULE_NAME)}</option>
                            <option value="1"{if $SELECTED_FIELD.preview_type eq "1"} selected{/if}>{vtranslate('Popup', $QUALIFIED_MODULE_NAME)}</option>
                        </select>
                    </td>
                    <td style="padding: 10px; vertical-align:top">
                        <textarea name="field_helpinfo_{$SELECTED_FIELD.fieldid}" id="field_helpinfo_{$SELECTED_FIELD.fieldid}" class="ckEditorSource" style="width:100%;">{$SELECTED_FIELD.helpinfo}</textarea>
                    </td>
                    <td style="width: 75px;padding: 10px; vertical-align:top" >
                        {if $SELECTED_FIELD.fieldid}
                            <button type="button" class="btn btn-primary" style="width:100px" onclick="tmPreview({$SELECTED_FIELD.fieldid})">{vtranslate("LBL_PREVIEW",$QUALIFIED_MODULE_NAME)}</button>
                            <div style="margin:1px;padding:1px"></div>
                            <button type="button" class="btn btn-success" style="width:100px" onclick="tmSave({$SELECTED_FIELD.fieldid})">{vtranslate("LBL_SAVE","Vtiger")}</button>
                            <div style="margin:1px;padding:1px"></div>
                            <button type="button" class="btn btn-danger" style="width:100px" onclick="tmDelete({$SELECTED_FIELD.fieldid})">{vtranslate("LBL_DELETE",$QUALIFIED_MODULE_NAME)}</button>
                        {/if}
                    </td>
                </tr>
            {/if}
        </table>
    </form>
</div>
<script type="text/javascript">
    var ckEditorInstance = new Vtiger_CkEditor_Js();
    var customConfig = { };
    customConfig['height'] = '150px';
    {if empty($SELECTED_FIELD.fieldid)}
    customConfig['readOnly'] = true;
    {/if}
    ckEditorInstance.loadCkEditor(jQuery("#field_helpinfo_{$SELECTED_FIELD.fieldid}"), customConfig);
    {literal}
    function openKCFinderImageType(div,fieldid) {
            window.KCFinder = {
                callBack: function(url) {
                    var urlRes = url.split('test/upload/');
                    url = 'test/upload/'+urlRes[1];

                    window.KCFinder = null;
                    div.innerHTML = '<div style="margin:5px">Loading...</div>';
                    var img = new Image();
                    img.src = url;
                    var field_icon_box = document.getElementById('field_icon_'+fieldid);
                    field_icon_box.value = url;
                    img.onload = function() {
                        div.innerHTML = '<img id="img_'+fieldid+'" class="img" src="' + url + '" />';
                        var img = document.getElementById('img_'+fieldid);
                        var o_w = img.offsetWidth;
                        var o_h = img.offsetHeight;
                        var f_w = div.offsetWidth;
                        var f_h = div.offsetHeight;
                        if ((o_w > f_w) || (o_h > f_h)) {
                            if ((f_w / f_h) > (o_w / o_h))
                                f_w = parseInt((o_w * f_h) / o_h);
                            else if ((f_w / f_h) < (o_w / o_h))
                                f_h = parseInt((o_h * f_w) / o_w);
                            img.style.width = f_w + "px";
                            img.style.height = f_h + "px";
                        } else {
                            f_w = o_w;
                            f_h = o_h;
                        }
                        img.style.visibility = "visible";
                    }
                }
            };
            window.open('kcfinder/browse.php?type=images',
                    'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
                    'directories=0, resizable=1, scrollbars=0, width=800, height=600'
            );
        }
    function tmPreview(fId){
        var previewType= jQuery("select[name=preview_type_"+ fId+ "]").val();
        var fieldHelpinfo= jQuery("textarea[name=field_helpinfo_"+ fId+ "]").val();
        var value = CKEDITOR.instances['field_helpinfo_'+fId].getData();
        fieldHelpinfo = value;
        if(previewType== 1){
            app.helper.showModal('<div class="modal-dialog modal-lg" style="width: 600px;"><div class="modal-content"><div class="modal-body"><div>'+ fieldHelpinfo +'</div></div></div></div>');
        } else{
            if(!fieldHelpinfo){
                return;
            }
            jQuery("#image_"+ fId).qtip({
                content: fieldHelpinfo,
                hide: false,
                show: {
                    event: "click",
                    ready: true
                },
                hide: "unfocus",
                position: {
                    my: 'top left',
                    at: 'bottom center',
                    adjust: {
                        x: 1,
                        y: 1
                    }
                },
                style: {
                    classes: 'qtip-blue'
                }
            });
        }
    }
    function tmSave(fId){
        for(var instance in CKEDITOR.instances){
            CKEDITOR.instances[instance].updateElement();
        }
        if(CKEDITOR.instances.field_helpinfo_{/literal}{$SELECTED_FIELD.fieldid}{literal}.document.getBody().getChild(0).getText().length <= 0) {
            jQuery('#field_helpinfo_'+fId).val('').text('');
        }
        app.helper.showProgress();
        var data = {
            module: 'ParsVT',
            action: 'Fields',
            mode: 'saveTooltipField',
            sourceModule: '{/literal}{$SELECTED_MODULE}{literal}',
            fieldid: '{/literal}{$SELECTED_FIELD.fieldid}{literal}',
            preview_type: $('#preview_type').val(),
            field_icon: $('.field_icon').val(),
            field_helpinfo: $('.ckEditorSource').val()
        };
        jQuery.post( "index.php", data,
                function(data){
                    app.helper.hideProgress();
                }
        );
    }
    function tmDelete(fId){
        app.helper.showConfirmationBox({
            message: app.vtranslate('LBL_DELETE_CONFIRMATION')
        }).then(function () {
            app.helper.showProgress();
            var data = {
                module: 'ParsVT',
                action: 'Fields',
                mode: 'deleteTooltipField',
                sourceModule: '{/literal}{$SELECTED_MODULE}{literal}',
                fieldid: fId
            };
            jQuery.post( "index.php", data,
                    function(data){
                        app.helper.hideProgress();
                        CKEDITOR.instances['field_helpinfo_'+fId].setData('');
                    }
            );
        });
    }
</script>
{/literal}
