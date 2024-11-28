<html lang="en">
<head>
  <!-- Required meta tag -->
  <meta charset="utf-8">
</head>
<body>
<script src="node_modules\jquery\dist\jquery.min.js"></script>
  <script src="node_modules\formBuilder\dist\form-builder.min.js"></script>
  <script src="node_modules\formBuilder\dist\form-render.min.js"></script>
  <script src="node_modules\jquery-ui-sortable\jquery-ui.min.js"></script>
  <script src="node_modules\sweetalert2\dist\sweetalert2.all.min.js"></script>
  <!-- jQuery -->
  <form class="form-inline">
  <div class="form-group mb-2" style="margin-left:1rem;">
    <label for="staticEmail2" class="sr-only">Email</label>
    <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Survey Title: ">
  </div>
  <div class="form-group mx-sm-3 mb-2">
    <input type="text" class="form-control" id="survey-title">
  </div>
</form>
  <form id="fb-render" class="fb-render"></form>

  <!-- <div class="build-wrap"></div> -->
  <div class="d-flex w-100 justify-content-center" id="form-buidler-action">
            <button class="btn btn-default border mr-1" type="button" id="clear-all-fields"><i class="fa fa-eraser"></i> Clear All Fields</button>
            <button class="btn btn-default border ml-1" type="button" id="save_form"><i class="fa fa-save"></i> Save Form</button>
</div>
</body>

<!-- 
<div class="setDataWrap">
  <button id="getXML" type="button">Get XML Data</button>
  <button id="getJSON" type="button">Get JSON Data</button>
  <button id="getJS" type="button">Get JS Data</button>
</div> -->


<style>
    .home-section .text {
    display: inline !important;
}
</style>


<script>
jQuery(function($) {
    function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };

  return text.replace(/[&<>"']/g, function(m) { return map[m]; });
}

var options = {
      showActionButtons: false, // defaults: `true`
      disableFields: [
      'file',
      'hidden',
      'paragraph',
    ],
    disabledAttrs: ["name", "className","maxlength","description"],
    };

var ClearFields = {
    
  };
  var fbEditor = document.getElementById('fb-render');
  var formBuilder = $(fbEditor).formBuilder(options);

  const getXML = document.getElementById('save_form')

  const clearFieldsButton = document.getElementById("clear-all-fields")
  clearFieldsButton.addEventListener('click', () => formBuilder.actions.clearFields(), false)


  getXML.addEventListener('click', function() {
    //  alert(formBuilder.actions.getData('xml'));

      var surveyTitle = document.querySelector('#survey-title').value;;
      htmldata = formBuilder.actions.getData('xml');
      const result = formBuilder.actions.save();
      console.log("result:", result);

      if(result.length != 0 ){
        if(surveyTitle.length > 0 &&  surveyTitle.trim().length > 0)
        {
        var new_el = $('<div>')
        var form_el = $('#form-field').clone()
        var form_code = $("[name='form_code']").length > 0 ? $("[name='form_code']").val() : "";
        var title = $('#form-title').text()
        var description = $('#form-description').text()
        form_el.find("[name='form_code']").remove()
        new_el.append(form_el)
        start_loader()
        $.ajax({
            url: "classes/Forms.php?a=save_form",
            method: 'POST',
            data: { form_data: htmldata, title: surveyTitle, form_code: form_code },
            dataType: 'json',
            error: err => {
                console.log(err)
                alert("an error occured")
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                  Swal.fire({
                    icon: "success",
                    text: 'Form has been saved',
                    type: 'success',
                    showConfirmButton: false,
                    timer: 1000,
                }).then(function () {
                    window.location.href = "./";
                })
                }
                end_loader()
            }
        })
        }else{
            Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Survey Title Required",
});
        }
      }else{
        Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "There is no field in the form",
});
      }
  });
});






</script>

</html>