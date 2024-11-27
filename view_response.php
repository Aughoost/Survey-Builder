<?php 
extract($_GET);

?>


<?php 
// include "./forms/".$code.".xml";


$mysqli = new mysqli('localhost', 'root', '', 'form_builder_db'); 
 
// Checking for connections
if ($mysqli->connect_error) {
    die('Connect Error (' .
    $mysqli->connect_errno . ') '.
    $mysqli->connect_error);
}
 



$query = "SELECT * FROM `responses` where ResponseList_Id = $id"; 
$result = $mysqli->query($query);
$mysqli->close();
?>


<script src="./js/form-builder.js"></script>
<div class="row">
    <div class="col-lg-12">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h3><b>Response</b></h3>
            </div>
        </div>
    </div>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">Question</th>
      <th scope="col">Answer</th>
    </tr>
  </thead>
  <tbody>
  <?php 
                // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
            ?>
    <tr>
    <td><?php echo $rows['meta_field'];?></td>
    <td><?php echo $rows['meta_value'];?></td>
    </tr>
    <?php
                }
            ?>
  </tbody>
</table>



<hr class="border-dark">


<script>
    $('#form-buidler-action').remove()
    $('.question-item .card-footer, .item-move,[name="choice"],.add_chk, .add_radio,.rem-on-display').remove()
    $('[contenteditable]').each(function() {
        $(this).removeAttr('contenteditable')
    })
    $('.question-item .choice-field').html('')
    var data = $.parseJSON('<?php echo json_encode($data) ?>');
    $(function(){
        $('.question-item').each(function(){
            var item = $(this).attr('data-item')
            if(!!data[item] && data[item]['type'] == 'file'){
                var el = $("<a download>")
                el.attr({
                    href:"./uploads/"+data[item]['value']
                })
                el.text(data[item]['value'])
                $(this).find('.choice-field').append(el)
            }else{
                $(this).find('.choice-field').append(data[item]['value'])
            }
        })
    })
</script>