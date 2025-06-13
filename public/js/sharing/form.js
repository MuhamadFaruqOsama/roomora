const disableForm = (e, buttonName) => {
    e.preventDefault()
    const buttonComponent = document.getElementById(`button-${buttonName}`)
    buttonComponent.disabled = true
    buttonComponent.classList.remove('hover:bg-[#ff6392]', 'cursor-pointer')
    buttonComponent.classList.replace('bg-[#ff6392]', 'bg-[#ff639288]')
    buttonComponent.innerHTML = `Processing... <span class="mini-loader ms-2"></span>`
    e.target.submit()
}