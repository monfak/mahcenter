{*<!--
/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
-->*}
{strip}


<div class="modal-dialog" style="width: 400px">


{include file="ModalHeader.tpl"|vtemplate_path:$MODULE TITLE=vtranslate('Actions', $MODULE)}
    <div class="modal-content offline-actions">
        <div class="form-horizontal">
            <div class="modal-body">
                <div class="form-group">
                    <div class="col-lg-12">
                        <div>
                            <ul class="list-unstyled pvtdash" style="line-height:200%">
                                <li data-toggle="tooltip"
                                    title="{vtranslate('View Tutorial Videos',$QUALIFIED_MODULE)}">
                                    <input style="opacity: 0;" {if $VIDEOS} value='1'  checked {else} value='0' {/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle" data-type="VIDEOS"/>
                                    {vtranslate('View Tutorial Videos',$QUALIFIED_MODULE)} -
                                    <a href="index.php?module=ParsVT&amp;parent=Settings&amp;view=Tutorials">({vtranslate("Settings", $QUALIFIED_MODULE)})</a>
                                </li>
                                <li data-toggle="tooltip"
                                    title="{vtranslate('Marketplace Banner on Dashboard',$QUALIFIED_MODULE)}">
                                    <input style="opacity: 0;" {if $MarketplaceBanner neq 1} value='0' {else} value='1' checked {/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle"
                                           data-type="MarketplaceBanner"/>
                                    {vtranslate('Marketplace Banner on Dashboard',$QUALIFIED_MODULE)}
                                </li>
                                <li data-toggle="tooltip"
                                    title="{vtranslate('Display latest news on login page',$QUALIFIED_MODULE)}">
                                    <input style="opacity: 0;" {if $LoginNews neq 1} value='0' {else} value='1' checked {/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle"
                                           data-type="LoginNews"/>
                                    {vtranslate('Display latest news on login page',$QUALIFIED_MODULE)}
                                </li>
                                <li data-toggle="tooltip"
                                    title="{vtranslate('Tutorial Widget on Dashboard',$QUALIFIED_MODULE)}">
                                    <input style="opacity: 0;" {if $Tutorial neq 1} value='0' {else} value='1' checked {/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle"
                                           data-type="Tutorial"/>
                                    {vtranslate('Tutorial Widget on Dashboard',$QUALIFIED_MODULE)}
                                </li>
                                <li data-toggle="tooltip"
                                    title="{vtranslate('News Widget on Dashboard',$QUALIFIED_MODULE)}">
                                    <input style="opacity: 0;" {if $News neq 1} value='0' {else} value='1' checked {/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle"
                                           data-type="News"/>
                                    {vtranslate('News Widget on Dashboard',$QUALIFIED_MODULE)}</li>
                                <li data-toggle="tooltip"
                                    title="{vtranslate('New Modules Widget on Dashboard',$QUALIFIED_MODULE)}">
                                    <input style="opacity: 0;" {if $Modules neq 1} value='0' {else} value='1' checked {/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle"
                                           data-type="Modules"/>
                                    {vtranslate('New Modules Widget on Dashboard',$QUALIFIED_MODULE)}
                                </li>
                                <li data-toggle="tooltip"
                                    title="{vtranslate('Latest Updates Widget on Dashboard',$QUALIFIED_MODULE)}">
                                    <input style="opacity: 0;" {if $LatestUpdates neq 1} value='0' {else} value='1' checked {/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle"
                                           data-type="LatestUpdates"/>
                                    {vtranslate('Latest Updates Widget on Dashboard',$QUALIFIED_MODULE)}
                                </li>
                                {if $ParsVTExtras}
                                <li data-toggle="tooltip" title="{vtranslate('Gold Price','ParsVTExtras')}">
                                    <input style="opacity: 0;" {if $Gold} value='1'  checked {else} value='0'{/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle" data-type="Gold"/>
                                    {vtranslate('Gold Price Widget','ParsVTExtras')}</li>
                                <li data-toggle="tooltip" title="{vtranslate('Currencies Price','ParsVTExtras')}">
                                    <input style="opacity: 0;" {if $Currency} value='1'  checked {else} value='0'{/if}
                                           class='cursorPointer bootstrap-switch' type="checkbox"
                                           data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                           data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                           data-on-color="primary" data-toggle="toggle" data-type="Currency"/>
                                    {vtranslate('Currencies Price Widget','ParsVTExtras')}</li>
                                <li data-toggle="tooltip" title="{vtranslate('Crypto Currencies','ParsVTExtras')}">
                                    <input style="opacity: 0;" {if $CRYPTOCURRENCIES} value='1'  checked {else} value='0'{/if}
                                       class='cursorPointer bootstrap-switch' type="checkbox"
                                       data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                       data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                       data-on-color="primary" data-toggle="toggle" data-type="CRYPTOCURRENCIES"/>
                                {vtranslate('Crypto Currencies Widget','ParsVTExtras')}</li>
                                {/if}
                                {foreach item=ONLINE_MODULE from=$ONLINE_MODULES}
                                    <li data-toggle="tooltip"
                                        title="{sprintf(vtranslate('%s module',$QUALIFIED_MODULE), vtranslate($ONLINE_MODULE['module'],$ONLINE_MODULE['module']))}">
                                        <input style="opacity: 0;" {if $ONLINE_MODULE['active'] neq 1} value='0' {else} value='1' checked {/if}
                                               class='cursorPointer bootstrap-switch' type="checkbox"
                                               data-on-text="{vtranslate('Active', $QUALIFIED_MODULE)}"
                                               data-off-text="{vtranslate('Inactive', $QUALIFIED_MODULE)}"
                                               data-on-color="primary" data-toggle="toggle"
                                               data-type="ModuleManager__{$ONLINE_MODULE['module']}__{if $ONLINE_MODULE['active']}1{else}0{/if}"/>
                                        {sprintf(vtranslate('%s module',$QUALIFIED_MODULE), vtranslate($ONLINE_MODULE['module'],$ONLINE_MODULE['module']))}
                                    </li>
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function () {
        var ParsVTErrors = {
            UNKNOWNERR: "{vtranslate('Unknown Error!', $MODULE)}",
            OPFAILED: "{vtranslate('Operation Failed : Error !', $MODULE)}",
            NO: "{vtranslate('LBL_NO', $MODULE)}",
            YES: "{vtranslate('LBL_YES', $MODULE)}",
        };
        jQuery('.bootstrap-switch').bootstrapSwitch();
        {literal}
        jQuery('body .offline-actions').on('switchChange.bootstrapSwitch', "input[type=checkbox]", function (e) {
            var currentElement = jQuery(e.currentTarget);
            if (currentElement.val() == 1) {
                currentElement.attr('value', 0);
                var state = true;
            } else {
                currentElement.attr('value', 1);
                var state = false;
            }
            var type = currentElement.data('type');
            OfflineOptions(type, {'value': currentElement.val()}, currentElement);
        });
        {/literal}
    });
    function OfflineOptions(option, params, target) {
        app.helper.showProgress();
        if (typeof params == 'undefined') {
            var params = {};
        }
        params.module = app.getModuleName();
        params.parent = app.getParentModuleName();
        params.action = 'Activate';
        params.mode = 'offlineAction';
        params.type = option;
        AppConnector.request(params).then(
            function (data) {
                app.helper.hideProgress();
                if (data.success) {
                    if (data.result.success) {
                        app.helper.showSuccessNotification({
                            message: data.result.message
                        });
                    } else {
                        app.helper.showErrorNotification({
                            message: data.result.message
                        });
                    }
                } else {
                    app.helper.showErrorNotification({
                        message: ParsVTErrors.OPFAILED
                    });
                }
            },
            function (error) {
                console.log('error =', error);
                app.helper.hideProgress();
                app.helper.showErrorNotification({
                    message: ParsVTErrors.OPFAILED
                });
                target.attr('value', 0);
            }
        );

        return false;
    }
</script>
{/strip}
