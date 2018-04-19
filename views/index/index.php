<?php



use yii\helpers\Html;
use humhub\modules\user\widgets\Image;
use humhub\modules\user\models\Profile;
use humhub\modules\user\models\User;



// Register our module assets, this could also be done within the controller
\phonebook\humhub\modules\phonebook\assets\Assets::register($this);


?>
<style>
tr{border-left:3px solid white}
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
				
				
				<th style="font-size:16px;text-align:center;padding-bottom:10px;" width="5%" >Foto</th>
				<th style="font-size:16px;text-align:center;padding-bottom:10px;" width="5%" >Kürzel</th>
				<th style="font-size:16px;text-align:center;padding-bottom:10px;" width="15%" >Name</th>
				<th style="font-size:16px;text-align:center;padding-bottom:10px;" width="5%" >Festnetz</th>
				<th style="font-size:16px;text-align:center;padding-bottom:10px;" width="10%" >Handy</th>
				<th style="font-size:16px;text-align:center;padding-bottom:10px;" width="15%" >E-Mail</th>
				<th style="font-size:16px;text-align:center;padding-bottom:10px;" width="20%" >Position</th>
				<th style="font-size:16px;text-align:center;padding-bottom:10px;" width="15%" >Abteilung</th>
				
			</tr>

			</thead>


<tbody id="table-data">

<?php foreach ($users as $user) : ?>
<tr class="tbody" style="text-align:center;border-top: 1px solid #eee;">

<td style="padding:10px;"><a href="<?php echo $user->getUrl(); ?>">
                <img src="<?php echo $user->getProfileImage()->getUrl(); ?>" class="img-rounded tt img_margin"
                     height="80" width="80" alt="80x80" style="width: 80px; height: 80px; "
                     data-toggle="tooltip" data-placement="top" title=""
                     data-original-title="<?php echo Html::encode($user->profile->lastname); ?>&nbsp;<?php echo Html::encode($user->profile->firstname); ?>">
            </a></td>
<td ><?= Html::encode($user->profile->kuerzel); ?></td>
<td><a style="color: #e10000;font-weight: 700;font-size: 13px;text-decoration: underline;" href="<?= $user->getUrl(); ?>"><?= Html::encode($user->profile->lastname); ?>&nbsp;<?= Html::encode($user->profile->firstname); ?></a></td>
                       <td><a href="tel:+4350148<?= Html::encode($user->profile->festnetz); ?>"><?= Html::encode($user->profile->festnetz); ?></a></td>
			<td><a href="tel:+4350148<?= Html::encode($user->profile->handy); ?>"><?= Html::encode($user->profile->handy); ?></a></td>
			<td><a style="color: #e10000;font-weight: 700;font-size: 13px;text-decoration: underline;" href="mailto:<?= Html::encode($user->email); ?>"><?= Html::encode($user->email); ?></a></td>
			<td><?= Html::encode($user->profile->title); ?></td>
			<td><?= Html::encode($user->profile->abteilung); ?></td>
</tr>
<?php endforeach; ?>
</table>
<hr>


</div>

<div class="pagination-container">
    <?= \humhub\widgets\LinkPager::widget(['pagination' => $pagination]); ?>
</div>

