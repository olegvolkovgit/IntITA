/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.mathJaxLib = basePath+'/angular/bower_components/MathJax/MathJax.js?config=TeX-AMS-MML_HTMLorMML';

    config.extraPlugins = 'eqneditor,pastebase64,youtube,audio,skipWord1,skipWord0';
    config.allowedContent = true;
    //config.pasteFromWordPromptCleanup = true;

    //config.filebrowserUploadUrl = '/lesson/CKEUploadImage';
    //config.extraPlugins = 'Audio';
    config.extraAllowedContent = 'audio[*]{*}';
    config.filebrowserImageUploadUrl=basePath+"/lesson/CKEUploadImageAudio";

    //native font for intita
    config.contentsCss = basePath+'/css/fontface.css';
    config.font_names = 'MyriadPro/MyriadPro;' + config.font_names;
};
