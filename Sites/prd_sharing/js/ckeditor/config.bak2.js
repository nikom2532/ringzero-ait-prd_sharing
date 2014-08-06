/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	/*
	// The toolbar groups arrangement, optimized for two toolbar rows.
	// Default setting.
	config.toolbarGroups = [
		{ name: 'document',    groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'forms' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'links' },
		{ name: 'insert' },
		'/',
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'tools' },
		{ name: 'others' },
		{ name: 'about' }
	];
	*/
	
	/*
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		// { name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		// '/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		// { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		// { name: 'styles' },
		{ name: 'colors' },
		
		
		// ['Source','-','Templates'],
        // ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        // ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        // ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	];
	*/
	
	config.toolbar = [
		// [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
        // ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
        // ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
        // ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
		// ['Source','-','Templates'],
		
		
		['Source','-','Save','NewPage','Preview','-','Templates'],
        
		// [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],
		// [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ],	
		// '/',
		// [ 'Bold', 'Italic' ]
		
		
		// { name: 'document', items: [ 'Source', '-', 'NewPage', 'Preview', '-', 'Templates' ] },	// Defines toolbar group with name (used to create voice label) and items in 3 subgroups.
		// [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ],			// Defines toolbar group without name.
		// '/',																					// Line break - next group will be placed in new line.
		// { name: 'basicstyles', items: [ 'Bold', 'Italic' ] }	
		
		// { name: 'clipboard',   items: [ 'clipboard', 'undo' ] },
		// { name: 'editing',     items: [ 'find', 'selection', 'spellchecker' ] },
		// { name: 'links' },
		// { name: 'insert' },
		// { name: 'forms' },
		// { name: 'tools' },
		// { name: 'document',	   items: [ 'mode', 'document', 'doctools' ] },
		// { name: 'others' },
		// // '/',
		// { name: 'basicstyles', items: [ 'basicstyles', 'cleanup' ] },
		// { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		// { name: 'styles' },
		// { name: 'colors' },
	];

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};
