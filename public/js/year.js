window.addEventListener('load', () => {
    const date = new Date()
    const year = date.getFullYear()
    const y = document.getElementById('year')

    y.innerHTML += ` ${year}`
})