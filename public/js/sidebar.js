document.addEventListener('DOMContentLoaded', () => {

    const sidebar = document.getElementById('smenu')

    sidebar.addEventListener('click', () => {
        document.getElementById('sidebar').style.transform = "translateX(350px)"
    })

})