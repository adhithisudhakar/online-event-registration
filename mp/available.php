<?php
session_start();

$msg = $_SESSION['msg'] ?? "";
$selected = $_SESSION['selected'] ?? "";
$list = $_SESSION['dates'] ?? [];

// clear session
session_unset();
?>

<!DOCTYPE html>
<html>
<head>
<title>Booking Status</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header>
    <div class="logo">
        <img src="logo.jpg">
        <span>Alagappa University</span>
    </div>
</header>

<section class="hero register-hero">
<div class="overlay">
<div class="content">

<h1 class="title">Booking Status</h1>

<!-- MESSAGE -->
<div class="msg">
<?php
if ($msg == "booked") {
    echo "<span style='color:red;'>❌ Date $selected Already Booked</span>";
}
elseif ($msg == "success") {
    echo "<span style='color:lightgreen;'>✅ Booking Successful for $selected</span>";
}
elseif ($msg == "past") {
    echo "<span style='color:orange;'>⚠ Past dates not allowed</span>";
}
?>
</div>

<!-- AVAILABLE DATES -->
<?php if ($msg == "booked") { ?>
<div id="availableDates">
<h3>Available Dates (Same Month)</h3>

<?php
foreach ($list as $d) {
    echo "<span onclick=\"go('$d')\">$d</span>";
}
?>

</div>
<?php } ?>

<br><br>
<a href="register.html" class="btn">⬅ Back to Booking</a>

</div>
</div>
</section>

<script>
function go(date){
    window.location.href = "register.html?date=" + date;
}
</script>

</body>
</html>