function showPassword(button, inputSelector) {
    const input = $(`#${inputSelector}`);
    const isPassword = input.attr("type") === "password"

    input.attr("type", isPassword ? "text" : "password")

    $(`#${button}`).html(
        isPassword 
        ? '<i class="fa-regular fa-eye-slash"></i>' 
        : '<i class="fa-regular fa-eye"></i>'
    )
}