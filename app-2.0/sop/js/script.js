const menuToggle = document.querySelector('.menu-toggle input');
const nav = document.querySelector('nav ul');


menuToggle.addEventListener('click', function () {
  nav.classList.toggle('slide');
});


/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function myFunction1() {
  document.getElementById("myDropdown1").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches('.dropbtn1')) {
    var dropdowns = document.getElementsByClassName("dropdown-content1");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function myFunction2() {
  document.getElementById("myDropdown2").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches('.dropbtn2')) {
    var dropdowns = document.getElementsByClassName("dropdown-content2");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

function myFunction3() {
  document.getElementById("myDropdown3").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function (event) {
  if (!event.target.matches('.dropbtn3')) {
    var dropdowns = document.getElementsByClassName("dropdown-content3");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}

// Menghilangkan Notif dalam interval waktu tertentu
$('#notif').delay(3000).fadeOut(300);

// Var untuk Sop Timer
var resultTime;

function insertSop(resTime, ket = "-") {
  // Deklarasi Variabel
  var http = new XMLHttpRequest();
  var req, res;

  // Mengambil Data yang akan di kirim
  const dataSet = {
    completedTime: resTime,
    keterangan: ket
  };

  // Menyiapkan Request
  req = `hasilDurasiSop=${dataSet.completedTime}&ket=${dataSet.keterangan}`;

  // Menjalankan fungsi ketika response siap
  http.onreadystatechange = function () {
    // Cek Status response
    if (this.readyState == 4 && this.status == 200) {
      // Konversi string response ke format json
      res = JSON.parse(this.responseText);

      if (res.status) {
        // Menampilkan Alert Sukses
        alert(res.message);
        window.location.href = "?hal=sop";
      } else {
        // Error Handling
        alert("Terjadi kesalahan pada Server. Pesan Error : " + res.message);
      }
    }
  };
  // Mengirim Request
  http.open("POST", "konten/sop_insert.php", true);
  http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  http.send(req);
}

function startTimer(timeEstimation) {
  var sec, min, hrs;
  sec = 0;
  min = 0;
  hrs = 0;

  var targetTime;
  targetTime = timeEstimation;

  timer = setInterval(function () {
    sec = parseInt(sec);
    min = parseInt(min);
    hrs = parseInt(hrs);

    sec++;
    if (sec >= 60) {
      min++;
      sec = 0;
    }
    if (min >= 60) {
      hrs++;
      min = 0;
      sec = 0;
    }
    if (sec < 10 || sec == 0) {
      sec = '0' + sec;
    }
    if (min < 10 || min == 0) {
      min = '0' + min;
    }
    if (hrs < 10 || hrs == 0) {
      hrs = '0' + hrs;
    }

    var durasi = document.getElementById("hasilDurasiSop");
    if (durasi != null) {
      durasi.innerHTML = hrs + ':' + min + ':' + sec;
      resultTime = hrs + ':' + min + ':' + sec;
    }

    if (resultTime >= targetTime) {
      clearInterval(timer);
      alert("Waktu telah selesai!");
      insertSop(resultTime);
    }
  }, 1000);
}

function stopTimer() {
  var conf = confirm('Anda yakin akan mengentikan Timer?');
  if (conf == true) {
    clearInterval(timer);
    var ket = prompt("Waktu telah dihentikan, silahkan masukan keterangan penghentian waktu...");
    insertSop(resultTime, ket);
  }
}

function getSopTime() {
  // Deklarasi Variabel
  var http = new XMLHttpRequest();
  var req, res;

  // Menjalankan fungsi ketika response siap
  http.onreadystatechange = function () {
    // Cek Status response
    if (this.readyState == 4 && this.status == 200) {
      // Konversi string response ke format json
      res = JSON.parse(this.responseText);

      if (res.status) {
        // Memulai Timer
        startTimer(res.data);
      } else {
        // Error Handling
        alert("Terjadi kesalahan pada Server. Pesan Error : " + res.message);
      }
    }
  };
  // Mengirim Request
  http.open("GET", "request/sop-time.php", true);
  http.send();
}

function timeEstCalc(context) {
  // console.log("Checkbox clicked...");
  let totalResTimeContext = context.find("#totalSopTime");
  let sopArr = [];

  $('.sop_checkbox').each(function () {
    if ($(this).is(":checked")) {
      sopArr.push($(this).val());
    }
  });

  sopArr = sopArr.toString();

  $.ajax({
    url: "request/sop-time-sum.php",
    method: "POST",
    dataType: "json",
    data: { sopArr: sopArr },
    success: function (res) {
      if (res.status) {
        // console.log(res);
        $(totalResTimeContext[0]).val(res.data != "" ? res.data.total_sop_time_est : "00:00");
      }
    },
    error: function () {
      alert("Terjadi kesalahan!");
    }
  });
}

function validateSopForm(context) {
  if (!confirm('Waktu akan dijalankan. Apa anda yakin untuk memulai?')) {
    return false;
  }
  for (let i = 0; i < context.pilihan_jenis_perawatan.length; i++) {
    if (context.pilihan_jenis_perawatan[i].checked == true) {
      alert("Form Dikirim!");
      return true;
    }
  }
  alert("Checkbox tidak boleh kosong!");
  return false;
}