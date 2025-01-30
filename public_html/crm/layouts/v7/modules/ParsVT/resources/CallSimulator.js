/* ********************************************************************************
 * The content of this file is subject to the ParsVT.com Modules License("License");
 * You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is ParsVT.com
 * Portions created by ParsVT.com. are Copyright(C) ParsVT Team
 * All Rights Reserved.
 * ****************************************************************************** */
$(document).ready((function(){$("#pvtStartCall").on("click",(function(){app.helper.showProgress();var a={module:"ParsVT",action:"ActionAjax",mode:"CallSimulator",number:$("#pvtCallPhone").val(),direction:$("#pvtCallType").val(),gateway:$("#pvtGateway").val()};app.request.post({data:a}).then((function(a,e){app.helper.hideProgress(),null===a?app.helper.showSuccessNotification({message:app.vtranslate("Start simulating call")}):a.message?app.helper.showErrorNotification({message:a.message}):app.helper.showErrorNotification({message:app.vtranslate("Operation Failed : Error !")})}))}))}));
