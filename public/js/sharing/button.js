function processing(id) {
    const button = $(`#${id}`)
    
    button.innerHTML = `
    <div class="flex gap-3 items-center justify-center">
        processing <span class="mini-loader"></span>
    </div>`
}