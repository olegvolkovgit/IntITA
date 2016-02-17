<div class="humStatus">
    <a href="<?php echo Yii::app()->createUrl('/studentreg/profile', array('idUser' => Yii::app()->user->id)); ?>">
        <div class="humavatar"><img src="<?php echo StaticFilesHelper::createPath('image', 'avatars', $post->avatar); ?>"/></div><div class="humName">
            <?php

                    if ($post->firstName == '' && $post->secondName == '' && $post->nickname == '')
                    {
                        echo '<span class="nameNAN">[' . Yii::t('regexp', '0163') . ']<br>[' . Yii::t('regexp', '0160') . ']<br>[' . Yii::t('regexp', '0162') . ']</span>';
                    }
                    else
                    {
                        echo  '<span class="statusColor">'.$post->nickname.'</span><br>'.$post->firstName.'<br>'.$post->secondName;
                    }

            ?><br>
            <span class='statusColor' style="font-size: smaller">&#x25A0; online</span>
        </div>
    </a>
</div>
