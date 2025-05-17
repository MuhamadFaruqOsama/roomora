const disableForm = (e, buttonName) => {
    e.preventDefault()
    const buttonComponent = document.getElementById(`button-${buttonName}`)
    buttonComponent.disabled = true
    buttonComponent.classList.remove('hover:bg-[#FBBC05]', 'cursor-pointer')
    buttonComponent.classList.replace('bg-[#FBBC05]', 'bg-[#fbbd059a]')
    buttonComponent.innerHTML = `Processing... <span class="mini-loader ms-2"></span>`
    e.target.submit()
}