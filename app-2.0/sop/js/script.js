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

function timeEstCalc(context) {
  // console.log("Checkbox clicked...");
  let totalResTimeContext = context.find("#totalSopTimeEst");
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

function sendTabIdsToCurrentModal(id) {
  try {
    $(window.modal_user_id).val(id);
    alert('Percobaan Berhasil!');
  } catch (e) {
    alert('Terjadi kesalahan pada program. . .\nPesan: ' + e);
  }
}

function validateSopForm(context) {
  try {
    if (!confirm('Waktu akan dijalankan. Apa anda yakin untuk memulai?')) { return false; }
    let checkboxArr = context.pilihan_jenis_perawatan,
      timeStamp = context.time_stamp.value,
      // id_user = context.id_user.value,
      id_user = context.modal_user_id.value,
      totalSopTimeEst = context.totalSopTimeEst.value;

    let checkArr = [], dataCheckboxArr = [];

    //! Validasi inputan file image disini!

    for (let i = 0; i < checkboxArr.length; i++) {
      checkArr.push(checkboxArr[i].checked);
      dataCheckboxArr.push(checkboxArr[i].value)
    }

    if (!checkArr.includes(true)) {
      alert("Checkbox tidak boleh kosong!");
      return false;
    }

    const OBJ_PROP_PREFIX = 'timer',
      SOPS_TAB_ID_PREFIX = '_';
    const DYNAMIC_OBJ_PROP = OBJ_PROP_PREFIX + id_user,
      DYNAMIC_SOPS_TAB_ID = SOPS_TAB_ID_PREFIX + id_user;

    if (typeof dynamicTimerObj == 'undefined') {
      dynamicTimerObj = {};
    }

    dynamicTimerObj[DYNAMIC_OBJ_PROP] = new Timer(DYNAMIC_SOPS_TAB_ID);
    dynamicTimerObj[DYNAMIC_OBJ_PROP].startTimer(totalSopTimeEst);

    console.log(dynamicTimerObj);

    $('.scotch-open').remove();
    alert("Form Dikirim! Timer SOP telah dimulai...");
    $(`#${DYNAMIC_SOPS_TAB_ID} #startSopBtn`).prop('disabled', true);
    $(`#${DYNAMIC_SOPS_TAB_ID} #stopSopBtn`).prop('disabled', false);
    return false;
  } catch (e) {
    alert('Terjadi kesalahan pada program...\nPesan Error: ' + e);
    return false;
  }
}

function stopSop(id) {
  if (!confirm('Waktu SOP sedang berjalan, Apa anda yakin untuk berhenti sekarang?')) { return false; }

  const OBJ_PROP_PREFIX = 'timer', OBJ_PROP_SUFFIX = id;
  const DYNAMIC_OBJ_PROP = OBJ_PROP_PREFIX + OBJ_PROP_SUFFIX;

  dynamicTimerObj[DYNAMIC_OBJ_PROP].stopTimer();
}

// Timer Class
class Timer {
  #timer_id;
  #resultTime;
  #countup_timer;

  #el_timer;
  #el_startBtn;
  #el_stopBtn;

  constructor(timer_id) {
    this.#timer_id = timer_id;

    if (this.#timer_id == null) {
      alert('Error On Timer Class: ID Tab Sop tidak ditemukan!');
    } else {
      this.#el_timer = $(`#${this.#timer_id} #hasilDurasiSop`);
      this.#el_startBtn = $(`#${this.#timer_id} #startSopBtn`);
      this.#el_stopBtn = $(`#${this.#timer_id} #stopSopBtn`);

      if (this.#el_timer == null) { alert('Error On Timer Class: ID Timer tidak ditemukan!'); }
      else if (this.#el_startBtn == null) { alert('Error On Timer Class: ID Start Timer Button tidak ditemukan!'); }
      else if (this.#el_stopBtn == null) { alert('Error On Timer Class: ID Stop Timer Button tidak ditemukan!'); }
    }
  }

  startTimer(EstimationTime, starterTime = '00:00:00') {
    let sec = 0, min = 0, hrs = 0;

    this.#countup_timer = setInterval(() => {
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

      this.#el_timer.text(`${hrs}:${min}:${sec}`);
      this.#resultTime = `${hrs}:${min}:${sec}`;

      if (this.#resultTime >= EstimationTime) {
        clearInterval(this.#countup_timer);
        alert("Waktu telah selesai!");
        this.#el_timer.text('00:00');
        this.#el_startBtn.prop('disabled', false);
        this.#el_stopBtn.prop('disabled', true);
        //this.#insertSop(this.#resultTime);
      }
    }, 1000);
  }

  #insertSop(resTime, ket = '-') {
    // Deklarasi Variabel
    var http = new XMLHttpRequest();
    var req, res;

    // Mengambil Data yang akan di kirim
    const REQ_DATA_SET = {
      completedTime: resTime,
      keterangan: ket
    };

    // Menyiapkan Request
    req = `hasilDurasiSop=${REQ_DATA_SET.completedTime}&ket=${REQ_DATA_SET.keterangan}`;

    // Menjalankan fungsi ketika response siap
    http.onreadystatechange = function () {
      // Cek Status response
      if (this.readyState == 4 && this.status == 200) {
        // Konversi string response ke format json
        res = JSON.parse(this.responseText);

        if (res.status) {
          // Menampilkan Alert Sukses
          alert(res.message);
          //window.location.href = "?hal=sop";
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

  stopTimer() {
    let conf = confirm('Anda yakin akan menghentikan Timer?');
    if (conf == true) {
      clearInterval(this.#countup_timer);
      let ket = prompt("Waktu telah dihentikan, silahkan masukan keterangan penghentian waktu...");
      this.#el_timer.text('00:00');
      this.#el_startBtn.prop('disabled', false);
      this.#el_stopBtn.prop('disabled', true);
      //this.#insertSop(this.#resultTime, ket);
    }
  }
}