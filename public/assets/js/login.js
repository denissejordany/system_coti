document.querySelectorAll(".switch-link").forEach(link => {
    link.addEventListener("click", () => {
        const target = link.dataset.target;

        document.querySelectorAll(".form").forEach(f => f.classList.remove("active"));

        document.getElementById(
            target === "login" ? "form-login" : "form-register"
        ).classList.add("active");
    });
});
