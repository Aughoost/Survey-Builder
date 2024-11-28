<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="node_modules\jquery-ui-sortable\jquery-ui.min.js"></script>
    <script src="node_modules\sweetalert2\dist\sweetalert2.all.min.js"></script>
<div class="container">
    <div class="pt-3">
    <h3 >Form List</h3>
    <hr class="border-primary">
    </div>

<div class="col-md-12">
    <table id="forms-tbl" class="table table-stripped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">DateTime</th>
                <th scope="col">Code</th>
                <th scope="col">Title</th>
                <th scope="col">URL</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
                $forms = $db->conn->query("SELECT * FROM `form_list` order by date(date_created) desc");
                while($row = $forms->fetch_assoc()):
            ?>
                <tr>
                    <th scope="row"><?php echo $i++ ?></th>
                    <td><?php echo date("M d,Y h:i A",strtotime($row['date_created'])) ?></td>
                    <td><?php echo $row['form_code'] ?></td>
                    <td><?php echo $row['title'] ?></td>
                    <td><a href="./form.php?code=<?php echo $row['form_code'] ?>">form.php?code=<?php echo $row['form_code'] ?></a></td>
                    <td class='text-center'>
                        <a href="./index.php?p=view_form&code=<?php echo $row['form_code'] ?>" class="btn btn-default border">View</a>
                        <a href="./index.php?p=view_responses&code=<?php echo $row['form_code'] ?>" class="btn btn-default border">Responses</a>
                        <a href="javascript:void(0)" class="btn btn-default border rem_form" data-id='<?php echo $row['form_code'] ?>'><span class="fa fa-trash text-danger"></span></a>
                    </td>
                </tr>
            <?php endwhile;  ?>
        </tbody>
    </table>
</div>
<script>
    $(function(){
        $('#forms-tbl').dataTable();
        $('.rem_form').click(function(){
            start_loader();
            console.log($(this).attr('data-id'))
            // var _conf = confirm("Are you sure to delete this data?")

            var _conf =   Swal.fire({
  title: "Do you want to save the changes?",
  showDenyButton: true,
  showCancelButton: true,
  confirmButtonText: "Delete",
  denyButtonText: `Don't Delete`
}).then((result) => 
{
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {

    $.ajax({
                    url:'classes/Forms.php?a=delete_form',
                    method:'POST',
                    data:{form_code: $(this).attr('data-id')},
                    dataType:'json',
                    error:err=>{
                        console.log(err)
                        alert("an error occured")
                        alert(err)
                    },
                    success:function(resp){
                        if(resp.status == 'success'){
                            Swal.fire({
                    icon: "success",
                    text: 'Deleted Successfully',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1000,
                }).then(function () {
                    window.location.href = "./";
                })

                        }else{
                            console.log(resp)
                        alert("an error occured")
                        }
                    }
                })
  } else if (result.isDenied) {
    Swal.fire("Survey isn't Deleted", "", "info");
  }
});
            end_loader()
        })
    })
</script>
<style>
      .home-section .text {
    display: contents !important;
}
</style>
</div>
