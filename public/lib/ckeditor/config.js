/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for a single toolbar row.
config.extraPlugins = 'newplugin';
config.stylesSet = 'my_styles';

// For a definition in an external file.
config.stylesSet = 'my_styles:http://www.example.com/styles.js';
    
config.toolbar = 'Full';
 
config.toolbar_Full =
[

	{ name: 'document', items : [ 'Source','-','Templates','-','Save','NewPage','DocProps','Preview','Print','-','Templates'  ] },
	{ name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
       	{ name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
	{ name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
        'HiddenField' ] },

         '/',
       { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
        { name: 'colors', items : [ 'TextColor','BGColor' ] },
	{ name: 'paragraph', items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv',
	'-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
        { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
        { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
	{ name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','Iframe' ] },
	{ name: 'tools', items : [ 'Maximize', 'ShowBlocks' ] },
	'/',
	{name:'readmore',items:['Newplugin']}
];
 
config.toolbar_Basic =
[
	['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-','About']
];

	// The default plugins included in the basic setup define some buttons that
	// are not needed in a basic editor. They are removed here.
	//config.removeButtons = 'Cut,Copy,Paste,Undo,Redo,Anchor,Underline,Strike,Subscript,Superscript';

	// Dialog windows are also simplified.
	config.removeDialogTabs = 'link:advanced';
        config.skin = 'bootstrapck';
        config.resize_maxWidth =500;
          config.resize_maxHeight =600;
          
          config.enterMode =CKEDITOR.ENTER_BR;
          
          
          config.filebrowserBrowseUrl =URL+"administrator247/dashboard/photo";
    config.filebrowserImageBrowseUrl=URL+'administrator247/dashboard/photo?type=Images' ; 
    config.filebrowserFlashBrowseUrl = URL+'administrator247/dashboard/photo?type=Flash' , 
    config.filebrowserUploadUrl =  '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files' , 
    config.filebrowserImageUploadUrl =  '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images' , 
    config.filebrowserFlashUploadUrl = '/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash' 

        
};
CKEDITOR.plugins.add('newplugin',
{
    init: function (editor) {
        var pluginName = 'newplugin';
        editor.ui.addButton('Newplugin',
            {
                label: 'My New Plugin',
                command: 'addreadmore',
                icon: 'rm.png'
            });
        var cmd = editor.addCommand('addreadmore', { exec: addreadmore });
    }
});

function addreadmore(e) {
       e.insertHtml('{readmore}');
    }
    CKEDITOR.stylesSet.add( 'my_styles', [
    // Block-level styles.
    { name: 'Blue Title', element: 'h2', styles: { color: 'Blue' } },
    { name: 'Red Title',  element: 'h3', styles: { color: 'Red' } },

    // Inline styles.
    { name: 'Button ', element: 'div', attributes: { 'class': 'buttontext' }, styles: { "border":"1px solid #f89406"} },
    { name: 'Tiêu đề', element: 'label',attributes: { 'class': 'tieuderedmore' }, styles: { "border":"1px solid #d9d9d9","padding": "5px"} },
    { name: 'Khung ', element: 'div', attributes: { 'class': 'boxreadmore' }, styles: { 'border':'1px solid #d9d9d9',"padding": "15px 5px 5px 5px;"} },
    { name: 'Khung Màu', element: 'div', styles: { "background":"#EEEEEE" ,"padding": "5px 5px 5px 5px","border-radius": "4px","margin":"5px"} },
    { name: 'Facebook', element: 'div', attributes: { 'class': 'boxfacebook' } ,styles: { "background":"#e4e4e4" ,"padding": "5px 5px 5px 5px","border-radius": "4px","width":"100%"} },
    { name: 'Slider ', element: 'div', attributes: { 'class': 'sliderimage' }, styles: { 'border':'1px solid #1976D2',"padding": "15px 5px 5px 5px;"} },

]);