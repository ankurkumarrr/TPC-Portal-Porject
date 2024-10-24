<?php
echo "Your have rejected the candidate successfully<br>
You will be redirected to your dashboard shortly...";
?>
<script>
setTimeout(function() {
    window.location.href = "welcome_company.php";
}, 5000);

</script>