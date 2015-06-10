<?php
/**
 * Created by PhpStorm.
 * User: Ivanna
 * Date: 13.05.2015
 * Time: 15:37
 */
$imagesPath = StaticFilesHelper::createPath('image', 'aboutus', '');
if(Yii::app()->user->isGuest)
    $buttonStart='<div class="buutt" style=""><a class="butstart" href="site#form">'.Yii::t('slider', '0008').'</a></div>';
else $buttonStart='';
$block1->drop1Text='<div  class="aboutStepBlock">
<div style=" " class="oned">
    <span id="spone" style="" class="detailTitle1">'.Yii::t("aboutus","0337").'</span>
    <table>
    <tr>
    <td>
      <img src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas1.png').'">
    </td>
    <td>
  <div>
    <span class="detailTitle12">'.Yii::t("aboutus","0338").'</span>
    <br>
    <span class="detailTitle1">'.Yii::t("aboutus","0339").'</span>
  </div>
    </td>
    </tr>
    </table>
    <div class="imgone"  style="">
       <img src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas2.png').'">
    </div>
  <div class="detailavt">
    <table>
    <tr>
    <td>
    <span class="detailTitle1">'.Yii::t("aboutus","0340").'</span>
    <br>
    <span class="detailTitle12">'.Yii::t("aboutus","0341").'</span>
    </td>
    </tr>
    <tr>
        <td>
            <img src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas3.png').'">
        </td>
    </tr>
    </table>
  </div>
</div>
   <img class="ellipse" style="" src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas10.png').'">
<div class="twod" style=" ">
    <table>
        <tr>
            <td>
                <span class="detailTitle1">'.Yii::t("aboutus","0342").'</span>
                <br>
                <span class="detailTitle13"> '.Yii::t("aboutus","0343").'</span>
                <br>
                <span class="detailTitle1"> '.Yii::t("aboutus","0344").'</span>
                <br>
                <span class="detailTitle14"> '.Yii::t("aboutus","0345").'</span>
            </td>
            <td>
                <img id="imtwo" style="" src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas8.png').'">
            </td>
        </tr>
    </table>
    <div>
        <img id="imtwooo" style="" src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas9.png').'">
    </div>
</div>
<div >
<div style="" class="detailkop">
    <table>
        <tr>
            <td>
                <span class="detailTitle13">'.Yii::t("aboutus","0346").' </span>
                <span class="detailTitle1">'.Yii::t("aboutus","0347").'</span>
                <br>
                <span class="detailTitle14"> '.Yii::t("aboutus","0348").'</span>
                <br>
                <span class="detailTitle1"> '.Yii::t("aboutus","0349").'</span>
                <br>
                <span class="detailTitle15">'.Yii::t("aboutus","0350").'</span>
                <br>
                <img id="pig" style="" src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas5.png').'">
                <img id="money" style="" src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas4.png').'">
            </td>
            <td>
                <img id="kopp" style="" src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas6.png').'">
                <img id="koppstr" style="" src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas7.png').'">
            </td>
        </tr>
    </table>
</div>
<div  class="detailTitle14" id="four">
    <table>
        <tr>
            <td>
                <img id="fst1" style="" src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas12.png').'">
                <img id="fst2" style="" src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas11.png').'">
            </td>
            <td>
<span>'.Yii::t("aboutus","0351").'</span>
            </td></tr></table>
</div>
</div>
<div class="five" style="">
                <span class="detailTitle18">'.Yii::t("aboutus","0352").' </span> <span class="detailTitle17">40 000 - 60 000 </span><span class="detailTitle19">'.Yii::t("profile","0259").' </span><br>
                <span id="fimouns" style="" class="detailTitle12">'.Yii::t("aboutus","0353").'</span>
</div>
<div class="six" style="">
    <table>
        <tr>
            <td>
                <img src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas13.png').'">
            </td>
            <td>
<span class="detailTitle1">
      '.Yii::t("aboutus","0354").'</span>
<span class="detailTitle16">'.Yii::t("aboutus","0355").'</span>
            </td>
        </tr>
    </table>
</div>
<div class="how">
    '.Yii::t("aboutus","0360").'
    </div>
<div class="jobfu" style="">
    <h1>'.Yii::t("aboutus","0356").'</h1>
    <table><tr><td>
                <img src="'.StaticFilesHelper::createPath('image', 'aboutus', '000pronas14.png').'">
            </td> <td>
<span class="detailTitle1">   '.Yii::t("aboutus","0357").'</span>
            </td></tr></table>
    <span class="detailTitle1">'.Yii::t("aboutus","0358").'</span>
    <h1 id="mashinn" style="">'.Yii::t("aboutus","0359").'    </h1>
    <ul id="theyy" style="" class="detailTitle1">
        '.Yii::t("aboutus","0361").'
    </ul>
    <div class="sevenn" style="">
<span class="detailTitle1"> '.Yii::t("aboutus","0362").'</span>
    </div>
</div>
<div>
    <div id="beginn" style="" class="detailTitle12">
        '.Yii::t("aboutus","0363").'
    </div>'.$buttonStart.'</div>
</div>';
$block1->drop2Text='<div class="aboutStepBlock"><span class="detailTitle1">Навчання майбутнього сьогодні</span>
<p>Коли мова йде про навчальний заклад, можемо побитися об заклад, що до думки тобі приходять велика будівля з десятками навчальних приміщень, лекційна аудиторія, парти, записники, конспекти, викладачі, лекції, семінари. Така система освіти сформувалася ще у Стародавній Греції, і за кілька тисяч років майже не змінилася. Але зараз світ стоїть на порозі великої революції в освіті, яка назавжди змінить те, як ми навчаємося. Сьогодні технології зробили доступним те, що раніше могли дозволити собі лише одиниці, наймаючи персональних вчителів та репетиторів: персоналізоване навчання.
<p></div><div class="aboutStepBlock"><span class="detailTitle2">“Три кити” Академії ІНТІТА </span>
<p><span class="detailTitle3">Кит перший. Гнучкість та зручність. </span>
<p>Ти можеш самостійно будувати графік навчання, виходячи з власних потреб та цілей. Якщо ти хочеш закінчити навчання та почати працювати вже через рік, обирай інтенсивне навчання та займайся 6-8 годин в день. Якщо ти хочеш освоїти програмування поступово, не жертвуючи іншими важливими для тебе речами, ти можеш займатися ті ж 6-8 годин, але у тиждень.
<p>Не потрібно відвідувати навчальний заклад, Академія з тобою всюди. Навіть якщо ти у місці, де немає звязку та інтернету, ти можеш переглядати лекції в офлайн-режимі, а практичну частину зробити пізніше, коли зявиться доступ.
<p></div><div class="aboutStepBlock"><span class="detailTitle3">Кит другий. Орієнтація на ринок. </span>
<p>Ми даємо тобі лише 100% необхідні знання. Ми поважаємо гуманітарні дисципліни та фундаментальні точні науки, які входять до  складу обовязкових для вивчення у вишах, але переконані, що вони не є обовязковими для того, щоб стати професіоналом у сфері інформаційних технологій. Ми вважаємо, що кожен має вирішувати індивідуально, що вивчати та чим цікавитись за межами своєї професії. У той же час у програмах вишів відсутні критичні для професійного успіху дисципліни, або ж вони викладаються недостатньо професійно (англійська мова для ІТ-спеціалістів, проектний менеджмент тощо). Інформаційні технології - це дисципліна, яка змінюється кожного дня, програми вишів просто не встигають адаптуватися до такої швидкості змін. ІНТІТА слідкує за змінами щодня, і адаптує як навчальну програму, так і зміст окремих предметів за необхідностю миттєво. Ми завжди у пошуку нового матеріалу, який можна передати студентам академії.
<p>Порівнюючи звичайний технічний виш та академію ІНТІТА, ти можеш думати про сімейний універсал та болід Формула-1. Перший підходить для широкого кола завдань, але він значно програє позашляховикам у прохідності, міні-венам у місткості, лімузинам - у комфорті, спротивним автомобілям - у швидкості та керуванні. Другий сконструйовано лише заради максимальної швидкості та маневреності, жертвуючи усім іншим. І в результаті ми не зробимо з тебе універсально освічену людину, яка розбирається потрохи у всьому, ми зробимо тебе професіоналом світового класу в області програмування.
 <p></div><div class="aboutStepBlock"><span class="detailTitle3">Кит третій. Результативність. </span>
<p>На відміну від традиційних закладів, ми не навчаємо задля оцінок. Ми працюємо індивідуально з кожним студентом, щоб досягти 100% засвоєння необхідних знань (а ми даємо лише необхідні знання). Ми не обмежуємо тебе у часі, теоретично ти можеш навчатися як завгодно довго. Ми беремо на себе зобовязання навчити тебе програмуванню, незважаючи на те, які знання у тебе вже є. Єдиними передумовами для початку занять є бажання, час на навчання, наявність хоча б простенького компютера та вміння читати та писати.
<p>Знання, які ти отримаєш, максимально практичні та сучасні. Починаючи з першого заняття, ти робитимеш завдання з реального світу програмування. Ближче до закінчення навчання ти будеш приймати участь у створенні реальних програмних продуктів для ринку.
<p>Ми гарантуємо тобі 100% отримання пропозиції про працевлаштування протягом 4-6-ти місяців після успішного закінчення навчання.
 <p></div><div class="aboutStepBlock"><span class="detailTitle2">ІНТІТА: переваги наочно</span>
 <p>
 <table id="detailTable">
<tr><td><span class="detailTitle2">Традиційне навчання</span></td><td><span class="detailTitle2">ІНТІТА</span></td><td><span class="detailTitle2">Переваги</span></td></tr>
 <tr><td>Необхідність відвідувати заняття у класі</td><td>Навчання у себе вдома</td><td>Комфортна домашня атмосфера, економія часу та коштів на поїздки</td></tr>
 <tr><td>Заняття за фіксованим графіком</td><td>Заняття за індивідуальним графіком</td><td>Можливість підлаштувати графік навчання під власні потреби</td></tr>
<tr><td>Жорстко визначена навчальна програма, привязана до часових рамок (академічний рік)</td><td>Можливість обирати предмети та термін навчання </td><td>Навчання в комфортному темпі за власним графіком, не обмежене часом</td></tr>
<tr><td>Лекції та семінари, як основа навчального процесу (вивчення теорії)</td><td>Практичні заняття з першого дня навчання, створення реальних працюючих проектів</td><td>Отримання реального робочого досвіду вже протягом навчання, портфоліо готових робіт на момент закінчення навчання</td></tr>
<tr><td>Оцінки за якість засвоєних знань за певний час </td><td>Оцінок немає, лише “знання засвоєні” чи “потрібно навчатися далі”</td><td>Навчання до позитивного результату: до повного засвоєння необхідних знань</td></tr>
<tr><td>Диплом про вищу освіту видається через 5-6 років за умови засвоєння великої кількості непрофільних знань (мова, історія, філософія тощо)</td><td>Лише практичні знання, які будуть потрібні тобі у роботі та житті: програмування, англійська мова, побудова карєри на ринку інформаційних технологій, основи життєвого успіху.</td><td>Весь час навчання витрачається на отримання корисних практичних знань, тому термін навчання скорочуються, а кількість практичних засвоєних знань більша, ніж у традиційних закладах.</td></tr>
 </table></div> ';
$block1->drop3Text='
<div class="aboutStepBlock"><span class="detailTitle1"> Питання, які нам часто ставлять</span>
<p><span class="detailTitle3">Скільки триває навчання, як швидко я зможу почати заробляти?
</span><p><ul><li class="listAbout">навчання не має фіксованого терміну і залежить виключно від темпу, який обереш ти.
</li></ul>
<p></div><div class="aboutStepBlock"><span class="detailTitle3">Чи отримаю я державний диплом про освіту?
</span><p><ul><li class="listAbout">ми не видаємо дипломів державного зразка, наша ціль - забезпечити передумови для гарантованого працевлаштування слухачів.
</li></ul>
<p></div><div class="aboutStepBlock"><span class="detailTitle3">Чому навчання коштує так дешево (дорого) у порівнянні з вишем (курсами) Х?
</span><p><ul><li class="listAbout">вартість навчання економічно обгрунтована і буде відроблена менше, ніж за рік роботи на позиції програміста-початківця.
</li></ul>
<p></div><div class="aboutStepBlock"><span class="detailTitle3">У мене зараз немає необхідних коштів, чи можу я навчатися у кредит?
</span><p><ul><li class="listAbout">так, ми пропонуємо гнучкий підхід в оплаті за навчання, детальніше можна вияснити написавши нам листа на електронну пошту. Контакти.
</li></ul>
<p></div><div class="aboutStepBlock"><span class="detailTitle3">Я чув від знайомого, що він освоїв програмування самотужки, це можливо?
</span><p><ul><li class="listAbout">так, на ринку багато “програмістів-самоучок”, але вони, як правило, пройшли довгий шлях для того, щоб навчитись програмуванню, ми - один із ефективних варіантів стати кваліфікованим програмістом за короткий час.
</li></ul>
<p></div><div class="aboutStepBlock"><span class="detailTitle3">У мене у школі було погано з математикою / я давно не займався математикою. Це може завадити мені навчитися програмуванню?
</span><p><ul><li class="listAbout">математика допомагає краще розвинути логічне мислення і знання елементарної математики необхідні обов’язково, проте, не математичне, а логічне мислення визначає наскільки гарний програміст і тільки невеликий відсоток гарних математиків стають професійними програмістами.
</li></ul>
<p></div><div class="aboutStepBlock"><span class="detailTitle3">Мені 34 роки, чи можу я зараз розпочати навчання?
</span><p><ul><li class="listAbout">верхньої вікової межі для того, щоб вивчати програмування - немає, люди і старшого віку розпочинали і досягали гарних результатів. Життєвий досвід людям старшого віку дозволяє ефективніше побудувати навчальний процес і швидше кар’єрно зростати.
</li></ul>
<p></div><div class="aboutStepBlock"><span class="detailTitle3">Я чув думку, що професія програміста технічна, а я - людина творча. Чи підійде програмування мені?
</span><p><ul><li class="listAbout">програмування - це і є творчість, варто спробувати, щоб зрозуміти чи це твоє покликання.
</li></ul>';
?>

<div id='aboutDetailMain'>
    <div id="dropTextLayer1" >
        <div  class="textBox">
            <?php 	echo $block1->drop1Text;	 ?>
        </div>
    </div>
    <div id="dropTextLayer2" >
        <div  class="textBox">
            <?php 	echo $block1->drop2Text;	 ?>
        </div>
    </div>
    <div id="dropTextLayer3">
        <div  class="textBox">
            <?php 	echo $block1->drop3Text;	 ?>
        </div>
    </div>
</div>