<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/angular.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-route/angular-route.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/app.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'js/lesson_app/controllers.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'ivpusic/angular-cookies.min.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/ui-bootstrap-tpls_0_13_0.js'); ?>"></script>
<link type='text/css' rel='stylesheet' href="<?php echo StaticFilesHelper::fullPathTo('angular', 'bower_components/angular-bootstrap/bootstrap.min.css'); ?>">
<?php
/* @var $this LessonController */
/* @var $lecture Lecture */
/* @var $page LecturePage */
/* @var $teacher Teacher */
/* @var integer $idCourse */

$this->pageTitle = 'INTITA';
if (!isset($idCourse)) $idCourse = 0;
?>
<!-- lesson style -->
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lessonsStyle.css'); ?>"/>
<link type="text/css" rel="stylesheet" href="<?php echo StaticFilesHelper::fullPathTo('css', 'lectureStyles.css'); ?>"/>
<script type="text/x-mathjax-config">
  MathJax.Hub.Config({
    tex2jax: {
      inlineMath: [ ['$','$'], ["\\(","\\)"] ],
      processEscapes: true
    }
  });

</script>

<?php
/**
 * Created by PhpStorm.
 * User: Wizlight
 * Date: 26.11.2015
 * Time: 17:08
 */
$this->widget('zii.widgets.jui.CJuiTabs', array(
    'tabs' => array(
        Yii::t('lecture', '0613') => array('id' => 'video', 'content' => $this->renderPartial(
            '_videoTab',
            array('page' => $page), true
        )),
        Yii::t('lecture', '0614') => array('id' => 'text', 'content' => $this->renderPartial(
            '_textListTab',
            array('dataProvider' => $dataProvider, 'editMode' => 0, 'user' => 49), true
        )),
        Yii::t('lecture', '0659') => array('id' => 'quiz', 'content' => $this->renderPartial(
            '_quiz',
            array('page' => $page, 'editMode' => 0, 'user' => 49), true
        )

        ),
    ),
    'options' => array(
        'collapsible' => true,
        'active' => 1,
    ),
    'id' => 'MyTab-Menu',
));
?>
<!-- lesson style -->
<!-- Підсвітка синтаксису-->
<link type='text/css' rel='stylesheet'
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'sh/styles/shCoreEclipse.css'); ?>">
<link type='text/css' rel='stylesheet'
      href="<?php echo StaticFilesHelper::fullPathTo('js', 'sh/styles/shThemeEclipse.css'); ?>">
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/XRegExp.js"); ?>'></script>
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/shLegacy.js"); ?>'></script>
<script class='javascript' src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/shCore.js"); ?>'></script>
<script class='javascript'
        src='<?php echo StaticFilesHelper::fullPathTo("js", "sh/scripts/shMegaLang.js"); ?>'></script>

<script>SyntaxHighlighter.all();</script>
<script src="https://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.min.css">
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'taskAnswer.js'); ?>"></script>
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'tests.js'); ?>"></script>
<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'plainTask.js'); ?>"></script>

<script async src="<?php echo StaticFilesHelper::fullPathTo('js', 'lesson.js'); ?>"></script>
<script src="<?php echo StaticFilesHelper::fullPathTo('js', 'SpoilerContent.js'); ?>"></script>
