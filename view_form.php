<?php 
extract($_GET);
?>
<script src="./js/form-builder.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="node_modules\formBuilder\dist\form-builder.min.js"></script>
  <script src="node_modules\formBuilder\dist\form-render.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>




<div id="fb-editor"></div>



<div class="d-flex w-100 justify-content-center" id="form-buidler-action">
               <button class="btn btn-default border ml-1" type="button" id="edit_form"><i class="fa fa-edit"></i> Save Form</button>
</div>



<style>
    .home-section .text {
    display: inline !important;
}
</style>


<script>


var  currentpage = `<?php include "./forms/".$code.".xml" ?>`;

console.log(currentpage)
 
let options = {
    dataType: 'xml',
    onSave: function(evt, formData){showPreview(formData)},
    formData: currentpage
  };
  const $fbEditor = $(document.getElementById('fb-editor'));

  const formBuilder = $fbEditor.formBuilder(options);

jQuery(function($) {
  function showPreview(formData) {
    let formRenderOpts = {
      dataType: 'xml',
      formData
    };
    let $renderContainer = $('<form/>');
    $renderContainer.formRender(formRenderOpts);
    let html = `<!doctype html><body class="container"><h1>Preview</h1><hr>${$renderContainer.html()}</body></html>`;
    var formPreviewWindow = window.open('', 'formPreview', 'height=480,width=640,toolbar=no,scrollbars=yes');

    formPreviewWindow.document.write(html);
    var style = document.createElement('link');
    style.setAttribute('href', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css');
    style.setAttribute('rel', 'stylesheet');
    style.setAttribute('type', 'text/css');
    formPreviewWindow.document.head.appendChild(style);
  }
});
  
const editform = document.getElementById("edit_form");
editform.addEventListener("click", EditFuction)

// var formBuilder = $(fbEditor).formBuilder();


function  EditFuction(){

        htmldata = formBuilder.actions.getData('xml');

        console.log(htmldata);

        var  currentpage = `<?php include "./forms/".$code.".xml" ?>`;
        var formcode = `<?php echo $code ?>`
        console.log(formcode)
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
            data: { form_data: htmldata, description: description, title: title, form_code: formcode },
            dataType: 'json',
            error: err => {
                console.log(err)
                alert("an error occured")
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    alert("Form successfully saved")
                    location.href = "./"
                } else {
                    console.log(resp)
                    alert("an error occured")
                }
                end_loader()
            }
        })
}
  
  
  </script>
