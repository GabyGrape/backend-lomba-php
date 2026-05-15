<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Login</title>

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
      max-width:400px;
    }

    .logo-wrapper{
      display:flex;
      justify-content:center;
      margin-bottom:18px;
    }

    .logo-wrapper img{
      width:80px;
      height:90px;
      object-fit:contain;
    }

    .card{

      background:
      rgba(26,42,108,0.88);

      backdrop-filter:blur(14px);

      border:
      1px solid rgba(255,255,255,0.08);

      border-radius:24px;

      padding:38px 32px;

      box-shadow:
      0 20px 60px rgba(0,0,0,0.45);

      animation:fadeUp .5s ease;

      transition:.3s ease;
    }

    .card:hover{
      transform:translateY(-3px);

      box-shadow:
      0 25px 70px rgba(0,0,0,0.6);
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

      margin-bottom:28px;

      letter-spacing:1px;
    }

    .input-group{
      margin-bottom:18px;
    }

    .input-group input{

      width:100%;

      padding:14px 16px;

      border:none;

      border-radius:12px;

      outline:none;

      font-size:14px;

      background:#fff;

      transition:.2s ease;

      border:2px solid transparent;
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
      padding-right:48px;
    }

    .toggle-pw{

      position:absolute;

      top:50%;
      right:14px;

      transform:translateY(-50%);

      border:none;

      background:none;

      cursor:pointer;

      font-size:18px;

      color:#888;
    }

    .forgot-link{

      display:block;

      text-align:right;

      margin-top:-6px;

      margin-bottom:22px;

      text-decoration:none;

      color:#dbe4ff;

      font-size:13px;

      transition:.2s;
    }

    .forgot-link:hover{
      color:#FFB800;
    }

    .btn-login{

      width:100%;

      padding:14px;

      border:none;

      border-radius:14px;

      background:#FFB800;

      color:#1a2a6c;

      font-size:15px;

      font-weight:700;

      cursor:pointer;

      transition:.2s ease;

      box-shadow:
      0 8px 20px rgba(255,184,0,0.35);
    }

    .btn-login:hover{
      background:#ffca40;
      transform:translateY(-1px);
    }

    .btn-login:disabled{
      opacity:.7;
      cursor:not-allowed;
    }

    .message{

      margin-top:18px;

      text-align:center;

      min-height:20px;

      font-size:13px;

      color:#ff8b8b;
    }

    .success{
      color:#4ade80;
    }

    .login-link{

      margin-top:22px;

      text-align:center;

      color:#dbe4ff;

      font-size:13px;
    }

    .login-link a{

      color:#FFB800;

      text-decoration:none;

      font-weight:600;
    }

    .login-link a:hover{
      text-decoration:underline;
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

    .btn-login.loading .spinner{
      display:block;
    }

    .btn-login.loading .btn-text{
      display:none;
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
    id="loginForm"
  >

    <h1 class="title">
      LOGIN
    </h1>

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
          placeholder="Masukkan Password"
          required
          autocomplete="current-password"
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

    <a
      href="{{ url('/forgot-password') }}"
      class="forgot-link"
    >
      Lupa Password?
    </a>

    <button
      type="submit"
      class="btn-login"
      id="loginBtn"
    >

      <span class="btn-text">
        Login
      </span>

      <div class="spinner"></div>

    </button>

    <div
      class="message"
      id="msg"
    ></div>

    <div class="login-link">

      Belum punya akun?

      <a href="{{ url('/register') }}">
        Register di sini
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
  .getElementById("loginForm")
  .addEventListener(
    "submit",
    async function(e){

      e.preventDefault();

      const btn =
      document.getElementById("loginBtn");

      const msg =
      document.getElementById("msg");

      msg.textContent = "";
      msg.classList.remove("success");

      const data = {

        email:
        document
        .getElementById("email")
        .value
        .trim(),

        password:
        document
        .getElementById("password")
        .value

      };

      if(
        !data.email ||
        !data.password
      ){

        msg.textContent =
        "Email dan password wajib diisi.";

        return;
      }

      btn.classList.add("loading");
      btn.disabled = true;

      try{

        const res =
        await fetch(
          "/api/login",
          {

            method:"POST",

            headers:{
              "Content-Type":"application/json",
              "Accept":"application/json"
            },

            body:JSON.stringify(data)

          }
        );

        const result =
        await res.json();

        console.log(result);

        if(!res.ok){

          msg.textContent =
          result.message ||
          "Login gagal";

          return;
        }

        localStorage.setItem(
          "token",
          result.token
        );

        localStorage.setItem(
          "user",
          JSON.stringify(result.user)
        );

        msg.classList.add("success");

        msg.textContent =
        "Login berhasil...";

        // JADI INI (sementara berdasarkan email)
const role = result.user.role;
const email = result.user.email;

setTimeout(() => {
    if(role === "pedagang" || email.includes("pedagang")){
        window.location.href = "/dashboard/seller";
    }
    else if(role === "konsumen" || email.includes("konsumen")){
        window.location.href = "/dashboard/consument";
    }
    else{
        window.location.href = "/dashboard/seller"; // default sementara
    }
}, 800);

      }
      catch(error){

        console.error(error);

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