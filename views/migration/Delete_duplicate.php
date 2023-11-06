
<div style='margin-top:100px;'>
    <?
    foreach($duplicates as $duplicate){
        echo"<a href='http://192.168.100.14/web/index.php?r=client/visit&ID_VISIT=$duplicate'>Визит #$duplicate</a> <br>";
    }
    ?>
</div>

<?
