<?php
ob_start();
require_once('./classes/DBConnection.php');
$db = new DBConnection();

$code = isset($_GET['code']) ? $_GET['code'] : "";
if (empty($code)) {
    echo "<script> alert('form code is not provided'); location.replace('./')</script>";
    exit;
}
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="node_modules\jquery\dist\jquery.min.js"></script>
    <script src="node_modules\formBuilder\dist\form-builder.min.js"></script>
    <script src="node_modules\formBuilder\dist\form-render.min.js"></script>
    <script src="node_modules\jquery-ui-sortable\jquery-ui.min.js"></script>
    <script src="node_modules\sweetalert2\dist\sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" href="classes\GoogleForms.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        var form_code = "<?php echo $code ?>";
    </script>
</head>

<body style="  background-color: #f0ebf8;">

<div class="FormContentWrapper">
      <div class="FormHeader"></div>
      <div class="FormContent">
        <div class="FormCard">
          <div class="ctrlqAccent"></div>
          <div class="FormContent1">
     

     

          <form id="fb-render" class="fb-render">
          </form>
         <div class="w-100 d-flex justify-content-center test">
            <button class="btn btn-primary" style="background-color:#673bb7"form="form-data" id="get-user-data">Sumbit</button>
        </div>
</div>
</div>
</div>
</div>
    </div>
</body>

</html>

<script>





    const getUserDataBtn = document.getElementById("get-user-data");
    const fbRender = document.getElementById("fb-render");
    // const formbuilderDivClass = document.getElementByClassName("formbuilder-text")[0];
    var currentpage = `<?php include "./forms/" . $code . ".xml" ?>`;
    var Required = true;
 
   
    getUserDataBtn.addEventListener("click", getData);
    function getData() {
        for(var i=0; i < fbRender.elements.length; i++){
            if(fbRender.elements[i].value === '' && fbRender.elements[i].hasAttribute('required')){
                Required = false;
                fbRender.elements[i].className += " is-invalid";
            }
        }
        if(Required != false){
            SaveData();
        }else{
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "Please Input Required Fields",
            });
        }
    }
    jQuery(function ($) {
        var fbTemplate = document.getElementById('fb-template');
        $('.fb-render').formRender({
            dataType: 'xml',
            formData: currentpage
        });
    });

    function SaveData(){
        const formData = JSON.stringify($(fbRender).formRender("userData"))
        const d = new Date();
        let ResponseList_Id = d.valueOf();
        var form_code = "<?php echo $code ?>";
        $.ajax({
            url: "classes/Forms.php?a=save_response",
            method: 'POST',
            data: { FormData: formData, code: form_code, ResponseList_Id: ResponseList_Id },
            // dataType: 'json',
            error: err => {
                console.log(err)
                alert("an error occured");
            },
            success: function (data) {
                Swal.fire({
                    icon: "success",
                    text: 'Survey Answers has been saved',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                }).then(function () {
                    window.location.href = "./";
                })
            }
        });
    }


    var name = jQuery.trim($(".fb-render .formbuilder-text .SampleClass").val());

    var name = $("#txt").val();



$(document).ready(function() {
    $('.fb-render .formbuilder-text .form-control').blur(function(){
    if( $(this).val().length != 0 ) {
        $(this).closest('.formbuilder-text').find(".formbuilder-text-label").css({ "color": "#9e9e9e", "font-size": ".75em", "top":"-25px"  });
        // console.log("test");
    }
    if( $(this).val().length == 0 ) {   
        $(this).closest('.formbuilder-text').find(".formbuilder-text-label").css({ "color": "black", "font-size": "1em", "top":"0"  });
    }
    })
    $('.fb-render .formbuilder-text .form-control').on('click', function() {
        $(this).closest('.formbuilder-text').find(".formbuilder-text-label").css({ "color": "#9e9e9e", "font-size": ".75em", "top":"-25px"  });
    });
});

</script>
