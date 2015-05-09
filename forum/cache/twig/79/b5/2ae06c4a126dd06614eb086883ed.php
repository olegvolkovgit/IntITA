<?php

/* plupload.html */
class __TwigTemplate_79b52ae06c4a126dd06614eb086883ed extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<script type=\"text/javascript\">
//<![CDATA[
phpbb.plupload = {
\ti18n: {
\t\t'b': '";
        // line 5
        echo addslashes($this->env->getExtension('phpbb')->lang("BYTES_SHORT"));
        echo "',
\t\t'kb': '";
        // line 6
        echo addslashes($this->env->getExtension('phpbb')->lang("KB"));
        echo "',
\t\t'mb': '";
        // line 7
        echo addslashes($this->env->getExtension('phpbb')->lang("MB"));
        echo "',
\t\t'gb': '";
        // line 8
        echo addslashes($this->env->getExtension('phpbb')->lang("GB"));
        echo "',
\t\t'tb': '";
        // line 9
        echo addslashes($this->env->getExtension('phpbb')->lang("TB"));
        echo "',
\t\t'Add Files': '";
        // line 10
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_ADD_FILES"));
        echo "',
\t\t'Add files to the upload queue and click the start button.': '";
        // line 11
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_ADD_FILES_TO_QUEUE"));
        echo "',
\t\t'Close': '";
        // line 12
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_CLOSE"));
        echo "',
\t\t'Drag files here.': '";
        // line 13
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_DRAG"));
        echo "',
\t\t'Duplicate file error.': '";
        // line 14
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_DUPLICATE_ERROR"));
        echo "',
\t\t'File: %s': '";
        // line 15
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_FILE"));
        echo "',
\t\t'File: %s, size: %d, max file size: %d': '";
        // line 16
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_FILE_DETAILS"));
        echo "',
\t\t'File count error.': '";
        // line 17
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_ERR_FILE_COUNT"));
        echo "',
\t\t'File extension error.': '";
        // line 18
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_EXTENSION_ERROR"));
        echo "',
\t\t'File size error.': '";
        // line 19
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_SIZE_ERROR"));
        echo "',
\t\t'File too large:': '";
        // line 20
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_ERR_FILE_TOO_LARGE"));
        echo "',
\t\t'Filename': '";
        // line 21
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_FILENAME"));
        echo "',
\t\t'Generic error.': '";
        // line 22
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_GENERIC_ERROR"));
        echo "',
\t\t'HTTP Error.': '";
        // line 23
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_HTTP_ERROR"));
        echo "',
\t\t'Image format either wrong or not supported.': '";
        // line 24
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_IMAGE_FORMAT"));
        echo "',
\t\t'Init error.': '";
        // line 25
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_INIT_ERROR"));
        echo "',
\t\t'IO error.': '";
        // line 26
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_IO_ERROR"));
        echo "',
\t\t'Invalid file extension:': '";
        // line 27
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_ERR_FILE_INVALID_EXT"));
        echo "',
\t\t'N/A': '";
        // line 28
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_NOT_APPLICABLE"));
        echo "',
\t\t'Runtime ran out of available memory.': '";
        // line 29
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_ERR_RUNTIME_MEMORY"));
        echo "',
\t\t'Security error.': '";
        // line 30
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_SECURITY_ERROR"));
        echo "',
\t\t'Select files': '";
        // line 31
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_SELECT_FILES"));
        echo "',
\t\t'Size': '";
        // line 32
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_SIZE"));
        echo "',
\t\t'Start Upload': '";
        // line 33
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_START_UPLOAD"));
        echo "',
\t\t'Start uploading queue': '";
        // line 34
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_START_CURRENT_UPLOAD"));
        echo "',
\t\t'Status': '";
        // line 35
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_STATUS"));
        echo "',
\t\t'Stop Upload': '";
        // line 36
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_STOP_UPLOAD"));
        echo "',
\t\t'Stop current upload': '";
        // line 37
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_STOP_CURRENT_UPLOAD"));
        echo "',
\t\t\"Upload URL might be wrong or doesn't exist.\": '";
        // line 38
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_ERR_UPLOAD_URL"));
        echo "',
\t\t'Uploaded %d/%d files': '";
        // line 39
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_UPLOADED"));
        echo "',
\t\t'%d files queued': '";
        // line 40
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_FILES_QUEUED"));
        echo "',
\t\t'%s already present in the queue.': '";
        // line 41
        echo addslashes($this->env->getExtension('phpbb')->lang("PLUPLOAD_ALREADY_QUEUED"));
        echo "'
\t},
\tconfig: {
\t\truntimes: 'html5',
\t\turl: '";
        // line 45
        if (isset($context["S_PLUPLOAD_URL"])) { $_S_PLUPLOAD_URL_ = $context["S_PLUPLOAD_URL"]; } else { $_S_PLUPLOAD_URL_ = null; }
        echo $_S_PLUPLOAD_URL_;
        echo "',
\t\tmax_file_size: '";
        // line 46
        if (isset($context["FILESIZE"])) { $_FILESIZE_ = $context["FILESIZE"]; } else { $_FILESIZE_ = null; }
        echo $_FILESIZE_;
        echo "b',
\t\tchunk_size: '";
        // line 47
        if (isset($context["CHUNK_SIZE"])) { $_CHUNK_SIZE_ = $context["CHUNK_SIZE"]; } else { $_CHUNK_SIZE_ = null; }
        echo $_CHUNK_SIZE_;
        echo "b',
\t\tunique_names: true,
\t\tfilters: [";
        // line 49
        if (isset($context["FILTERS"])) { $_FILTERS_ = $context["FILTERS"]; } else { $_FILTERS_ = null; }
        echo $_FILTERS_;
        echo "],
\t\t";
        // line 50
        if (isset($context["S_RESIZE"])) { $_S_RESIZE_ = $context["S_RESIZE"]; } else { $_S_RESIZE_ = null; }
        echo $_S_RESIZE_;
        echo "
\t\theaders: {'X-PHPBB-USING-PLUPLOAD': '1', 'X-Requested-With': 'XMLHttpRequest'},
\t\tfile_data_name: 'fileupload',
\t\tmultipart_params: {'add_file': '";
        // line 53
        echo addslashes($this->env->getExtension('phpbb')->lang("ADD_FILE"));
        echo "'},
\t\tform_hook: '#postform',
\t\tbrowse_button: 'add_files',
\t\tdrop_element : 'message',
\t},
\tlang: {
\t\tERROR: '";
        // line 59
        echo addslashes($this->env->getExtension('phpbb')->lang("ERROR"));
        echo "',
\t\tTOO_MANY_ATTACHMENTS: '";
        // line 60
        echo addslashes($this->env->getExtension('phpbb')->lang("TOO_MANY_ATTACHMENTS"));
        echo "',
\t},
\torder: '";
        // line 62
        if (isset($context["ATTACH_ORDER"])) { $_ATTACH_ORDER_ = $context["ATTACH_ORDER"]; } else { $_ATTACH_ORDER_ = null; }
        echo $_ATTACH_ORDER_;
        echo "',
\tmaxFiles: ";
        // line 63
        if (isset($context["MAX_ATTACHMENTS"])) { $_MAX_ATTACHMENTS_ = $context["MAX_ATTACHMENTS"]; } else { $_MAX_ATTACHMENTS_ = null; }
        echo $_MAX_ATTACHMENTS_;
        echo ",
\tdata: ";
        // line 64
        if (isset($context["S_ATTACH_DATA"])) { $_S_ATTACH_DATA_ = $context["S_ATTACH_DATA"]; } else { $_S_ATTACH_DATA_ = null; }
        echo $_S_ATTACH_DATA_;
        echo ",
}
//]]>
</script>
";
        // line 68
        if (isset($context["T_ASSETS_PATH"])) { $_T_ASSETS_PATH_ = $context["T_ASSETS_PATH"]; } else { $_T_ASSETS_PATH_ = null; }
        $asset_file = (("" . $_T_ASSETS_PATH_) . "/plupload/plupload.full.min.js");
        $asset = new \phpbb\template\asset($asset_file, $this->getEnvironment()->get_path_helper());
        if (substr($asset_file, 0, 2) !== './' && $asset->is_relative()) {
            $asset_path = $asset->get_path();            $local_file = $this->getEnvironment()->get_phpbb_root_path() . $asset_path;
            if (!file_exists($local_file)) {
                $local_file = $this->getEnvironment()->findTemplate($asset_path);
                $asset->set_path($local_file, true);
            $asset->add_assets_version('1');
            $asset_file = $asset->get_url();
            }
        }
        $context['definition']->append('SCRIPTS', '<script type="text/javascript" src="' . $asset_file. '"></script>

');
        // line 69
        if (isset($context["T_ASSETS_PATH"])) { $_T_ASSETS_PATH_ = $context["T_ASSETS_PATH"]; } else { $_T_ASSETS_PATH_ = null; }
        $asset_file = (("" . $_T_ASSETS_PATH_) . "/javascript/plupload.js");
        $asset = new \phpbb\template\asset($asset_file, $this->getEnvironment()->get_path_helper());
        if (substr($asset_file, 0, 2) !== './' && $asset->is_relative()) {
            $asset_path = $asset->get_path();            $local_file = $this->getEnvironment()->get_phpbb_root_path() . $asset_path;
            if (!file_exists($local_file)) {
                $local_file = $this->getEnvironment()->findTemplate($asset_path);
                $asset->set_path($local_file, true);
            $asset->add_assets_version('1');
            $asset_file = $asset->get_url();
            }
        }
        $context['definition']->append('SCRIPTS', '<script type="text/javascript" src="' . $asset_file. '"></script>

');
    }

    public function getTemplateName()
    {
        return "plupload.html";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  256 => 69,  227 => 63,  222 => 62,  217 => 60,  197 => 50,  192 => 49,  186 => 47,  165 => 40,  145 => 35,  133 => 32,  125 => 30,  53 => 12,  49 => 11,  45 => 10,  41 => 9,  29 => 6,  178 => 55,  164 => 51,  161 => 39,  140 => 43,  135 => 42,  130 => 39,  127 => 38,  103 => 30,  83 => 22,  64 => 17,  52 => 13,  27 => 5,  169 => 41,  157 => 38,  150 => 63,  141 => 34,  82 => 29,  71 => 24,  56 => 16,  51 => 15,  44 => 11,  24 => 4,  347 => 102,  344 => 101,  322 => 99,  317 => 98,  314 => 97,  305 => 94,  302 => 93,  299 => 92,  290 => 89,  285 => 88,  282 => 87,  274 => 85,  259 => 81,  255 => 80,  239 => 75,  236 => 74,  232 => 64,  228 => 72,  224 => 71,  213 => 59,  210 => 67,  206 => 66,  202 => 65,  198 => 80,  193 => 62,  180 => 55,  177 => 70,  174 => 53,  142 => 42,  131 => 33,  109 => 26,  97 => 23,  93 => 22,  89 => 21,  81 => 19,  77 => 18,  69 => 16,  65 => 15,  61 => 14,  770 => 189,  766 => 187,  759 => 184,  754 => 183,  751 => 182,  748 => 181,  745 => 180,  741 => 178,  735 => 176,  731 => 175,  724 => 174,  719 => 173,  715 => 171,  711 => 170,  708 => 169,  702 => 166,  695 => 165,  690 => 164,  687 => 163,  683 => 162,  680 => 161,  651 => 158,  641 => 157,  638 => 156,  635 => 155,  632 => 154,  628 => 152,  623 => 151,  620 => 150,  609 => 148,  605 => 147,  596 => 145,  592 => 144,  583 => 142,  579 => 141,  570 => 139,  566 => 138,  557 => 136,  553 => 135,  544 => 133,  540 => 132,  531 => 130,  527 => 129,  525 => 128,  519 => 124,  515 => 123,  512 => 122,  507 => 119,  501 => 116,  498 => 115,  493 => 114,  486 => 110,  482 => 108,  479 => 107,  475 => 106,  463 => 104,  458 => 103,  455 => 102,  445 => 95,  435 => 94,  427 => 93,  420 => 92,  415 => 91,  410 => 90,  405 => 87,  401 => 86,  398 => 85,  393 => 82,  390 => 81,  387 => 80,  384 => 79,  380 => 77,  378 => 76,  358 => 73,  354 => 71,  352 => 70,  348 => 68,  345 => 67,  337 => 66,  326 => 65,  320 => 64,  315 => 63,  312 => 96,  304 => 59,  298 => 57,  293 => 90,  287 => 55,  284 => 54,  278 => 86,  270 => 84,  266 => 50,  263 => 49,  254 => 47,  246 => 45,  221 => 43,  211 => 41,  207 => 40,  203 => 39,  199 => 37,  187 => 36,  184 => 73,  182 => 34,  179 => 33,  158 => 49,  153 => 37,  149 => 36,  129 => 31,  121 => 29,  118 => 31,  116 => 21,  113 => 27,  106 => 17,  101 => 24,  98 => 29,  94 => 32,  91 => 13,  86 => 30,  55 => 9,  46 => 8,  40 => 10,  33 => 7,  30 => 3,  330 => 84,  325 => 81,  310 => 80,  307 => 79,  291 => 78,  288 => 77,  273 => 52,  265 => 83,  262 => 71,  249 => 78,  245 => 77,  240 => 68,  234 => 63,  219 => 70,  216 => 42,  204 => 53,  195 => 63,  190 => 48,  185 => 46,  181 => 46,  176 => 45,  173 => 31,  170 => 40,  155 => 48,  152 => 47,  137 => 33,  134 => 59,  126 => 24,  122 => 30,  117 => 28,  114 => 34,  105 => 25,  102 => 23,  96 => 19,  90 => 31,  85 => 20,  76 => 21,  73 => 17,  63 => 10,  60 => 9,  57 => 13,  47 => 12,  37 => 8,  34 => 3,  31 => 2,  39 => 10,  25 => 5,  22 => 2,  19 => 1,);
    }
}
