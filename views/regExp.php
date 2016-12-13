<?php
include 'header.php';
?>
<style>

    .error
    {
        color: red;
        font-family : Verdana;
        font-size : 8pt;
    }
</style>
<span>Enter Date: </span><input type="text" id="txtDate" />
<span class="error"> Invalid Date.(mm/dd/yyyy or mm-dd-yyyy)
</span>
<br/><br/>
<input id="btnSubmit" type="submit" value="Submit">

<?php
include 'footer.php';
?>
<script>
    $(document).ready(function () {
        $('.error').hide();
        $('#btnSubmit').click(function (event) {
            var dtVal = $('#txtDate').val();
            if (ValidateDate(dtVal))
            {
                $('.error').hide();
            }
            else
            {
                $('.error').show();
                event.preventDefault();
            }
        });
    });

    function ValidateDate(dtValue)
    {
        var dtRegex = new RegExp(/\b\d{1,2}[\/-]\d{1,2}[\/-]\d{4}\b/);
        return dtRegex.test(dtValue);
    }
</script>