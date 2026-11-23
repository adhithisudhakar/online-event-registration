<!DOCTYPE html>
<html>
<head>
<title>Available Dates</title>

<link rel="stylesheet" href="style.css">

<style>

/* 🔥 CALENDAR BOX (UPDATED PROFESSIONAL STYLE) */
.calendar-box {
    background: rgba(15, 23, 42, 0.85);
    padding: 20px 25px;
    border-radius: 20px;
    text-align: center;
    max-width: 700px;
    width: 100%;

    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);

    box-shadow: 0 10px 30px rgba(0,0,0,0.6);
    border: 1px solid rgba(255,255,255,0.1);

    margin: auto;
}

/* TITLE IMPROVE */
.calendar-box .title {
    font-size: 28px;
    margin-bottom: 10px;
    letter-spacing: 1px;
}

/* INPUT + BUTTON */
.top-box {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-top: 15px;
}

.top-box input[type="month"] {
    width: 200px;
    height: 42px;
    padding: 0 12px;
    border-radius: 10px;
    border: none;
    outline: none;
}

.top-box .btn {
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* 🔥 CALENDAR GRID */
.calendar {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 10px;
    margin-top: 25px;
}

/* DAY */
.day {
    padding: 18px;
    font-size: 16px;
    border-radius: 10px;
    text-align: center;
    font-weight: bold;
    transition: 0.3s;
}

/* COLORS */
.available {
    background: #27ae60;
    cursor: pointer;
}

.available:hover {
    background: #2ecc71;
    transform: scale(1.05);
}

.booked {
    background: #e74c3c;
    cursor: not-allowed;
}

/* BACK BUTTON */
.back-btn {
    margin-top: 20px;
}

</style>
</head>

<body>

<!-- ✅ NAVBAR -->
<header>
    <div class="logo">
        <img src="logo.jpg">
        <span>Alagappa University</span>
    </div>

    <nav>
        <a href="index.html">Home</a>
        <a href="about.html">About</a>
        <a href="speakers.html">Speakers</a>
        <a href="register.html">Register</a>
        <a href="contact.html">Contact</a>
    </nav>
</header>

<!-- ✅ BACKGROUND -->
<section class="hero register-hero">
<div class="overlay">
<div class="content">

<!-- 🔥 MAIN BOX -->
<div class="calendar-box">

<h1 class="title">Check Available Dates</h1>

<div class="top-box">
    <input type="month" id="month">
    <button onclick="loadDates()" class="btn">Check</button>
</div>

<div id="result"></div>

<a href="register.html" class="btn back-btn">⬅ Back to Booking</a>

</div>

</div>
</div>
</section>

<script>
function loadDates() {

    let month = document.getElementById("month").value;

    if (month == "") {
        alert("Select month first");
        return;
    }

    fetch("calendar_data.php?month=" + month)
    .then(res => res.text())
    .then(data => {
        document.getElementById("result").innerHTML = data;
    });
}

function selectDate(date) {
    window.location.href = "register.html?date=" + date;
}
</script>

</body>
</html>