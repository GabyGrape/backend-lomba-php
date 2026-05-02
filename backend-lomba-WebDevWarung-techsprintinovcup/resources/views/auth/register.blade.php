<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form id="registerForm">
    <input type="text" id="name" placeholder="Nama" required><br><br>
    <input type="email" id="email" placeholder="Email" required><br><br>
    <input type="password" id="password" placeholder="Password" required><br><br>

    <select id="role">
        <option value="konsumen">Konsumen</option>
        <option value="pedagang">Pedagang</option>
    </select><br><br>

    <button type="submit">Register</button>
</form>

<p id="message"></p>
<p>
    Sudah punya akun?
    <a href="/login">Login di sini</a>
</p>

<script>
document.getElementById("registerForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value,
        role: document.getElementById("role").value
    };

    const res = await fetch("/api/register", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json"
        },
        body: JSON.stringify(data)
    });

    const result = await res.json();

   if (res.ok) {
    localStorage.setItem("token", result.token);

    document.getElementById("message").innerText = "Register berhasil! Redirect ke login...";

    setTimeout(() => {
        window.location.href = "/login";
    }, 1500); 
}
});
</script>

</body>
</html>