{*<!--
/*********************************************************************************
  ** The contents of this file are subject to the vtiger CRM Public License Version 1.0
   * ("License"); You may not use this file except in compliance with the License
   * The Original Code is: vtiger CRM Open Source
   * The Initial Developer of the Original Code is vtiger.
   * Portions created by vtiger are Copyright (C) vtiger.
   * All Rights Reserved.
  *
 ********************************************************************************/
-->*}

{assign var=FIELDVAL value=$FIELD_MODEL->getDisplayValue($FIELD_MODEL->get('fieldvalue'), $RECORD->getId(), $RECORD)}
{assign var="PLAQUE_VALUE" value=Vtiger_Mplaque_UIType::getPlaqueValue($FIELDVAL)}
{assign var="PLAQUE_LIST" value=Vtiger_Mplaque_UIType::getCustomPlaques()}
{if $PLAQUE_VALUE}
        {assign var="PLAQUE_IMAGE" value=$PLAQUE_LIST['O']['image']}
        {assign var="PLAQUE_COLOR" value=$PLAQUE_LIST['O']['color']}
        {assign var="PLAQUE_BGCOLOR" value=$PLAQUE_LIST['O']['bgcolor']}
    <link type="text/css" rel="stylesheet" href="layouts/{vglobal('default_layout')}/modules/ParsVT/resources/Plaque/Plaque.css" media="all"/>
    <div class="w-middle plaque-pay col-sm-4">
        <div class="form-group">
            <div class="text">
                <label>
                    {vtranslate('Plaque','ParsVT')}
                </label>
            </div>
            <div class="input">
                <div class="Plaque">
                    <div style="flex-grow: 1; padding: 5px 5px 0px 25px !important; border: 1px solid #0b0b0b; color: #{$PLAQUE_COLOR}; background-color: #{$PLAQUE_BGCOLOR}; height: 80px !important;" class="in plaque-ins col-xs-4 displayPlaque">
                        {Vtiger_Mplaque_UIType::convertNumbers($PLAQUE_VALUE[0])}<br>
                        {Vtiger_Mplaque_UIType::convertNumbers($PLAQUE_VALUE[1])}
                        <div class="pic2">
                            <img src="layouts/{vglobal('default_layout')}/modules/ParsVT/resources/Plaque/pelak.png" alt="">
                        </div>
                    </div>

                    <div class="clearfix"></div>
                    <div>
                        {Vtiger_Mplaque_UIType::findPlaqueCity($FIELDVAL)}
                    </div>
                </div>
            </div>
        </div>
    </div>
{/if}
