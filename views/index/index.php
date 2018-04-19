<?php


namespace humhub\modules\phonebook\views\index;

use Yii;
use yii\helpers\Html;
use humhub\modules\user\widgets\Image;
use humhub\modules\user\models\Profile;
use humhub\modules\user\models\User;
use humhub\modules\directory\widgets\UserGroupList;


// Register our module assets, this could also be done within the controller
\phonebook\humhub\modules\phonebook\assets\Assets::register($this);

    
$memberListSortField = 'lastname';
$pageSize = 100;
$users = User::find()
                ->addSelect(['*', 'user.*', 'profile.*'])
                ->joinWith('profile')           
                ->active()
                ->limit(100) //how many users should be shown on one page
                ->all();
$keyword = Yii::$app->request->get('keyword', "");
$page = (int) Yii::$app->request->get('page', 1);

$global_number = '+4350148';

$label_field1 = 'Foto';
$label_field2 = 'Kürzel';
$label_field3 = 'Name';
$label_field4 = 'Festnetz';
$label_field5 = 'Handy';
$label_field6 = 'E-Mail';
$label_field7 = 'Position';
$label_field8 = 'Abteilung';

?>
<style>
tr{border-left:3px solid white}
table th{font-size:16px;text-align:center;padding-bottom:10px;}
.tbody:hover {background-color:#f7f7f7;border-left:3px solid #e10000}
</style>
<script>


function gi(name)
{
	return document.getElementById(name);
}
function filter_table() {
  // Declare variables
  var input, filter, table, tr, td, i;
  input = gi("search");
  filter = input.value.toLowerCase();
  table = gi("table-data");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    tds = tr[i].getElementsByTagName("td");
	var sh = "none";
	var j;
	for(j = 0; j < tds.length; j++)
	{
		if(tds[j])
		{
		  var str = tds[j].textContent || tds[j].innerHTML;
		  if(str.toLowerCase().indexOf(filter) > -1)
		  {
			sh = "";
			break;
		  }
		}
	}
	tr[i].style.display = sh;
  }
}

function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = gi("table");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc";
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("TR");
	if(rows.length > 300) return;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.textContent.toLowerCase() > y.textContent.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.textContent.toLowerCase() < y.textContent.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
// JavaScript Document
</script>



<div class="panel panel-default">

    

    <div class="panel-body">
<br>
        <?= Html::beginForm('', 'get', ['class' => 'form-search']); ?>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="form-group form-group-search">
                    <?= Html::hiddenInput('page', '1'); ?>
                    <?= Html::textInput("keyword", $keyword, ['id'=>'search', 'onkeyup'=>'filter_table()', 'class' => 'form-control form-search', 'placeholder' => Yii::t('DirectoryModule.base', 'search for members')]); ?>
                    
                </div>

            </div>
            <div class="col-md-3"></div>
        </div>
        <?= Html::endForm(); ?>

       
    </div>

  
<br>
<table id="table" class="main-table">
<thead>
			<tr class="thead" style="vertical-align:middle;text-align:center;" height:40px;">
				
				
				<th width="5%" ><?= $label_field1 ?></th>
				<th width="5%" ><?= $label_field2 ?></th>
				<th width="15%" ><?= $label_field3 ?></th>
				<th width="5%" ><?= $label_field4 ?></th>
				<th width="10%" ><?= $label_field5 ?></th>
				<th width="15%" ><?= $label_field6 ?></th>
				<th width="20%" ><?= $label_field7 ?></th>
				<th width="15%" ><?= $label_field8 ?></th>
				
			</tr>

			</thead>


<tbody id="table-data">

<?php foreach ($users as $user) : ?>
<?php $field1 = $user->getProfileImage()->getUrl(); ?>
<?php $field2 = Html::encode($user->profile->kuerzel); ?>
<?php $field3 = Html::encode($user->profile->lastname); ?>
<?php $field4 = Html::encode($user->profile->firstname); ?>
<?php $field5 = Html::encode($user->profile->festnetz); ?>
<?php $field6 = Html::encode($user->profile->handy); ?>
<?php $field7 = Html::encode($user->email); ?>
<?php $field8 = Html::encode($user->profile->title); ?>
<?php $field9 = UserGroupList::widget(['user' => $user]); ?>

<tr class="tbody" style="text-align:center;border-top: 1px solid #eee;">

<td style="padding:10px;">
<a href="<?php echo $user->getUrl(); ?>">
<img src="<?= $field1 ?>" class="img-rounded tt img_margin"
                     height="80" width="80" alt="80x80" style="width: 80px; height: 80px; "
                     data-toggle="tooltip" data-placement="top" title=""
                     data-original-title="<?= $field3 ?>&nbsp;<?= $field4 ?>">
            </a></td>
<td ><?= $field2 ?></td>
<td><a style="color: #e10000;font-weight: 700;font-size: 13px;text-decoration: underline;" href="<?= $user->getUrl(); ?>"><?= $field3 ?>&nbsp;<?= $field4 ?></a></td>
<td><a href="tel:<?= $global_number ?><?= $field5 ?>"><?= $field5 ?></a></td>
<td><a href="tel:<?= $field6 ?>"><?= $field6 ?></a></td>
<td><a style="color: #e10000;font-weight: 700;font-size: 13px;text-decoration: underline;" href="mailto:<?= $field7 ?>"><?= $field7 ?></a></td>
<td><?= $field8 ?></td>
<td><small><?= $field9 ?></small></td>
</tr>
<?php endforeach; ?>
</table>
<hr>


</div>


