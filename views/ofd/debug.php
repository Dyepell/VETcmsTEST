<?php
    use MercuryAPI\MercuryWrapper;


    function dump($arr){
        echo '<pre>'.print_r($arr, true).'</pre>';
    }
?>
<div class="container-fluid row" style="margin-top: 70px;margin-bottom: 50px;">
    <h1>Debug</h1>
    <div class="col-lg-8">
        <h3>Requests</h3>
        <a href="#" id ="GetDriverInfo" class="btn btn-success request">GetDriverInfo</a>
        <a href="#" id ="GetGoodsBase" class="btn btn-success request">GetGoodsBase</a><br><br>
        <a href="#" id ="OpenSession" class="btn btn-success request">OpenSession</a>
        <a href="#" id ="CloseSession" class="btn btn-success request">CloseSession</a> <br><br>
        <a href="#" id ="OpenShift" class="btn btn-success request">OpenShift</a>
        <a href="#" id ="CloseShift" class="btn btn-success request">CloseShift</a> <br><br>
        <a href="#" id ="CreateCheck" class="btn request btn-warning">CreateCheck</a>
        <a href="#" id ="OpenCheck" class="btn btn-success request">OpenCheck</a>
        <a href="#" id ="AddGoods" class="btn btn-success request">AddGoods</a>
        <a href="#" id ="CloseCheck" class="btn btn-success request">CloseCheck</a>
        <a href="#" id ="ResetCheck" class="btn btn-danger request">ResetCheck</a>
    </div>
    <div class="col-lg-4">
        <h3>Response</h3>

        <textarea id="response" style="width: 100%; height: 500px;word-wrap: break-word;background-color: #d1cccc; border-radius: 15px; padding: 15px; font-size: 20px " >

        </textarea>
    </div>
</div>

<?php
$js = <<<JS
var spinner = (function () {
    var spinnerHtml =
        $('<div class="modal fade" id="spinner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">' +
            '<div class="modal-dialog">' +
            '<div class="modal-content">' +
            '<div class="modal-body">' +
            '<h5 align="center"><img src="/web/images/loading.gif" style="margin-left: -10px; margin-right: 10px"/></h5> <br>' +
            '<h5 align="center">Запрос выполняется...</h5>' +
            '<div align="center"><a href="#" id ="exit" class="btn btn-danger request" style = "">Отмена</a></div>' +
            '</div>' +
            '</div>' +
            '</div>' +
            '</div>');
 
    return {
        start: function start() {
            spinnerHtml.modal('show');
        },
        stop: function stop() {
            spinnerHtml.modal('hide');
        }
    };    
})();

$(document).on({
    ajaxStart: function() { spinner.start();},
     ajaxStop: function() { spinner.stop(); }    
});

function getGet(name) {
    var s = window.location.search;
    s = s.match(new RegExp(name + '=([^&=]+)'));
    return s ? s[1] : false;
}

let requestButtons = document.querySelectorAll(".request");
let out = document.querySelector('#response'); 

for (let button of requestButtons) {
    
    button.addEventListener("click", (r) => {
        $.ajax({
            url:  'index.php?r=ofd/mercurydebug&request=' + r.target.id,
            type: 'POST',
                success: function(response) {
                    console.log(response);
                    out.innerHTML = response;
                }
            });
        return false;
    })
}
JS;

$this->registerJs($js);?>

