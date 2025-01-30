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
    {assign var="FIELD_INFO" value=$FIELD_MODEL->getFieldInfo()}
    {assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
    {if (!$FIELD_NAME)}
        {assign var="FIELD_NAME" value=$FIELD_MODEL->getFieldName()}
    {/if}
    {assign var="ORIGINAL_FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}
    {assign var=ALL_CURRENCIES value=Vtiger_Multicurrency_UIType::getAvailableCurrencies()}
    {if $FIELD_MODEL->get('uitype') eq '74'}
        {assign var=CURRENCY_INFO value=array()}
        {foreach item=CURRENCY_DATA from=$ALL_CURRENCIES}
            {append var=CURRENCY_INFO value=$CURRENCY_DATA index=$CURRENCY_DATA.currency_id}
        {/foreach}
        {if $RECORD}
            {assign var=RECORD_MODEL value=$RECORD}
        {/if}
        {if $RECORD_STRUCTURE_MODEL && $RECORD_STRUCTURE_MODEL->getRecord()}
            {assign var=RECORD_MODEL value=$RECORD_STRUCTURE_MODEL->getRecord()}
        {/if}
        {if $RECORD_MODEL}
            {assign var=RECORDID value=$RECORD_MODEL->getId()}
        {/if}

		{assign var="FIELD_VALUES" value=Vtiger_Multicurrency_UIType::getMultiCurrencyValue($FIELD_MODEL->get('id'), $ORIGINAL_FIELD_VALUE, $RECORDID)}
		{assign var=SELECTED_CURRENCY_ID value=$FIELD_VALUES['id']}
		{assign var=RECORD_CONVERSION_RATE value=$FIELD_VALUES['conversion_rate']}
		{assign var=CONVERTED_VALUE value=$FIELD_VALUES['value']}
		{if $SELECTED_CURRENCY_ID && $CURRENCY_INFO && !$CURRENCY_INFO.$SELECTED_CURRENCY_ID}
			{assign var=INACTIVE_CURRENCY_INFO value=getCurrencySymbolandCRate($SELECTED_CURRENCY_ID)}
		{/if}

        {if !$SELECTED_CURRENCY_ID}
            {assign var=SELECTED_CURRENCY_ID value=$USER_MODEL->get('currency_id')}
        {/if}

        {if !$RECORD_CONVERSION_RATE || $RECORD_CONVERSION_RATE eq 0 }
            {assign var=RECORD_CONVERSION_RATE value=$USER_MODEL->get('conv_rate')}
        {/if}

        {if $IS_DUPLICATE && $INACTIVE_CURRENCY_INFO }
            {assign var=INACTIVE_CURRENCY_INFO value=''}
            {assign var=SELECTED_CURRENCY_ID value=$USER_MODEL->get('currency_id')}
            {assign var=RECORD_CONVERSION_RATE value=$USER_MODEL->get('conv_rate')}
        {/if}

		{if $INACTIVE_CURRENCY_INFO }
			{assign var=SELECTED_CURRENCY_ID value=$USER_MODEL->get('currency_id')}
			{assign var=CONVERTED_VALUE value=CurrencyField::convertToUserFormat($ORIGINAL_FIELD_VALUE, null, false, true)}
		{/if}


        {if count($ALL_CURRENCIES) > 1}
            <div class="input-container" style="width: 200px; display: flex">
                <input type="hidden" name="{$FIELD_NAME}" value="{$ORIGINAL_FIELD_VALUE}"/>
                <input type="hidden" name="{$FIELD_NAME|strtolower}_targetcurrency_id" id="{$FIELD_NAME|strtolower}_targetcurrency_id" value="{$SELECTED_CURRENCY_ID}"/>
                <input type="hidden" name="{$FIELD_NAME|strtolower}_conversion_rate" id="{$FIELD_NAME|strtolower}_conversion_rate" value="{$RECORD_CONVERSION_RATE}"/>
				<select id="{$FIELD_NAME|strtolower}_currency_id" name="{$FIELD_NAME|strtolower}_currency_id"
						class="select2 currenciesList multicurrencyid input-group-dropdown">
					{foreach item=CURRENCY_DATA key=CURRENCY_KEY from=$CURRENCY_INFO}
						<option {if ($CURRENCY_DATA['currency_id'] eq $SELECTED_CURRENCY_ID)} selected="selected" {/if}
								value="{$CURRENCY_DATA['currency_id']}"
								data-conversion-rate="{$CURRENCY_DATA.conversionrate}"
								data-conversionRate="{$CURRENCY_DATA.conversionrate}">
							{$CURRENCY_DATA['currencycode']}-{$CURRENCY_DATA['currencysymbol']}
						</option>
					{/foreach}
				</select>
				&nbsp;
                <input style="width: 120px" autofocus="autofocus" id="{$MODULE}_editView_fieldName_{$FIELD_NAME}" type="number" class="inputElement multiCurrencyField multicurrency"
                       value="{$CONVERTED_VALUE}" {if !empty($SPECIAL_VALIDATOR)}data-validator='{Zend_Json::encode($SPECIAL_VALIDATOR)}'{/if}
                        {if $FIELD_INFO["mandatory"] eq true} data-rule-required="true" {/if} data-rule-currency='true'
                        {if count($FIELD_INFO['validator'])}
                            data-specific-rules='{ZEND_JSON::encode($FIELD_INFO["validator"])}'
                        {/if}
                       data-fieldtype="MultiCurrency" />
            </div>
        {else}
			<input type="hidden" name="{$FIELD_NAME|strtolower}_targetcurrency_id" id="{$FIELD_NAME|strtolower}_targetcurrency_id" value="{$USER_MODEL->get('currency_id')}"/>
			<input type="hidden" name="{$FIELD_NAME|strtolower}_conversion_rate" id="{$FIELD_NAME|strtolower}_conversion_rate" value="1"/>
            <div class="input-group">
                <span class="input-group-addon">{$USER_MODEL->get('currency_symbol')}</span>
                <input id="{$MODULE}_editView_fieldName_{$FIELD_NAME}" type="number" class="inputElement currencyField"
					   name="{$FIELD_NAME}" value="{$ORIGINAL_FIELD_VALUE}"
                       {if !empty($SPECIAL_VALIDATOR)}data-validator='{Zend_Json::encode($SPECIAL_VALIDATOR)}'{/if}
                        {if $FIELD_INFO["mandatory"] eq true} data-rule-required="true" {/if} data-rule-currency='true'
                        {if count($FIELD_INFO['validator'])}
                            data-specific-rules='{ZEND_JSON::encode($FIELD_INFO["validator"])}'
                        {/if} />
            </div>
        {/if}
    {/if}
{/strip}
{if count($ALL_CURRENCIES) > 1}
<script>
    jQuery('body').on('change', '#{$FIELD_NAME|strtolower}_currency_id', function (e) {
        var selectedElement = jQuery(e.currentTarget);
        console.dir(selectedElement.val());
        if (selectedElement.val() != '') {
            var conversionrate = selectedElement.find('option:selected').data('conversion-rate');
            jQuery("#{$FIELD_NAME|strtolower}_targetcurrency_id").val(selectedElement.val());
            jQuery("#{$FIELD_NAME|strtolower}_conversion_rate").val(conversionrate);
            if (jQuery('#{$MODULE}_editView_fieldName_{$FIELD_NAME}').val() != '') {
                jQuery('input[name="{$FIELD_NAME}"]').val(ParsVTCustomFields_Js.convertToDollar(jQuery('#{$MODULE}_editView_fieldName_{$FIELD_NAME}').val(), conversionrate))
            } else {
                jQuery('input[name="{$FIELD_NAME}"]').val(0);
            }
        }
    });
    jQuery('body').on('change input', '#{$MODULE}_editView_fieldName_{$FIELD_NAME}', function () {
        var conversionrate = $('#{$FIELD_NAME|strtolower}_currency_id').find('option:selected').data('conversion-rate');
        jQuery('input[name="{$FIELD_NAME}"]').val(ParsVTCustomFields_Js.convertToDollar(jQuery('#{$MODULE}_editView_fieldName_{$FIELD_NAME}').val(), conversionrate))
    });
</script>
{/if}
