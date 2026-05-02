<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>

<form id="loginForm">
    <input type="email" id="email" placeholder="Email" required><br><br>
    <input type="password" id="password" placeholder="Password" required><br><br>

    <button type="submit">Login</button>
</form>

<script>
document.getElementById("loginForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const data = {
        email: document.getElementById("email").value,
        password: document.getElementById("password").value
    };

    try {
        const res = await fetch("/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json"
            },
            body: JSON.stringify(data)
        });

        const result = await res.json();

        if (!res.ok) {
            alert(result.message || "Login gagal");
            return;
        }

        // ✅ simpan token & user
        localStorage.setItem("token", result.token);
        localStorage.setItem("user", JSON.stringify(result.user));

        // =========================
        // 🔥 REDIRECT SESUAI ROLE
        // =========================
        const role = result.user.role;

        if (role === "pedagang") {
            window.location.href = "/dashboard/seller";
        } 
        else if (role === "konsumen") {
            window.location.href = "/dashboard/consument";
        } 
        else {
            window.location.href = "/";
        }

    } catch (error) {
        console.error(error);
        alert("Error koneksi ke server");
    }
});
</script>

</body>
</html>