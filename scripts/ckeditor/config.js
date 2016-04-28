/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    config.mathJaxLib = '//cdn.mathjax.org/mathjax/2.2-latest/MathJax.js?config=TeX-AMS_HTML';

    config.extraPlugins = 'eqneditor,pastebase64,youtube,audio,skipWord1,skipWord0';
    config.allowedContent = true;
    //config.pasteFromWordPromptCleanup = true;

    //config.filebrowserUploadUrl = '/lesson/CKEUploadImage';
    //config.extraPlugins = 'Audio';
    config.extraAllowedContent = 'audio[*]{*}';
    config.filebrowserImageUploadUrl="/lesson/CKEUploadImageAudio";
};
