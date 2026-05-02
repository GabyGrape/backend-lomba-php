<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

<form id="registerForm">

    <input type="text" id="name" placeholder="Nama Lengkap" required><br><br>

    <input type="email" id="email" placeholder="Email" required><br><br>

    <input type="password" id="password" placeholder="Password" required><br><br>

    <!-- ROLE -->
    <select id="role" required>
        <option value="">Pilih Role</option>
        <option value="pedagang">Pedagang</option>
        <option value="konsumen">Konsumen</option>
    </select><br><br>

    <!-- TAMBAHAN UNTUK PEDAGANG -->
    <input type="text" id="nama_warung" placeholder="Nama Warung (opsional)"><br><br>

    <textarea id="alamat_warung" placeholder="Alamat Warung (opsional)"></textarea><br><br>

    <button type="submit">Register</button>

</form>

<p id="message"></p>

<p>
    Sudah punya akun?
    <a href="/login">Login di sini</a>
</p>

<script>
document.getElementById("registerForm")
.addEventListener("submit", async function(e) {
    e.preventDefault();

    const message = document.getElementById("message");
    message.innerText = "Loading...";

    const data = {
        name: document.getElementById("name").value,
        email: document.getElementById("email").value,
        password: document.getElementById("password").value,
        role: document.getElementById("role").value,
        nama_warung: document.getElementById("nama_warung").value || null,
        alamat_warung: document.getElementById("alamat_warung").value || null
    };

    try {
        const res = await fetch("/api/register", {
            method: "POST",
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await res.json();

        if (!res.ok) {
            console.error(result);
            message.innerText = "❌ " + (result.message || "Register gagal");
            return;
        }

        // ✅ simpan token & user
        localStorage.setItem("token", result.token);
        localStorage.setItem("user", JSON.stringify(result.user));

        // 🔥 redirect sesuai role
        if (result.user.role === "pedagang") {
            window.location.href = "/dashboard/seller";
        } else {
            window.location.href = "/dashboard/consument";
        }

    } catch (error) {
        console.error(error);
        message.innerText = "❌ Server error";
    }
});
</script>

</body>
</html>