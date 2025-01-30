/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

/**PVTPATCHER-F0B52697176D62E281E37E8E41F7791F-START-ckeditor**/
/** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:43 **/
var editorlanguage = jQuery('body').data('language').slice(0,2);
if (typeof(editorlanguage) === 'undefined') {
	var editorlanguage = 'fa';
}
/**PVTPATCHER-F0B52697176D62E281E37E8E41F7791F-FINISH**/
CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
/**PVTPATCHER-A667BAA14D3B4E3CCF8C7F584A623AD9-START-ckeditor**/
/** Don't remove the Start and Finish Markup! Modified: 2025-01-09 09:29:43 **/
config.language = editorlanguage;
/**PVTPATCHER-A667BAA14D3B4E3CCF8C7F584A623AD9-FINISH**/
	// config.uiColor = '#AADC6E';
    //vtiger editor toolbar configuration 
 		    config.removePlugins = 'save,maximize,magicline'; 
			config.fullPage = true; 
 		    config.allowedContent = true; 
			config.disableNativeSpellChecker = false;
			config.enterMode = CKEDITOR.ENTER_BR;  
			config.shiftEnterMode = CKEDITOR.ENTER_P; 
			config.autoParagraph = false;
			config.fillEmptyBlocks = false;
			config.filebrowserBrowseUrl = 'kcfinder/browse.php?type=images'; 
			config.filebrowserUploadUrl = 'kcfinder/upload.php?type=images'; 
 	        config.plugins = 'dialogui,dialog,docprops,about,a11yhelp,dialogadvtab,basicstyles,bidi,blockquote,clipboard,button,panelbutton,panel,floatpanel,colorbutton,colordialog,menu,contextmenu,div,resize,toolbar,elementspath,enterkey,entities,popup,filebrowser,find,fakeobjects,floatingspace,listblock,richcombo,font,format,horizontalrule,htmlwriter,wysiwygarea,image,indent,indentblock,indentlist,justify,link,list,liststyle,magicline,pagebreak,preview,removeformat,selectall,showborders,sourcearea,specialchar,menubutton,stylescombo,tab,table,tabletools,undo,wsc'; 
 		    config.toolbarGroups = [ 
 		        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] }, 
 		        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] }, 
				{ name: 'insert' ,groups:['blocks']}, 
 		        { name: 'links' }, 
 		        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] }, 
 	        '/', 
 		        { name: 'styles' }, 
 		        { name: 'colors' }, 
 		        { name: 'tools' }, 
 		        { name: 'others' }, 
 		        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },{name: 'align'}, 
 	        { name: 'paragraph', groups: [ 'list', 'indent' ] }, 
            ];
			
			//Add new custom font names in below array
			var customFonts = ['FreeStyle Script','Brush Script STD','Bradley Hand ITC','Vladimir Script'];
			for(var i = 0; i < customFonts.length; i++){
				  config.font_names = config.font_names+';'+customFonts[i];
			}
};