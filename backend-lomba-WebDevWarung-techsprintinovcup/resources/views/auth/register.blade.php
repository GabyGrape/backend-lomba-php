<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

  <title>Register</title>

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
    }

    .input-group{
      margin-bottom:18px;
    }

    .input-group input,
    .input-group select,
    .input-group textarea{

      width:100%;

      padding:14px 16px;

      border:none;

      border-radius:12px;

      outline:none;

      font-size:14px;

      background:#fff;

      transition:.2s ease;

      border:2px solid transparent;

      font-family:'Poppins',sans-serif;
    }

    .input-group textarea{
      resize:none;
      height:90px;
    }

    .input-group input:focus,
    .input-group select:focus,
    .input-group textarea:focus{

      border-color:#FFB800;

      box-shadow:
      0 0 0 4px rgba(255,184,0,0.15);
    }

    .input-group input::placeholder,
    .input-group textarea::placeholder{
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

    .pedagang-fields{
      display:none;
    }

    .divider{

      border:none;

      border-top:
      1px solid rgba(255,255,255,0.15);

      margin:16px 0;
    }

    .btn-register{

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

    .btn-register:hover{
      background:#ffca40;
      transform:translateY(-1px);
    }

    .btn-register:disabled{
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

    .btn-register.loading .spinner{
      display:block;
    }

    .btn-register.loading .btn-text{
      display:none;
    }

  </style>
</head>

<body>

<div class="container">

  <div class="logo-wrapper">
    <img src="{{ asset('logo.png') }}" alt="Logo">
  </div>

  <form class="card" id="registerForm">

    <h1 class="title">
      REGISTER
    </h1>

    <div class="input-group">

      <input
        type="text"
        id="name"
        placeholder="Nama Lengkap"
        required
      >

    </div>

    <div class="input-group">

      <input
        type="email"
        id="email"
        placeholder="Masukkan Email"
        required
      >

    </div>

    <div class="input-group">

      <div class="input-icon-wrap">

        <input
          type="password"
          id="password"
          placeholder="Masukkan Password"
          required
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

      <select
        id="role"
        required
        onchange="togglePedagang()"
      >

        <option value="">
          Pilih Role
        </option>

        <option value="pedagang">
          Pedagang
        </option>

        <option value="konsumen">
          Konsumen
        </option>

      </select>

    </div>

    <div
      class="pedagang-fields"
      id="pedagangFields"
    >

      <hr class="divider">

      <div class="input-group">

        <input
          type="text"
          id="nama_warung"
          placeholder="Nama Warung (Opsional)"
        >

      </div>

      <div class="input-group">

        <textarea
          id="alamat_warung"
          placeholder="Alamat Warung (Opsional)"
        ></textarea>

      </div>

    </div>

    <button
      type="submit"
      class="btn-register"
      id="registerBtn"
    >

      <span class="btn-text">
        Register
      </span>

      <div class="spinner"></div>

    </button>

    <div
      class="message"
      id="message"
    ></div>

    <div class="login-link">

      Sudah punya akun?

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

  function togglePedagang(){

    const role =
    document.getElementById("role").value;

    const fields =
    document.getElementById("pedagangFields");

    fields.style.display =
    role === "pedagang"
    ? "block"
    : "none";
  }

  document
  .getElementById("registerForm")
  .addEventListener(
    "submit",
    async function(e){

      e.preventDefault();

      const message =
      document.getElementById("message");

      const btn =
      document.getElementById("registerBtn");

      message.textContent = "";
      message.classList.remove("success");

      const data = {

        name:
        document
        .getElementById("name")
        .value
        .trim(),

        email:
        document
        .getElementById("email")
        .value
        .trim(),

        password:
        document
        .getElementById("password")
        .value,

        role:
        document
        .getElementById("role")
        .value,

        nama_warung:
        document
        .getElementById("nama_warung")
        .value,

        alamat_warung:
        document
        .getElementById("alamat_warung")
        .value
      };

      if(
        !data.name ||
        !data.email ||
        !data.password ||
        !data.role
      ){

        message.textContent =
        "Semua field wajib diisi.";

        return;
      }

      btn.classList.add("loading");
      btn.disabled = true;

      try{

        const res =
        await fetch(
          "/api/register",
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

          message.textContent =
          result.message ||
          "Register gagal";

          return;
        }

        // TIDAK AUTO LOGIN

        message.classList.add("success");

        message.textContent =
        "Register berhasil! Redirect ke login...";

        setTimeout(() => {

          window.location.href =
          "/login";

        }, 1500);

      }
      catch(error){

        console.error(error);

        message.textContent =
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