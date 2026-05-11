<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Lupa Password</title>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

  <style>

    *{
      margin:0;
      padding:0;
      box-sizing:border-box;
    }

    body{

      min-height:100vh;

      display:flex;
      justify-content:center;
      align-items:center;

      padding:20px;

      font-family:'Poppins',sans-serif;

      background:
      linear-gradient(
        135deg,
        #0f172a 0%,
        #1e3a8a 100%
      );
    }

    .container{
      width:100%;
      max-width:420px;
    }

    .logo-wrapper{
      display:flex;
      justify-content:center;
      margin-bottom:18px;
    }

    .logo-wrapper img{
      width:85px;
      height:95px;
      object-fit:contain;
      filter:drop-shadow(0 10px 20px rgba(0,0,0,.4));
    }

    .card{

      background:
      rgba(26,42,108,0.88);

      backdrop-filter:blur(16px);

      border:
      1px solid rgba(255,255,255,0.08);

      border-radius:28px;

      padding:40px 34px;

      box-shadow:
      0 20px 70px rgba(0,0,0,0.45);

      animation:fadeUp .5s ease;

      transition:.3s ease;
    }

    .card:hover{

      transform:translateY(-3px);

      box-shadow:
      0 28px 80px rgba(0,0,0,0.6);
    }

    @keyframes fadeUp{

      from{
        opacity:0;
        transform:translateY(15px);
      }

      to{
        opacity:1;
        transform:translateY(0);
      }

    }

    .title{

      text-align:center;

      color:#FFB800;

      font-size:28px;

      font-weight:700;

      margin-bottom:10px;
    }

    .subtitle{

      text-align:center;

      color:#cbd5e1;

      font-size:13px;

      line-height:1.6;

      margin-bottom:28px;
    }

    .input-group{
      margin-bottom:18px;
    }

    .input-group input{

      width:100%;

      padding:15px 16px;

      border:none;

      border-radius:14px;

      outline:none;

      font-size:14px;

      background:#fff;

      transition:.25s ease;

      border:2px solid transparent;

      font-family:'Poppins',sans-serif;
    }

    .input-group input:focus{

      border-color:#FFB800;

      box-shadow:
      0 0 0 4px rgba(255,184,0,0.15);
    }

    .input-group input::placeholder{
      color:#999;
    }

    .input-icon-wrap{
      position:relative;
    }

    .input-icon-wrap input{
      padding-right:52px;
    }

    .toggle-pw{

      position:absolute;

      top:50%;
      right:15px;

      transform:translateY(-50%);

      border:none;

      background:none;

      cursor:pointer;

      font-size:18px;

      color:#888;

      transition:.2s ease;
    }

    .toggle-pw:hover{
      color:#FFB800;
    }

    .btn-reset{

      width:100%;

      padding:15px;

      border:none;

      border-radius:16px;

      background:#FFB800;

      color:#1a2a6c;

      font-size:15px;

      font-weight:700;

      cursor:pointer;

      transition:.25s ease;

      box-shadow:
      0 10px 24px rgba(255,184,0,0.35);
    }

    .btn-reset:hover{

      background:#ffca40;

      transform:translateY(-1px);
    }

    .btn-reset:disabled{
      opacity:.7;
      cursor:not-allowed;
    }

    .message{

      margin-top:18px;

      text-align:center;

      min-height:20px;

      font-size:13px;

      font-weight:500;
    }

    .success{
      color:#4ade80;
    }

    .error{
      color:#ff8b8b;
    }

    .spinner{

      display:none;

      width:18px;
      height:18px;

      border:2px solid #1a2a6c;

      border-top-color:transparent;

      border-radius:50%;

      animation:spin .7s linear infinite;

      margin:auto;
    }

    @keyframes spin{

      to{
        transform:rotate(360deg);
      }

    }

    .btn-reset.loading .spinner{
      display:block;
    }

    .btn-reset.loading .btn-text{
      display:none;
    }

    .back-login{

      margin-top:22px;

      text-align:center;

      font-size:13px;

      color:#dbe4ff;
    }

    .back-login a{

      color:#FFB800;

      text-decoration:none;

      font-weight:600;
    }

    .back-login a:hover{
      text-decoration:underline;
    }

  </style>
</head>

<body>

<div class="container">

  <div class="logo-wrapper">

    <img
      src="{{ asset('logo.png') }}"
      alt="Logo"
    >

  </div>

  <form
    class="card"
    id="resetForm"
  >

    <h1 class="title">
      Reset Password
    </h1>

    <p class="subtitle">
      Masukkan email dan password baru
      untuk mengakses akun kembali.
    </p>

    <div class="input-group">

      <input
        type="email"
        id="email"
        placeholder="Masukkan Email"
        required
        autocomplete="off"
      >

    </div>

    <div class="input-group">

      <div class="input-icon-wrap">

        <input
          type="password"
          id="password"
          placeholder="Password Baru"
          required
          autocomplete="new-password"
        >

        <button
          type="button"
          class="toggle-pw"
          onclick="togglePw('password')"
        >
          👁
        </button>

      </div>

    </div>

    <div class="input-group">

      <div class="input-icon-wrap">

        <input
          type="password"
          id="password_confirmation"
          placeholder="Konfirmasi Password"
          required
          autocomplete="new-password"
        >

        <button
          type="button"
          class="toggle-pw"
          onclick="togglePw('password_confirmation')"
        >
          👁
        </button>

      </div>

    </div>

    <button
      type="submit"
      class="btn-reset"
      id="submitBtn"
    >

      <span class="btn-text">
        Reset Password
      </span>

      <div class="spinner"></div>

    </button>

    <div
      class="message"
      id="msg"
    ></div>

    <div class="back-login">

      Sudah ingat password?

      <a href="{{ url('/login') }}">
        Login di sini
      </a>

    </div>

  </form>

</div>

<script>

  function togglePw(id){

    const input =
    document.getElementById(id);

    input.type =
    input.type === "password"
    ? "text"
    : "password";
  }

  document
  .getElementById("resetForm")
  .addEventListener(
    "submit",
    async function(e){

      e.preventDefault();

      const email =
      document
      .getElementById("email")
      .value
      .trim();

      const password =
      document
      .getElementById("password")
      .value;

      const confirm =
      document
      .getElementById("password_confirmation")
      .value;

      const btn =
      document.getElementById("submitBtn");

      const msg =
      document.getElementById("msg");

      msg.className = "message";
      msg.textContent = "";

      if(
        !email ||
        !password ||
        !confirm
      ){

        msg.classList.add("error");

        msg.textContent =
        "Semua field wajib diisi.";

        return;
      }

      if(password !== confirm){

        msg.classList.add("error");

        msg.textContent =
        "Konfirmasi password tidak cocok.";

        return;
      }

      if(password.length < 8){

        msg.classList.add("error");

        msg.textContent =
        "Password minimal 8 karakter.";

        return;
      }

      btn.classList.add("loading");
      btn.disabled = true;

      try{

        const res =
        await fetch(
          "/api/reset-password",
          {

            method:"POST",

            headers:{
              "Content-Type":"application/json",
              "Accept":"application/json"
            },

            body:JSON.stringify({

              email,
              password,
              password_confirmation:confirm

            })

          }
        );

        const result =
        await res.json();

        console.log(result);

        if(!res.ok){

          msg.classList.add("error");

          msg.textContent =
          result.message ||
          "Gagal reset password.";

          return;
        }

        msg.classList.add("success");

        msg.textContent =
        result.message ||
        "Password berhasil direset!";

        document
        .getElementById("resetForm")
        .reset();

        setTimeout(() => {

          window.location.href =
          "/login";

        }, 1500);

      }
      catch(error){

        console.error(error);

        msg.classList.add("error");

        msg.textContent =
        "Tidak dapat terhubung ke server.";

      }
      finally{

        btn.classList.remove("loading");

        btn.disabled = false;

      }

    }
  );

</script>

</body>
</html>