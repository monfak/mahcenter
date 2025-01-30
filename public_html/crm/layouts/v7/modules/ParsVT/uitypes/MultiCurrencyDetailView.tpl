{*<!--
/* ********************************************************************************
 * The content of this file is subject to the VTFarsi.ir Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is VTFarsi.ir
 * Portions created by VTFarsi.ir. are Copyright(C) VTFarsi Team
 * All Rights Reserved.
 * ****************************************************************************** */
-->*}
{assign var=CURRENT_USER_MODEL value=Users_Record_Model::getCurrentUserModel()}
{assign var=SYMBOL_PLACEMENT value=$CURRENT_USER_MODEL->get('currency_symbol_placement')}
{assign var="FIELD_INFO" value=$FIELD_MODEL->getFieldInfo()}
{assign var="SPECIAL_VALIDATOR" value=$FIELD_MODEL->getValidator()}
{if (!$FIELD_NAME)}
    {assign var="FIELD_NAME" value=$FIELD_MODEL->getFieldName()}
{/if}
{assign var="ORIGINAL_FIELD_VALUE" value=$FIELD_MODEL->get('fieldvalue')}

{if $RECORD}
    {assign var=RECORD_MODEL value=$RECORD}
{/if}
{if $RECORD_STRUCTURE_MODEL && method_exists($RECORD_STRUCTURE_MODEL,'getRecord')}
    {assign var=RECORD_MODEL value=$RECORD_STRUCTURE_MODEL->getRecord()}
{/if}
{if $RECORD_MODEL}
    {assign var=RECORDID value=$RECORD_MODEL->getId()}
{/if}
{assign var="TOTAL_VALUES" value=Vtiger_Multicurrency_UIType::getMultiCurrencyValues($FIELD_MODEL->get('id'), $ORIGINAL_FIELD_VALUE, $RECORDID)}
<span class="convertedCurrency">
    {foreach from=$TOTAL_VALUES item=RECORD}
        <span class="currencyValue" title="{vtranslate($RECORD['label'], "ParsVT")}">
            {if $SYMBOL_PLACEMENT eq '$1.0'}
                {$RECORD['symbol']}&nbsp;<span class="currencyValue" title="{vtranslate($RECORD['label'], "ParsVT")}">{$RECORD['value']}</span>
            {else}
                <span class="currencyValue"  title="{vtranslate($RECORD['label'], "ParsVT")}">{$RECORD['value']}</span>&nbsp;{$RECORD['symbol']}
            {/if}
        </span><br>
    {/foreach}
</span>