{strip}
{assign var=FIELD_INFO value=$FIELD_MODEL->getFieldInfo()}
{assign var=$FIELD_INFO['picklistvalues'] value=[]}
{assign var=FIELD_INFO value=Vtiger_Util_Helper::toSafeHTML(Zend_Json::encode($FIELD_INFO))}
{assign var=SEARCH_VALUES value=explode(',',$SEARCH_INFO['searchValue'])}
<div class="">
     <input type="hidden" id="target_{$FIELD_MODEL->get('name')}" name="{$FIELD_MODEL->get('name')}" class="listSearchContributor" value="{$SEARCH_INFO['searchValue']}" />
     <input type="text" id="search_{$FIELD_MODEL->get('name')}" class="Citiesfield inputElement" value="{Vtiger_Citiesfield_UIType::getCityName($SEARCH_INFO['searchValue'])}" data-field-type="{$FIELD_MODEL->getFieldDataType()}" />
 </div>
{/strip}