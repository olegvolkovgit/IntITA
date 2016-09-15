<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.05.2015
 * Time: 15:37
 */
$imagesPath = StaticFilesHelper::createPath('image', 'aboutus', '');
if (Yii::app()->user->isGuest)
    $buttonStart = '<div class="buutt"><a class="butstart" href="' . Config::getBaseUrl() . '/#form">' . Yii::t('slider', '0008') . '</a></div>';
else $buttonStart = '';
$drop1Text = '<div  class="aboutStepBlock">
<div class="oned">
    <span id="spone" class="detailTitle1">' . Yii::t("aboutus", "0337") . '</span>
    <table>
    <tr>
    <td>
      <img src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas1.png') . '">
    </td>
    <td>
  <div>
    <span class="detailTitle12">' . Yii::t("aboutus", "0338") . '</span>
    <br>
    <span class="detailTitle1">' . Yii::t("aboutus", "0339") . '</span>
  </div>
    </td>
    </tr>
    </table>
    <div class="imgone">
       <img src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas2.png') . '">
       <div class="detailavt">
        <table>
        <tr>
        <td>
        <span class="detailTitle1">' . Yii::t("aboutus", "0340") . '</span>
        <br>
        <span class="detailTitle12">' . Yii::t("aboutus", "0341") . '</span>
        </td>
        </tr>
        <tr>
            <td>
                <img src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas3.png') . '">
            </td>
            <td>
                <img id="cararrow" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'cararrow.png') . '">
            </td>
        </tr>
        </table>
       </div>
    </div>
</div>
<div class="ellipse">
   <img src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas10.png') . '">
   <img id="fst1" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas12.png') . '">
</div>

<div class="twod" >
    <table>
        <tr>
            <td>
                <span class="detailTitle1">' . Yii::t("aboutus", "0342") . '</span>
                <br>
                <span class="detailTitle13"> ' . Yii::t("aboutus", "0343") . '</span>
                <br>
                <span class="detailTitle1"> ' . Yii::t("aboutus", "0344") . '</span>
                <br>
                <span class="detailTitle14"> ' . Yii::t("aboutus", "0345") . '</span>
            </td>
            <td>
            <div><img id="imtwo" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas8.png') . '"></div>
            </td>
        </tr>
    </table>
    <div>
        <img id="imtwooo" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas9.png') . '">
    </div>
</div>

<div class="detailkop">
    <table>
        <tr>
            <td>
                <span class="detailTitle13">' . Yii::t("aboutus", "0346") . ' </span>
                <span class="detailTitle1">' . Yii::t("aboutus", "0347") . '</span>
                <br>
                <span class="detailTitle14"> ' . Yii::t("aboutus", "0348") . '</span>
                <br>
                <span class="detailTitle1"> ' . Yii::t("aboutus", "0349") . '</span>
                <br>
                <span class="detailTitle15">' . Yii::t("aboutus", "0350") . '</span>
                <br>
                <img id="pig" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas5.png') . '">
                <img id="money" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas4.png') . '">
            </td>
            <td>
              <img id="koppstr" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas7.png') . '">
            </td>
        </tr>
    </table>
</div>
<div  class="detailTitle14" id="four">
    <table>
        <tr>
            <td>
                <img id="question" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'question.png') . '">
                <img id="fst2" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas11.png') . '">
            </td>
            <td class="freelife">
                <span>' . Yii::t("aboutus", "0351") . '</span>
            </td>
        </tr>
    </table>
</div>
<div class="five">
    <span class="detailTitle18">' . Yii::t("aboutus", "0352") . ' </span> <span class="detailTitle17">40 000 - 60 000 </span><span class="detailTitle19">' . Yii::t("profile", "0259") . ' </span><br class="br">
    <span id="fimouns" class="detailTitle12">' . Yii::t("aboutus", "0353") . '</span>
</div>
<img id="firstHum" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas13.png') . '">
<div class="six">
    <table>
        <tr>
            <td>
                <img id="secondHum" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas13.png') . '">
            </td>
            <td>
                <span class="detailTitle1">' . Yii::t("aboutus", "0354") . '</span>
                <span class="detailTitle16">' . Yii::t("aboutus", "0355") . '</span>
            </td>
        </tr>
    </table>
</div>
<div class="how">
    ' . Yii::t("aboutus", "0360") . '
</div>
<div class="jobfu">
    <h1 class="jobTitle marginLeft">' . Yii::t("aboutus", "0356") . '</h1>
    <table class="marginLeft">
        <tr>
            <td>
                <img id="rocketImg" src="' . StaticFilesHelper::createPath('image', 'aboutus', '000pronas14.png') . '">
                <span id="rocketText" class="detailTitle1">   ' . Yii::t("aboutus", "0357") . '</span>
            </td>
        </tr>
    </table>
    <span class="detailTitle1 marginLeft">' . Yii::t("aboutus", "0358") . '</span>
    <h1 id="mashinn" class="marginLeft">' . Yii::t("aboutus", "0359") . '    </h1>
    <ul id="theyy" class="marginLeft" class="detailTitle1">
        ' . Yii::t("aboutus", "0361") . '
    </ul>
    <div>
    <span class="detailTitle1"> ' . Yii::t("aboutus", "0362") . '</span>
    </div>
    <h1 class="mashinn marginLeft" >' . Yii::t("aboutus", "0580") . '    </h1>
    <div>
    <span class="detailTitle1">' . Yii::t("aboutus", "0581") . '</span>
    </div>
    <div>
    <span class="detailTitle1">' . Yii::t("aboutus", "0582") . '</span>
    </div>
    <div>
    <span class="detailTitle1">' . Yii::t("aboutus", "0583") . '</span>
    </div>
    <br>
    <div>
    <span class="detailTitle1">' . Yii::t("aboutus", "0584") . '</span>
    </div>
    <h1 class="marginLeft">' . Yii::t("aboutus", "0585") . '</h1>
    <div>
    <span class="detailTitle1">' . Yii::t("aboutus", "0586") . '</span>
    </div>
    <div>
    <span class="detailTitle1">' . Yii::t("aboutus", "0587") . '</span>
    </div>
    <div>
    <span class="detailTitle1">' . Yii::t("aboutus", "0588") . '</span>
    </div>
    <div>
    <span class="detailTitle1">' . Yii::t("aboutus", "0589") . '</span>
    </div>
</div>
<div>
    <div id="beginn" class="detailTitle12">
        ' . Yii::t("aboutus", "0363") . '
    </div>' . $buttonStart . '</div>
</div>';

$drop2Text = '
<div class="textBox">
    <div class="tabcolumn">
        <p>
            <img class="imgtableft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'robot.png') . '">
            ' . Yii::t("aboutus", "0578") . '
            <img class="imgtableft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'books.png') . '">
            ' . Yii::t("aboutus", "0579") . '
        </p>
        <h3 class="header1">' . Yii::t("aboutus", "0443") . '</h3>
        <img class="img1" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'chair.png') . '">
        <span class="subheader1">' . Yii::t("aboutus", "0444") . '</span>
        <img class="img2" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'man.png') . '">
        <p>' . Yii::t("aboutus", "0445") . '<img class="imgtabright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'calendar.png') . '">' . Yii::t("aboutus", "0446") . '</p>
        ' . Yii::t("aboutus", "0432") . '<img class="imgtableft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'leptop.png') . '">' . Yii::t("aboutus", "0433") . '
    </div>

    <div class="tabcolumn">
        <p>
            <img class="imgtableft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'whale.png') . '">
            <span class="subheader2">' . Yii::t("aboutus", "0434") . '</span><br>' . Yii::t("aboutus", "0435") . '
            <img class="imgtabright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'light.png') . '">
            ' . Yii::t("aboutus", "0436") . '<br>
        </p>
        <p>
            ' . Yii::t("aboutus", "0437") . '
            <img class="imgtabright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'f1.png') . '">
            ' . Yii::t("aboutus", "0438") . '
        </p>
    </div>
    <div class="tabcolumn">
         <p>
            <img class="imgtableft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'ITman.png') . '">
            <span class="subheader3">' . Yii::t("aboutus", "0439") . '</span><br>
            ' . Yii::t("aboutus", "0440") . '
            <img class="imgtabright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'roadsign.png') . '">
            ' . Yii::t("aboutus", "0441") . '
         </p>
         <p>' . Yii::t("aboutus", "0442") . '</p>
         <p><img class="imgtableft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'key.png') . '">' . Yii::t("aboutus", "0447") . '</p>
    </div>
</div>
<div class="benefittitle">
    <table><tr><td><img class="img13" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'weigher.png') . '"></td><td><h1>' . Yii::t("aboutus", "0448") . '</h1></td></tr></table>
</div>
<div class="benefit">
    <div class="benefitcolumn">
        <p><h3 class="benefitheader">' . Yii::t("aboutus", "0449") . '</h3></p>
        <p><img class="imgleft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'school.png') . '">' . Yii::t("aboutus", "0450") . '</p>
        <p>' . Yii::t("aboutus", "0451") . '</p>
        <p>' . Yii::t("aboutus", "0452") . '</p>
        <p>' . Yii::t("aboutus", "0453") . '</p>
        <p><img class="imgleft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'doc.png') . '">' . Yii::t("aboutus", "0454") . '</p>
        <p><img class="imgright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'diplom.png') . '">' . Yii::t("aboutus", "0455") . '</p>
    </div>
    <div class="benefitcolumn">
        <p><h3 class="benefitheader">' . Yii::t("aboutus", "0456") . '</h3></p>
        <p><img class="imgleft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'inhome.png') . '">' . Yii::t("aboutus", "0457") . '</p>
        <p>' . Yii::t("aboutus", "0458") . '</p>
        <p><img class="imgright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'PC.png') . '">' . Yii::t("aboutus", "0459") . '</p>
        <p><img class="imgleft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'practice.png') . '">' . Yii::t("aboutus", "0460") . '</p>
        <p><img class="imgleft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'win.png') . '">' . Yii::t("aboutus", "0461") . '</p>
        <p><img class="imgright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'system.png') . '">' . Yii::t("aboutus", "0462") . '</p>
    </div>
    <div class="benefitcolumn">
        <p><h3 class="benefitheader">' . Yii::t("aboutus", "0463") . '</h3></p>
        <p><img class="imgright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'OK.png') . '">' . Yii::t("aboutus", "0464") . '</p>
        <p>' . Yii::t("aboutus", "0465") . '</p>
        <p><img class="imgleft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'cube.png') . '">' . Yii::t("aboutus", "0466") . '</p>
        <p><img class="imgright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'notebook.png') . '">' . Yii::t("aboutus", "0467") . '</p>
        <p><img class="imgleft" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'happy.png') . '">' . Yii::t("aboutus", "0468") . '</p>
        <p><img class="imgright" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'job.png') . '">' . Yii::t("aboutus", "0469") . '</p>
    </div>
</div>
';


$drop3Text = '
<div class="faqBox">
    <table>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'weigh.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0470") . '</span><br>' . Yii::t("aboutus", "0481") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'time.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0471") . '</span><br>' . Yii::t("aboutus", "0482") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'dip.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0472") . '</span><br>' . Yii::t("aboutus", "0483") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'cash.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0473") . '</span><br>' . Yii::t("aboutus", "0484") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'pay.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0474") . '</span><br>' . Yii::t("aboutus", "0485") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'pig.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0475") . '</span><br>' . Yii::t("aboutus", "0486") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'contract.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0476") . '</span><br>' . Yii::t("aboutus", "0487") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'rich.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0477") . '</span><br>' . Yii::t("aboutus", "0488") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'calculation.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0478") . '</span><br>' . Yii::t("aboutus", "0489") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'old.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0479") . '</span><br>' . Yii::t("aboutus", "0490") . '</td></tr>
        <tr><td><img class="faqimg" src="' . StaticFilesHelper::createPath('image', 'aboutus', 'wtf.png') . '"></td><td><span class="blueword">' . Yii::t("aboutus", "0480") . '</span><br>' . Yii::t("aboutus", "0491") . '</td></tr>
    </table>
</div>
';
?>

<div id='aboutDetailMain'>
    <div ng-show='openPage==1' id="dropTextLayer1">
        <div class="textBox">
            <?php echo $drop1Text; ?>
        </div>
    </div>
    <div ng-show='openPage==2' id="dropTextLayer2">
        <?php echo $drop2Text; ?>
    </div>
    <div ng-show='openPage==3' id="dropTextLayer3">
        <div class="textBox">
            <?php echo $drop3Text; ?>
        </div>
    </div>
</div>