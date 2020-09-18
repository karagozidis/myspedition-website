/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
        
        config.extraPlugins = 'font';
        config.toolbar = 'Custom';
        config.resize_enabled = false;
	config.htmlEncodeOutput = false;
        
	config.toolbar_Custom = [
		['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
		['SpecialChar'],
		'/',
		['Font','FontSize'],
		['TextColor','BGColor'],
	];
        
};
