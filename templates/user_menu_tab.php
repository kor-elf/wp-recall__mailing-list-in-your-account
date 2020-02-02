<?php
if (!defined('ABSPATH')) die('No direct access allowed');
?>
<h3>Группы рассылок:</h3>
<?php
    if (empty($groups)) {
?>
        <p><strong>Группы не найдены!</strong></p>
<?php
    } else {
        echo '<ul id="list-group-mailing">';
        foreach ($groups as $groupKey => $groupArr) {
?>
            <li id="group-mailing-<?=$groupArr->id;?>"><?=$groupArr->name;?> - <a href="javascript:;" data-id="<?=$groupArr->id;?>" class="list-group-mailing__loading"> </a></li>
<?php
        }
        echo '</ul>';
    }
