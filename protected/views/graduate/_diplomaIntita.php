<div id="editor"></div>
    <button id="print-diploma" onclick="printPDF()">Save</button>
    <div class="diploma-container" id="graduateDiploma">
        <div class="diploma-logo" >
            <img class="img-diploma" src="/images/diploma/logo_diplom.png" alt="logo_diploma_intita">
            </div>
        <h1 class="diploma-header">diploma</h1>
        <p class="certificate">This Sertifies That:</p>
        <h2 class="diploma-owner-name"><?=$name?></h2>
        <p class="student_achievements">has successfully completed the requirements for the
            <br><span>certificate program</span>
            <br>in <span>information technologies</span>
            <br> and meets strong junior level of programmer</p>
        <p class="course"><?=$type?>:</p>
        <h2 class="diploma-owner-name"><?=$model->{'id'.ucfirst($type)}->title_en?></h2>
        <div class="sign">
            <ul>
                <li>CEO: Roman Melnyk</li>
                <li>Date: <?=CLocale::getInstance('en_US')->dateFormatter->formatDateTime((isset($model->date_done)?$model->date_done:$model->end_module),'long',null)?></li>
                </ul>
            <img class="img-diploma" src="/images/diploma/sing_intita.png" alt="director_sign">
            <p class="diplom-number"><?=ucfirst($type[0])?> № 0000-<?="{$model->{'id_'.$type}}-{$model->id_user} "?></p>
            </div>
</div>