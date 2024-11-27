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
    <script src="node_modules\jquery\dist\jquery.min.js"></script>
    <script src="node_modules\formBuilder\dist\form-builder.min.js"></script>
    <script src="node_modules\formBuilder\dist\form-render.min.js"></script>
    <script src="node_modules\jquery-ui-sortable\jquery-ui.min.js"></script>
    <script src="node_modules\sweetalert2\dist\sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css" rel="stylesheet">
        <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Form Builder</title>

    <script>
        var form_code = "<?php echo $code ?>";
    </script>


<style>
    table th,
    table td {
        padding: 3px !important
    }

    .FormHeader {
  height: 278px;
}
.FormContent1 {
  color: rgba(0,0,0,.87);
  padding: 20px 35px
}

.FormContentWrapper {
  display: -webkit-box;
  display: -moz-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  box-orient: vertical;
  -webkit-flex-direction: column;
  flex-direction: column
}

.ctrlqAccent {
  background-color: #673bb7;
  height: 8px;
}
.FormContent {
  margin: auto;
  width: 600px; 
}
.FormCard {
  background-color: #fff;
  margin-bottom: 48px;
  -webkit-box-shadow: 0 1px 4px 0 rgba(0,0,0,0.37);
  box-shadow: 0 1px 4px 0 rgba(0,0,0,0.37);
  word-wrap: break-word
}

.FormCard:first-of-type {
  margin-top: -100px
}

.ctrlqHeaderTitle {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  font-size: 34px;
  line-height: 135%;
  max-width: 100%;
  min-width: 0%;
  margin-bottom: 22px
}

@media (max-width: 660px) {
  .FormHeader {
    height: 122px;
  }
  .FormCard:first-of-type {
    margin-top: -50px;
  }

  .FormContent {
    width: 90%;
  }
}

div.error {
  position: relative;
  top: -1rem;
  left: 0rem;
  font-size: 0.8rem;
  color: #FF4081;
  -webkit-transform: translateY(0%);
  -ms-transform: translateY(0%);
  -o-transform: translateY(0%);
  transform: translateY(0%);
}

input[type="radio"]:checked+label:after, [type="radio"].with-gap:checked+label:after{
 background-color: #673bb7;
}

input[type="radio"]:checked+label:after, [type="radio"].with-gap:checked+label:before, [type="radio"].with-gap:checked+label:after {
border: 2px solid #673bb7;
}

input[type=text]:not(.browser-default):focus:not([readonly]) {
    border-bottom: 1px solid #673bb7;
    /* box-shadow: 0 0 0 0 var(#673bb7); */
}


input[type="checkbox"]:checked + span:not(.lever)::before{
    border:2px solid transparent;
    border-bottom:2px solid #006AB5;
    border-right:2px solid #006AB5;
    background:transparent;
}
.checkbox[type="checkbox"]:checked + span:not(.checkbox)::after {
    border: 2px solid transparent;
    background-color: var(--color-primary);
}
[type="checkbox"]:checked+label:before {
    top: -4px;
    left: -5px;
    width: 12px;
    height: 22px;
    border-top: 2px solid transparent;
    border-left: 2px solid transparent;
    border-right: 2px solid #673bb7;
    border-bottom: 2px solid #673bb7;
}
</style>


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

   
                <div class="input-field col s12">
                  <label for="name" class="">Your Name</label>
                  <input id="name" name="name" type="text" class="validate" data-error="#e1" required="" aria-required="true">
                  <div id="e1"></div>
                </div>
          

    <!-- <input id="name" name="name" type="text" class="validate" data-error="#e1" required> -->
         <div class="w-100 d-flex justify-content-center">
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

    // for(let i=0; i<fbRender.childNodes.length; i++){
    //     formbuilderDivClass.childNodes[i].className="input-field";
    // }

  


   
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
</script>
