function previewImage(event) {
	let reader = new FileReader();
	reader.onload = function () {
		let output = document.getElementById('preview');
		output.src = reader.result;
		
		let confirmButton = document.getElementById('btnUpdateImageAccount');
		confirmButton.style.display = 'inline-block';
		let exitButton = document.getElementById('btnExitUpdateImageAccount');
		exitButton.style.display = 'inline-block';
	};
	reader.readAsDataURL(event.target.files[0]);
}

function exitBtn() {
	var output = document.getElementById('preview');
	output.src = 'assets/images/404.jpg';

	let confirmButton = document.getElementById('btnUpdateImageAccount');
	confirmButton.style.display = 'none';
	let exitButton = document.getElementById('btnExitUpdateImageAccount');
	exitButton.style.display = 'none';
}

function showPassEdit() {
	let a = document.getElementById("passwordEdit");
	let b = document.getElementById("showPassEdit");
	if (a.type == "password") {
		a.type = "text";
		b.innerHTML = "Ẩn mật khẩu";
	} else {
		a.type = "password";
		b.innerHTML = "Hiện mật khẩu";
	}
};

function showPass() {
	let a = document.getElementById("password");
	let b = document.getElementById("showPass");
	if (a.type == "password") {
		a.type = "text";
		b.innerHTML = "Ẩn mật khẩu";
	} else {
		a.type = "password";
		b.innerHTML = "Hiện mật khẩu";
	}
};

function showRePass() {
	let a = document.getElementById("repassword");
	let b = document.getElementById("showRePass");
	if (a.type == "password") {
		a.type = "text";
		b.innerHTML = "Ẩn mật khẩu";
	} else {
		a.type = "password";
		b.innerHTML = "Hiện mật khẩu";
	}
};


function showPassOld() {
	let x = document.getElementById("passwordOld");
	let y = document.getElementById("showPassOld");
	if (x.type == "password") {
		x.type = "text";
		y.innerHTML = "Ẩn mật khẩu";
	} else {
		x.type = "password";
		y.innerHTML = "Hiện mật khẩu";
	}
};

function showPassNew() {
	let x = document.getElementById("passwordNew");
	let y = document.getElementById("showPassNew");
	if (x.type == "password") {
		x.type = "text";
		y.innerHTML = "Ẩn mật khẩu";
	} else {
		x.type = "password";
		y.innerHTML = "Hiện mật khẩu";
	}
};

function showPassRenew() {
	let x = document.getElementById("passwordRenew");
	let y = document.getElementById("showPassRenew");
	if (x.type == "password") {
		x.type = "text";
		y.innerHTML = "Ẩn mật khẩu";
	} else {
		x.type = "password";
		y.innerHTML = "Hiện mật khẩu";
	}
};