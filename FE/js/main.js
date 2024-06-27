var validate = new Validation();

function DomID(id) {
  var element = document.getElementById(id);
  return element;
}

function DangKy() {
  var HoTen = DomID("HoTen").value;
  var tenDangNhap = DomID("tenDangNhap").value;
  var matKhau = DomID("matKhau").value;
  var nhapLaiMatKhau = DomID("nhapLaiMatKhau").value;
  //   var gioiTinh = DomID("gioiTinh").value;
  var email = DomID("Email").value;
  var sdt = DomID("SDT").value;
  var errorUsername = DomID("errorUsername");
  var errorPassword = DomID("errorPassword");
  var errorConfirm = DomID("errorConfirmPassword");
  var loi = 0;
  if (KiemTraDauVaoRong("HoTen", HoTen) == true) {
    loi++;
  }
  if (KiemTraDauVaoRong("tenDangNhap", tenDangNhap) == true) {
    loi++;
  }
  if (validate.KiemTraTaiKhoan(tenDangNhap) == false) {
    loi++;
    DomID("tenDangNhap").style.borderColor = "red";
    errorUsername.style.display = "block";
    errorUsername.innerHTML = "Bắt đầu bằng chữ<br>Độ dài từ 8 -> 20 ký tự";
  } else {
    DomID("tenDangNhap").style.borderColor = "green";
    errorUsername.style.display = "none";
  }
  if (KiemTraDauVaoRong("matKhau", matKhau) == true) {
    loi++;
  }
  if (validate.KiemTraMatKhau(matKhau) == false) {
    loi++;
    DomID("matKhau").style.borderColor = "red";
    errorPassword.style.display = "block";
    errorPassword.innerHTML = "Phải có chữ và số <br> Độ dài từ 8 -> 20 ký tự";
  } else {
    DomID("matKhau").style.borderColor = "green";
    errorPassword.style.display = "none";
  }
  if (KiemTraDauVaoRong("nhapLaiMatKhau", nhapLaiMatKhau) == true) {
    loi++;
  }
  if (matKhau == nhapLaiMatKhau) {
    errorConfirm.style.display = "none";
  } else {
    errorConfirm.style.display = "block";
    errorConfirm.innerHTML = "không trùng khớp";
    DomID("nhapLaiMatKhau").style.borderColor = "red";
    loi++;
  }
  //   if (KiemTraDauVaoRong("gioiTinh", gioiTinh) == true) {
  //     loi++;
  //   }
  if (validate.KiemTraRong(email) == true) {
  } else {
    if (validate.KiemTraEmail(email) == false) {
      document.getElementById("Email").value = "";
      document.getElementById("Email").placeholder = "Sai định dạng";
      loi++;
    }
  }
  if (validate.KiemTraRong(sdt) == true) {
  } else {
    if (validate.KiemTraSoDT(sdt) == false) {
      document.getElementById("SDT").value = "";
      document.getElementById("SDT").placeholder = "Sai định dạng";
      loi++;
    }
  }
  if (loi === 0) {
    return true;
  }
  return false;
}

function DangNhap() {
  var tenDangNhap = DomID("tenDangNhap").value;
  var matKhau = DomID("matKhau").value;
  var loi = 0;
  if (KiemTraDauVaoRong("tenDangNhap", tenDangNhap) == true) {
    loi++;
  }
  if (KiemTraDauVaoRong("matKhau", matKhau) == true) {
    loi++;
  }

  if (loi != 0) {
    return false;
  } else {
    return true;
  }
}

function DoiMK() {
  var oldPassword = DomID("oldPassword").value;
  var newPassword = DomID("newPassword").value;
  var confirmNewPassword = DomID("confirmNewPassword").value;
  var erroroldPassword = DomID("errorOldPassword");
  var errorNewPassword = DomID("errorNewPassword");
  var errorConfirmNewPassword = DomID("errorConfirmNewPassword");
  var loi = 0;
  if (KiemTraDauVaoRong("oldPassword", oldPassword) == true) {
    loi++;
  }
  if (KiemTraDauVaoRong("newPassword", newPassword) == true) {
    loi++;
  }
  if (validate.KiemTraMatKhau(newPassword) == false) {
    loi++;
    DomID("newPassword").style.borderColor = "red";
    errorNewPassword.style.display = "block";
    errorNewPassword.innerHTML = "Phải có chữ và số <br> Độ dài từ 8 -> 20 ký tự";
  } else {
    DomID("newPassword").style.borderColor = "green";
    errorNewPassword.style.display = "none";
  }
  if (KiemTraDauVaoRong("confirmNewPassword", confirmNewPassword) == true) {
    loi++;
  }
  if (newPassword == confirmNewPassword) {
    errorConfirmNewPassword.style.display = "none";
  } else {
    errorConfirmNewPassword.style.display = "block";
    errorConfirmNewPassword.innerHTML = "không trùng khớp";
    DomID("confirmNewPassword").style.borderColor = "red";
    loi++;
  }
  if (loi === 0) {
    return true;
  }
  return false;
}

function CapNhatTT() {
  var HoTen = DomID("HoTen").value;
  var EmailND = DomID("EmailND").value;
  var SDTND = DomID("SDTND").value;
  var DiaChiND = DomID("DiaChiND").value;
  var errorHoTen = DomID("errorHoTen");
  var errorEmailND = DomID("errorEmailND");
  var errorSDTND = DomID("errorSDTND");
  var errorDiaChiND = DomID("errorDiaChiND");
  var loi = 0;
  if (KiemTraDauVaoRong("HoTen", HoTen) == true) {
    loi++;
    errorHoTen.style.display = "block";
    errorHoTen.innerHTML = "Vui lòng nhập họ và tên";
  } else {
    DomID("errorHoTen").style.borderColor = "green";
    errorHoTen.style.display = "none";
  }
  if (KiemTraDauVaoRong("EmailND", EmailND) == true) {
    loi++;
  }
  if (validate.KiemTraEmail(EmailND) == false) {
    loi++;
    errorEmailND.style.display = "block";
    errorEmailND.innerHTML = "Định dạng: name@email.com";
  } else {
    DomID("errorEmailND").style.borderColor = "green";
    errorEmailND.style.display = "none";
  }
  if (KiemTraDauVaoRong("SDTND", SDTND) == true) {
    loi++;
    errorSDTND.style.display = "block";
    errorSDTND.innerHTML = "Định dạng: 0123456789";
  } else {
    DomID("errorSDTND").style.borderColor = "green";
    errorSDTND.style.display = "none";
  }
  if (validate.KiemTraSoDT(SDTND) == false) {
    loi++;
  }
  if (KiemTraDauVaoRong("DiaChiND", DiaChiND) == true) {
    loi++;
    errorDiaChiND.style.display = "block";
    errorDiaChiND.innerHTML = "Không để trống địa chỉ";
  } else {
    DomID("errorDiaChiND").style.borderColor = "green";
    errorDiaChiND.style.display = "none";
  }
  if (loi === 0) {
    return true;
  }
  return false;
}

function KiemTraDauVaoRong(ID, value) {
  if (validate.KiemTraRong(value) == true) {
    DomID(ID).style.borderColor = "red";
    DomID(ID).placeholder = "Nhập thông tin vào đây!";

    return true;
  } else {
    DomID(ID).style.borderColor = "green";
    return false;
  }
}
